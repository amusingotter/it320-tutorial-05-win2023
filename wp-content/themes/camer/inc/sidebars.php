<?php 
/**
 * Register theme sidebars
 * @package Camer
*/
  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function camer_widgets_init() {
	
	register_sidebar( array(
		'name' => esc_html__( 'Blog Sidebar', 'camer' ),
		'id' => 'blog-sidebar',
		'description' => esc_html__( 'Sidebar for your blog and archives.', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Page Right Sidebar', 'camer' ),
		'id' => 'right-sidebar',
		'description' => esc_html__( 'Right sidebar for your pages.', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Page Left Sidebar', 'camer' ),
		'id' => 'left-sidebar',
		'description' => esc_html__( 'Left sidebar for your pages.', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Banner', 'camer' ),
		'id' => 'banner',
		'description' => esc_html__( 'For Images and Sliders.', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Content Top 1', 'camer' ),
		'id' => 'ctop1',
		'description' => esc_html__( 'Content Top 1 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Top 2', 'camer' ),
		'id' => 'ctop2',
		'description' => esc_html__( 'Content Top 2 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Top 3', 'camer' ),
		'id' => 'ctop3',
		'description' => esc_html__( 'Content Top 3 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Top 4', 'camer' ),
		'id' => 'ctop4',
		'description' => esc_html__( 'Content Top 4 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 1', 'camer' ),
		'id' => 'cbottom1',
		'description' => esc_html__( 'Content Bottom 1 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 2', 'camer' ),
		'id' => 'cbottom2',
		'description' => esc_html__( 'Content Bottom 2 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 3', 'camer' ),
		'id' => 'cbottom3',
		'description' => esc_html__( 'Content Bottom 3 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 4', 'camer' ),
		'id' => 'cbottom4',
		'description' => esc_html__( 'Content Bottom 4 position', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );			
	register_sidebar( array(
		'name' => esc_html__( 'Breadcrumbs', 'camer' ),
		'id' => 'breadcrumbs',
		'description' => esc_html__( 'For adding breadcrumb navigation if using a plugin, or you can add content here.', 'camer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );	

	// Register recent posts widget
	register_widget( 'Camer_Recent_Posts_Widget' );
	
}
add_action( 'widgets_init', 'camer_widgets_init' );


// Count the number of widgets to enable resizable widgets in the content top group.
function camer_ctop_group() {
	$count = 0;
	if ( is_active_sidebar( 'ctop1' ) )
		$count++;
	if ( is_active_sidebar( 'ctop2' ) )
		$count++;
	if ( is_active_sidebar( 'ctop3' ) )
		$count++;		
	if ( is_active_sidebar( 'ctop4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-lg-6';
			break;
		case '3':
			$class = 'col-lg-4';
			break;
		case '4':
			$class = 'col-sm-12 col-md-6 col-lg-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}
// Count the number of widgets to enable resizable widgets in the content top group.
function camer_cbottom_group() {
	$count = 0;
	if ( is_active_sidebar( 'cbottom1' ) )
		$count++;
	if ( is_active_sidebar( 'cbottom2' ) )
		$count++;
	if ( is_active_sidebar( 'cbottom3' ) )
		$count++;		
	if ( is_active_sidebar( 'cbottom4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-lg-6';
			break;
		case '3':
			$class = 'col-lg-4';
			break;
		case '4':
			$class = 'col-sm-12 col-md-6 col-lg-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}