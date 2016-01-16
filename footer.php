<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Business Leader
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
			<?php printf( '&copy; %1$s <a href="%2$s" rel="site url">%3$s</a>', esc_html( date( 'Y' ) ), esc_url( get_site_url() ), esc_html( get_bloginfo( 'name' ) ) ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
