<?php
/**
 * @package WordPress
 * @subpackage P2
 */
?>

<?php if ( post_password_required() )
	return;
?>

<?php if ( get_comments_number() > 0 ) : ?>
<ul class="commentlist inlinecomments">
	<?php wp_list_comments( array( 'callback' => 'p2_responsive_comments' ) ); ?>
</ul>
<?php endif; ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<div class="navigation">
	<p class="nav-older"><?php previous_comments_link( __( '&larr; Older Comments', 'p2' ) ); ?></p>
	<p class="nav-newer"><?php next_comments_link( __( 'Newer Comments &rarr;', 'p2' ) ); ?></p>
</div>
<?php endif; ?>