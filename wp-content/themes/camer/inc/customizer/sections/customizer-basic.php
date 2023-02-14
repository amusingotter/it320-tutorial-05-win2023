<?php
/**
 * Basic Settings
 *
 * Register Basic Settings section, settings and controls for Theme Customizer
 *
 * @package Camer
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_basic_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'camer_section_basic', array(
		'title'    => esc_html__( 'Basic Settings', 'camer' ),
		'priority' => 8,
		'panel' => 'camer_options_panel',
	) );
		
	// Add Post Details Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[basic_options]', array(
			'label' => esc_html__( 'Basic Options', 'camer' ),
			'section' => 'camer_section_basic',
			'settings' => array(),
		)
	) );

	// footer logo
  	$wp_customize->add_setting( 'camer_footer_logo',  array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
   	 ) ); 	 
	$wp_customize->add_control(  new WP_Customize_Image_Control(  $wp_customize,  'camer_footer_logo',  array(
		   'label'      => esc_html__( 'Footer Logo', 'camer' ),
		   'description'	=> esc_html__( 'Add a footer logo.', 'camer' ),
		   'section'    => 'camer_section_basic',
		   'settings'   => 'camer_footer_logo',
		)
	 ) ); 	
	
	// Add Blog Title setting and control.
	$wp_customize->add_setting( 'camer_copyright', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'camer_copyright', array(
		'label'    => esc_html__( 'Copyright Name', 'camer' ),
		'section'  => 'camer_section_basic',
		'type'     => 'text',
	) );
	
	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'camer_show_design_by', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_show_design_by', array(
		'label'    => esc_html__( 'Show the Design By Credit Line', 'camer' ),
		'section'  => 'camer_section_basic',
		'type'     => 'checkbox',
	) );

		// Add Gallery Comments Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[basic_options]', array(
			'label' => esc_html__( 'WP Gallery Options', 'camer' ),
			'section' => 'camer_section_basic',
			'settings' => array(),
		)
	) );
	
	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'camer_attachment_comments', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_attachment_comments', array(
		'label'    => esc_html__( 'Enable Gallery View Comments', 'camer' ),
		'section'  => 'camer_section_basic',
		'type'     => 'checkbox',
	) );
	
	// Add Google Fonts Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[google_fonts_option]', array(
			'label' => esc_html__( 'Default Google Fonts', 'camer' ),
			'section' => 'camer_section_basic',
			'settings' => array(),
		)
	) );

	// Enable Default Google Fonts
	$wp_customize->add_setting( 'camer_default_google_fonts', array(
		'default'           => true,
		'description' => esc_html__( 'This theme has a couple Google Fonts included. If you choose to use a plugin for different fonts, you can disable them.', 'camer' ),
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_default_google_fonts', array(
		'label'    => esc_html__( 'Enable the Default Google Fonts', 'camer' ),
		'section'  => 'camer_section_basic',
		'type'     => 'checkbox',
	) );	
	
}
add_action( 'customize_register', 'camer_customize_register_basic_settings' );

