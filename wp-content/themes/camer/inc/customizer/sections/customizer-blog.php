<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package Camer
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_blog_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'camer_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'camer' ),
		'priority' => 30,
		'panel' => 'camer_options_panel',
	) );
	
	// Add Setting and Control for showing post full meta info
	$wp_customize->add_setting( 'camer_show_blog_title', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_show_blog_title', array(
		'label'    => esc_html__( 'Display Blog Title Group', 'camer' ),
		'section'  => 'camer_section_blog',
		'type'     => 'checkbox',
	) );		
	
	// Add Blog Title setting and control.
	$wp_customize->add_setting( 'camer_blog_title', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'camer_blog_title', array(
		'label'    => esc_html__( 'Blog Title', 'camer' ),
		'section'  => 'camer_section_blog',
		'type'     => 'text',
	) );

	$wp_customize->selective_refresh->add_partial( 'camer_blog_title', array(
		'selector'         => '.blog-header .blog-title',
		'render_callback'  => 'camer_customize_partial_blog_title',
		'fallback_refresh' => false,
	) );

	// Add Blog Description setting and control.
	$wp_customize->add_setting( 'camer_blog_description', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'camer_blog_description', array(
		'label'    => esc_html__( 'Blog Description', 'camer' ),
		'section'  => 'camer_section_blog',
		'type'     => 'textarea',
	) );

	$wp_customize->selective_refresh->add_partial( 'camer_blog_description', array(
		'selector'         => '.blog-header .blog-description',
		'render_callback'  => 'camer_customize_partial_blog_description',
		'fallback_refresh' => false,
	) );

	
	// Add Settings and Controls for blog layout.
	$wp_customize->add_setting( 'camer_blog_layout', array(
		'default'           => 'default',
		'sanitize_callback' => 'camer_sanitize_select',
	) );

	$wp_customize->add_control( 'camer_blog_layout', array(
		'label'    => esc_html__( 'Blog Layout', 'camer' ),
		'section'  => 'camer_section_blog',
		'settings' => 'camer_blog_layout',
		'type'     => 'select',
		'choices'  => array(
			'default' => esc_html__( 'Default Right Sidebar', 'camer' ),
			'default-left'  => esc_html__( 'Default Left Sidebar', 'camer' ),
			'photowall'  => esc_html__( 'Photowall Full Width', 'camer' ),
		),
	) );
	
	// Add Settings and Controls for blog content.
	$wp_customize->add_setting( 'camer_blog_content', array(	
		'default'           => 'index',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_select',				
	) );

	$wp_customize->add_control( 'camer_blog_content', array(
		'label'    => esc_html__( 'Blog Summary Type', 'camer' ),
		'description' => esc_html__( 'This will let you choose to use excerpts for your blog summaries. This is for the Large and Standard default blog layouts.', 'camer' ),
		'section'  => 'camer_section_blog',
		'settings' => 'camer_blog_content',
		'type'     => 'radio',
		'choices'  => array(
			'index'   => esc_html__( 'Post Summary', 'camer' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'camer' ),
		),	
	) );		

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'camer_excerpt_length', array(
		'default'           => 35,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'camer_excerpt_length', array(
		'label'    => esc_html__( 'Excerpt Length', 'camer' ),
		'section'  => 'camer_section_blog',
		'type'     => 'number',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 1,
        ),		
	) );

	// Add Partial for Blog Layout and Excerpt Length.
	$wp_customize->selective_refresh->add_partial( 'camer_blog_content_partial', array(
		'selector'         => '.site-main',
		'settings'         => array(
			'camer_blog_layout',
			'camer_blog_content',
			'camer_excerpt_length',
		),
		'render_callback'  => 'camer_customize_partial_blog_content',
		'fallback_refresh' => false,
	) );
	
	// Add Setting and Control for showing featured label.
	$wp_customize->add_setting( 'camer_show_featured_label', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_show_featured_label', array(
		'label'    => esc_html__( 'Show Featured Label', 'camer' ),
		'section'  => 'camer_section_blog',
		'type'     => 'checkbox',
	) );	

	// Add Customize Archive Title Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_post_archive_title_option', array(
			'label' => esc_html__( 'Customize Archive Titles', 'camer' ),
			'section' => 'camer_section_blog',
			'settings' => array(),
		)
	) );	
	// show hide archive heading labels
	$wp_customize->add_setting( 'camer_show_archive_labels',	array(
		'default' => true,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'camer_show_archive_labels', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show or hide the archive heading labels like Category:  or Tags: that show just before the names. Default is enabled to hide the label.', 'camer' ),
		'section'  => 'camer_section_blog',
	) );	
	
}
add_action( 'customize_register', 'camer_customize_register_blog_settings' );

/**
 * Render the blog title for the selective refresh partial.
 */
function camer_customize_partial_blog_title() {
	echo wp_kses_post( get_theme_mod('camer_blog_title' )  );
}

/**
 * Render the blog description for the selective refresh partial.
 */
function camer_customize_partial_blog_description() {
	echo wp_kses_post( get_theme_mod( 'camer_blog_description' ) );
}

/**
 * Render the blog content for the selective refresh partial.
 */
function camer_customize_partial_blog_content() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	}
}
