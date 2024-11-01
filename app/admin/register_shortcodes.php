<?php

/**
 * Register shortcodes.
 */
function uhmi_shortcodes_init()
{
	add_shortcode( 'uhmi', 'uhmi__register_shortcode' );

	function uhmi__register_shortcode($atts = array(), $content = null)
    {
        return $content;
    }
}

add_action('init', 'uhmi_shortcodes_init');
