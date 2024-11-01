<?php

/**
 * Show page.
 *
 * @return mixed
 */
function uhmi_blank_state()
{
	if ( ! uhmi_is_blank_state()) {
		return;
	}

	include UHMI_PLUGIN_DIR_ADMIN . '/views/blank_state.php';
}

add_action( 'manage_posts_extra_tablenav', 'uhmi_blank_state' );

/**
 * Add class to body.
 *
 * @param  string  $classes
 * @return string
 */
function uhmi_blank_state__body_class($classes)
{
    if ( ! uhmi_is_blank_state()) {
		return;
	}

    return $classes .= ' uhmi-body-blank-state';
}

add_filter( 'admin_body_class', 'uhmi_blank_state__body_class' );

/**
 * Is blank state?
 *
 * @return bool
 */
function uhmi_is_blank_state()
{
	global $pagenow;

	if ($pagenow !== 'admin.php') {
		return false;
    }

	if ( ! isset($_GET['page'])) {
		return false;
	}

	if ($_GET['page'] !== 'uhmi_ready') {
		return false;
	}

	return true;
}
