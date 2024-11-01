<?php

/**
 * Enqueue stylesheet.
 *
 * @return void
 */
function uhmi_admin_styles()
{
    wp_enqueue_style( 'uhmi_admin_styles',  plugin_dir_url( __FILE__ ) . 'css/uhmi.css' );

    wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
}

add_action( 'admin_enqueue_scripts', 'uhmi_admin_styles' );

/**
 * Enqueue javascript.
 *
 * @return void
 */
function uhmi_admin_scripts()
{
    wp_enqueue_script(
        'uhmi_admin_javascript',
        plugin_dir_url( __FILE__ ) .  'js/uhmi.js',
        array('jquery', 'jquery-ui-core', 'jquery-ui-dialog', 'wp-color-picker'),
        null,
        true
    );

    // add variables to js
    wp_localize_script( 'uhmi_admin_javascript', 'UHMI_ACCOUNT_URL', UHMI_WEBSITE . '/a' );
    wp_localize_script( 'uhmi_admin_javascript', 'UHMI_TINYMCE_BUTTON_TITLE', __( 'Insert Uhmi shortcode', 'uhmi' ) );
}

add_action( 'admin_enqueue_scripts', 'uhmi_admin_scripts' );
