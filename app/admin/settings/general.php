<?php

/**
 * Save API keys.
 *
 * @return void
 */
function uhmi_settings__save_api_keys()
{
	if ( ! isset($_POST['uhmi_public_key']) || ! isset($_POST['uhmi_private_key'])) {
		return;
	}

	if ( ! isset($_POST['uhmi_settings_api_keys__nonce']) || ! wp_verify_nonce( $_POST['uhmi_settings_api_keys__nonce'], '_uhmi_settings_api_keys__nonce' )) {
		return;
	}

	if ( ! current_user_can('manage_options')) {
		Uhmi_Helper::notice_not_allowed();
		return;
	}

	$api_keys = array(
		'public_key'  => trim($_POST['uhmi_public_key']),
		'private_key' => trim($_POST['uhmi_private_key'])
	);

	if ( ! uhmi_validate_api_keys($api_keys)) {
		return;
	}

	$verified_keys = new Uhmi_Verify();
	$verified_keys = $verified_keys->verifyApiKeys($api_keys);

	if ( ! uhmi_check_verified_api_keys($verified_keys)) {
		return;
	}

	Uhmi_Helper::update_options($api_keys);

	Uhmi_Helper::notice_success();
}

add_action( 'init', 'uhmi_settings__save_api_keys' );
