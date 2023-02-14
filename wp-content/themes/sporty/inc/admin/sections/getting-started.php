<?php
/**
 * Welcome screen getting started template
 */
?>
<?php
// get theme customizer url
$url 	= admin_url() . 'customize.php?';
$url 	.= '&return=' . urlencode( admin_url() . 'themes.php?page=sporty-welcome' );
$url 	.= '&sporty-customizer=true';
?>
<div id="getting_started" class="col two-col panel" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<h2><?php echo sprintf( esc_html__( '%sSporty%s works for you', 'sporty' ), '<strong>', '</strong>'); ?></h2>
	<p class="tagline"><?php _e( 'We\'ve made this theme simple and enjoyable to configure.', 'sporty' ); ?></p>

	<div class="col-1">

		<!-- Plugins -->
		<div class="section plugins">
			<h4><?php _e( 'Install recommended plugins <span class="dashicons dashicons-admin-plugins"></span>' ,'sporty' ); ?></h4>
			<p><?php echo sprintf( esc_html__( '%sSporty%s harnesses the power and functionality of the popular and free sports plugin %sSports Press%s.', 'sporty' ), '<strong>', '</strong>', '<a target="blank" href="' . esc_url('https://wordpress.org/plugins/sportspress/') . '"><strong>', '</strong></a>'); ?></p>
			<p><?php _e('SportsPress is an extendable all-in-one sports data plugin that helps sports clubs set up and manage a league or club site quickly and easily.', 'sporty'); ?></p>
			<p><?php echo sprintf( esc_html__( 'The developers of this great free plugin also offer %ssport specific plugins%s for sports such as Football (soccer), Baseball, Basketball, Cricket and Golf.', 'sporty'), '<a target="blank" href="' . esc_url('https://profiles.wordpress.org/themeboy/#content-plugins') . '">', '</a>'); ?></p>

			<p><a href="<?php echo esc_url( self_admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-primary"><?php _e( 'Install &amp; Activate Recommended Plugins', 'sporty' ); ?></a></p>
		</div>

		<!-- HOMEPAGE -->
		<div class="section homepage">
			<h4><?php _e( 'Setup the homepage <span class="dashicons dashicons-admin-home"></span>', 'sporty' ); ?></h4>
			<p><?php echo sprintf( esc_html__( 'Sporty includes a custom homepage template that can be seen in use on our %sdemo site%s', 'sporty' ), '<a target="_blank" href="' . esc_url('http://demos.templateexpress.com/sporty/') . '">', '</a>'); ?></p>
			<p><?php echo sprintf( esc_html__( 'Create a new page and assign the %sCustom Home Page%s Template. Then set this new page as your Front page in the %sReading%s settings.', 'sporty'), '<strong>', '</strong>', '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>'); ?></p>
			<p><?php echo sprintf( esc_html__( 'You can then customize the homepage sections through the %scustomize section%s.', 'sporty'),  '<a href="' . esc_url( self_admin_url( 'customize.php' ) ) . '">', '</a>'); ?></p>
			<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Open the Customizer', 'sporty' ); ?></a></p>
		</div>

	</div>

	<div class="col-2 last-feature">
		<!-- CUSTOMIZER -->
		<h4><?php _e( 'Hundreds of options available <span class="dashicons dashicons-admin-generic"></span>' ,'sporty' ); ?></h4>
		<p><?php _e( 'Using the WordPress Customizer you can change Sporty\'s appearance to match your brand and create a unique look.', 'sporty' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Open the Customizer', 'sporty' ); ?></a></p>

		<!-- MENUS -->
		<h4><?php _e( 'Configure menu location <span class="dashicons dashicons-menu"></span>' ,'sporty' ); ?></h4>
		<p><?php _e( 'Sporty includes the ability to customize your menu structure. Add pages, custom links, categories to your menu then assign it to the Primary Menu Location.', 'sporty' ); ?></p>
		<p><a href="<?php echo esc_url( self_admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php _e( 'Configure menus', 'sporty' ); ?></a></p>

		<!-- DOCUMENTATION -->
		<h4><?php _e( 'View documentation <span class="dashicons dashicons-welcome-learn-more"></span>', 'sporty' ); ?></h4>
		<p><?php _e( 'You can read detailed information on Sporty\'s features and how to develop on top of it in the documentation.', 'sporty' ); ?></p>
		<p><?php echo sprintf( esc_html('%sView documentation%s', 'sporty'), '<a target="_blank" href="http://templateexpress.com/docs/sporty/" class="button button-primary">', '</a>'); ?></p>

	</div>
</div>
