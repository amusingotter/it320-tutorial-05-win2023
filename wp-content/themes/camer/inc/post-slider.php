<?php 
/**
 * Featured image slider, displayed on front page for static page and blog. Recommend that you create a
 * featured category where you can create only featured posts to display in your slides.
 *
 * Function excerpt = custom excerpt length for our slides
 * Function featured slider = Second is our structure for building our slides.
 */

 
 /*
* Custom Excerpt Length
* Use camer_slide_excerpt(20); 
* This is REQUIRED for managing the slider exerpt size independently of the blog
* Does not affect the admin posts excerpt view.
*/

function camer_slide_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }
      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
      return $excerpt;
}

// Build the slides  
if( ! function_exists( 'camer_post_slider' ) ) :
	function camer_post_slider() {


$slides = array(); 

$slider_cat     = esc_attr(get_theme_mod( 'camer_slider_cat' ) );
$slide_count = esc_attr(get_theme_mod( 'camer_slide_count', 3 ) );
$slide_excerpt_size = esc_attr(get_theme_mod( 'camer_slide_excerpt_size', 10 ) );

// set our query attributes
$args = array( 
	'cat' => $slider_cat, 
	'nopaging'=>true, 
	'posts_per_page' => $slide_count, 
	);

// set our query up
$slider_query = new WP_Query( $args );
if ( $slider_query->have_posts() ) {
    while ( $slider_query->have_posts() ) {
        $slider_query->the_post();
        if(has_post_thumbnail()) {
            $temp = array();
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'camer-slide-thumbnail', true);
            $thumb_url = $thumb_url_array[0];
            $temp['title'] = get_the_title();
            $temp['link'] = get_permalink();
            $temp['image'] = $thumb_url;
			$temp['excerpt'] = camer_slide_excerpt( $slide_excerpt_size );
            $slides[] = $temp;
        }
    }
} 
wp_reset_postdata();
?>

<?php if(count($slides) > 0) { ?>

<div id="bootstrap-carousel" class="carousel slide carousel-fade" data-ride="carousel">

    <ol class="carousel-indicators">
        <?php for($i=0;$i<count($slides);$i++) { ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo esc_attr($i); ?>" <?php if($i==0) { ?>class="active"
            <?php } ?>></li>
        <?php } ?>
    </ol>

    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($slides as $slide) { extract($slide); ?>
        <div class="carousel-item <?php if($i == 0) { ?>active<?php } ?>">
            <img src="<?php echo esc_attr($image); ?>" alt="<?php echo esc_attr($title); ?>">
            <div class="carousel-caption-box">
                <div class="carousel-caption">
                    <?php if ( esc_attr(get_theme_mod( 'camer_display_slide_title', true ) )  ) { ?>
                    <h3 class="slide-title"><a href="<?php echo esc_attr($link); ?>">
                            <?php echo esc_attr($title); ?></a></h3>
                    <?php } ?>

                    <?php if ( esc_attr(get_theme_mod( 'camer_display_slide_excerpt', true ) )  ) { ?>
                    <p class="slide-excerpt">
                        <?php echo esc_html($excerpt); ?>
                    </p>
                    <?php } ?>

                    <?php if ( esc_attr(get_theme_mod( 'camer_display_slide_readmore', false ) )  ) { ?>
                    <p class="slide-readmore"><a href="<?php echo esc_attr($link); ?>">
                            <?php esc_html_e( 'Read More','camer' ); ?></a></p>
                    <?php } ?>

                </div>
            </div>

        </div>
        <?php $i++; } ?>
    </div>
    <div id="carousel-nav">
        <a class="carousel-control-prev" href="#bootstrap-carousel" role="button" data-slide="prev">
            <?php echo camer_get_svg( 'collapse' ); ?><span class="screen-reader-text">
                <?php esc_html_e( 'Previous', 'camer' ); ?></span></a>
        <a class="carousel-control-next" href="#bootstrap-carousel" role="button" data-slide="next">
            <?php echo camer_get_svg( 'expand' ); ?><span class="screen-reader-text">
                <?php esc_html_e( 'Next', 'camer' ); ?></span></a>
    </div>
</div>

<?php } 
	
	
	
		
	}
endif;

add_action( 'camer_post_slider', 'camer_post_slider', 15 );
