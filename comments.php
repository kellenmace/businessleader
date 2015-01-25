<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Business Leader
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Comments</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'bus_leader_comment',
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation clear" role="navigation">
		    <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'bus_leader' ); ?></h1>
		    <?php previous_comments_link( '<div class="nav-previous"><i class="fa fa-angle-left"></i>' . __( ' Older Comments', 'bus_leader' ) . '</div>'); ?>
		    <?php next_comments_link( '<div class="nav-next">' . __( 'Newer Comments ', 'bus_leader' ) . '<i class="fa fa-angle-right"></i></div>' ); ?>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'bus_leader' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
