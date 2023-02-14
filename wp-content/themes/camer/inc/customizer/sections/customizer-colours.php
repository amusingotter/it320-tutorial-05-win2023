<?php
/**
 * Layout Settings
 *
 * Register Layout section, settings and controls for Theme Customizer
 *
 * @package Camer
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_colour_settings( $wp_customize ) {


// Site Title Colour
 	$wp_customize->add_setting( 'camer_sitetitle_colour', array(
		'default'        => '#161616',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_sitetitle_colour', array(
		'label'   => esc_html__( 'Site Title Colour', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_sitetitle_colour',
	) ) );
	
// Site Title tagline
 	$wp_customize->add_setting( 'camer_tagline_colour', array(
		'default'        => '#9a9a9a',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_tagline_colour', array(
		'label'   => esc_html__( 'Site Tagline Colour', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_tagline_colour',
	) ) );		
	
	
// Accent Colour 
 	$wp_customize->add_setting( 'camer_accent_colour', array(
		'default'        => '#bcd6dc',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_accent_colour', array(
		'label'   => esc_html__( 'Gutenberg Accent Colour', 'camer' ),
		'description'   => esc_html__( 'This is your accent colour when using the Gutenberg editor.', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_accent_colour',
	) ) );		

// Primary Colour
 	$wp_customize->add_setting( 'camer_first_colour', array(
		'default'        => '#bcd6dc',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_first_colour', array(
		'label'   => esc_html__( 'First Colour', 'camer' ),
		'description'   => esc_html__( 'This is the blue colour.', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_first_colour',
	) ) );		
	
// Secondary Colour
 	$wp_customize->add_setting( 'camer_second_colour', array(
		'default'        => '#161616',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_second_colour', array(
		'label'   => esc_html__( 'Second Colour', 'camer' ),
		'description'   => esc_html__( 'This is the dark grey colour.', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_second_colour',
	) ) );		
	
// Third Colour
 	$wp_customize->add_setting( 'camer_third_colour', array(
		'default'        => '#9a9a9a',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_third_colour', array(
		'label'   => esc_html__( 'Third Colour', 'camer' ),
		'description'   => esc_html__( 'This is a medium grey colour; used mostly for grey text.', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_third_colour',
	) ) );		
	
// Dropcap Colour
 	$wp_customize->add_setting( 'camer_dropcap_colour', array(
		'default'        => '#161616',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'camer_dropcap_colour', array(
		'label'   => esc_html__( 'Dropcap Colour', 'camer' ),
		'section' => 'colors',
		'settings'   => 'camer_dropcap_colour',
	) ) );		

}
add_action( 'customize_register', 'camer_customize_register_colour_settings' );
