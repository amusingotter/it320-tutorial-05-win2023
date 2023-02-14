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
function camer_customize_register_upgrade_settings( $wp_customize ) {

// SECTION - UPGRADE
    $wp_customize->add_section( 'camer_upgrade', array(
        'title'       => esc_html__( 'Upgrade to Pro', 'camer' ),
        'priority'    => 0
    ) );
	
		$wp_customize->add_setting( 'camer_upgrade_pro', array(
			'default' => '',
			'sanitize_callback' => '__return_false'
		) );
		
		$wp_customize->add_control( new Camer_Customize_Static_Text_Control( $wp_customize, 'camer_upgrade_pro', array(
			'label'	=> esc_html__('Get The Pro Version:','camer'),
			'section'	=> 'camer_upgrade',
			'description' => array('')
		) ) );	
		
}
add_action( 'customize_register', 'camer_customize_register_upgrade_settings' );