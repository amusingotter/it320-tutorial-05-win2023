<?php
/**
 * Main Navigation
 * @package Camer
 */
?>

    <nav id="main-navigation" class="primary-navigation navigation clearfix">
        <?php
		// Display Main Navigation.
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'main-navigation-menu',
			'echo' => true,
			'fallback_cb' => 'camer_fallback_menu',
			)
		);
	?>
    </nav>
