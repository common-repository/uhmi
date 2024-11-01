<?php

/**
 * Enqueue Gutenberg script.
 *
 * @return void
 */
function uhmi_gutenberg_scripts()
{
    wp_register_script(
        'uhmi_gutenberg_javascript',
        plugins_url( 'js/uhmi-gutenberg.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-notices' )
    );

    if (function_exists( 'register_block_type' )) {

        register_block_type( 'uhmi/uhmi-shortcode', array(
            'editor_script' => 'uhmi_gutenberg_javascript'
        ));

        register_block_type( 'uhmi/uhmi-shortcode-close', array(
            'editor_script' => 'uhmi_gutenberg_javascript'
        ));
    }

    wp_localize_script( 'uhmi_gutenberg_javascript', 'UHMI_SHORTCODE_CLOSE', __( 'Uhmi closing shortcode', 'uhmi' ) );
    wp_localize_script( 'uhmi_gutenberg_javascript', 'UHMI_CLOSE', __( 'Close', 'uhmi' ) );
}

add_action( 'enqueue_block_editor_assets', 'uhmi_gutenberg_scripts' );

/**
 * Adds the Uhmi category.
 *
 * @param array $categories
 * @return array
 */
function uhmi_add_block_category($categories)
{
    $categories[] = array(
        'slug'  => 'uhmi',
        'title' => __( 'Uhmi', 'uhmi' ),
        'icon'  => '',
    );

    return $categories;
}

add_filter( 'block_categories', 'uhmi_add_block_category', 10, 2 );
