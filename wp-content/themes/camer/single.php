<?php
/**
 * The Template for displaying all single posts.
 * @package Camer
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
?>

<div id="single-wrapper" class="container">
	<div id="primary" class="content-area row">
		<main id="main" class="site-main col-lg-8">
			<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/post/content', 'single' );			
							if( true == esc_attr(get_theme_mod( 'camer_post_navigation' ) ) ) {
								camer_post_navigation();	
							}	
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile;
					?>
		</main>
		
		<div class="col-lg-4">
		<?php get_sidebar(); ?>
		</div>
		
	</div>
</div>



<?php get_footer(); ?>
