<?php
/**
 * Thumbnail Settings
 * Register Thumbnails section, settings and controls for the Theme Customizer
 * Settings and controls to manage image thumbnail cropping
 *
 * @package Camer
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_thumbnail_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'camer_section_thumbnails', array(
		'title'    => esc_html__( 'Thumbnail Settings', 'camer' ),
		'priority' => 50,
		'panel'    => 'camer_options_panel',
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[crop_featured_images]', array(
		'label' => esc_html__( 'Crop Blog Featured Images', 'camer' ),
		'section' => 'camer_section_thumbnails',
		'settings' => array(),
		)
	) );
	
	// Add Setting and Control for cropping default featured images on blog and archives.
	$wp_customize->add_setting( 'camer_crop_standard_featured', array(
		'default'           => false,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_crop_standard_featured', array(
		'label'    => esc_html__( 'Crop featured images for the standard (default) blog Layout', 'camer' ),
		'section'  => 'camer_section_thumbnails',
		'type'     => 'checkbox',
	) );	

	// Add Setting and Control for cropping Photowall featured images on blog and archives.
	$wp_customize->add_setting( 'camer_crop_photowall_featured', array(
		'default'           => false,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_crop_photowall_featured', array(
		'label'    => esc_html__( 'Crop featured images for the Photowall Blog Layout', 'camer' ),
		'section'  => 'camer_section_thumbnails',
		'type'     => 'checkbox',
	) );
}
add_action( 'customize_register', 'camer_customize_register_thumbnail_settings' );
