<?php
/**
 * Business Leader Theme Customizer
 *
 * @package Business Leader
 */

/**
 * Add Theme Customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bus_leader_customize_register_header( $wp_customize ) {
	// Add header image section
	$wp_customize->add_section( 'bus-leader-header-image-section' , array(
	    'title'       => __( 'Header Images', 'bus_leader' ),
	    'priority'    => 70,
	    'description' => __( 'Recommended size for header images is 1200 by 715 pixels', 'bus_leader' ),
	) );

	// Set header image for front page
	$wp_customize->add_setting( 'bus-leader-header-image-setting-front-page' , array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
	       $wp_customize,
	       'bus-leader-header-image-control-front-page',
	       array(
	           'label'      => __( 'Header image for front page', 'bus_leader' ),
	           'section'    => 'bus-leader-header-image-section',
	           'settings'   => 'bus-leader-header-image-setting-front-page',
	           'context'    => 'bus-leader-header-image-front-page'
	       )
	   )
	);

	// Set header image for blog
	$wp_customize->add_setting( 'bus-leader-header-image-setting-home' , array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
	       $wp_customize,
	       'bus-leader-header-image-control-home',
	       array(
	           'label'      => __( 'Header image for blog', 'bus_leader' ),
	           'section'    => 'bus-leader-header-image-section',
	           'settings'   => 'bus-leader-header-image-setting-home',
	           'context'    => 'bus-leader-header-image-home'
	       )
	   )
	);

	// Set header image for single posts that don't have a featured image
	$wp_customize->add_setting( 'bus-leader-header-image-setting-single' , array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
	       $wp_customize,
	       'bus-leader-header-image-control-single',
	       array(
	           'label'      => __( 'Header image for posts that don\'t have a featured image', 'bus_leader' ),
	           'section'    => 'bus-leader-header-image-section',
	           'settings'   => 'bus-leader-header-image-setting-single',
	           'context'    => 'bus-leader-header-image-single'
	       )
	   )
	);

	// Set header image for pages, archive, search & 404
	$wp_customize->add_setting( 'bus-leader-header-image-setting-pages' , array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
	       $wp_customize,
	       'bus-leader-header-image-control-archive',
	       array(
	           'label'      => __( 'Header image for pages that don\'t have a featured image', 'bus_leader' ),
	           'section'    => 'bus-leader-header-image-section',
	           'settings'   => 'bus-leader-header-image-setting-pages',
	           'context'    => 'bus-leader-header-image-pages'
	       )
	   )
	);
}
add_action( 'customize_register', 'bus_leader_customize_register_header' );

/**
 * Rename default Header Image section to "Logo" and move to top of list
 */
function bus_leader_filter_customizer( $wp_customize ) {
	$wp_customize->get_section('header_image')->title = __( 'Logo', 'bus_leader' );
	$wp_customize->get_section('header_image')->priority = 1;
}
add_filter( 'customize_register', 'bus_leader_filter_customizer' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bus_leader_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'bus_leader_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bus_leader_customize_preview_js() {
	wp_enqueue_script( 'bus_leader_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'bus_leader_customize_preview_js' );
