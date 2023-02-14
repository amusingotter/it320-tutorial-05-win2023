<?php
/**
 * The template for displaying page article content
 * @package Camer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() && true == esc_attr(get_theme_mod( 'show_page_featured_image' ) ) && ! is_page_template( 'templates/about.php' ) ) {					
		camer_post_image();
	} 
	?>

    <div class="post-content">
        <header class="entry-header">
            <?php 
			$show_page_featured_banner = esc_attr(get_theme_mod( 'show_page_featured_banner', true ) );
			// show the regular title if we are not showing the banner featured image
			if ( false == $show_page_featured_banner || ! has_post_thumbnail() || is_page_template( 'templates/about.php' )) {	
			the_title( '<h1 class="page-title">', '</h1>' );
			}
			?>
        </header>


        <div class="entry-content clearfix">
            <?php the_content(); ?>
            <?php camer_multipage_navigation(); ?>
        </div>

    </div>
</article>
