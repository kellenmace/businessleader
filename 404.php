<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Business Leader
 */

get_header(); ?>

<div class='featured-image-banner'>
	<header class="page-header">
		<h1 class="page-title"><i class="fa fa-times-circle"></i> Page not available</h1>
	</header><!-- .page-header -->
</div><!-- .featured-image-banner -->

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

			<?php get_template_part( 'partials/content', 'none' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
