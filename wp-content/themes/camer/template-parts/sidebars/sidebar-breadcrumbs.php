<?php
/**
 * For displaying breadcrumbs
 * @package Camer
*/

if ( ! is_active_sidebar( 'breadcrumbs' ) ) {
	return;
}
 
?>


<nav id="breadcrumb-sidebar" class="widget-area">
	<?php dynamic_sidebar( 'breadcrumbs' ); ?>
</nav> 
