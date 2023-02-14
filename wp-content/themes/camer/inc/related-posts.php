<?php
/**
 * Related Posts for full post
 * @package Camer
*/
?>


<?php $related_posts = camer_related_posts(); 
 if ( $related_posts->have_posts() ): ?>

<div id="related-posts-wrapper">
    <h4 id="related-posts-heading"><span>
            <?php esc_html_e('You may also like these articles', 'camer'); ?></span></h4>

    <ul id="related-posts" class="row">
        <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>

        <li class="col-md-6">

            <?php if ( has_post_thumbnail() ): ?>
            <figure class="related-posts-thumbnail">
                <a class="related-posts-link" href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('camer-related-thumbnail'); ?>
                </a>
            </figure>
            <?php else: ?>
            <figure class="related-posts-thumbnail">
                <a class="related-posts-link" href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/no-related.png" alt="<?php esc_html_e( 'related-post', 'camer');?>" />
                </a>
            </figure>
            <?php endif; ?>

            <div class="related-posts-content">
                <h3 class="related-posts-title">
                    <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?></a>
                </h3>
                <div class="related-post-date">
                    <?php echo the_modified_date(); ?>
                </div>
            </div>

        </li>

        <?php endwhile; ?>
    </ul>
</div>
<?php endif; 
 wp_reset_query(); ?>
