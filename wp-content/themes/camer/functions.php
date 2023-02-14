<?php
/**
 * The main functions file.
 * @package Camer
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/*--------------------------------------------------------
Sets up RP defaults and registers support 
for various WordPress features
 -------------------------------------------------------*/
 
if ( ! function_exists( 'camer_setup' ) ) :
function camer_setup() {
	
		// Set the default content width.
		$GLOBALS['content_width'] = 1140;	
	
		// Make theme available for translation.
		load_theme_textdomain( 'camer', get_template_directory() . '/languages' );	
	
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		
		// Recent Posts widget thumbnail
		add_image_size( 'camer-recent-thumbnail', 110, 95, true );
		
		// Enable support for related post thumbnail crop
		if( esc_attr(get_theme_mod( 'camer_show_related_posts', true ) ) ) {
			add_image_size( 'camer-related-thumbnail', 400, 230, true );
		}
		// Enable support for the standard post thumbnail crop
		if( esc_attr(get_theme_mod( 'camer_crop_standard_featured', false ) ) ) {
			add_image_size( 'camer-standard-thumbnail', 730, 430, true );
		}					
		// Enable support for photowall blog post thumbnail crop
		if( esc_attr(get_theme_mod( 'camer_crop_photowall_featured', false ) ) ) {
			add_image_size( 'camer-photowall-thumbnail', 450, 450, true );
		}			
		// Enable support for the slider thumbnail 
		if( esc_attr(get_theme_mod( 'camer_display_slider', false ) ) ) {
			add_image_size( 'camer-slide-thumbnail', 1920, 700, true );
		}		
		
		// Gutenberg align wide support
		add_theme_support( 'align-wide' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'camer' ),
			'top-social'  => esc_html__( 'Top Social Icon Menu', 'camer' ),
			'footer-social'  => esc_html__( 'Footer Social Text Menu', 'camer' ),
			'footer'  => esc_html__( 'Footer Menu', 'camer' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'camer_custom_background_args', array(
			'default-color' => 'f2f2f2',
			'default-image' => '',
		) ) );		
		
		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add styles to post editor
		add_editor_style( array( 'editor-style.css', camer_fonts_url() ) );


	
}
endif; 
add_action( 'after_setup_theme', 'camer_setup' );	


/*--------------------------------------------------------
Set the content width in pixels, based on 
the theme's design and stylesheet.
 -------------------------------------------------------*/
function camer_content_width() {
	$content_width = $GLOBALS['content_width'];

	if ( is_active_sidebar( 'left-sidebar'  ) || is_active_sidebar( 'right-sidebar' ) || is_active_sidebar( 'blog-sidebar' ) ) {
		$content_width = 730;
	}	
  $GLOBALS['content_width'] = apply_filters( 'camer_content_width', $content_width );
}
add_action( 'template_redirect', 'camer_content_width', 0 );

/*--------------------------------------------------------
Register Google fonts
 -------------------------------------------------------*/
if ( ! function_exists( 'camer_fonts_url' ) ) :

	function camer_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'camer' ) ) {
			$fonts[] = 'Open Sans:300,400,600,800';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				), 'https://fonts.googleapis.com/css'
			);
		}
		return esc_url_raw( $fonts_url );
	}
endif;


/*--------------------------------------------------------
Load editor fonts from Google
 -------------------------------------------------------*/
 function camer_admin_scripts( $hook ) {
	if ( 'post.php' != $hook ) {
        return;
	}
wp_enqueue_style( 'camer-admin-fonts', camer_fonts_url(), array(), null );
}
add_action( 'admin_enqueue_scripts', 'camer_admin_scripts', 5 );


/*--------------------------------------------------------
Add preconnect for Google Fonts
 -------------------------------------------------------*/
function camer_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'camer-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}	
		return $urls;
}
add_filter( 'wp_resource_hints', 'camer_resource_hints', 10, 2 );


/*--------------------------------------------------------
 Enqueue scripts and styles
 -------------------------------------------------------*/
