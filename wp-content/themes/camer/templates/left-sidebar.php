<?php
/**
 * Template Name: Page Left Sidebar
 * Description: Displays a page with a left sidebar.- source ordered content.
 * @package Camer
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="page-wrapper" class="container">

    <?php get_template_part( 'template-parts/sidebars/sidebar', 'content-top' ); ?>

    <div class="row">

        <div id="primary" class="content-page col-lg-8 order-lg-2">
            <main id="main" class="site-main ">
                <?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/page/content', 'page' ); 
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile; ?>
            </main>
        </div>

        <div class="col-lg-4 order-4 order-lg-1">
            <?php get_sidebar();?>
        </div>

    </div>



</div>

<?php 
get_footer();
