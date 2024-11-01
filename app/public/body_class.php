<?php

/**
 * Add class to body.
 *
 * @param  array  $classes
 * @return array
 */
function uhmi_body_class($classes) {

    global $post;

    if ( ! isset($post->post_content)) {
        return $classes;
    }

    if (has_shortcode($post->post_content, 'uhmi')) {
	    $classes[] = 'uhmi';
    }

    return $classes;
}

add_filter( 'body_class', 'uhmi_body_class' );
