<?php

/**
 * Add action links to plugin page.
 *
 * @param  array  $links
 * @return array
 */
function uhmi_add_action_links($links)
{
	if (UHMI_API_KEYS) {

		$new_links = array(
			sprintf('<a href="%s">%s</a>',
				esc_url( admin_url( 'admin.php?page=uhmi_settings' ) ),
				esc_html__( 'Settings' , 'uhmi' )
			)
		);

	} else {

		$new_links = array(
			sprintf('<a href="%s">%s</a>',
				esc_url( admin_url( 'admin.php?page=uhmi' ) ),
				esc_html__( 'Get Started!' , 'uhmi' )
			)
		);
	}

	return array_merge($new_links, $links);
}

add_filter( 'plugin_action_links_' . UHMI_PLUGIN_BASENAME, 'uhmi_add_action_links' );
