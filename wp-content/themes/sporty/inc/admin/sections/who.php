<?php
/**
 * Welcome screen who are woo template
 */
?>
<hr />
<div id="who" class="feature-section col three-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<div class="col-1">

		<h4><?php _e( 'Who are Template Express?', 'sporty' ); ?></h4>
		<p><?php _e( 'Template Express is a small team of passionate WordPress enthusists who love producing themes that people are excited to use.', 'sporty' ); ?></p>
		<p><?php echo sprintf( esc_html__('%sVisit Template Express%s', 'sporty'), '<a href="'. esc_url('https://www.templateexpress.com') . '" class="button">', '</a>'); ?></p>
	</div>

	<div class="col-2">
		<h4><?php _e( 'Can\'t find a feature?', 'sporty' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Please send any suggestions to our support email address %ssupport@templateexpress.com%s. We always want to improve our themes and your ideas help us achieve that.', 'sporty' ), '<a href="mailto:support@templateexpress.com">', '</a>' ); ?></p>

	</div>

	<div class="col-3 last-feature">
		<h4><?php _e( 'Are you enjoying Sporty?', 'sporty' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Why not leave a review on %sWordPress.org%s? We\'d really appreciate it! :-)', 'sporty' ), '<a href="https://wordpress.org/themes/sporty">', '</a>' ); ?></p>
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/img/TE-logo.png'; ?>" alt="<?php _e( 'Template Express Team Logo', 'sporty' ); ?>" class="image-50" width="220" />
	</div>

</div>
