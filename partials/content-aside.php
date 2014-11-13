<?php
/**
 * The template part for the aside post format
 *
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php bus_leader_posted_on(); ?>
		<?php bus_leader_comments_link(); ?>
		<?php bus_leader_edit_link() ?>
	</footer><!-- .entry-footer -->
    </div>
</article><!-- #post-## -->