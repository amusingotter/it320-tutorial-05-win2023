<?php
/*
* Template Name: Custom Home Page
* Description: A home page with featured slider and widgets.
*
* @package sporty
* @since sporty 1.0
*/

get_header(); ?>

<?php

	/* SLIDER SECTION */

	$postOrShortcode  =  esc_attr( get_theme_mod( 'sporty_slider_choice', 'default') );

	if( $postOrShortcode === 'default' ){

		$featured_cat   	=   esc_attr( get_theme_mod( 'homepage_slider_cat') );
		$number         	=   absint( get_theme_mod( 'homepage_slider_slide_no', 3 ) );
		$hideTitleTeaser  =   esc_attr( get_theme_mod( 'homepage_slider_hide_text', false ) );
		$hideTeaser     	=   esc_attr( get_theme_mod( 'homepage_slider_hide_teaser', false ) );

		$the_query     =   new WP_Query( array(
			'cat'             => $featured_cat,
			'posts_per_page'  => $number,
			'meta_query'      => array(
				array(
					'key'           => '_thumbnail_id',
					'compare'       => 'EXISTS',
				),
			),
		));

	} elseif ( $postOrShortcode === 'shortcode') {

		$shortcode = get_theme_mod('sporty_slider_shortcode');
		echo do_shortcode( $shortcode );

	}

?>

<?php if( $postOrShortcode === 'default' ): ?>

	<div class="flex-container">
	    <div class="flexslider">
	        <ul class="slides">
	            <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
	            <li>
	                <?php the_post_thumbnail(); ?>
									<?php if( ! $hideTitleTeaser ): ?>
		                <div class="flex-caption">
		                    <div class="flex-caption-title">
		                        <a href="<?php the_permalink() ?>">
		                            <?php the_title(); ?>
		                        </a>
		                    </div>
												<?php if( ! $hideTeaser ): ?>
			                    <p><?php echo sporty_get_slider_excerpt(); ?><a href="<?php the_permalink() ?>">...</a></p>
												<?php endif; ?>
		                </div>
									<?php endif; ?>
	            </li>
	            <?php endwhile; wp_reset_query(); ?>
	        </ul>
	    </div>
	</div>

<?php

	endif; //end flexslider display


	/* PROMO BAR SECTION */

	$useAdvOptions = esc_attr( get_theme_mod('promo_use_new', false));
	$featuredTitle = esc_html( get_theme_mod('featured_title', __( 'THE ULTIMATE THEME FOR SPORTS CLUBS ', 'sporty' )));
	$featuredBtnTxt = esc_html( get_theme_mod('featured_btn_txt', __( 'Find Out More', 'sporty' )) );
	$featuredBtnUrl = esc_url( get_theme_mod('featured_btn_url', __( 'http://', 'sporty')) );

	if( $useAdvOptions ):
		echo '<div class="featuretext_top">';
			echo '<h3>' . $featuredTitle . '<a href="' . $featuredBtnUrl . '">' . $featuredBtnTxt . '</a></h3>' ;
		echo '</div>';
	else:
 ?>
	<div class="featuretext_top">
	    <h3><?php echo get_theme_mod( 'featured_textbox' ); ?></h3>
	</div>
<?php endif; ?>


<?php

 	/* ADVERT SECTION */

	$pageID = get_theme_mod( 'sporty_block1_page' );
  $block1_image = get_the_post_thumbnail_url( $pageID, 'homepage-block' );
  $block1_url = get_theme_mod( 'sporty_block_1_btn_url' );
  $showLeft = get_theme_mod( 'sporty_block_1_img_left' );

	if($pageID):
