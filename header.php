<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Business Leader
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'businesstheme' ); ?></a>


	<header class="navigation">
	  <div class="menu-wrapper">
	    <a href="javascript:void(0)" class="logo">
	      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="">
	    </a>
	    <p class="navigation-menu-button" id="js-mobile-menu">MENU</p>
	    <div class="nav">
	      <ul id="navigation-menu">
	        <li class="nav-link"><a href="javascript:void(0)">Products</a></li>
	        <li class="nav-link"><a href="javascript:void(0)">About Us</a></li>
	        <li class="nav-link"><a href="javascript:void(0)">Contact</a></li>
	        <li class="nav-link more"><a href="javascript:void(0)">More</a>
	          <ul class="submenu">
	            <li><a href="javascript:void(0)">Submenu Item</a></li>
	            <li><a href="javascript:void(0)">Another Item</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	    <div class="navigation-tools">
	      <div class="search-bar">
	        <div class="search-and-submit">
	          <input type="search" placeholder="Enter Search" />
	          <button type="submit">
	            <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="">
	          </button>
	        </div>
	      </div>
	      <a href="javascript:void(0)" class="sign-up">Sign Up</a>
	    </div>
	  </div>
	</header>


<?php /*
	<header id="masthead" class="site-header" role="banner">
		<div class="nav-bar-container">
				<a href="#######" class="logo">
			      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="">
			    </a>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<!-- <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2> -->
			<nav id="site-navigation" class="main-navigation" role="navigation">

				<!-- <button class="menu-toggle"><?php _e( 'Primary Menu', 'businesstheme' ); ?></button> -->
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
		<div class="featured-header-image-container">
			<img src="http://thb_demo_medialibrary_w3.s3.amazonaws.com/demo/bigfoot/wp-content/uploads/sites/9/6594076175_9a560953fb_o-1160x866.jpg?c90533">
		</div>
	</header><!-- #masthead -->
*/
?>


	<div id="content" class="site-content">
