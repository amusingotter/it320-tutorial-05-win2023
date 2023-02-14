<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Camer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Displays the date and author of a post
 */
if ( ! function_exists( 'camer_entry_meta' ) ) :

	function camer_entry_meta() {

 echo '<ul class="entry-meta post-details">' ;								
				camer_entry_author();
				camer_entry_date();
				camer_entry_comments();
				camer_edit_link();

		echo '</ul>';
	}
endif;

/**
 * Displays the meta info for the default blog styles
 */
if ( ! function_exists( 'camer_default_entry_meta' ) ) :

	function camer_default_entry_meta() {

 echo '<ul class="entry-meta post-details">' ;							
				camer_entry_author();
				camer_entry_date();
				camer_entry_comments();
				camer_edit_link();
		echo '</ul>';
	}
endif;

if ( ! function_exists( 'camer_sticky_entry_post' ) ) :
	// Returns the sticky label
	function camer_sticky_entry_post() {         
				if( is_sticky()  && ! is_archive() && esc_attr(get_theme_mod( 'camer_show_featured_tag', true ) ) ) { 
					echo '<div class="featured-post"><span class="featured-label">', esc_html_e('Featured', 'camer'), '</span></div>';
				}
	}
endif;


if ( ! function_exists( 'camer_entry_date' ) ) :
	// Returns the post date
	function camer_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		
		$posted_on = sprintf(
			/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'camer' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		echo '<li class="posted-on meta-date">' . $posted_on . '</li>'; // WPCS: XSS OK.	
	}
endif;


if ( ! function_exists( 'camer_entry_author' ) ) :
	// Returns the post author
	function camer_entry_author() {

		$author_avatar_size = apply_filters( 'camer_author_avatar_size', 32 );
		$author_string = sprintf( '<div class="byline">%1$s <span class="author vcard"><span class="written-by">%2$s </span><a class="url fn n" href="%3$s">%4$s</a></span></div>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			_x( 'By', 'Used before post author name.', 'camer' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);		

		echo '<li class="posted-by meta-author">' . $author_string . '</li>'; // WPCS: XSS OK.	
	}
endif;


if ( ! function_exists( 'camer_entry_comments' ) ) :
	// Displays the post comments
	function camer_entry_comments() {

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
				comments_popup_link(
					esc_html__( 'Comment', 'camer' )
				);
			echo '</li>';
		}
	}
endif;



// Get the full category list for a post
if ( ! function_exists( 'camer_categories' ) ) :
function camer_categories() {		
	echo get_the_category_list(); // WPCS: XSS OK.
	}
endif;

// Edit link function
if ( ! function_exists( 'camer_edit_link' ) ) :
	function camer_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'camer' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<li class="edit-link">',
			'</li>'
		);
	}
endif;

if ( ! function_exists( 'camer_blog_title' ) ) :
	/**
	 * Show a custom blog home title and introduction.
	 * Displays the archive title and archive description for the blog index
	 */
	function camer_blog_title() {

		// Get blog title and descripton from database.
		$camer_blog_title = get_theme_mod( 'camer_blog_title' );
		$camer_blog_description = get_theme_mod( 'camer_blog_description' );
		
		// Display Blog Title.
		if ( '' !== $camer_blog_title || '' !== $camer_blog_description || is_customize_preview() && get_theme_mod( 'camer_show_blog_title', false ) ) : ?>

<header class="archive-header blog-header clearfix">

    <?php // Display Blog Title.
				if ( '' !== $camer_blog_title || is_customize_preview() ) : ?>

    <h3 class="archive-title blog-title">
        <?php echo wp_kses_post( $camer_blog_title ); ?>
    </h3>

    <?php endif;

				// Display Blog Description.
				if ( '' !== $camer_blog_description || is_customize_preview() ) : ?>

    <p class="blog-description">
        <?php echo wp_kses_post( $camer_blog_description ); ?>
    </p>

    <?php endif; ?>

</header>

<?php endif;
	}
endif;


