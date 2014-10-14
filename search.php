<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Business Leader
 */

get_header(); ?>

	<div class='featured-image-banner'>
		<header class="page-header">
			<h1 class="page-title"><i class="fa fa-times-circle"></i> Nothing found</h1>
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

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'bus_leader' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
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
