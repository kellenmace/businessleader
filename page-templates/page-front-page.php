<?php
/**
 * Template Name: Front Page
 *
 * @package Business Leader
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php do_action( 'bus_leader_before_front_page_content' ); ?>

				<?php get_template_part( 'partials/content', 'front-page' ); ?>

				<?php do_action( 'bus_leader_after_front_page_content' ); ?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>