<?php
/**
 * Template Name: Page Right Sidebar
 * Description: Displays a page with a right sidebar.
 * @package Camer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="page-wrapper" class="container">

    <?php get_template_part( 'template-parts/sidebars/sidebar', 'content-top' ); ?>

    <div class="row">

        <div id="primary" class="content-page col-lg-8">
            <main id="main" class="site-main ">
                <?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/page/content', 'page' ); 
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile; ?>
            </main>
        </div>

        <div class="col-lg-4">
            <?php get_sidebar();?>
        </div>

    </div>



</div>

<?php 
get_footer();
