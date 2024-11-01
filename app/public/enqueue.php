<?php

/**
 * Enqueue stylesheet.
 *
 * @return void
 */
function uhmi_public_styles()
{
    wp_register_style( 'uhmi_public_styles',  plugin_dir_url( __FILE__ ) . 'css/uhmi.css' );
    //wp_enqueue_style( 'uhmi_public_styles' );
}

add_action( 'wp_enqueue_scripts', 'uhmi_public_styles' );

/**
 * Enqueue javascript.
 *
 * @return void
 */
function uhmi_public_scripts()
{
    wp_register_script(
        'uhmi_public_javascript',
        plugin_dir_url( __FILE__ ) .  'js/uhmi.js',
        array('jquery'),
        null,
        true
    );

    // add variables to js
    wp_localize_script( 'uhmi_public_javascript', 'UHMI_PUBLIC_KEY', UHMI_PUBLIC_KEY );
}

add_action( 'wp_enqueue_scripts', 'uhmi_public_scripts' );
