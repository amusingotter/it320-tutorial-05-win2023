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
function camer_customize_register_layout_settings( $wp_customize ) {


	// Add Section for Theme Options.
	$wp_customize->add_section( 'camer_section_layout', array(
		'title'    => esc_html__( 'Layout Settings', 'camer' ),
		'priority' => 10,
		'panel'    => 'camer_options_panel',
	) );

	// Page Width
	$wp_customize->add_setting( 'camer_page_width', array(
		'default'           => '2560',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_range',
	) );

	$wp_customize->add_control( 'camer_page_width', array(
		'type'            => 'range',
		'section'         => 'camer_section_layout',
		'label'           => esc_html__( 'Page Width', 'camer' ),
		'description'     => esc_html__( 'Adjust the overall page width to give a boxed layout that shows the page background. Min width is 960px while the max width is 2560px.', 'camer' ),
		'input_attrs' => array(
			'min'   => 960,
			'max'   => 2560,
			'step'  => 10,
			'style' => 'width: 100%',
		),
	) );	

	// Banner Width
	$wp_customize->add_setting( 'camer_banner_width', array(
		'default'           => '2560',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_range',
	) );

	$wp_customize->add_control( 'camer_banner_width', array(
		'type'            => 'range',
		'section'         => 'camer_section_layout',
		'label'           => esc_html__( 'Banner Width', 'camer' ),
		'description'     => esc_html__( 'Adjust the width of the banner sidebar area. This only gets applied in desktop viewing. Min width is 960px while the max width is 2560px.', 'camer' ),
		'input_attrs' => array(
			'min'   => 960,
			'max'   => 2560,
			'step'  => 10,
			'style' => 'width: 100%',
		),
	) );
	
}
add_action( 'customize_register', 'camer_customize_register_layout_settings' );