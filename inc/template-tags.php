<?php
/**
 * Custom template tags for this theme.
 *
 * @package Business Leader
 */

if ( ! function_exists( 'bus_leader_get_header_container' ) ) :
	/**
	 * Display header container with image inside
	 */
	function bus_leader_get_header_container() {
		// Issue: When a new image is chosen in the customizer, then removed,
		// get_theme_mod() returns an empty string intead of false, resulting in blank headers
		// See this issue in Trac: https://core.trac.wordpress.org/ticket/28637
		global $post;
		if ( has_post_thumbnail( $post->ID ) ) {
			$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large-thumb' );
			$featured_image_url   = $featured_image_array[0];
		}
		$header_image_setting_single       = get_theme_mod( 'bus-leader-header-image-setting-single' );
		$header_image_setting_home         = get_theme_mod( 'bus-leader-header-image-setting-home' );
		$header_image_setting_front_page   = get_theme_mod( 'bus-leader-header-image-setting-front-page' );
		$header_image_setting_pages        = get_theme_mod( 'bus-leader-header-image-setting-pages' );

		// Get featured image, else Customizer header image for single posts
		if ( is_single() ) {
			if( has_post_thumbnail( $post->ID ) ) {
				$header_image = $featured_image_url;
			}
			elseif( ! empty( $header_image_setting_single ) ) {
				$header_image = $header_image_setting_single;
			}
			else {
				$header_image = get_template_directory_uri() . '/images/default-featured-image.jpg';
			}
		}
		// Get Customizer header image for blog
		elseif ( is_home() && ! empty( $header_image_setting_home ) ) {
			$header_image = $header_image_setting_home;
		}
		// Get Customizer header image for front page
		elseif ( is_front_page() && ! empty( $header_image_setting_front_page ) ) {
			$header_image = $header_image_setting_front_page;
		}
		// Get Customizer header image for pages, archive, search & 404
		elseif ( is_page() || is_search() || is_archive() || is_404() && ! empty( $header_image_setting_pages ) ) {
			if ( has_post_thumbnail( $post->ID ) ) {
				$header_image = $featured_image_url;
			}
			elseif ( ! empty( $header_image_setting_pages ) ) {
				$header_image = $header_image_setting_pages;
			}
			else {
				$header_image = get_template_directory_uri() . '/images/default-featured-image.jpg';
			}
		}
		// Else, get default theme header image
		else {
			$header_image = get_template_directory_uri() . '/images/default-featured-image.jpg';
		}

	?>

	<div class="header-container">

		<?php
		// Display darkened background if text is displayed on top of header image
		if ( is_404() || is_search() || is_archive() ) : ?>
			<div class="header-image header-image-overlay" style="background-image: url('<?php echo esc_attr( $header_image ); ?>')"></div><!-- .header-image -->
		<?php else : ?>
			<div class="header-image" style="background-image: url('<?php echo esc_attr( $header_image ); ?>')"></div><!-- .header-image -->
		<?php endif; ?>

		<?php if ( is_404() ) : ?>
			<header class="page-header">
				<h1 class="page-title page-title-404">
					<?php _e( 'Page not available', 'bus_leader' ); ?>
				</h1>
			</header><!-- .header-title -->

		<?php elseif ( is_search() ) : ?>
			<header class="page-header">
				<h1 class="page-title page-title-search">
					<?php printf( __( 'Search results for<br><em>', 'bus_leader') . get_search_query() . '</em>' ); ?>
				</h1>
			</header><!-- .header-title -->

		<?php elseif ( is_archive() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							printf( __( 'Filed under%s', 'bus_leader' ), '<br><em>' . single_cat_title('', false ) . '</em>' );

						elseif ( is_tag() ) :
							printf( __( 'Tagged as%s', 'bus_leader' ), '<br><em>' . single_tag_title('', false ) . '</em>' );

						elseif ( is_author() ) :
							printf( __( 'Articles by %s', 'bus_leader' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Articles from %s', 'bus_leader' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Articles from %s', 'bus_leader' ), '<span>' . get_the_date( _x( 'F, Y', 'monthly archives date format', 'bus_leader' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Articles from %s', 'bus_leader' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bus_leader' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'bus_leader' );

						else :
							_e( 'Archives', 'bus_leader' );

						endif;
					?>
				</h1>
			</header><!-- .page-header -->
		<?php endif; ?>

	</div><!-- .header-image-container -->
	<?php
	}
endif;


if ( ! function_exists( 'bus_leader_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function bus_leader_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 2,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_next' => false,
        'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'bus_leader' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
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

	printf( __( '<span class="posted-on">%1$s</span><span class="byline">Posted by %2$s</span>', 'bus_leader' ),
		$time_string,
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

if ( ! function_exists( 'bus_leader_comments_link' ) ) :
/**
 * Prints HTML with meta information for the number of comments
 */
function bus_leader_comments_link() {
	if ( ! post_password_required() && comments_open() && '0' != get_comments_number() ) { 
        echo '<span class="comments-link">';
        comments_popup_link( '', __( '1 Comment', 'bus_leader' ), __( '% Comments', 'bus_leader' ) );
        echo '</span>';
    }
}
endif;

if ( ! function_exists( 'bus_leader_edit_link' ) ) :
/**
 * Prints HTML with meta information for the edit link
 */
function bus_leader_edit_link() {
	edit_post_link( __( 'Edit', 'bus_leader' ), '<span class="edit-link">', '</span>' );
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
	                <div class="comment-metadata">
	                    <time pubdate datetime="<?php comment_time( 'c' ); ?>">
	                    <?php
	                        printf( __( '%1$s', 'bus_leader' ), get_comment_date() ); ?>
	                    </time>
	                    <?php edit_comment_link( __( '(Edit)', 'bus_leader' ), ' ' );
	                    ?>
	                </div><!-- .comment-meta .commentmetadata -->
	                <?php if ( $comment->comment_approved == '0' ) : ?>
	                	<br />
	                    <em><?php _e( 'Thanks &#8212; your comment is awaiting moderation.', 'bus_leader' ); ?></em>
	                    <br />
	                <?php endif; ?>
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
