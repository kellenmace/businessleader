<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Business Leader
 */

get_header(); ?>

	<?php
	// TODO: add a default parallax image to display when no featured image has been selected.
	// Same as front page image? Add as option in theme customizer?
    if ( has_post_thumbnail() ) {
        echo '<div class="single-post-featured-image clear">';
        echo the_post_thumbnail('large-thumb');
        echo '</div><!-- .single-post-featured-image -->';
    }
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'partials/content', 'single' ); ?>

			<?php bus_leader_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>