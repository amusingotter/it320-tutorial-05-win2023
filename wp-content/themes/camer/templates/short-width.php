<?php
/**
 * Template Name: Short Width No Sidebars
 * Template Post Type: page
 * Description: Display a page with a shorter width and no left or right sidebars.
 * @package Camer
 */

get_header(); ?>

<div id="page-wrapper" class="container">

    <?php get_template_part( 'template-parts/sidebars/sidebar', 'content-top' ); ?>

    <div class="row justify-content-center">
        <div id="primary" class="content-page col-lg-8 align-self-center">
            <main id="main" class="site-main">

                <?php
		while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div>

</div>

<?php 
get_footer();
