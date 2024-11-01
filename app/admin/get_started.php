<?php

/**
 * Show page.
 *
 * @return mixed
 */
function uhmi_get_started()
{
	$step = uhmi_get_started__get_step();

	$public_key  = Uhmi_Helper::get_option('public_key');
	$private_key = Uhmi_Helper::get_option('private_key');
	$public_key  = isset($_POST['uhmi_get_started__public_key'])  ? $_POST['uhmi_get_started__public_key']  : $public_key;
	$private_key = isset($_POST['uhmi_get_started__private_key']) ? $_POST['uhmi_get_started__private_key'] : $private_key;

	include UHMI_PLUGIN_DIR_ADMIN . '/views/get_started.php';
}

/**
 * Get step.
 *
 * @return int
 */
function uhmi_get_started__get_step()
{
	$steps = array(
	    1, 2
	);

	$step = isset($_GET['step']) ? $_GET['step'] : '1';

	if ( ! in_array($step, $steps)) {
	    return 1;
	}

	return $step;
}

/**
 * Add class to body.
 *
 * @param  string  $classes
 * @return string
 */
function uhmi_get_started__body_class($classes)
{
	$screen = get_current_screen();

	if ($screen->id !== 'toplevel_page_uhmi') {
		return $classes;
	}

    return $classes .= ' uhmi-body-get-started';
}

add_filter( 'admin_body_class', 'uhmi_get_started__body_class' );

/**
 * Save API keys.
 *
 * @return void
 */
function uhmi_get_started__save_api_keys()
{
	if ( ! isset($_POST['uhmi_get_started__public_key']) || ! isset($_POST['uhmi_get_started__private_key'])) {
		return;
	}

	if ( ! isset($_POST['uhmi_get_started__api_key__nonce']) || ! wp_verify_nonce( $_POST['uhmi_get_started__api_key__nonce'], '_uhmi_get_started__api_key__nonce' )) {
		return;
	}

	if ( ! current_user_can('manage_options')) {
		return;
	}

	$api_keys = array(
		'public_key'  => trim($_POST['uhmi_get_started__public_key']),
		'private_key' => trim($_POST['uhmi_get_started__private_key'])
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

	wp_safe_redirect( admin_url( 'admin.php?page=uhmi_ready' ) );

	exit;
}

add_action( 'init', 'uhmi_get_started__save_api_keys' );
