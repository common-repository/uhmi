<?php

/**
 * Validate API keys.
 *
 * @param  array  $keys
 * @return bool
 */
function uhmi_validate_api_keys($keys)
{
	$validated = true;

	if ( ! ctype_alnum($keys['public_key']) || strlen($keys['public_key']) != 40) {
		$validated = false;
		Uhmi_Helper::notice_error( __( 'Please, enter a valid public API key.', 'uhmi' ) );
	}

	if ( ! ctype_alnum($keys['private_key']) || strlen($keys['private_key']) != 40) {
		$validated = false;
		Uhmi_Helper::notice_error( __( 'Please, enter a valid private API key.', 'uhmi' ) );
	}

	return $validated;
}

/**
 * Check verified API keys.
 *
 * @param  array  $keys
 * @return bool
 */
function uhmi_check_verified_api_keys($keys)
{
	$verified = true;

	if ( ! isset($keys['private_key']) || ! $keys['private_key']) {
		$verified = false;
		Uhmi_Helper::notice_error( __( 'Could not verify private API key. Please, enter a valid private API key.', 'uhmi' ) );
	}

	if ( ! isset($keys['public_key']) || ! $keys['public_key']) {
		$verified = false;
		Uhmi_Helper::notice_error( __( 'Could not verify public API key. Please, enter a valid public API key.', 'uhmi' ) );
	}

	return $verified;
}
