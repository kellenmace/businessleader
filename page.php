<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Business Leader
 */

get_header(); ?>

	<?php
	if ( has_post_thumbnail( $post->ID ) ) {
		$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large-thumb' )[0];
	}
	else {
		$featured_image_url = get_template_directory_uri() . '/images/default-featured-image.jpg';
	}
	?>
	<div class="single-post-featured-image" style="background-image: url('<?php echo $featured_image_url ?>')">
	</div><!-- .single-post-featured-image -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

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
