<?php
/*
<form method="post" class="uhmi-tutorial">

	<?php wp_nonce_field( '_uhmi_settings_tour__nonce', 'uhmi_settings_tour__nonce' ) ?>

	<h2><?php esc_html_e( 'Tutorial', 'uhmi' ) ?></h2>

	<p><?php esc_html_e( 'Would you like to start the tutorial again?', 'uhmi' ) ?></p>

	<input class="button-primary uhmi-save-button" type="submit" name="save" value="<?php esc_attr_e( 'Start tutorial', 'uhmi' ) ?>" />

</form>
*/
?>

<div class="uhmi-how_it_works">

	<h3><?php esc_html_e( 'How it works', 'uhmi' ) ?></h3>

	<div>
		<p><?php esc_html_e( 'Go to a post or page and fill in the title, price and other content details. Then, use the Uhmi shortcode [uhmi] ... [/uhmi] to wrap the paid part of your content. Or, add [uhmi] without the closing tag and all content below [uhmi] will be the paid part of your content.', 'uhmi' ) ?></p>
	</div>

	<div>
		<p><?php esc_html_e( 'You can place anything inside this shortcode: photos, videos, music, software, text, PDF’s, you name it. The content inside this shortcode will only be visible after the visitor has paid.', 'uhmi' ) ?></p>
	</div>

	<div>
		<p><?php esc_html_e( 'Tip: Give your visitors a preview of what they are about to pay for. For example: add the first paragraph of your article; a lower-res version of your photo; or a thumbnail of your video.', 'uhmi' ) ?></p>
	</div>

	<div>
		<a href="https://uhmi.io/wordpress" target="_blank">
			<strong><?php esc_html_e( 'More about the plugin &rsaquo;', 'uhmi' ) ?></strong>
		</a>
	</div>

</div>


<?php if (current_user_can('manage_options')) { ?>

	<h3><?php esc_html_e( 'API keys', 'uhmi' ) ?></h3>

	<form method="post">

		<?php wp_nonce_field( '_uhmi_settings_api_keys__nonce', 'uhmi_settings_api_keys__nonce' ) ?>

		<table class="form-table uhmi-content-data">
			<tr>
				<th>
					<label for="uhmi_public_key"><?php esc_html_e( 'Public API key:', 'uhmi' ) ?></label>
				</th>
				<td>
					<input name="uhmi_public_key" type="text" value="<?php echo esc_attr( $public_key ) ?>" placeholder="<?php esc_attr_e( 'Your public API key', 'uhmi' ) ?>" class="regular-text" />
				</td>
			</tr>

			<tr>
				<th>
					<label for="uhmi_private_key"><?php esc_html_e( 'Private API key:', 'uhmi' ) ?></label>
				</th>
				<td>
					<input name="uhmi_private_key" type="text" value="<?php echo esc_attr( $private_key ) ?>" placeholder="<?php esc_attr_e( 'Your private API key', 'uhmi' ) ?>" class="regular-text" />
				</td>
			</tr>
		</table>

		<p class="submit">
			<input class="button-primary uhmi-save-button" type="submit" name="save" value="<?php esc_attr_e( 'Save changes', 'uhmi' ) ?>" />
		</p>

	</form>

<?php } ?>