function camer_scripts() {
	
	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );
	
	// Enable or Disable Google default fonts
	if ( esc_attr(get_theme_mod( 'camer_default_google_fonts', true ) ) ) {
		wp_enqueue_style( 'camer-fonts', camer_fonts_url(), array(), null );
	}

	// Bootstrap CSS
	wp_enqueue_style( 'bootstrap-reboot', get_theme_file_uri( '/assets/css/bootstrap-reboot.css' ), '4.1.3', 'screen' );	
	wp_enqueue_style( 'bootstrap-grid', get_theme_file_uri( '/assets/css/bootstrap-grid.css' ), '4.1.3', 'screen' );
	
	// Theme CSS
	wp_enqueue_style( 'camer-stylesheet', get_stylesheet_uri(), array(), $theme_version );
	
	// Main Menu
	wp_enqueue_script( 'camer-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '1.0.0', true );	
	wp_localize_script( 'camer-navigation', 'camer_menu_title', camer_get_svg( 'menu' ) . esc_html__( 'Menu', 'camer' ) );

	// Skip Link
	wp_enqueue_script( 'camer-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	// Bootstrap with Slider Scripts
	if ( esc_attr(get_theme_mod( 'camer_display_slider', false ) ) ) { 
		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/assets/js/bootstrap-scripts.js', array(), '4.0.0', true );		
		wp_enqueue_script( 'camer-theme-scripts', get_template_directory_uri() . '/assets/js/theme-scripts.js', array(), '1.0.0', true );
	}
	
	// Comments script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
add_action( 'wp_enqueue_scripts', 'camer_scripts' );


 /*--------------------------------------------------------
 Enqueue Gutenberg editor styles
 -------------------------------------------------------*/
function camer_gutenberg_editor_styles() { 
	wp_enqueue_style( 'camer-gutenberg-editor-styles', get_template_directory_uri() . '/gutenberg-editor.css'); 
}
// only name the function and leave the enqueue as enqueue_block_editor_assets
add_action( 'enqueue_block_editor_assets', 'camer_gutenberg_editor_styles' );

if ( ! function_exists( 'camer_add_gutenberg_features' ) ) {
	function camer_add_gutenberg_features() {
		
		/* Gutenberg Colour Palette */
		$accent_color = get_theme_mod( 'camer_accent_colour' ) ? get_theme_mod( 'camer_accent_colour' ) : '#bcd6dc';

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'camer' ),
				'slug' 	=> 'accent',
				'color' => esc_attr($accent_color),
			),
			array(
				'name' 	=> _x( 'Dark Grey', 'Name of the dark grey color in the Gutenberg palette', 'camer' ),
				'slug' 	=> 'dark-grey',
				'color' => '#161616',
			),
			array(
				'name' 	=> _x( 'Medium Grey', 'Name of the medium grey color in the Gutenberg palette', 'camer' ),
				'slug' 	=> 'medium-grey',
				'color' => '#9a9a9a',
			),
			array(
				'name' 	=> _x( 'Light Grey', 'Name of the light grey color in the Gutenberg palette', 'camer' ),
				'slug' 	=> 'light-grey',
				'color' => '#f2f2f2',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'camer' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );
		}
	add_action( 'after_setup_theme', 'camer_add_gutenberg_features' );

}

/*--------------------------------------------------------
 Add other function files
 -------------------------------------------------------*/

// Theme info
require get_template_directory() . '/inc/theme-info/camer-info-class-about.php';
require get_template_directory() . '/inc/theme-info/camer-info.php';

// SVG Icons
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/inline-styles.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/sidebars.php';
require get_template_directory() . '/inc/post-slider.php';

// recent posts widget
require get_template_directory() . '/inc/widgets/recent-posts-widget.php';

// CUSTOMIZER
require( get_template_directory() . '/inc/customizer/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/controls/headline-control.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-basic.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-layout.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-blog.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-thumbnails.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-slider.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-colours.php' );
require( get_template_directory() . '/inc/customizer/controls/upgrade-control.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-pro-upgrade.php' );

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}