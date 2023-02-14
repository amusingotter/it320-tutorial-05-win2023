<?php
/**
 * Welcome screen intro template
 */
?>
<?php
$sporty = wp_get_theme( 'sporty' );

?>
<div class="col two-col" style="margin-bottom: 1.618em; overflow: hidden;">
	<div class="col">
		<h1 style="margin-right: 0;"><?php echo '<strong>Sporty</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $sporty['Version'] ) . '</sup>'; ?></h1>
		<p style="font-size: 1.2em;"><?php _e( 'Excellent! You\'ve activated <strong>Sporty</strong>, we hope you enjoy this free sports theme.', 'sporty' ); ?></p>
		<p><?php _e( 'This page will help you get up and running quickly with <strong>Sporty</strong>. Please use the <a href="https://wordpress.org/support/theme/sporty">Wordpress Support Forums</a> if you have experience issues with this theme.', 'sporty' ); ?></p>
	</div>

	<div class="col last-feature">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="sporty" class="image-50" width="440" />
	</div>
</div>
