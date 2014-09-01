<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business Leader
 */

if ( ! function_exists( 'bus_leader_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function bus_leader_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'bus_leader' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bus_leader' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bus_leader' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bus_leader_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function bus_leader_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="post-nav-box clear">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'bus_leader' ); ?></h1>
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous"><div class="nav-indicator">%link</div>', _x( 'Previous Post', 'Previous post', 'bus_leader' ) );
					previous_post_link( '<h1>%link</h1></div>', '%title' );
					next_post_link(		'<div class="nav-next"><div class="nav-indicator">%link</div>', _x( 'Next Post', 'Next post', 'bus_leader' ) );
					next_post_link(		'<h1>%link</h1></div>', '%title' );
				?>
			</div><!-- .nav-links -->
		</div><!-- .post-nav-box -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bus_leader_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bus_leader_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span><span class="byline"> • Posted by %2$s</span>', 'bus_leader' ),
		$time_string,
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bus_leader_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bus_leader_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bus_leader_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bus_leader_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bus_leader_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bus_leader_categorized_blog.
 */
function bus_leader_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'bus_leader_categories' );
}
add_action( 'edit_category', 'bus_leader_category_transient_flusher' );
add_action( 'save_post',     'bus_leader_category_transient_flusher' );

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
if ( ! function_exists( 'bus_leader_comment' ) ) :
	function bus_leader_comment( $comment, $args, $depth ) {
	    $GLOBALS['comment'] = $comment;
	    switch ( $comment->comment_type ) :
	        case 'pingback' :
	        case 'trackback' :
	    ?>
	    <li class="post pingback">
	        <p><?php _e( 'Pingback:', 'bus_leader' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'bus_leader' ), ' ' ); ?></p>
	    <?php
	            break;
	        default :
	    ?>
	    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
	            <footer class="comment-meta">
	                <div class="comment-author vcard">
	                    <?php echo get_avatar( $comment, 65 ); ?>
	                    <?php printf( '<b class="fn">%s</b>', get_comment_author_link() ); ?>
	                </div><!-- .comment-author .vcard -->
	                <?php if ( $comment->comment_approved == '0' ) : ?>
	                    <em><?php _e( 'Your comment is awaiting moderation.', 'bus_leader' ); ?></em>
	                    <br />
	                <?php endif; ?>
	 
	                <div class="comment-metadata">
	                    <time pubdate datetime="<?php comment_time( 'c' ); ?>">
	                    <?php
	                        printf( __( '%1$s', 'bus_leader' ), get_comment_date() ); ?>
	                    </time>
	                    <?php edit_comment_link( __( '(Edit)', 'bus_leader' ), ' ' );
	                    ?>
	                </div><!-- .comment-meta .commentmetadata -->
	            </footer>
	 
	            <div class="comment-content"><?php comment_text(); ?></div>
	 
	            <div class="reply">
	                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	            </div><!-- .reply -->
	        </article><!-- #comment-## -->
	 
	    <?php
	            break;
	    endswitch;
	}
endif;

