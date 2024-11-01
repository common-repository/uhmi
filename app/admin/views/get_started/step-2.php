<h1><?php esc_html_e( 'Great! Let\'s connect your Uhmi account', 'uhmi' ) ?></h1>

<div class="uhmi-get-started-box uhmi-round-12px">

	<div class="uhmi-fix">

		<p><?php esc_html_e( 'By connecting, all your sold content and earnings will be added to your Uhmi account. Follow the link to your account and copy your API keys into the form below.', 'uhmi' ) ?></p>

		<br />

		<p><a href="<?php echo esc_url( UHMI_WEBSITE ) ?>/a/api" target="_blank" data-next="<?php echo admin_url( 'admin.php?page=uhmi&step=2' ) ?>"><?php esc_html_e( 'Go to my API keys', 'uhmi' ) ?> &rsaquo;</a></p>

		<form method="post" class="uhmi-form-api" autocomplete="off">

			<?php wp_nonce_field( '_uhmi_get_started__api_key__nonce', 'uhmi_get_started__api_key__nonce' ) ?>

			<div class="uhmi-input-group">

				<p><?php esc_html_e( 'Enter your public API key', 'uhmi' ) ?></p>
				<input name="uhmi_get_started__public_key" type="text" value="<?php echo esc_attr( $public_key ) ?>" class="regular-text" autocomplete="off" />

			</div>

			<div class="uhmi-input-group">

				<p><?php esc_html_e( 'Enter your private API key', 'uhmi' ) ?></p>
				<input name="uhmi_get_started__private_key" type="text" value="<?php echo esc_attr( $private_key ) ?>" class="regular-text" autocomplete="off" />

			</div>

			<input class="uhmi-btn uhmi-btn-small uhmi-round" type="submit" value="<?php esc_attr_e( 'Save API keys', 'uhmi' ) ?>" />

		</form>

	</div>

</div>
