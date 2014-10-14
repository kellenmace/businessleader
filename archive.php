<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business Leader
 */

get_header(); ?>

<div class='featured-image-banner'>
	<header class="page-header">
		<h1 class="page-title">
			<?php
				if ( is_category() ) :
				    printf( __( 'Filed under ', 'bus_leader' ) );
				    echo '<em>';
				    single_cat_title();
				    echo '</em>';

				elseif ( is_tag() ) :
				    printf( __( 'Tagged as ', 'bus_leader' ) );
				    echo '<em>';
				    single_tag_title();
				    echo '</em> ' . __('tag', 'bus_leader');

				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'bus_leader' ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'bus_leader' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'bus_leader' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bus_leader' ) ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'bus_leader' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bus_leader' ) ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'bus_leader' );

				else :
					_e( 'Archives', 'bus_leader' );

				endif;
			?>
		</h1>
		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
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
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
