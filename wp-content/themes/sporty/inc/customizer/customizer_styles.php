<?php

function sporty_add_customizer_css() { ?>

	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/<?php echo strtolower( get_theme_mod( 'sporty_color_scheme', 'blue' ) ); ?>.css" type="text/css" media="screen">
  <style rel="stylesheet" id="customizer-css">
    <?php
      $siteWidth = esc_attr( get_theme_mod('site_width', 960) );
      if( $siteWidth ){ ?>
        #wrap, #main,
        .main-navigation,
        .site-title,
        .site-description,
        .site-footer,
        #masthead-wrap,
        .flex-container {
          max-width: <?php echo $siteWidth;?>px;
        }
    <?php
      }
    ?>
  </style>


<?php }
add_action( 'wp_head', 'sporty_add_customizer_css' );


/*------------------------------------*\
  #COLORS OUTPUT
\*------------------------------------*/
function sporty_colors_customizer_get_output() {

    // Start output buffering
    ob_start();
    ?>
		#wrap,
		.sticky h1,
		.site-footer,
		.home_widget h4,
		.widget-title,
		.flex-caption-title {
			border-color: <?php echo esc_attr( get_theme_mod( 'sporty_primary_color', '#6699CC' ) ); ?>;
		}

		.main-navigation li.current_page_item,
		#main-navigation li.current-menu-parent,
		.main-navigation li:hover a,
		.main-navigation > li > a,
		.main-navigation li.current_page_ancestor a,
		.main-navigation li.current_page_item,
		#main-navigation li.current-menu-parent,
		.main-navigation li.current_page_item:hover a,
		#main-navigation li.current_page_item:hover,
		.main-navigation li.current-menu-parent:hover > a,
		.main-navigation li.current-menu-parent ul.sub-menu li.current_page_item,
		.featuretext_top,
		.menu-top-menu-container .current-menu-item {
		    background-color: <?php echo esc_attr( get_theme_mod( 'sporty_primary_color', '#6699CC' ) ); ?>!important;
		}

		.main-navigation ul ul li a:hover,
		#main-navigation ul ul li a:hover i,
		.main-navigation li.current-menu-parent ul.sub-menu li.current_page_item a,
		.stickymore a:hover,
		.entry-content a, .entry-content a:visited,
		.entry-summary a,
		.entry-summary a:visited,
		.main-small-navigation li:hover > a,
		.main-small-navigation li.current_page_item a,
		.main-small-navigation li.current-menu-item a,
		.main-small-navigation ul ul a:hover,
		.site-description{
			color: <?php echo esc_attr( get_theme_mod( 'sporty_primary_color', '#6699CC' ) ); ?>!important;
		}

		header#masthead{
			background-color: <?php echo esc_attr( get_theme_mod( 'sporty_header_color', '#000000' ) ); ?>!important;
		}


		<?php

		// Release output buffering
		return ob_get_clean();
}

function sporty_colors_customizer_wp_head() {

	if( get_theme_mod( 'sporty_own_colors' ) ){
		echo '<style type="text/css">' . sporty_colors_customizer_get_output() . '</style>';
	}

}

add_action('wp_head', 'sporty_colors_customizer_wp_head', 20);