if ( ! function_exists( 'camer_featured_image' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 */
	function camer_featured_image() {
	
		// Set image size.
		$image_size = get_theme_mod( 'blog_layout' );  ?>

<?php if (has_post_thumbnail() ) { ?>
<figure class="post-image">

    <a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark">

        <?php 
				// Set the post thumbnail based on the blog layout and active cropped thumbnail setting
				$camer_blog_layout = get_theme_mod( 'camer_blog_layout', 'default' );
				switch ( esc_attr($camer_blog_layout ) ) {
	
				case "photowall":
					// alternating thumbnail
					the_post_thumbnail( 'camer-photowall-thumbnail' );
				break;
				
				case "default-left":
				case "default":
					// standard thumbnail
					the_post_thumbnail( 'camer-standard-thumbnail' );
				break;
				
				default:
					the_post_thumbnail( 'post-thumbnails' ); 
				}
				?>

    </a>

    <?php if ( has_post_thumbnail() && esc_attr(get_theme_mod( 'camer_show_featured_label', true ) ) ) {
				camer_sticky_entry_post(); 
			}
			?>
</figure>

<?php
		}
	}
endif;

// Displays the featured image caption on the image
if ( ! function_exists( 'camer_featured_image_caption' ) ) :
function camer_featured_image_caption() {
	
				$get_description = get_post(get_post_thumbnail_id())->post_excerpt;
				  if(!empty($get_description) && is_single() || is_page()) {
					  // If caption exists - show it
					 echo '<figcaption class="banner-featured-caption">' . esc_html($get_description) . '</figcaption>';
				  }
	}
endif;


if ( ! function_exists( 'camer_post_default_image' ) ) :
	// Displays the featured image on single posts in a standard default format
	function camer_post_image() {
		echo '<figure class="post-image">';
			the_post_thumbnail(); 
		echo '</figure>';			
	}
endif;


if ( ! function_exists( 'camer_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function camer_entry_tags() {

	$tag_list = get_the_tag_list( '<ul id="entry-tags"><li>', '</li><li>', '</li></ul>' );
	 
	if ( $tag_list && ! is_wp_error( $tag_list ) ) {
		echo $tag_list; // WPCS: XSS OK.	
	}		
		
	}
endif;


/**
 * Custom comment output
 */
function camer_comment( $comment, $args, $depth ) { ?>
<li <?php comment_class( 'clearfix' ); ?> id="li-comment-
    <?php comment_ID(); ?>">

    <div id="comment-<?php comment_ID(); ?>" class="comment-body">

        <div class="comment-wrapper">

            <div class="comment-author vcard clearfix">
                <?php echo get_avatar( $comment, 65 ); ?>
                <h6 class="comment-cite">
                    <?php comment_author_link() ?>
                </h6>
                <span class="comment-date">
                    <?php echo get_comment_date(); ?></span>
                <span class="comment-edit">
                    <?php edit_comment_link( esc_html__( 'Edit', 'camer' ) ); ?></span>
            </div>

            <div class="comment-content">
                <?php comment_text() ?>
                <p class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
                </p>
            </div>

            <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation">
                <?php esc_html_e( 'Your comment is awaiting moderation.', 'camer' ) ?></em>
            <?php endif; ?>
        </div>
    </div>
    <?php
}



/**
* Display custom archive titles without the labels
*/
 if ( esc_attr(get_theme_mod( 'camer_show_archive_labels', true ) ) ) :
 
	if ( ! function_exists( 'camer_archive_title' ) ) :

	function camer_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = sprintf( 
			/* translators: %s: Name of tag */
			esc_html__( 'Articles with %s', 'camer' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( 
			/* translators: %s: Name of author */
			esc_html__( 'Articles by %s', 'camer' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( 
			/* translators: %s: Name of year */
			esc_html__( 'Articles from: %s', 'camer' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'camer' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( 
			/* translators: %s: Name of month  */
			esc_html__( 'Articles from %s', 'camer' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'camer' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( 
			/* translators: %s: Name of day */
			esc_html__( 'Articles from %s', 'camer' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'camer' ) ) );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( 
			/* translators: %s: Name of archive title */
			esc_html__( 'Archives: %s', 'camer' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( 
			/* translators: %s: Name of title  */
			esc_html__( '%1$s: %2$s', 'camer' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = esc_html__( 'Archives', 'camer' );
		}

		/**
		 * Filter the archive title.
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;  // WPCS: XSS OK.
		}
	}
	endif;
endif;

/**
 * Displays pagination on the blog and archive pages
 */
if ( ! function_exists( 'camer_blog_navigation' ) ) :

	function camer_blog_navigation() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '<span class="nav-arrow">&laquo</span><span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'camer' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'camer' ) . '</span><span class="nav-arrow">&raquo;</span>',
		) );
	}
endif;

/**
 * Displays Single Post Navigation
 */
if ( ! function_exists( 'camer_post_navigation' ) ) :

	function camer_post_navigation() {

			if( esc_attr(get_theme_mod( 'camer_crop_list_featured', true ) || is_customize_preview()) ) {

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text">' . esc_html_x( 'Previous Post', 'post navigation', 'camer' ) . '</span><h5 class="nav-entry-title">%title</h5>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'camer' ) . '</span><h5 class="nav-entry-title">%title</h5>',
			) );
		}
	}
endif;

/**
 * Displays Multi-page Navigation
 */
if ( ! function_exists( 'camer_multipage_navigation' ) ) :

	function camer_multipage_navigation() {
		wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'camer' ),
		'after'  => '</div>',
		'link_before' => '<span class="page-wrap">',
		'link_after' => '</span>',
		) ); 
	}
endif;
