<?php
/**
 * Template part for displaying posts
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Camer
 */

?>


<?php $camer_blog_layout = get_theme_mod( 'camer_blog_layout', 'default' );	
		switch ( esc_attr($camer_blog_layout ) ) {
	
		case "photowall":
			// photowall
			echo '<li class="col-md-6  col-lg-4 col-xl-3"><article id="post-', the_ID(), '"', esc_attr(post_class()), '><div class="post-content">';
				camer_featured_image(); 
			echo '<header class="entry-header flex-center"><div class="photowall-caption">';			
				the_title( '<h3 class="entry-title">', '</h3>' );
			echo '<ul class="entry-meta">';			
				camer_entry_date();		
			echo '</ul></div><a href="'. esc_url( get_permalink() ) . '"></a></header></div></article></li>';			
			break;	
		
		default:
			// default blog
			echo '<article id="post-', the_ID(), '"', esc_attr(post_class()), '>';
				camer_featured_image(); 
			echo '<div class="post-content">';			
			echo '<div class="entry-content"><header class="entry-header">';
			
			if ( ! has_post_thumbnail() && esc_attr(get_theme_mod( 'camer_show_featured_label', true ) ) ) {
				camer_sticky_entry_post(); 
			}
			
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></header>' );					
				
				if ( 'excerpt' === esc_attr(get_theme_mod( 'camer_blog_content', 'index' )) ) {
					the_excerpt();				
				} else {							
					the_content( sprintf(
					/* translators: %s: Name of current post */
						__( 'Read More&hellip;<span class="screen-reader-text"> "%s"</span>', 'camer' ),
						get_the_title()
					) );
				}	
				
			camer_default_entry_meta();	
			camer_multipage_navigation();
			echo '</div></div></article>';
		}
	?>
