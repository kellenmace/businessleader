<?php
/**
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="index-box">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="small-index-thumbnail clear">
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Read ', 'bus_leader' ); ?><?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail( 'index-thumb' ); ?></a>
			</div><!-- .small-index-thumbnail -->
		<?php endif ?>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

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
			<a href="<?php the_permalink(); ?>" title="Read More <?php the_title(); ?>>" rel="bookmark"><?php esc_html_e( 'Read More', 'bus_leader' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Read More', 'bus_leader' ); ?></span></a>
		</footer><!-- .entry-footer -->
	</div><!-- .index-box -->
</article><!-- #post-## -->
