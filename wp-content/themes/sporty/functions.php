<?php
/**
 * sporty functions and definitions
 *
 * @package sporty
 * @since sporty 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since sporty 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'sporty_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since sporty 1.0
 */
function sporty_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on sporty, use a find and replace
	 * to change 'sporty' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sporty', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sporty' ),
		'secondary' => __( 'Secondary Menu', 'sporty'),
	) );

	function sporty_get_secondary_menu() {
	    if ( has_nav_menu( 'secondary' ) ) {
				wp_nav_menu( 	array(
						'theme_location'  => 'secondary',
						'container'       => 'div',
						'container_id'    => 'menu-secondary',
						'container_class' => 'menu-secondary',
						'menu_id'         => 'menu-secondary-items',
						'menu_class'      => 'menu-items text-right',
						'depth'           => 1,
						'fallback_cb'     => '',
				));
	    }
		}

	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size(100, 300, true);
	add_image_size( 'homepage-block', 700, 394, array('center', 'center'));

	// Display Title in theme
	add_theme_support( 'title-tag' );

	// Custom Header support
	add_theme_support( 'custom-header' );

	//Add support for the Aside Post Formats
	add_theme_support( 'post-formats', array( 'aside', ) );


	// link a custom stylesheet file to the TinyMCE visual editor
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans' );
	add_editor_style( array('style.css', 'css/editor-style.css', $font_url) );

}
endif; // sporty_setup
add_action( 'after_setup_theme', 'sporty_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since sporty 1.0
 */
function sporty_register_custom_background() {
	$args = array(
		'default-color' => 'EEE',
	);

	$args = apply_filters( 'sporty_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( $args['default-color'] );
		define( $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', 'sporty_register_custom_background' );


function sporty_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'sporty_add_excerpt_support_for_pages' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since sporty 1.0
 */
function sporty_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'sporty' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'sporty' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar(array(
			'name' => 'Left Footer Column',
			'id'   => 'left_column',
			'description'   => 'Widget area for footer left column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Center  Footer Column',
			'id'   => 'center_column',
			'description'   => 'Widget area for footer center column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Right Footer Column',
			'id'   => 'right_column',
			'description'   => 'Widget area for footer right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Right Home Column',
			'id'   => 'right_home_column',
			'description'   => 'Widget area for homepage right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

}
add_action( 'widgets_init', 'sporty_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function sporty_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), '', '1.8.2' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120207', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120203' );
	}

	wp_enqueue_script('flexslider', get_template_directory_uri('stylesheet_directory').'/js/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_script('flexslider-init', get_template_directory_uri('stylesheet_directory').'/js/flexslider-init.js', array('jquery', 'flexslider'));
	wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120203' );
	wp_enqueue_script( 'smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '',  true );

	wp_enqueue_style('flexslider', get_template_directory_uri().'/js/flexslider.css', '', '1.8.2');

}
add_action( 'wp_enqueue_scripts', 'sporty_scripts' );


/**
 * Show Welcome screen on activation
*/
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/welcome-screen.php';
}
function sporty_welcome_redirect(){
  global $pagenow;
  if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
  	wp_redirect( admin_url( 'themes.php?page=sporty-welcome' ) );
  }
}
add_action('after_setup_theme', 'sporty_welcome_redirect');


/**
 * Load plugin enhancement file to display admin notices.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/plugin-enhancement.php';
add_action( 'tgmpa_register', 'sporty_register_required_plugins' );

/**
 * Pro Link
 */
 function sporty_get_pro_link( $content ) {
	return esc_url( 'https://www.templateexpress.com/sporty-pro-theme' );
}

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer/customizer_controller.php';
require get_template_directory() . '/inc/customizer/settings.php';
require get_template_directory() . '/inc/customizer/customizer_styles.php';

/**
 * Implement excerpt for homepage slider
 */
function sporty_get_slider_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 100);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return balanceTags($excerpt, true);
}

function sporty_content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return balanceTags($content, true);
}

/**
 * Implement the Custom Header feature
 */

function sporty_custom_header_setup() {
	$args = array(
		'default-image'          => '',
			'default-text-color'     => 'FFF',
			'width'                  => get_theme_mod('site_width', 960),
			'height'                 => get_theme_mod('site_height', 400),
			'flex-height'            => true,
			'wp-head-callback'       => 'sporty_header_style',
			'admin-head-callback'    => 'sporty_admin_header_style',
			'admin-preview-callback' => 'sporty_admin_header_image',
	);
	$args = apply_filters( 'sporty_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
			add_theme_support( 'custom-header', $args );
	}
}
add_action( 'after_setup_theme', 'sporty_custom_header_setup' );


if ( ! function_exists( 'sporty_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see sporty_custom_header_setup().
 *
 * @since sporty 1.0
 */
function sporty_header_style() {

	// If no custom options for text are set, let's bail
	
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Do we have a custom header image?
		if ( '' != get_header_image() ) :
	?>
		.site-header img {
			display: block;
		}
	<?php endif;

		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		.site-header hgroup {
			background: none;
			padding: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // sporty_header_style

if ( ! function_exists( 'sporty_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see sporty_custom_header_setup().
 *
 * @since sporty 1.0
 */
function sporty_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #000;
		border: none;
		min-height: 200px;
	}
	#headimg h1 {
		font-size: 30px;
		font-family: Georgia, 'Times New Roman', serif;
		font-style: italic;
		font-weight: normal;
		padding: 0.8em 0.5em 0;
	}
	#desc {
		padding: 0 2em 2em;
	}
	#headimg h1 a,
	#desc {
		color: #666;
		text-decoration: none;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // sporty_admin_header_style

if ( ! function_exists( 'sporty_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see sporty_custom_header_setup().
 *
 * @since sporty 1.0
 */
function sporty_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // sporty_admin_header_image


/**
 * Declare SportsPress Support
 */
add_theme_support( 'sportspress' );
