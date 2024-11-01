<?php

/**
 * Get meta values.
 *
 * @param  string  $value
 * @param  mixed   $post
 * @return mixed
 */
function uhmi_content_data__get_meta($value, $post = false)
{
	if ( ! $post) {
		global $post;
	}

    $field = get_post_meta( $post->ID, $value, true );

    if ( ! empty($field)) {
	    return $field;
    }

    return null;
}

/**
 * Get category.
 *
 * @param  mixed   $post
 * @return string
 */
function uhmi_content_data__get_meta__category($post)
{
	return uhmi_content_data__get_meta( 'uhmi_content_category', $post );
}

/**
 * Get cover.
 *
 * @return string
 */
function uhmi_content_data__get_meta__cover()
{
	return uhmi_content_data__get_meta( 'uhmi_content_cover' );
}

/**
 * Get price.
 *
 * @param  mixed   $post
 * @return float
 */
function uhmi_content_data__get_meta__price($post)
{
	return number_format_i18n( (float) uhmi_content_data__get_meta( 'uhmi_content_price', $post ), 2);
}

/**
 * Get donation.
 *
 * @param  mixed   $post
 * @return bool
 */
function uhmi_content_data__get_meta__donation($post)
{
	$donation = uhmi_content_data__get_meta( 'uhmi_content_type', $post );
	return ( $donation !== 'donation' ? false : true );
}

/**
 * Get pwyw.
 *
 * @param  mixed   $post
 * @return bool
 */
function uhmi_content_data__get_meta__pwyw($post)
{
	$pwyw = uhmi_content_data__get_meta( 'uhmi_content_pwyw', $post );
	$pwyw = ( ! $pwyw ? false : $pwyw );
	return ( $pwyw === 'yes' ? true : false );
}

/**
 * Get refundable.
 *
 * @param  mixed   $post
 * @return bool
 */
function uhmi_content_data__get_meta__refundable($post)
{
	$refundable = uhmi_content_data__get_meta( 'uhmi_content_refundable', $post );
	$refundable = ( ! $refundable ? 'yes' : $refundable );
	return ( $refundable === 'yes' ? true : false );
}

/**
 * Get repeatable.
 *
 * @param  mixed   $post
 * @return bool
 */
function uhmi_content_data__get_meta__repeatable($post)
{
	$repeatable = uhmi_content_data__get_meta( 'uhmi_content_repeatable', $post );
	$repeatable = ( ! $repeatable ? false : $repeatable );
	return ( $repeatable === 'yes' ? true : false );
}

/**
 * Get button.
 *
 * @param  mixed   $post
 * @return array
 */
function uhmi_content_data__get_meta__button($post)
{
	$button = uhmi_content_data__get_meta( 'uhmi_content_button', $post );

	if ( ! is_array($button)) {
		$button = array();
	}

	$button['type']  = ( isset($button['type']) ? $button['type'] : 'general' );
	$button['text']	 = ( (isset($button['text']) && ! empty($button['text'])) ? $button['text'] : Uhmi_Helper::get_button_text() );
	$button['color'] = ( (isset($button['color']) && ! empty($button['color'])) ? $button['color'] : Uhmi_Helper::get_button_color() );
	$button['color_type'] = ( (isset($button['color_type']) && ! empty($button['color_type'])) ? $button['color_type'] : 'default' );

	return $button;
}

/**
 * Get note.
 *
 * @param  mixed   $post
 * @return array
 */
function uhmi_content_data__get_meta__note($post)
{
	$note = uhmi_content_data__get_meta( 'uhmi_content_note', $post );

	if ( ! is_array($note)) {
		$note = array();
	}

	$note['type'] = ( isset($note['type']) ? $note['type'] : 'disabled' );
	$note['text'] = ( isset($note['text']) ? $note['text'] : Uhmi_Helper::get_option('note', '') );

	return $note;
}
