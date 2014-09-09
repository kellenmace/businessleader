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
	        echo the_post_thumbnail('index-thumb');
	        echo '</a>';
	        echo '</div><!-- .small-index-thumbnail -->';
	    }
		?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php bus_leader_posted_on(); ?>
				<?php
				    if ( ! post_password_required() && comments_open() && '0' != get_comments_number() ) { 
				        echo '<span class="comments-link"> • ';
				        comments_popup_link( '', __( '1 Comment', 'bus_leader' ), __( '% Comments', 'bus_leader' ) );
				        echo '</span>';
				    }
				?>
				<?php edit_post_link( __( 'Edit', 'bus_leader' ), '<span class="edit-link"> • ', '</span>' ); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer read-more">
			<?php echo '<a href="' . get_permalink() . '" title="' . __('Read more ', 'bus_leader') . get_the_title() . '" rel="bookmark">Read more</a>'; ?>
		</footer><!-- .entry-footer -->
	</div><!-- .index-box -->
</article><!-- #post-## -->
