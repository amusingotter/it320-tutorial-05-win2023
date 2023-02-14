<?php
/**
 * The template for displaying Search results.
 * @package Camer
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="page-wrapper" class="container">

    <div id="primary" class="content-archive content-area">
        <main id="main" class="site-main">

            <?php
		if ( have_posts() ) : ?>

            <header class="archive-header">

                <h1 class="archive-title">
                    <?php printf( 
				/* translators: %s: for the search keyword */
				esc_html__( 'Search Results for: %s', 'camer' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>
                <?php get_search_form(); ?>

            </header><!-- .archive-header -->

            <div id="post-wrapper" class="post-wrapper">

                <?php while ( have_posts() ) : the_post();
				
					get_template_part( 'template-parts/post/content', 'search' );
			
			endwhile; ?>

            </div>

            <?php
			camer_blog_navigation();
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

</div>

<?php
get_footer();
