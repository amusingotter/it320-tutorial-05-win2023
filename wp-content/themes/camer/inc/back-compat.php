<?php
/**
 * Camer back compat functionality
 *
 * Prevents Camer from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Camer
 */

/**
 * Prevent switching to Camer on old versions of WordPress.
 * Switches to the default theme.
 */
function camer_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'camer_upgrade_notice' );
}
add_action( 'after_switch_theme', 'camer_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 * Prints an update nag after an unsuccessful attempt to switch to Camer on WordPress versions prior to 4.7.
 */
function camer_upgrade_notice() {
	/* translators: %s: version number */
	$message = sprintf( esc_html__( 'Camer requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'camer' ), esc_attr($GLOBALS['wp_version'] ) );
	printf( '<div class="error"><p>%s</p></div>', esc_html($message ));
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.7.
 * @since Camer 1.0
 */
function camer_customize() {
	wp_die(
	/* translators: %s: version number */
		sprintf( esc_html__( 'Camer requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'camer' ), esc_attr($GLOBALS['wp_version'] )), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'camer_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.7.
 * @since Camer 1.0
 */
function camer_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: version number */
		wp_die( sprintf( esc_html__( 'Camer requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'camer' ), esc_attr($GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'camer_preview' );
