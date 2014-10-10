<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business Leader
 */

get_header(); ?>

	<?php
	// TODO: add upload option & integrate customizer
    // if ( has_post_thumbnail( $post->ID ) ) {
	// $featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large-thumb' )[0];
		$featured_image_url = get_template_directory_uri() . '/images/default-featured-image.jpg';
	?>
	<div class="single-post-featured-image" style="background-image: url('<?php echo $featured_image_url ?>')">
	</div><!-- .single-post-featured-image -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
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
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
