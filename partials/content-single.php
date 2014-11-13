<?php
/**
 * The template part for displaying page content in single.php
 * 
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php bus_leader_posted_on(); ?>
			<?php bus_leader_comments_link(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bus_leader' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = ( is_attachment() ? get_the_category_list( ', ','bus_leader',$post->post_parent ) : get_the_category_list( __( ', ', 'bus_leader' ) ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'bus_leader' ) );

			if ( ! bus_leader_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<div class="tag-list">' . __( 'Tagged %2$s', 'bus_leader' ) . '</div>';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<div class="category-list">' . __( 'Filed under %1$s', 'bus_leader' ) . '</div><div class="tag-list">' . __( 'Tagged %2$s', 'bus_leader' ) . '</div>';
				} else {
					$meta_text = '<div class="category-list">' . __( 'Filed under %1$s', 'bus_leader' ) . '</div>';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'bus_leader' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
