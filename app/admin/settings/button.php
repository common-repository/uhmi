<?php

/**
 * Get button.
 *
 * @return array
 */
function uhmi_settings__get_button()
{
	$currency = Uhmi_Helper::get_default_button_currency();
	$color	  = Uhmi_Helper::get_default_button_color();
	$text  	  = Uhmi_Helper::get_default_button_text();
	$options  = Uhmi_Helper::get_option('button', array());
	$note  	  = Uhmi_Helper::get_option('note', '');

	if (is_array($options) && count($options)) {

		if (isset($options['currency'])) {
	        $currency = $options['currency'];
	    }

	    if (isset($options['text'])) {
	        $text = $options['text'];
	    }

		if (isset($options['color'])) {
	        $color = $options['color'];
	    }
	}

	$noteEditorSettings = array(
        'wpautop' => false,
        'media_buttons' => false,
        'editor_height' => '120',
        'drag_drop_upload' => true,
        //'quicktags' => false
    );

	return array(
		'currency' => $currency,
		'color'	   => $color,
		'text'     => $text,
		'note'     => $note,
		'settings' => $noteEditorSettings
	);
}

/**
 * Save button.
 *
 * @return void
 */
function uhmi_settings__save_button()
{
	if ( ! isset($_POST['uhmi_settings_button'])) {
		return;
	}

	if ( ! isset($_POST['uhmi_settings_button__nonce']) || ! wp_verify_nonce( $_POST['uhmi_settings_button__nonce'], '_uhmi_settings_button__nonce' )) {
		return;
	}

	if ( ! current_user_can('edit_pages')) {
		Uhmi_Helper::notice_not_allowed();
		return;
	}

    $currency = isset($_POST['uhmi_button_currency']) ? $_POST['uhmi_button_currency'] : '';
	$color = isset($_POST['uhmi_button_color']) ? $_POST['uhmi_button_color'] : '';
    $text = isset($_POST['uhmi_button_text']) ? $_POST['uhmi_button_text'] : '';
    $note = isset($_POST['uhmi_button_note']) ? $_POST['uhmi_button_note'] : '';

    $currencies = Uhmi_Helper::get_currencies();

    if ( ! isset($currencies[$currency])) {
		Uhmi_Helper::notice_error( __( 'Please, select a valid currency.', 'uhmi' ) );
	    return;
    }

    $options['currency'] = $currency;
	$options['color'] = $color;
    $options['text'] = wp_unslash($text);

	Uhmi_Helper::update_options(array(
		'button' => $options,
		'note' => wp_unslash($note)
	));

    Uhmi_Helper::notice_success();
}

add_action( 'init', 'uhmi_settings__save_button' );
