<?php

/**
 * Init Uhmi shortcode button for tinyMCE.
 *
 * @return void
 */
function uhmi_init_tinymce_plugin()
{
	if ( ! current_user_can('edit_posts') || ! current_user_can('edit_pages')) {
		return;
	}

	add_filter( 'mce_external_plugins', 'uhmi_add_tinymce_button' );
	add_filter( 'mce_buttons', 'uhmi_register_tinymce_button', 0, 2 );
}

add_action( 'admin_init', 'uhmi_init_tinymce_plugin' );

/**
 * Register Uhmi shortcode button for tinyMCE.
 *
 * @param  array   $buttons
 * @param  string  $editor_id
 * @return array
 */
function uhmi_register_tinymce_button($buttons, $editor_id)
{
	if ($editor_id === 'uhmi_button_note') {
		return $buttons;
	}

	array_push($buttons, 'Uhmi');
	return $buttons;
}

/**
 * Add Uhmi shortcode button to tinyMCE.
 *
 * @param  array  $plugins
 * @return array
 */
function uhmi_add_tinymce_button($plugins)
{
	$plugins['Uhmi'] = plugins_url( '/js/uhmi-tinymce.js', __FILE__ );
	return $plugins;
}
