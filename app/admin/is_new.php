<?php

/**
 * Add "is new" class to body.
 *
 * @param  string  $classes
 * @return string
 */
function uhmi_is_new($classes)
{
	if ( ! current_user_can('edit_posts')) {
		return;
	}

	$is_new = Uhmi_Helper::get_option('is_new');

	if ( ! $is_new) {
		return $classes;
	}

	$screen = get_current_screen();

	if ($screen->id === 'toplevel_page_uhmi') {

		Uhmi_Helper::update_options(array(
			'is_new' => false
		));

		return $classes;
	}

    return $classes .= ' uhmi-is_new';
}

add_filter( 'admin_body_class', 'uhmi_is_new' );
