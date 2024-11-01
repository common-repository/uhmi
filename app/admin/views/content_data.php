<div class="uhmi-tabs nav-tab-wrapper">
    <a href="#" class="nav-tab nav-tab-active" data-tab="general"><?php esc_html_e( 'General', 'uhmi' ) ?></a>
    <a href="#" class="nav-tab" data-tab="button"><?php esc_html_e( 'Button', 'uhmi' ) ?></a>
</div>

<table class="form-table uhmi-content-data uhmi-content-data-metabox uhmi-content-data-general uhmi-content-data-active">

    <tr id="uhmi-content-price-tr">
        <th>
            <label for="uhmi_content_price"><?php esc_html_e( 'Price', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <input
             class="regular-text uhmi-input-price"
             name="uhmi_content_price"
             id="uhmi-content-price"
             value="<?php esc_attr_e( $price ) ?>"
             type="text">

            <p class="description"><?php esc_html_e( 'Minimum', 'uhmi' ) ?>: <?php echo number_format_i18n( 0.01, 2 ) ?>. <?php esc_html_e( 'Maximum', 'uhmi' ) ?>: 150. <?php esc_html_e( 'Leave blank or enter 0 to offer the content for free.', 'uhmi' ) ?></p>

        </td>
    </tr>

    <tr id="uhmi-content-pwyw-tr">
        <th>
            <label for="uhmi_content_pwyw"><?php esc_html_e( 'Pay What You Want', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <input type="checkbox" name="uhmi_content_pwyw" id="uhmi-content-pwyw" value="pwyw" <?php echo ( $pwyw ? 'checked' : '' ) ?> />

            <p class="description"><?php esc_html_e( 'Allow visitors to fill in their own price. You can set a minimum by setting a price at \'Price\'.', 'uhmi' ) ?></p>

        </td>
    </tr>

    <tr id="uhmi-content-type-tr">
        <th>
            <label for="uhmi_content_type"><?php esc_html_e( 'Donation', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <input type="checkbox" name="uhmi_content_type" id="uhmi-content-type" value="donation" <?php echo ( $donation ? 'checked' : '' ) ?> />

            <p class="description"><?php esc_html_e( 'Is it a donation? This option is to adjust the interface accordingly, e.g. \'Pay\' will change into \'Donate\'.', 'uhmi' ) ?></p>

        </td>
    </tr>

    <tr id="uhmi-content-category-tr">
        <th>
            <label for="uhmi_content_category"><?php esc_html_e( 'Category', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <select name="uhmi_content_category" id="uhmi-content-category">

				<option disabled <?php echo ( ! $category ? 'selected' : '') ?>><?php esc_attr_e( 'Select content category...', 'uhmi' ) ?></option>

                <?php foreach ($content_categories as $content_category) { ?>

                	<option value="<?php echo esc_attr( $content_category ) ?>" <?php echo ( $category === $content_category ) ? 'selected' : ''; ?>><?php echo esc_attr( ucfirst( $content_category ) ) ?></option>

                <?php } ?>

            </select>

        </td>
    </tr>

    <tr id="uhmi-content-cover-tr">
        <th>
            <label for="uhmi_content_cover"><?php esc_html_e( 'Cover', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <input type="text" name="uhmi_content_cover" id="uhmi-content-cover" class="regular-text" value="<?php echo esc_url( $cover ) ?>" placeholder="<?php esc_attr_e( 'File path/URL', 'uhmi' ) ?>" />

            <a href="#" id="uhmi-add-cover" class="button uhmi-upload-button" data-text-title="<?php esc_attr_e( 'Add a cover', 'uhmi' ) ?>" data-text-button="<?php esc_attr_e( 'Add Cover', 'uhmi' ) ?>"><?php esc_html_e( 'Add Cover', 'uhmi' ) ?></a>

        </td>
    </tr>

    <tr id="uhmi-content-refundable-tr">
        <th>
            <label for="uhmi_content_refundable"><?php esc_html_e( 'Refundable', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <input type="checkbox" name="uhmi_content_refundable" id="uhmi-content-refundable" value="refundable" <?php echo ( $refundable ? 'checked' : '' ) ?> />

            <p class="description"><?php esc_html_e( 'Is the content refundable?', 'uhmi' ) ?> <a href="<?php echo esc_url( UHMI_WEBSITE ) ?>/help/sellers/getting-started/what-is-meant-by-refundable" target="_blank"><?php esc_html_e( 'More information', 'uhmi' ) ?></a></p>

        </td>
    </tr>

    <tr id="uhmi-content-repeatable-tr">
        <th>
            <label for="uhmi_content_repeatable"><?php esc_html_e( 'One-time purchase', 'uhmi' ) ?>:</label>
        </th>
        <td>

            <input type="checkbox" name="uhmi_content_repeatable" id="uhmi-content-repeatable" value="repeatable" <?php echo ( ! $repeatable ? 'checked' : '' ) ?> />

            <p class="description"><?php esc_html_e( 'When unchecked, visitors will have to pay each time in order to access the content. For donations, you may want to uncheck to allow visitors to donate multiple times.', 'uhmi' ) ?></p>

        </td>
    </tr>

</table>

<table class="form-table uhmi-content-data uhmi-content-data-metabox uhmi-content-data-button">

    <tr id="uhmi-content-button-color-tr">
		<th>
			<label for="uhmi_button_color"><?php esc_html_e( 'Button color', 'uhmi' ) ?>:</label>
		</th>
		<td>
            <div class="uhmi-content-radio">

				<label>

					<input <?php echo($buttonColorType === 'default' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_button_color_type" class="uhmi-content-radio-button_color" value="default" />

					<span><?php esc_html_e( 'Use default Uhmi color', 'uhmi' ) ?></span>

				</label>

			</div>

			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($buttonColorType === 'general' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_button_color_type" class="uhmi-content-radio-button_color" value="general" />

					<span><?php esc_html_e( 'Use general button color.', 'uhmi' ) ?> <a href="<?php echo esc_url( admin_url( 'admin.php?page=uhmi_settings&tab=button' ) ) ?>" target="_blank"><?php esc_html_e( 'Edit general color', 'uhmi' ) ?></a></span>

				</label>

			</div>

			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($buttonColorType === 'custom' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_button_color_type" class="uhmi-content-radio-button_color" value="custom" />

					<span><?php esc_html_e( 'Use custom button color', 'uhmi' ) ?></span>

				</label>

			</div>

            <div id="uhmi_content_button_color-wrap" class="uhmi-disabled">
                <input id="uhmi_color_picker" name="uhmi_content_button_color" type="text" value="<?php esc_attr_e( $buttonColor ) ?>" data-default-color="<?php esc_attr_e( Uhmi_Helper::get_default_button_color() ) ?>" />
            </div>
		</td>
	</tr>

	<tr id="uhmi-content-button-text-tr">
		<th>
			<label for="uhmi_button_text"><?php esc_html_e( 'Button text', 'uhmi' ) ?>:</label>
		</th>
		<td>
			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($buttonType === 'general' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_button_text_type" class="uhmi-content-radio-button_text" value="general" />

					<span><?php esc_html_e( 'Use general button text.', 'uhmi' ) ?> <a href="<?php echo esc_url( admin_url( 'admin.php?page=uhmi_settings&tab=button' ) ) ?>" target="_blank"><?php esc_html_e( 'Edit general text', 'uhmi' ) ?></a></span>

				</label>

			</div>

			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($buttonType === 'custom' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_button_text_type" class="uhmi-content-radio-button_text" value="custom" />

					<span><?php esc_html_e( 'Use custom button text', 'uhmi' ) ?></span>

				</label>

			</div>

			<input id="uhmi_content_button_text" name="uhmi_content_button_text" type="text" value="<?php esc_attr_e( $buttonText ) ?>" class="regular-text uhmi-disabled" />
		</td>
	</tr>

	<tr id="uhmi-content-button-note-tr">
		<th>
			<label for="uhmi_content_note"><?php esc_html_e( 'Button note', 'uhmi' ) ?>:</label>
		</th>
		<td>
			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($noteType === 'disabled' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_note_type" class="uhmi-content-radio-note" value="disabled" />

					<span><?php esc_html_e( 'Disable note', 'uhmi' ) ?></span>

				</label>

			</div>

			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($noteType === 'general' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_note_type" class="uhmi-content-radio-note" value="general" />

					<span><?php esc_html_e( 'Use general note.', 'uhmi' ) ?></span> <a href="<?php echo esc_url( admin_url( 'admin.php?page=uhmi_settings&tab=button' ) ) ?>" target="_blank"><?php esc_html_e( 'Edit general note', 'uhmi' ) ?></a>

				</label>

			</div>

			<div class="uhmi-content-radio">

				<label>

					<input <?php echo($noteType === 'custom' ? 'checked="checked"' : '') ?> type="radio" name="uhmi_content_note_type" class="uhmi-content-radio-note" value="custom" />

					<span><?php esc_html_e( 'Use custom note', 'uhmi' ) ?></span>

				</label>

			</div>

			<?php wp_editor($noteText, 'uhmi_content_note', $noteEditorSettings) ?>

		</td>
	</tr>

</table>
