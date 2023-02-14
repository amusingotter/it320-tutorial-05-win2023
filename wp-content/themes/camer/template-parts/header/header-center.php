<?php
/**
 * The template for a centered header
 * @package Camer
 */
?>

<header id="masthead" class="site-header">
    <div id="site-branding" class="site-branding">

        <?php 
				if ( has_custom_logo() ) {
					the_custom_logo();
				}	
			

if ( esc_attr(get_theme_mod( 'camer_show_site_title', true ) ) ) {
			
						if ( is_front_page() ) { ?>
        <h1 id="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php bloginfo( 'name' ); ?>
            </a>
        </h1>
        <?php
						} else {						
						?>
        <p id="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php bloginfo( 'name' ); ?>
            </a>
        </p>
        <?php
						}
					}						
					$camer_description = get_bloginfo( 'description', 'display' );
						if ( $camer_description && esc_attr(get_theme_mod( 'camer_show_site_description', true ) ) || is_customize_preview() )  { 
					?>
        <p id="site-description">
            <?php echo $camer_description; /* WPCS: xss ok. */ ?>
        </p>
        <?php 
					}				
				?>

    </div><!-- .site-branding -->
</header><!-- #masthead -->

<?php get_template_part( 'template-parts/navigation/nav', 'primary' ); ?>

<div id="header-page-footer">
    <div id="header-page-footer-inner"></div>
</div>
<?php get_template_part( 'template-parts/navigation/nav', 'social' ); ?>
