<?php
/**
 * The template for displaying the blog index (latest posts)
 * This template also handles the archives
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Camer
 */
 
	
get_header(); ?>

<?php
		if ( is_home() &&  esc_attr(get_theme_mod( 'camer_show_blog_title', false ) ) )  {
			camer_blog_title();
		}
		
		if ( is_archive() ) {
			echo '<header class="archive-header">';
			// customize the archive titles if set to true
				if ( esc_attr(get_theme_mod( 'camer_show_archive_labels', true ) ) ) :
					camer_archive_title( '<h1 class="archive-title">', '</h1>' );
				else: 
					the_archive_title( '<h1 class="archive-title">', '</h1>' );
				endif;		
					the_archive_description( '<div class="archive-description">', '</div>' );
			echo '</header>';
		}
		
		if ( have_posts() ) :
			
			echo '<div class="post-wrapper container">';	

			get_template_part( 'template-parts/sidebars/sidebar', 'content-top' ); 

			$camer_blog_layout = get_theme_mod( 'camer_blog_layout', 'default' );	
				switch ( esc_attr($camer_blog_layout ) ) {
					
				case "photowall":
					// photowall
					echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-12"><ul id="photowall" class="row row-eq-height">';
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/post/content', get_post_format() );
						endwhile;
					echo '</ul></main></div>';
					break;						
				case "default-left":
					// default left sidebar
					echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-8 order-lg-2">';
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/post/content', get_post_format() );
						endwhile;
					echo '</main><div class="col-lg-4 order-3 order-lg-1">';		
						get_sidebar(); 
					echo '</div></div>';
				break;	
				
				default:
					// default blog
					echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-8">';
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/post/content', get_post_format() );
						endwhile;
					echo '</main><div class="col-lg-4">';	
						get_sidebar(); 
					echo '</div></div>';
				}
		
			camer_blog_navigation();
			get_template_part( 'template-parts/sidebars/sidebar', 'bottom' ); 
			
			echo '</div><!-- .post-wrapper -->';
			
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif; 
		?>


<?php
get_footer();
