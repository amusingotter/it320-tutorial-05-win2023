<?php
/**
 * The template for displaying the header
 * @package Camer
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page">
        <?php get_template_part( 'template-parts/header/header-center' ); ?>

        <?php get_template_part( 'template-parts/sidebars/sidebar', 'banner' ); ?>

        <?php if ( has_post_thumbnail() && esc_attr(get_theme_mod( 'show_post_single_featured_banner', true ))  && is_single() )  : ?>
        <div id="featured-image-banner">
            <figure class="post-single-featured-image" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url() ) ?>');">
                <?php echo '<div id="featured-image-banner-caption">', the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <?php if( esc_attr(get_theme_mod( 'camer_show_featured_captions', true ) ) ) {			
			camer_featured_image_caption();
			} 
			echo '</div>';
		?>
            </figure>
        </div>
        <?php endif; ?>

        <?php if ( has_post_thumbnail() && ! is_page_template( 'templates/about.php' ) && esc_attr(get_theme_mod( 'show_page_featured_banner', true ))  && is_page() )  : ?>
        <div id="featured-image-banner">
            <figure class="page-featured-image" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url() ) ?>');">
                <?php echo '<div id="featured-image-banner-caption">', the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <?php if( esc_attr(get_theme_mod( 'camer_show_featured_captions', true ) ) ) {			
			camer_featured_image_caption();
			} 
			echo '</div>';
		?>
            </figure>
        </div>
        <?php endif; ?>

        <?php // Display slider if enabled
		if ( is_front_page() && true == esc_attr(get_theme_mod( 'camer_display_slider' ) )   ) { 
			camer_post_slider(); 
			wp_reset_postdata();
		}
?>

<?php 
if ( ! is_front_page() ) {
	get_template_part( 'template-parts/sidebars/sidebar', 'breadcrumbs' ); 
}
?>
