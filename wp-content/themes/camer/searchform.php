<?php
/**
 * This template displays the search form.
 * @package Camer
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>



<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text">
            <?php echo esc_html_x( 'Search for:', 'label', 'camer' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'camer' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'camer' ); ?>" />
    </label>
    <button type="submit" class="search-submit">
        <?php echo camer_get_svg( 'search' ); ?>
        <span class="screen-reader-text">
            <?php echo esc_html_x( 'Search', 'submit button', 'camer' ); ?></span>
    </button>
</form>
