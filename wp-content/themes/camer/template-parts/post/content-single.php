<?php
/**
 * Single post partial template.
 *
 * @package Camer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
<?php if ( has_post_thumbnail() && esc_attr(get_theme_mod( 'show_post_single_featured_image', true ) ) ) { 			
	camer_post_image();
} 
?>  

	<div class="post-content">	
		<header class="entry-header">
			<?php 
			$show_post_single_featured_banner = esc_attr(get_theme_mod( 'show_post_single_featured_banner', true ) );
			// show the regular title if we are not showing the banner featured image
			if ( false == $show_post_single_featured_banner  || ! has_post_thumbnail()) {	
			the_title( '<h1 class="entry-title">', '</h1>' );
			}
			if( esc_attr(get_theme_mod( 'camer_meta_info', true ) ) ) {
			camer_default_entry_meta(); 
			}
			?>
		</header> 

		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php camer_multipage_navigation(); ?>
		</div>


		<footer class="entry-footer">
			<?php if ( esc_attr(get_theme_mod( 'camer_meta_category', true ) ) ) {
			echo '<p id="footer-posted-in">', esc_html_e( 'Posted In', 'camer' ) . '</p>';
				camer_categories();
			}
			
			if ( has_tag() && esc_attr(get_theme_mod( 'camer_meta_tags', true ) )) {
				echo '<p id="footer-tagged-with">', esc_html_e( 'Tagged', 'camer' ) . '</p>';
				camer_entry_tags(); 
			}
			?>

			<?php // Related posts show or hide
			if( esc_attr(get_theme_mod( 'camer_show_related_posts', true ) ) ) {
				get_template_part( 'inc/related-posts' );
			}
			?>
		</footer>
	</div>
</article>
