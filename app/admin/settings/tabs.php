<?php

/**
 * Get active tab.
 *
 * @return string
 */
function uhmi_settings__get_active_tab()
{
	if (current_user_can('edit_pages')) {

		$tabs = array(
		    'general',
		    'button'
		);

	} else {

		$tabs = array(
			'general'
		);
	}

	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';

	if ( ! in_array($active_tab, $tabs)) {
	    return 'general';
	}

	return $active_tab;
}
