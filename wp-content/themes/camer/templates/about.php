<?php
/**
 * Template Name: About Page
 * Description: Displays a page with a about left and right
 * @package Camer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="page-wrapper">

    <?php get_template_part( 'template-parts/sidebars/sidebar', 'content-top' ); ?>

    <div class="about-container">

        <div id="about-page-left" class="content-page">

            <?php if ( has_post_thumbnail() ) {					
		camer_post_image();
	} 
	?>

        </div>

        <div id="about-page-right">
            <main id="main" class="site-main ">
                <?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/page/content', 'page' ); 
					endwhile; ?>
            </main>
        </div>

    </div>




</div>

<?php 
get_footer();
