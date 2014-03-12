<?php

// Modernizr for HTML5 and media query support for older browsers
// FitVids.js for responsive embedded videos
add_action( 'wp_enqueue_scripts', 'p2_responsive_js' );
function p2_responsive_js() {
	wp_enqueue_script( 'Modernizr', get_stylesheet_directory_uri() . '/js/modernizr.min.js', '', '2.0.6');
	wp_enqueue_script( 'FitVids', get_stylesheet_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0' );
}


// Enable Figure + FigCaption for images and remove width style from caption so it responds well.
function mytheme_caption( $attr, $content = null ) {
    $output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
    if ( $output != '' )
        return $output;

    extract( shortcode_atts ( array(
    'id' => '',
    'align' => 'alignnone',
    'width'=> '',
    'caption' => ''
    ), $attr ) );

    if ( 1 > (int) $width || empty( $caption ) )
        return $content;

    if ( $id ) $id = 'id="' . $id . '" ';

    return '<figure ' . $id . 'class="wp-caption ' . $align . '" >'
. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

add_shortcode( 'wp_caption', 'mytheme_caption' );
add_shortcode( 'caption', 'mytheme_caption' );

// Rewriten p2_comments with span.actions at the bottom
function p2_responsive_comments( $comment, $args ) {
	$GLOBALS['comment'] = $comment;

	if ( !is_single() && get_comment_type() != 'comment' )
		return;

	$depth          = prologue_get_comment_depth( get_comment_ID() );
	$can_edit_post  = current_user_can( 'edit_post', $comment->comment_post_ID );

	$reply_link     = prologue_get_comment_reply_link(
		array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => ' | ', 'reply_text' => __( 'Reply', 'p2' ) ),
		$comment->comment_ID, $comment->comment_post_ID );

	$content_class  = 'commentcontent';
	if ( $can_edit_post )
		$content_class .= ' comment-edit';

	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php do_action( 'p2_comment' ); ?>

		<?php echo get_avatar( $comment, 32 ); ?>
		<h4>
			<?php echo get_comment_author_link(); ?>
			<span class="meta">
				<?php echo p2_date_time_with_microformat( 'comment' ); ?>

			</span>
		</h4>
		<div id="commentcontent-<?php comment_ID(); ?>" class="<?php echo esc_attr( $content_class ); ?>"><?php
				echo apply_filters( 'comment_text', $comment->comment_content );

				if ( $comment->comment_approved == '0' ): ?>
					<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'p2' ); ?></em></p>
				<?php endif; ?>

				<span class="actions">
					<a href="<?php echo esc_url( get_comment_link() ); ?>"><?php _e( 'Permalink', 'p2' ); ?></a>
					<?php
					echo $reply_link;

					if ( $can_edit_post )
						edit_comment_link( __( 'Edit', 'p2' ), ' | ' );

					?>
				</span>
		</div>

	<?php
}

add_action( 'after_setup_theme', 'p2_responsive_remove_iPhone' );
function p2_responsive_remove_iPhone () {
	remove_action( 'wp_enqueue_scripts', 'p2_iphone_style', 1000 );
}