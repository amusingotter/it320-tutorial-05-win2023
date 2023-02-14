<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Camer
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'camer_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'camer' ),
		'priority' => 40,
		'panel' => 'camer_options_panel',
	) );
	
	// Add Settings and Controls for the single header style.
	$wp_customize->add_setting( 'camer_post_header_style', array(
		'default'           => 'default',
		'sanitize_callback' => 'camer_sanitize_select',
	) );

	// Add  Post Featured Image Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[post_featured_image]', array(
			'label' => esc_html__( 'Post Featured Image Banners', 'camer' ),
			'section' => 'camer_section_post',
			'settings' => array(),
		)
	) );
	
	// Add Setting and Control for showing regular post featured image.
	$wp_customize->add_setting( 'show_post_single_featured_image', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_post_single_featured_image', array(
		'label'    => esc_html__( 'Display the Post Regular Featured Image', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );	
	
	
	// Add Setting and Control for showing page featured banner.
	$wp_customize->add_setting( 'show_post_single_featured_banner', array(
		'default'           => true,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_post_single_featured_banner', array(
		'label'    => esc_html__( 'Display the Post Featured Image as Banner', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );	
	
	// Add Settings and Controls for featured banner attachment
	$wp_customize->add_setting( 'show_post_featured_banner_fixed', array(
		'default'           => false,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_post_featured_banner_fixed', array(
		'label'    => esc_html__( 'Display the Post Featured Banner as Parallax View', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );		

	// Add  Post Featured Image Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[page_featured_image]', array(
			'label' => esc_html__( 'Page Featured Image Banners', 'camer' ),
			'section' => 'camer_section_post',
			'settings' => array(),
		)
	) );

	// Add Setting and Control for showing regular page featured image.
	$wp_customize->add_setting( 'show_page_featured_image', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_page_featured_image', array(
		'label'    => esc_html__( 'Display the Page Regular Featured Image', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );	
	
	// Add Setting and Control for showing page featured banner.
	$wp_customize->add_setting( 'show_page_featured_banner', array(
		'default'           => true,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_page_featured_banner', array(
		'label'    => esc_html__( 'Display the Page Featured Image as Banner', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );

	// Add Settings and Controls for featured banner attachment
	$wp_customize->add_setting( 'show_page_featured_banner_fixed', array(
		'default'           => false,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_page_featured_banner_fixed', array(
		'label'    => esc_html__( 'Display the Page Featured Banner as Parallax View', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );
	
	// Add Single Post Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[single_post]', array(
			'label' => esc_html__( 'Single Post', 'camer' ),
			'section' => 'camer_section_post',
			'settings' => array(),
		)
	) );
	
	// Add Setting and Control for showing post full meta info
	$wp_customize->add_setting( 'camer_meta_info', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_meta_info', array(
		'label'    => esc_html__( 'Display All Meta Info', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );		

	// Add Setting and Control for showing author avatar
	$wp_customize->add_setting( 'camer_display_author_avatar', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_display_author_avatar', array(
		'label'    => esc_html__( 'Display Author Avatar', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );	
	
	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'camer_meta_category', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_meta_category', array(
		'label'    => esc_html__( 'Display categories', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );
	
	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'camer_meta_tags', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_meta_tags', array(
		'label'    => esc_html__( 'Display tags', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );	

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'camer_show_related_posts', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_show_related_posts', array(
		'label'    => esc_html__( 'Display Related Posts', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );
		
	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'camer_post_navigation', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_post_navigation', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'camer' ),
		'section'  => 'camer_section_post',
		'type'     => 'checkbox',
	) );

}
add_action( 'customize_register', 'camer_customize_register_post_settings' );


/**
 * Render single posts partial
 */
function camer_customize_partial_single_post() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', 'single' );
	}
}
