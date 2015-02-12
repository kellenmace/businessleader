<?php
/**
 * @package Business Leader
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="index-box">
		<?php
	    if ( has_post_thumbnail() ) {
	        echo '<div class="small-index-thumbnail clear">';
	        echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'bus_leader') . get_the_title() . '" rel="bookmark">';
	        the_post_thumbnail('index-thumb');
	        echo '</a>';
	        echo '</div><!-- .small-index-thumbnail -->';
	    }
		?>
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
			<?php echo '<a href="' . get_permalink() . '" title="' . __('Read More ', 'bus_leader') . get_the_title() . '" rel="bookmark">Read More<span class="screen-reader-text">  ' . get_the_title() . '</span></a>'; ?>
		</footer><!-- .entry-footer -->
	</div><!-- .index-box -->
</article><!-- #post-## -->
