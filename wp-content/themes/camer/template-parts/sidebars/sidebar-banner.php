<?php
/**
 * For displaying banner
 * @package Camer
*/

if ( ! is_active_sidebar( 'banner' ) ) {
	return;
}
?>

<?php if ( is_active_sidebar( 'banner' ) ) : ?>
<aside id="banner-sidebar" class="widget-area">
    <?php dynamic_sidebar( 'banner' ); ?>
</aside>
<?php endif; ?>
