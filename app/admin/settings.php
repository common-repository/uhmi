<?php

include UHMI_PLUGIN_DIR_ADMIN . '/settings/tabs.php';
include UHMI_PLUGIN_DIR_ADMIN . '/settings/general.php';
include UHMI_PLUGIN_DIR_ADMIN . '/settings/button.php';

/**
 * Settings page.
 *
 * @return mixed
 */
function uhmi_settings_callback()
{
	global $uhmi_error;

    $uhmi_error = new WP_Error;

	$currencies = Uhmi_Helper::get_currencies();

	// for consistency
	$public_key  = Uhmi_Helper::get_option('public_key');
	$private_key = Uhmi_Helper::get_option('private_key');

	$button	= uhmi_settings__get_button();
	$active_tab = uhmi_settings__get_active_tab();

	include UHMI_PLUGIN_DIR_ADMIN . '/views/settings.php';
}
