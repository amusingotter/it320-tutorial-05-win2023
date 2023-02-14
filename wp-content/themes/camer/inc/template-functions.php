<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Camer
 */

if ( ! function_exists( 'camer_fallback_menu' ) ) :
	/**
	 * Display default page as navigation if no custom menu was set
	 */
	function camer_fallback_menu() {
		$pages = wp_list_pages( 'title_li=&echo=0' );
		echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">' .  $pages  . '</ul>';  // WPCS: XSS OK.
	}
endif;

/**
 * Adds custom classes to the array of body classes.
 * @param array $classes Classes for the body element.
 * @return array
 */
function camer_body_classes( $classes ) {

// Set Header Style.	
	$classes[] = 'header-center';
	
// Set blog layout.		
$camer_blog_layout = esc_attr(get_theme_mod( 'camer_blog_layout', 'default' ) );

if (is_home() || is_archive() ) {	
		if ( 'photowall' === $camer_blog_layout ) {	
			$classes[] = 'blog-photowall';

		} elseif ( 'default-left' === $camer_blog_layout ) {	
			$classes[] = 'blog-default-left';	
					
		} else {
			$classes[] = 'blog-default-right';
		}
	}

// Set Single layout.		
	$classes[] = 'single-right';	

/** 
 * Check if sidebar widget area is empty and what template is being used.
 * This is for the Page Templates sidebar position
 */
	if ( is_page_template( 'templates/left-sidebar.php' ) ) {
		$classes[] = 'sidebar-left';		
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$classes[] = 'sidebar-right';	
	} elseif ( is_page_template( 'templates/short-width.php' ) ) {
		$classes[] = 'sidebar-none';		
	} else {
		// fallback
		$classes[] = 'sidebar-blog';
	}
	

// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'camer_body_classes' );


/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function camer_post_classes( $classes ) {

	// Add comments-off class.
	if ( ! ( comments_open() || get_comments_number() ) ) {
		$classes[] = 'comments-off';
	}
	
	if ( ! has_post_thumbnail()) {
		$classes[] = 'has-no-featured-image';
	}
	
	return $classes;
}
add_filter( 'post_class', 'camer_post_classes' );


// Display the related posts
if ( ! function_exists( 'camer_related_posts' ) ) {

   function camer_related_posts() {
      wp_reset_postdata();
      global $post;

      // Define shared post arguments
      $args = array(
         'no_found_rows'            => true,
         'update_post_meta_cache'   => false,
         'update_post_term_cache'   => false,
         'ignore_sticky_posts'      => 1,
         'orderby'               => 'rand',
         'post__not_in'          => array($post->ID),
         'posts_per_page'        => 2
      );
      // Related by categories
      if ( get_theme_mod('camer_related_posts', 'categories') == 'categories' ) {

         $cats = get_post_meta($post->ID, 'related-posts', true);

         if ( !$cats ) {
            $cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
            $args['category__in'] = $cats;
         } else {
            $args['cat'] = $cats;
         }
      }
      // Related by tags
      if ( get_theme_mod('camer_related_posts', 'categories') == 'tags' ) {

         $tags = get_post_meta($post->ID, 'related-posts', true);

         if ( !$tags ) {
            $tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
            $args['tag__in'] = $tags;
         } else {
            $args['tag_slug__in'] = explode(',', $tags);
         }
         if ( !$tags ) { $break = true; }
      }

      $query = !isset($break)?new WP_Query($args):new WP_Query;
      return $query;
   }

}


//	Move the read more link outside of the post summary paragraph	
add_filter( 'the_content_more_link', 'camer_move_more_link' );
	function camer_move_more_link() {
		$camer_read_more_text = esc_html( get_theme_mod( 'camer_read_more_text' ) );
	return '<p class="more-link-wrapper"><a class="more-link" href="'. esc_url(get_permalink()) . '">' . esc_html__( 'Read More&hellip;', 'camer' ) . '</a></p>';
}


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function camer_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	// Get excerpt length from database.
	$excerpt_length = esc_attr(get_theme_mod( 'camer_excerpt_length', '35' ) );
	// Return excerpt text.
	if ( $excerpt_length >= 0 ) :
		return absint( $excerpt_length );
	else :
		return 35; // Number of words.
	endif;
}
add_filter( 'excerpt_length', 'camer_excerpt_length' );


/**
 * Change excerpt more text for posts
 *
 * @param String $more_text Excerpt More Text.
 * @return string
 */
function camer_excerpt_more( $more_text ) {

	if ( is_admin() ) {
		return $more_text;
	}

	return '&hellip;';
}
add_filter( 'excerpt_more', 'camer_excerpt_more' );


/*
* Image attachment description
*/
function wp_get_attachment( $attachment_id ) {

$attachment = get_post( $attachment_id );
return array(
'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
'caption' => $attachment->post_excerpt,
'description' => $attachment->post_content,
'href' => get_permalink( $attachment->ID ),
'src' => $attachment->guid,
'title' => $attachment->post_title
);
}
