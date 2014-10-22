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
	//All our sections, settings, and controls will be added here
	$wp_customize->add_section( 'bus-leader-header-image-section' , array(
	    'title'      => __( 'Header Images', 'bus_leader' ),
	    'priority'   => 70,
	) );

	$wp_customize->add_setting( 'bus-leader-header-image-setting-home' , array() );

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

	$wp_customize->add_setting( 'bus-leader-header-image-setting-archive' , array() );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
	       $wp_customize,
	       'bus-leader-header-image-control-archive',
	       array(
	           'label'      => __( 'Header image for archive, search and 404 (page not found) pages', 'bus_leader' ),
	           'section'    => 'bus-leader-header-image-section',
	           'settings'   => 'bus-leader-header-image-setting-archive',
	           'context'    => 'bus-leader-header-image-archive'
	       )
	   )
	);

	$wp_customize->add_setting( 'bus-leader-header-image-setting-single' , array() );

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
	       $wp_customize,
	       'bus-leader-header-image-control-single',
	       array(
	           'label'      => __( 'Header image for posts and pages that don\'t have a featured image', 'bus_leader' ),
	           'section'    => 'bus-leader-header-image-section',
	           'settings'   => 'bus-leader-header-image-setting-single',
	           'context'    => 'bus-leader-header-image-single'
	       )
	   )
	);
}
add_action( 'customize_register', 'bus_leader_customize_register_header' );

/**
 * Rename default Header Image section to "Logo" and move to top of list
 */
function bus_leader_filter_customizer( $wp_customize ) {
	$wp_customize->get_section('header_image')->title = __( 'Logo' );
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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'bus_leader_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bus_leader_customize_preview_js() {
	wp_enqueue_script( 'bus_leader_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'bus_leader_customize_preview_js' );
