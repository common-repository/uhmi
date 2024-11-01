<?php

/**
 * Plugin activation.
 *
 * @return void
 */
function uhmi_plugin_activation()
{
	Uhmi_Helper::update_options(array(
		'is_new' 	=> true,
		'pointers' 	=> 'tour'
	));

	flush_rewrite_rules( false );

	set_transient( 'uhmi_plugin_activation_redirect', true, 30 );
}

register_activation_hook( UHMI_PLUGIN, 'uhmi_plugin_activation' );

/**
 * Redirects to plugin Settings page after plugin activation via transient.
 *
 * @return void
 */
function uhmi_plugin_activation_transient()
{
	$transient = get_transient( 'uhmi_plugin_activation_redirect' );

	if ($transient) {

		delete_transient( 'uhmi_plugin_activation_redirect' );

		if ( ! UHMI_API_KEYS) {
			wp_safe_redirect( admin_url( 'admin.php?page=uhmi' ) );
		} else {
			wp_safe_redirect( admin_url( 'admin.php?page=uhmi_ready' ) );
		}

		exit;
	}
}

add_action( 'admin_init', 'uhmi_plugin_activation_transient' );
