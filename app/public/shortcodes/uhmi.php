<?php

/**
 * Add Uhmi shortcode: Uhmi.
 *
 * @param  array   $attributes
 * @param  string  $content
 * @return mixed
 */
function uhmi_shortcodes__uhmi($attributes, $content = '')
{
	if ( ! UHMI_API_KEYS) {
        return;
    }

    global $post;

    if ( ! $post) {
		$post_id = (isset($_GET['post_id']) ? $_GET['post_id'] : null);
		$post = get_post( $post_id );
    }

    if ( ! $post) {
	    return;
    }

    return uhmi_shortcodes__show($post, 'uhmi', $attributes, $content = '');
}

add_shortcode('uhmi', 'uhmi_shortcodes__uhmi');


/**
 * When [uhmi] with no closing tag, meaning it has no [/uhmi], show the content above the shortcode only.
 *
 * @param  string  $content
 * @return string
 */
function uhmi_shortcodes__uhmi__the_content_filter($content)
{
	if ( ! has_shortcode($content, 'uhmi')) {
		return $content;
	}

	$pattern = get_shortcode_regex(array('uhmi'));

	if (preg_match('/'. $pattern .'/s', $content, $matches) && isset($matches[2]) && isset($matches[5]) && ! empty($matches[5])) {
		return $content;
	}

	$split = preg_split("/$pattern/s", $content);

	if ( ! is_array($split) || ! isset($split[0])) {
		return $content;
	}

	return $split[0] . '[uhmi]';
}

add_filter( 'the_content', 'uhmi_shortcodes__uhmi__the_content_filter' );
