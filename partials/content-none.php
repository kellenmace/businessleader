<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package Business Leader
 */
?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
    <div class="index-box">
    	<header class="entry-header">
    		<h1 class="entry-title">
                        <?php 
                        if ( is_404() ) { _e( 'Page not available', 'bus_leader' ); }
                        else if ( is_search() ) { printf( __( 'Nothing found for %s', 'bus_leader' ), '<em>' . get_search_query() . '</em>' ); }
                        else { _e( 'Nothing Found', 'bus_leader' ); }
                        ?>
                    </h1>
    	</header>

    	<div class="entry-content">
    		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bus_leader' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
                            
                    <?php elseif ( is_404() ) : ?>
                            
                            <p><?php _e( 'Sorry &mdash; that page can&rsquo;t be found. You can view the most recent articles below or try a search:', 'bus_leader' ); ?></p>
                            <?php get_search_form(); ?>
                            
    		<?php elseif ( is_search() ) : ?>

    			<p><?php _e( 'Sorry &mdash; nothing matched your search terms. You can view the most recent articles below or try a search:', 'bus_leader' ); ?></p>
    			<?php get_search_form(); ?>

    		<?php else : ?>

    			<p><?php _e( 'Sorry &mdash; it seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bus_leader' ); ?></p>
    			<?php get_search_form(); ?>

    		<?php endif; ?>
    	</div><!-- .entry-content -->
    </div><!-- .index-box -->
    
    <?php
    if ( is_404() || is_search() ) {
        
        ?>
    <div class="index-box index-page-header">
        <header class="page-header"><h1 class="page-title">Recent posts:</h1></header>
    </div><!-- .index-box -->
    <?php
        // Get the 6 latest posts
        $args = array(
            'posts_per_page' => 6
        );

        $latest_posts_query = new WP_Query( $args );

        // The Loop
        if ( $latest_posts_query->have_posts() ) {
                while ( $latest_posts_query->have_posts() ) {

                    $latest_posts_query->the_post();
                    
                    if ( 'aside' == get_post_format() ) {
                        get_template_part( 'partials/content', 'aside' );
                    }
                    else {
                        get_template_part( 'content', get_post_format() );
                    }

                }
        }
        /* Restore original Post Data */
        wp_reset_postdata();

    }
    ?>
    
</section><!-- .no-results -->
