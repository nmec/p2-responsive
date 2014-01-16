<?php
/**
 * @package WordPress
 * @subpackage P2
 */
?>
<li id="prologue-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

	/**
	 * POST META
	 */

	if ( ! is_page() ):
		$author_posts_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$posts_by_title   = sprintf(
			__( 'Posts by %1$s ( @%2$s )', 'p2' ),
			get_the_author_meta( 'display_name' ),
			get_the_author_meta( 'user_nicename' )
		); ?>

		<a href="<?php echo esc_attr( $author_posts_url ); ?>" title="<?php echo esc_attr( $posts_by_title ); ?>">
			<?php echo get_avatar( get_the_author_meta('user_email'), 48 ); ?>
		</a>
	<?php endif; ?>
	<h4>
		<?php if ( ! is_page() ): ?>
			<a href="<?php echo esc_attr( $author_posts_url ); ?>" title="<?php echo esc_attr( $posts_by_title ); ?>"><?php the_author(); ?></a>
		<?php endif; ?>
		<span class="meta">
			<?php
			if ( ! is_page() ) {
				echo p2_date_time_with_microformat();
			} ?>

			<?php if ( ! is_page() ) : ?>
				<span class="tags">
					<?php tags_with_count( '', __( '<br />Tags:' , 'p2' ) .' ', ', ', ' &nbsp;' ); ?>&nbsp;
				</span>
			<?php endif; ?>
		</span>
	</h4>

	<?php
	/**
	 * CONTENT
	 */
	?>

	<div id="content-<?php the_ID(); ?>" class="postcontent">
		<?php
		if ( 'status' == p2_get_the_category() || 'link' == p2_get_the_category() ) :
			the_content( __( '(More ...)' , 'p2' ) );

		elseif ( 'quote' == p2_get_the_category() ) :
			echo "<blockquote>";
			p2_quote_content();
			echo "</blockquote>";

		elseif ( 'post' == p2_get_the_category() ) :
			p2_title();
			the_content( __( '(More ...)' , 'p2' ) );

		else :
			p2_title();
			the_content( __( '(More ...)' , 'p2' ) );

		endif; ?>
	</div>
		<span class="actions">
				<?php if ( ! is_singular() ) : ?>
					<?php $before_reply_link = ' | '; ?>
					<a href="<?php the_permalink(); ?>" class="thepermalink"><?php _e( 'Permalink', 'p2' ); ?></a>
				<?php endif;

				if ( comments_open() && ! post_password_required() ) {
						echo post_reply_link( array(
							'before'        => isset( $before_reply_link ) ? $before_reply_link : '',
							'after'         => '',
							'reply_text'    => __( 'Reply', 'p2' ),
							'add_below'     => 'prologue'
						), get_the_ID() );
				}

				if ( current_user_can( 'edit_post', get_the_ID() ) ) : ?> | <a href="<?php echo ( get_edit_post_link( get_the_ID() ) ); ?>" class="edit-post-link" rel="<?php the_ID(); ?>"><?php _e( 'Edit', 'p2' ); ?></a>
				<?php endif; ?>

				<?php do_action( 'p2_action_links' ); ?>
			</span>
	<?php
	/**
	 * COMMENTS
	 */

	$comment_field = '<div class="form"><textarea id="comment" class="expand50-100" name="comment" cols="45" rows="3"></textarea></div> <label class="post-error" for="comment" id="commenttext_error"></label>';

	$comment_notes_before = '<p class="comment-notes">' . ( get_option( 'require_name_email' ) ? sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' ) : '' ) . '</p>';

	$comment_notes_after = sprintf(
		'<span class="progress"><img src="%1$s" alt="%2$s" title="%2$s" /></span>',
		str_replace( WP_CONTENT_DIR, content_url(), locate_template( array( "i/indicator.gif" ) ) ),
		esc_attr( 'Loading...', 'p2' )
	);

	$p2_comment_args = array(
		'title_reply'           => __( 'Reply', 'p2' ),
		'comment_field'         => $comment_field,
		'comment_notes_before'  => $comment_notes_before,
		'comment_notes_after'   => $comment_notes_after,
		'label_submit'          => __( 'Reply', 'p2' ),
		'id_submit'             => 'comment-submit',
	);

	?>

	<?php if ( get_comments_number() > 0 && ! post_password_required() ) : ?>
		<div class="discussion" style="display: none">
			<p>
				<?php p2_discussion_links(); ?>
				<a href="#" class="show-comments"><?php _e( 'Toggle Comments', 'p2' ); ?></a>
			</p>
		</div>
	<?php endif;

	wp_link_pages( array( 'before' => '<p class="page-nav">' . __( 'Pages:', 'p2' ) ) ); ?>

	<div class="bottom-of-entry">&nbsp;</div>

	<?php
	if ( ! p2_is_ajax_request() ) :
		comments_template();
		$pc = 0;
		if ( p2_show_comment_form() && $pc == 0 && ! post_password_required() ) :
			$pc++; ?>
			<div class="respond-wrap" <?php echo ( ! is_singular() ) ? 'style="display: none; "' : ''; ?>>
				<?php comment_form( $p2_comment_args ); ?>
			</div><?php
		endif;
	endif; ?>
</li>
