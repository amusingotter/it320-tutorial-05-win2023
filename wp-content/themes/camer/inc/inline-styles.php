<?php
/**
 * Add inline styles to the head area
 * @package Camer
*/
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 // Dynamic styles
function camer_inline_styles($camer_customizer_css) {
	

// BEGIN CUSTOM CSS	
	
//Content Sizes			
$camer_page_width   = esc_attr(get_theme_mod( 'camer_page_width', '2560' ).'px' );	
$camer_banner_width   = esc_attr(get_theme_mod( 'camer_banner_width', '2560' ).'px' );
$camer_customizer_css .="
	#page {max-width: $camer_page_width;}
	#banner-sidebar {max-width: $camer_banner_width;}";	
	

// Colours
$camer_first_colour = esc_attr(get_theme_mod( 'camer_first_colour', '#bcd6dc' ) );
$camer_second_colour = esc_attr(get_theme_mod( 'camer_second_colour', '#161616' ) );
$camer_third_colour = esc_attr(get_theme_mod( 'camer_third_colour', '#9a9a9a' ) );
$camer_customizer_css .="
	::-moz-selection {background-color: $camer_first_colour;}
	::selection {background-color: $camer_first_colour;}	
#header-page-footer-inner,
.blog-grid .date-block-wrapper,
.featured-box-link:hover,
.slide-readmore a:hover,
.wp-block-button .wp-block-button__link,
#comments .submit,
.main-navigation-menu ul li,
.has-accent-background-colour	{ background-color: $camer_first_colour;}
.featured-box-link:hover,
blockquote,
blockquote.alignright,
	#site-footer,
.slide-readmore a:hover,
.main-navigation-menu:before, 
.main-navigation-menu:after	{ border-color: $camer_first_colour;}
.carousel .icon-collapse:hover,
.carousel .icon-expand:hover,
.top-social-menu .social-icons-menu li a .icon:hover { fill: $camer_first_colour;}
.blog-grid .post-meta-category,
.has-accent-colour { color: $camer_first_colour;}		
#site-title a,
#site-title a:visited,
h1, h2, h3, h4, h5, h6,
a:focus,
a:hover,
.entry-title a,
.entry-title a:visited,
#footer-posted-in,
#footer-tagged-with,
#error-title,
.wp-caption-text,
.main-navigation-toggle,
.main-navigation-menu a:link,
.main-navigation-menu a:visited,
.has-dark-grey-colour,
.wp-block-image figcaption,
p.has-drop-cap:not(:focus):first-letter { color: $camer_second_colour;}	
.main-navigation-toggle .icon,
.top-social-menu .social-icons-menu li a .icon,
.footer-social-menu a,
.footer-social-menu a:visited	{ fill: $camer_second_colour;}
#comments .submit:hover,
.button:focus,
.button:hover,
#infinite-handle span:focus,
#infinite-handle span:hover,
.wp-block-button .wp-block-button__link:focus,
.wp-block-button .wp-block-button__link:hover,
button:focus,
button:hover,
input[type=submit]:focus,
input[type=submit]:hover,
input[type=reset]:focus,
input[type=reset]:hover,
input[type=button]:focus,
input[type=button]:hover,
.has-dark-grey-background-colour { background-color: $camer_second_colour;}	
.has-medium-grey-background-colour { background-color: $camer_third_colour;}
#footer-copyright,
#footer-copyright a,
#footer-credit,
#footer-credit a,
blockquote cite,
.entry-meta, 
.entry-meta a, 
.entry-meta a:visited,
.related-post-date,
.has-medium-grey-colour	{ color: $camer_third_colour;}
::-webkit-input-placeholder { color: $camer_third_colour;}
::-moz-placeholder { color: $camer_third_colour;}
::-ms-input-placeholder { color: $camer_third_colour;}	
::placeholder { color: $camer_third_colour;} ";

// Miscellaneous

// show post banner as fixed
if ( esc_attr(get_theme_mod( 'show_post_featured_banner_fixed', false ) ) ) {
	$camer_customizer_css .=".post-single-featured-image { background-attachment: fixed; } ";
}
// show page banner as fixed
if ( esc_attr(get_theme_mod( 'show_page_featured_banner_fixed', false ) ) ) {
	$camer_customizer_css .=".page-featured-image { background-attachment: fixed; } ";
}

// show hide entry meta avatar
if ( esc_attr(get_theme_mod( 'camer_display_author_avatar', true ) ) ) {
	$camer_customizer_css .=".entry-meta .avatar { display: inline-block; } ";
}

// Dropcap
	$camer_dropcap_colour = esc_attr(get_theme_mod( 'camer_dropcap_colour', '#161616' ) );			
	$camer_customizer_css .="p.has-drop-cap:not(:focus):first-letter { color: $camer_dropcap_colour;	} ";

		
// END CUSTOM CSS - Output all the styles
wp_add_inline_style( 'camer-stylesheet', $camer_customizer_css );
	
}
add_action( 'wp_enqueue_scripts', 'camer_inline_styles' );
