<?php

/**
 * Get POST data.
 *
 * @param  object  $post
 * @return array
 */
function uhmi_content_data__get_post_data($post)
{
	$success_url = Uhmi_Helper::get_payment_success_url($post);

	return array(
		'type' => array(
			'default' => 'content',
			'value'	  => uhmi_content_data__get__type()
		),
		'title' => array(
			'default' => sprintf( '%s #%s',
				__( 'Your content', 'uhmi' ),
				$post->ID
			),
			'value'	  => Uhmi_Helper::sanitize_title( $post->post_title )
		),
		'price' => array(
			'default' => 0,
			'value'	  => uhmi_content_data__get__price()
		),
		'pwyw' => array(
			'default' => false,
			'value'	  => uhmi_content_data__get__pwyw()
		),
		'refundable' => array(
			'default' => false,
			'value'	  => uhmi_content_data__get__refundable()
		),
		'repeatable' => array(
			'default' => false,
			'value'	  => uhmi_content_data__get__repeatable()
		),
		'category' => array(
			'default' => null,
			'value'	  => uhmi_content_data__get__category()
		),
		'cover' => array(
			'default' => '',
			'value'	  => uhmi_content_data__get__cover($post)
		),
		'success_url' => array(
			'default' => $success_url,
			'value'	  => $success_url
		)
	);
}

/**
 * Get type.
 *
 * @return string
 */
function uhmi_content_data__get__type()
{
	if ( ! isset($_POST['uhmi_content_type'])) {
		return 'content';
	}

	return 'donation';
}

/**
 * Get price.
 *
 * @return float
 */
function uhmi_content_data__get__price()
{
	if ( ! isset($_POST['uhmi_content_price'])) {
		return 0;
	}

	$price = $_POST['uhmi_content_price'];
	$price = str_replace(',', '.', $price);
	$price = floatval($price);

	if ($price < 0) {
		return 0;
	}

	if ($price > 150) {
		return 150;
	}

	return $price;
}

/**
 * Get PWYW.
 *
 * @return bool
 */
function uhmi_content_data__get__pwyw()
{
	if ( ! isset($_POST['uhmi_content_pwyw'])) {
		return false;
	}

	return true;
}

/**
 * Get refundable.
 *
 * @return bool
 */
function uhmi_content_data__get__refundable()
{
	if ( ! isset($_POST['uhmi_content_refundable'])) {
		return false;
	}

	return true;
}

/**
 * Get repeatable.
 *
 * @return bool
 */
function uhmi_content_data__get__repeatable()
{
	if ( ! isset($_POST['uhmi_content_repeatable'])) {
		return true;
	}

	return false;
}

/**
 * Get category.
 *
 * @return string
 */
function uhmi_content_data__get__category()
{
	if ( ! isset($_POST['uhmi_content_category'])) {
		return 'other';
	}

	$categories = Uhmi_Helper::get_content_categories();
	$category = strtolower($_POST['uhmi_content_category']);

	return (in_array($category, $categories) ? $category : 'other');
}

/**
 * Get cover.
 *
 * @param  object  $post
 * @return string
 */
function uhmi_content_data__get__cover($post)
{
	if (isset($_POST['uhmi_content_cover']) && ! empty($_POST['uhmi_content_cover'])) {
		return $_POST['uhmi_content_cover'];
	}

	$featured = get_the_post_thumbnail_url($post);

	return ($featured ? $featured : '');
}

/**
 * Get button values.
 *
 * @return array
 */
function uhmi_content_data__get__button()
{
	$button['value'] = array();
	$button['value'] += uhmi_content_data__get__button_text();
	$button['value'] += uhmi_content_data__get__button_color();

	return $button;
}

/**
 * Get button text.
 *
 * @return array
 */
function uhmi_content_data__get__button_text()
{
	$button = array(
		'type' 		 => 'custom',
		'currency'	 => Uhmi_Helper::get_default_button_currency(),
		'text' 		 => Uhmi_Helper::get_button_text()
	);

	if ( ! isset($_POST['uhmi_content_button_text_type'])) {
		return $button;
	}

	$type = $_POST['uhmi_content_button_text_type'];

	if ($type === 'general') {
		$button['type'] = 'general';
		return $button;
	}

	if ( ! isset($_POST['uhmi_content_button_text'])) {
		return $button;
	}

	if (empty($_POST['uhmi_content_button_text'])) {
		return $button;
	}

	$button['type'] = 'custom';
	$button['text'] = $_POST['uhmi_content_button_text'];

	return $button;
}

/**
 * Get button color.
 *
 * @return array
 */
function uhmi_content_data__get__button_color()
{
	$button = array(
		'color'		 => Uhmi_Helper::get_default_button_color(),
		'color_type' => 'default'
	);

	if ( ! isset($_POST['uhmi_content_button_color_type'])) {
		return $button;
	}

	$type = $_POST['uhmi_content_button_color_type'];

	if ($type === 'default') {
		return $button;
	}

	if ($type === 'general') {
		$button['color_type'] = 'general';
		return $button;
	}

	if ( ! isset($_POST['uhmi_content_button_color'])) {
		return $button;
	}

	if (empty($_POST['uhmi_content_button_color'])) {
		return $button;
	}

	$button['color_type'] = 'custom';
	$button['color'] = $_POST['uhmi_content_button_color'];

	return $button;
}

/**
 * Get note.
 *
 * @return array
 */
function uhmi_content_data__get__note()
{
	$note = array(
		'value' => array(
			'type' 	=> 'disabled',
			'text' 	=> ''
		)
	);

	if ( ! isset($_POST['uhmi_content_note_type'])) {
		return $note;
	}

	$type = $_POST['uhmi_content_note_type'];

	if ($type === 'disabled') {
		return $note;
	}

	if ($type === 'general') {
		$note['value']['type'] = 'general';
		return $note;
	}

	if ( ! isset($_POST['uhmi_content_note'])) {
		return $note;
	}

	$note['value']['type'] = 'custom';
	$note['value']['text'] = $_POST['uhmi_content_note'];

	return $note;
}
