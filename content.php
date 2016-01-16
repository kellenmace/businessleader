<?php
/**
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="index-box">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="small-index-thumbnail clear">
				<?php printf( __( '<a href="%1$s" title="Read %2$s" rel="bookmark">%3$s</a>', 'bus_leader' ), esc_url( get_permalink() ), esc_attr( get_the_title() ), get_the_post_thumbnail( null, 'index-thumb' ) ); ?>
			</div><!-- .small-index-thumbnail -->
		<?php endif ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php bus_leader_posted_on(); ?>
				<?php bus_leader_comments_link(); ?>
				<?php bus_leader_edit_link() ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer read-more">
			<?php sprintf( esc_html__( '<a href="%1$s" title="Read More %2$s" rel="bookmark">Read More<span class="screen-reader-text">%3$s</span></a>', 'bus_leader' ), esc_url( get_permalink() ), esc_attr( get_the_title() ), esc_html( get_the_title() ) ); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .index-box -->
</article><!-- #post-## -->
