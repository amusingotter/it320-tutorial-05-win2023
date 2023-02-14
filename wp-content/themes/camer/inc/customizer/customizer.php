<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Camer
 */

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'camer_options_panel', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'camer' ),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section   = 'background_image';
	$wp_customize->get_section( 'background_image' )->title     = esc_html__( 'Page Background', 'camer' );

	// Add postMessage support for site title and description so we can preview changes instantly.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Add selective refresh for site title and description.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title',
		'render_callback' => 'camer_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'camer_customize_partial_blogdescription',
	) );
	
		
	// Add Show Site Title Setting.
	$wp_customize->add_setting( 'camer_show_site_title', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_show_site_title', array(
		'label'    => esc_html__( 'Show Site Title', 'camer' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
	) );


	// Add Hide Tagline Setting.
	$wp_customize->add_setting( 'camer_show_site_description', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_show_site_description', array(
		'label'    => esc_html__( 'Show Tagline', 'camer' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
	) );
}
add_action( 'customize_register', 'camer_customize_register_options' );



/**
 * Render the site title for the selective refresh partial.
 */
function camer_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function camer_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function camer_customize_preview_js() {
	wp_enqueue_script( 'camer-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20180609', true );
}
add_action( 'customize_preview_init', 'camer_customize_preview_js' );

/**
 * Embed JS for Customizer Controls.
 */
function camer_customizer_controls_js() {
	wp_enqueue_script( 'camer-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '20180609', true );
}
add_action( 'customize_controls_enqueue_scripts', 'camer_customizer_controls_js' );

/**
 * Embed CSS styles Customizer Controls.
 */
function camer_customizer_controls_css() {
	wp_enqueue_style( 'camer-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '20180609' );
}
add_action( 'customize_controls_print_styles', 'camer_customizer_controls_css' );
