<?php if (current_user_can('edit_pages')) { ?>

	<h3><?php esc_html_e( 'Button', 'uhmi' )?></h3>

	<form method="post">

		<input type="hidden" name="uhmi_settings_button" value="1">

		<?php wp_nonce_field( '_uhmi_settings_button__nonce', 'uhmi_settings_button__nonce' ) ?>

		<table class="form-table uhmi-content-data">

			<tr>
				<th>
					<label for="uhmi_button_currency"><?php esc_html_e( 'Currency', 'uhmi' ) ?>:</label>
				</th>
				<td>
					<select name="uhmi_button_currency">

						<?php foreach ($currencies as $key => $value) : ?>

	                    	<option value="<?php echo esc_attr( $key ) ?>" <?php echo ( $key === $button['currency'] ) ? 'selected' : ''; ?>><?php echo esc_html( "$key ($value)" ) ?></option>

	                    <?php endforeach; ?>

	                </select>

	                <p class="description"><?php esc_html_e( 'The currency is used to replace %currency% on the Button.', 'uhmi' ) ?></p>
				</td>
			</tr>

			<tr>
				<th>
					<label for="uhmi_button_color"><?php esc_html_e( 'Button color', 'uhmi' ) ?>:</label>
				</th>
				<td>
					<input id="uhmi_color_picker" name="uhmi_button_color" type="text" value="<?php esc_attr_e( $button['color'] ) ?>" data-default-color="<?php esc_attr_e( Uhmi_Helper::get_default_button_color() ) ?>" />
				</td>
			</tr>

			<tr>
				<th>
					<label for="uhmi_button_text"><?php esc_html_e( 'Button text', 'uhmi' ) ?>:</label>
				</th>
				<td>
					<input name="uhmi_button_text" type="text" value="<?php echo esc_attr( $button['text'] ) ?>" class="regular-text" />

					<p class="description"><?php esc_html_e( '%currency% will be replaced with the currency selected at Currency.', 'uhmi' ) ?></p>
					<p class="description"><?php esc_html_e( '%price% will be replaced with the price of the content.', 'uhmi' ) ?></p>
				</td>
			</tr>

			<tr>
				<th>
					<label for="uhmi_button_note"><?php esc_html_e( 'Note', 'uhmi' ) ?>:</label>
				</th>
				<td>
					<div class="uhmi-button-note">

						<?php wp_editor($button['note'], 'uhmi_button_note', $button['settings']) ?>

						<p class="description"><?php esc_html_e( 'This note will be placed above the button and can be used, for example, as a general message for your visitors to explain what Uhmi is or why you chose to add a paywall. Leave blank to disable.', 'uhmi' ) ?></p>

					</div>
				</td>
			</tr>

		</table>

		<p class="submit">
			<input class="button-primary uhmi-save-button" type="submit" name="save" value="<?php esc_attr_e( 'Save changes', 'uhmi' ) ?>" />
		</p>

	</form>

<?php } ?>