?>
<section id="block-1" class="home-block homepage-block-1 <?php if( $showLeft ){ echo 'align-left'; }?>">
  <div class="content-wrap">
    <?php

    if( $showLeft && $block1_image ){
      echo '<div class="six columns image"> <img src="' . esc_url( $block1_image ) . '" alt="' . esc_attr( get_the_title( $pageID ) ) . __(' featured image', 'sporty') . '"/> </div>';
    } ?>

    <div class="<?php if( $block1_image ){ echo 'six'; }else{ echo 'text-center-align'; }?> columns text-area">
      <?php

        $h2Class = '';
        $block1_subtitle = "";
        $readMore = get_theme_mod('sporty_block_1_btn_label', __( 'Read more', 'sporty' ));

        if( intval($pageID) ){

          echo '<h2 class="' . $h2Class . '">' . esc_html( get_the_title( $pageID ) ) . '</h2>';
          if( $block1_subtitle ){
            echo '<p class="sub-title">' . esc_html( $block1_subtitle ) . '</p>';
          }

          if( has_excerpt( $pageID ) ){
            echo '<p class="description">' . esc_html( get_the_excerpt( $pageID ) ) . '</p>';
          }

        }
        if( intval($block1_url) ){
          echo '<a class="btn btn-sm thar-three" href="' . esc_url( get_the_permalink( $block1_url ) ) . '">' . esc_html( $readMore ) . '</a>';
        }
      ?>
    </div>

    <?php // default show image to the right of the text.
    if(! $showLeft && $block1_image ){
      echo '<div class="six columns image"> <img src="' . esc_url( $block1_image ) . '" alt="' . esc_attr( get_the_title( $pageID ) ) . __('featured image', 'sporty') . '"/> </div>';
    }?>
  </div>
</section>
<?php
	endif; // only show advert block if page selected.
?>

<div id="primary" class="content-area">
    <div id="content" class="fullwidth" role="main">

        <div class="group">
            <div class="col span_2_of_3">
							<?php

								/* SHOW HOMEPAGE CONTENT */
								$showContent = get_theme_mod('homepage_show_page_content', false);
								if( $showContent ){
									the_content();
								}

								/* SHOW POSTS ON HOMEPAGE */
								$stickies 	= get_option( 'sticky_posts' );
								$postCount 	= get_theme_mod( 'homepage_post_count', 3);
								$hidePosts 	= get_theme_mod( 'homepage_hide_posts', false);
								$postCat		= get_theme_mod( 'homepage_post_cat', '');
								$latestPosts		= get_theme_mod( 'homepage_post_latest', false);
								$hideImages = get_theme_mod( 'homepage_hide_post_img', false);

								if ( !$hidePosts ) {
									if( $latestPosts ){
										$args = array(
												'cat'									=> esc_attr($postCat),
												'post_type'           => 'post',
												'posts_per_page'      => $postCount,
												'ignore_sticky_posts' => true
										);
									}else{
										$args = array(
												'cat'									=> esc_attr($postCat),
												'post_type'           => 'post',
												'post__in'            => $stickies,
												'posts_per_page'      => $postCount,
												'ignore_sticky_posts' => 1 // If you do not ignore stickies, all stickies will be returned regardless of what you have queried
										);
									}
									$the_query = new WP_Query($args);

									if ( $the_query->have_posts() ) {
										while ( $the_query->have_posts()) : $the_query->the_post();
								?>
											<article class="sticky">
													<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
													<?php
														 if( $hideImages ){
															 // show nothing.
														 }else{
															 ?>
															 <div class="blog-image">
		 															<?php if ( has_post_thumbnail() ) { $image_src=wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured' ); echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">'; } ?>
		 													 </div>
															<?php
														 }
													 ?>
													<?php echo sporty_content(50); ?>
													<div class="stickymore">
															<a href="<?php the_permalink() ?>">
																	<?php echo __( 'More', 'sporty'); ?>
															</a>
													</div>
											</article>
								<?php
										endwhile;
										wp_reset_postdata();
									}
									}
								?>
            </div>


            <div class="col span_1_of_3">
                <div class="home_widget">
                    <?php if ( is_active_sidebar( 'right_home_column' ) && dynamic_sidebar( 'right_home_column') ) : else : ?>
                    <?php echo '<h4>' . __( 'Widget Ready', 'sporty') . '</h4>'; ?>
                    <?php echo '<p>' . __( 'This right column is widget ready! Add one in the admin panel.', 'sporty') . '</p>'; ?>
                </div>
                <?php endif; ?>
            </div>

        </div>


    </div>
    <!-- #content .site-content -->
</div>
<!-- #primary .content-area -->
</div>
<?php get_footer(); ?>
