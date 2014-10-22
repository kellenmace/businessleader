<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Business Leader
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				if ( 'aside' == get_post_format() ) {
					get_template_part( 'partials/content', 'aside' );
				}
				else {
					get_template_part( 'content', get_post_format() );
				}
				?>

			<?php endwhile; ?>

			<?php bus_leader_paging_nav(); ?>

		<?php else : ?>
			
			<?php get_template_part( 'partials/content', 'none' ); ?>
			
		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
