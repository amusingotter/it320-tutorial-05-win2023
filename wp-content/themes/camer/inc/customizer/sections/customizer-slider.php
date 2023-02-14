<?php
/**
 * Slider Settings
 *
 * Register Slider section, settings and controls for Theme Customizer
 *
 * @package Camer
 */

/**
 * Adds all slider settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function camer_customize_register_slider_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'camer_section_slider', array(
		'title'    => esc_html__( 'Slider Settings', 'camer' ),
		'priority' => 55,
		'panel'    => 'camer_options_panel',
	) );


	// Add Show Slider Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[display_slider_option]', array(
			'label' => esc_html__( 'Display Slider', 'camer' ),
			'section' => 'camer_section_slider',
			'settings' => array(),
		)
	) );

	// Display Slider
	$wp_customize->add_setting( 'camer_display_slider', array(
		'default'           => false,
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_display_slider', array(
		'label'    => esc_html__( 'Display the Slider', 'camer' ),
		'section'  => 'camer_section_slider',
		'type'     => 'checkbox',
	) );		

	
	
	// Slider category
	$wp_customize->add_setting( 'camer_slider_cat', array(
		'default' => '',
		'sanitize_callback' => 'camer_sanitize_slidecat',
	) );

	$wp_customize->add_control( 'camer_slider_cat', array(
		'type' => 'select',
		'label' => esc_html__( 'Choose a category', 'camer' ),
		'description' => esc_html__( 'Choose your category to load slides from. Make sure your posts have featured images and we recommend also that you create a special category just for featured slide posts.', 'camer' ),
		'choices' => camer_slide_cats(),
		'section' => 'camer_section_slider',
	) );	
	
	
    /** No. of slides */
    $wp_customize->add_setting( 'camer_slide_count', array(
            'default'           => 3,
            'sanitize_callback' => 'absint'
        ) );
    
    $wp_customize->add_control( 'camer_slide_count', array(
            'type'        => 'number',
            'section'     => 'camer_section_slider',
            'label'       => esc_html__( 'Number of Slides', 'camer' ),
            'description' => esc_html__( 'Choose the number of slides you want to display when showing the Latest Posts option.', 'camer' ),
            'input_attrs' => array(
				'min'   => 1,
				'max'   => 8,
				'step'  => 1,
            ),
        )
    );	


	// Slide excerpt size
	$wp_customize->add_setting( 'camer_slide_excerpt_size', array(
		'default' => 10,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'camer_slide_excerpt_size', array(
		'type' => 'number',
		'label' => esc_html__( 'Slider Excerpt Size', 'camer' ),
		'description' => esc_html__( 'This lets you choose how many words to show in your slide excerpt from 4 to 20 words. Default is 10.', 'camer' ),
		'section' => 'camer_section_slider',
		'input_attrs' => array(
				'min' => 4, // Required. Minimum value for the slider
				'max' => 20, // Required. Maximum value for the slider
				'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
		),
	) );
	
	// Add Slide Element Headline.
	$wp_customize->add_control( new Camer_Customize_Header_Control(
		$wp_customize, 'camer_theme_options[display_slider_elements]', array(
			'label' => esc_html__( 'Display Slider Elements', 'camer' ),
			'section' => 'camer_section_slider',
			'settings' => array(),
		)
	) );
	// Display Slide title
	$wp_customize->add_setting( 'camer_display_slide_title', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_display_slide_title', array(
		'label'    => esc_html__( 'Display the Slide Title', 'camer' ),
		'section'  => 'camer_section_slider',
		'type'     => 'checkbox',
	) );
	
	// Display Slide excerpt
	$wp_customize->add_setting( 'camer_display_slide_excerpt', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_display_slide_excerpt', array(
		'label'    => esc_html__( 'Display the Slide Excerpt', 'camer' ),
		'section'  => 'camer_section_slider',
		'type'     => 'checkbox',
	) );	
	
	// Display Slide read more
	$wp_customize->add_setting( 'camer_display_slide_readmore', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'camer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'camer_display_slide_readmore', array(
		'label'    => esc_html__( 'Display the Slide Read More', 'camer' ),
		'section'  => 'camer_section_slider',
		'type'     => 'checkbox',
	) );	
	
	

}
add_action( 'customize_register', 'camer_customize_register_slider_settings' );



/**
 * Function to list post categories in customizer options
 * This loads categories for our slider dropdown select
 */
function camer_slide_cats() {
	$cats = array();
	$cats[0] = 'All';

	foreach ( get_categories() as $categories => $category ) {
		$cats[ $category->term_id ] = $category->name;
	}
	return $cats;
}