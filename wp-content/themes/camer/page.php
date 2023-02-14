<?php
/**
 * The template for displaying a page
 * @package Camer
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="page-wrapper" class="container">

    <?php get_template_part( 'template-parts/sidebars/sidebar', 'content-top' ); ?>

    <div class="row">
        <div id="primary" class="content-page content-area col-12">
            <main id="main" class="site-main">

                <?php while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div>


</div>


<?php 
get_footer();
