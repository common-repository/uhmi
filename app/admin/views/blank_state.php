<div class="uhmi-blank-state">

	<?php
	if (file_exists(UHMI_PLUGIN_DIR_ADMIN . '/views/partials/header.php')) {

		include UHMI_PLUGIN_DIR_ADMIN . '/views/partials/header.php';

	}
	?>

	<div class="uhmi-main">

		<p><?php esc_html_e( 'You\'re all set!', 'uhmi' ) ?></p>

		<h1><?php esc_html_e( 'Ready to start selling your content?', 'uhmi' ) ?></h1>

		<a class="uhmi-btn uhmi-round-3em" href="<?php echo esc_url( admin_url( 'post-new.php' ) ) ?>"><?php esc_html_e( 'Create your first content', 'uhmi' ) ?></a>

	</div>

	<div class="uhmi-decor uhmi-decor-left"></div>
	<div class="uhmi-decor uhmi-decor-right"></div>
</div>
