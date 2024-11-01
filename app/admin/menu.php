<?php

/**
 * Add menu page.
 *
 * @return void
 */
function uhmi_menu()
{
    add_menu_page(
        'Uhmi',
        'Uhmi',
        ( ! UHMI_API_KEYS ? 'publish_posts' : null),
        'uhmi',
        ( ! UHMI_API_KEYS ? 'uhmi_get_started' : null),
        'dashicons-uhmi',
        20
    );
}

add_action( 'admin_menu', 'uhmi_menu' );

/**
 * Add submenu pages.
 *
 * @return void
 */
function uhmi_submenu()
{
    add_submenu_page(
        '',
        __( 'Ready', 'uhmi' ),
        __( 'Ready', 'uhmi' ),
        'activate_plugins',
        'uhmi_ready',
        'uhmi_blank_state'
    );

    add_submenu_page(
    	'uhmi',
    	esc_html__( 'Settings', 'uhmi' ),
    	esc_html__( 'Settings', 'uhmi' ),
    	'edit_posts',
    	'uhmi_settings',
    	'uhmi_settings_callback'
    );

    add_submenu_page(
    	'uhmi',
    	esc_html__( 'Uhmi Account', 'uhmi' ) . ' &#8594;',
    	esc_html__( 'Uhmi Account', 'uhmi' ) . ' &#8594;',
    	'edit_posts',
    	null,
    	null
    );
}

if (UHMI_API_KEYS) {
    add_action( 'admin_menu', 'uhmi_submenu' );
}
