<?php
/**
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php bus_leader_posted_on(); ?>
		<?php
		    if ( ! post_password_required() && comments_open() && '0' != get_comments_number() ) { 
		        echo '<span class="comments-link"> • ';
		        comments_popup_link( '', __( '1 Comment', 'bus_leader' ), __( '% Comments', 'bus_leader' ) );
		        echo '</span>';
		    }
		?>
		<?php edit_post_link( __( 'Edit', 'bus_leader' ), '<span class="edit-link"> • ', '</span>' ); ?>
	</footer><!-- .entry-footer -->
    </div>
</article><!-- #post-## -->