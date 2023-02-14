<?php
/**
 * The template for displaying the footer.
 * @package Camer
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 $camer_footer_logo = get_theme_mod('camer_footer_logo' ); 
?>

<?php get_template_part( 'template-parts/sidebars/sidebar', 'content-bottom' ); ?>

<?php if ( get_theme_mod( 'camer_footer_logo' ) ) : ?>
<footer id="site-footer">
    <div id="footer-logo">
        <img id="footer-logo-image" src="<?php echo esc_url($camer_footer_logo); ?>" />
    </div>

    <?php else:
			echo '<footer id="site-footer">'; 
		 endif; 
		 ?>

    <nav id="footer-social-menu clearfix">
        <?php 
				if ( has_nav_menu( 'footer-social' ) ) : 									
						wp_nav_menu( array(
							'theme_location' => 'footer-social',
							'container' => false,
							'menu_class' => 'footer-social-menu',
							'echo' => true,
							'fallback_cb' => '',
							'link_before' => '<span class="social-label">',
							'link_after' => '</span>',
							'depth' => 1,
							)
						);
				 endif; ?>
    </nav>

    <?php 
				// Check if there is a footer menu.
				if ( has_nav_menu( 'footer' ) ) { 
					get_template_part( 'template-parts/navigation/nav', 'footer' ); 
				}
				?>

    <div id="footer-copyright">
        <?php esc_html_e('Copyright &copy;', 'camer'); ?>
        <?php echo date_i18n( __( 'Y', 'camer' ) ); // WPCS: XSS OK ?>
        <span class="copyright-name">
            <?php echo esc_html(get_theme_mod( 'camer_copyright' )); ?></span>.
        <?php esc_html_e('All rights reserved.', 'camer'); ?>
    </div>

    <?php 
			if ( esc_attr(get_theme_mod( 'camer_show_design_by', true ) ) ) {
		?>
    <div id="footer-credit">
        <?php esc_html_e('Camer theme designed by ', 'camer'); ?>
        <a href="<?php echo esc_url( __( 'https://www.bloggingthemestyles.com', 'camer' ) ); ?>">
            <?php esc_html_e( 'Blogging Theme Styles', 'camer' ); ?></a>
    </div>
    <?php 
			}
		?>

    <?php // If you enable the privacy policy page
		if ( function_exists( 'camer_the_privacy_policy_link' ) ) {
			echo '<div id="privacy-link">';
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			echo '</div>';
		}
		?>




</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>
