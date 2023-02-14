<?php
/**
 * Upgrade Control for the Customizer
 * @package Camer
 */

 /**
 * Control type.
 * For Upsell content in the customizer
 */
if ( ! class_exists( 'Camer_Customize_Static_Text_Control' ) ) {
	if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
		class Camer_Customize_Static_Text_Control extends WP_Customize_Control {
		public $type = 'static-text';
		public function esc_html__construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}
		protected function render_content() {
			if ( ! empty( $this->label ) ) :
				?><span class="camer-customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
			endif;
			if ( ! empty( $this->description ) ) :
				?><div class="camer-description camer-customize-control-description"><?php

				if( is_array( $this->description ) ) {
					echo '<p>' . implode( '</p><p>', wp_kses_post( $this->description )) . '</p>';
					
				} else {
					echo wp_kses_post( $this->description );
				}
				?>
							
			<h1><?php esc_html_e('Camer Pro', 'camer') ?></h1>

			<p><?php esc_html_e('If you decide to upgrade to the pro version of this theme, use this discount code on checkout.','camer'); ?></p>	
			<div id="promotion-header"><p class="main-title"><?php esc_html_e('Upgrade to Pro (Save $5)', 'camer') ?><br><?php esc_html_e('Use Code:', 'camer') ?> <strong><?php esc_html_e('SAVEFIVE', 'camer') ?></strong></p>
			<p><a href="https://www.bloggingthemestyles.com/wordpress-themes/camer-pro/" target="_blank" class="button button-primary"><?php esc_html_e('Get the Pro - Save $5', 'camer') ?></a></p></div>
			
			
			<p style="font-weight: 700;"><?php esc_html_e('Pro Features:', 'camer') ?></p>
			<ul>
				<li><?php esc_html_e('&bull; 6 Blog Styles', 'camer')?></li>
				<li><?php esc_html_e('&bull; 15 Dynamic Sidebar Positions', 'camer')?></li>
				<li><?php esc_html_e('&bull; 3 Header Styles', 'camer')?></li>
				<li><?php esc_html_e('&bull; 7 Page Templates - Including Front Pages', 'camer')?></li>
				<li><?php esc_html_e('&bull; Stylish Full Splash Page with Randomized Photos', 'camer')?></li>
				<li><?php esc_html_e('&bull; 3 Full Post Layouts', 'camer')?></li>
				<li><?php esc_html_e('&bull; Adjustable Content Widths', 'camer')?></li>
				<li><?php esc_html_e('&bull; Thumbnail Creation for the Blogs', 'camer')?></li>
				<li><?php esc_html_e('&bull; An About Me Widget', 'camer')?></li>
				<li><?php esc_html_e('&bull; A Social Links Widget', 'camer')?></li>
				<li><?php esc_html_e('&bull; Full Post Featured Image Banners with Title Overlay', 'camer')?></li>
				<li><?php esc_html_e('&bull; Add Photo Captions to Featured Image Banners', 'camer')?></li>
				<li><?php esc_html_e('&bull; 1 Click Demo Content Import', 'camer')?></li>
				<li><?php esc_html_e('&bull; Featured Image Captions for Posts', 'camer')?></li>
				<li><?php esc_html_e('&bull; Customize the Read More Button Text', 'camer')?></li>
				<li><?php esc_html_e('&bull; Premium Support', 'camer')?></li>
			</ul>
							
			<?php
			endif;
		}
	}
}