<?php

include UHMI_PLUGIN_DIR_ADMIN . '/metaboxes/content_data/get_meta.php';
include UHMI_PLUGIN_DIR_ADMIN . '/metaboxes/content_data/get_post_data.php';

/**
 * Add content data metabox.
 *
 * @return void
 */
function uhmi_content_data__add_metabox()
{
    if ( ! current_user_can('publish_posts')) {
        return;
    }

	global $post;

	if ( ! Uhmi_Helper::is_post_type_allowed($post->post_type)) {
		return false;
	}

    if ($post->post_type === 'post' || $post->post_type === 'page') {

		add_meta_box(
	        'uhmi_content_data_metabox',
	        esc_html__( 'Uhmi', 'uhmi' ),
	        'uhmi_content_data__add_metabox_callback',
	        null,
	        'normal',
	        'high'
	    );
	}
}

add_action( 'add_meta_boxes', 'uhmi_content_data__add_metabox' );

/**
 * Content data metabox callback.
 *
 * @param  object  $post
 * @return mixed
 */
function uhmi_content_data__add_metabox_callback($post)
{
	global $pagenow;

	// Get previously added content to repeat that content data
	if ($pagenow === 'post-new.php') {

		$query = new WP_Query(array(
			'post_type' => $post->post_type,
			'post__not_in' => array( $post->ID ),
			'post_status' => array( 'publish', 'future' ),
			'posts_per_page' => 1,
			'order_by' => 'DESC'
		));

		$post = ($query->post ? $query->post : $post);
	}

	$locale = Uhmi_Helper::get_user_locale();
	$content_categories = Uhmi_Helper::get_content_categories();

	$category 	 = uhmi_content_data__get_meta__category($post);
	$cover 		 = uhmi_content_data__get_meta__cover($post);
	$price		 = uhmi_content_data__get_meta__price($post);
	$donation    = uhmi_content_data__get_meta__donation($post);
	$pwyw   	 = uhmi_content_data__get_meta__pwyw($post);
	$refundable  = uhmi_content_data__get_meta__refundable($post);
	$repeatable  = uhmi_content_data__get_meta__repeatable($post);

    $button  	 = uhmi_content_data__get_meta__button($post);
    $buttonType  = $button['type'];
    $buttonText  = $button['text'];
    $buttonColor = $button['color'];
    $buttonColorType = $button['color_type'];

	$note  	 	 = uhmi_content_data__get_meta__note($post);
	$noteType	 = $note['type'];
	$noteText	 = $note['text'];

	$noteEditorSettings = array(
        'wpautop' => false,
        'media_buttons' => false,
        'editor_height' => '120',
        'drag_drop_upload' => true,
        //'quicktags' => false
    );

    wp_nonce_field( '_uhmi_content_data_nonce', 'uhmi_content_data_nonce' );

    include UHMI_PLUGIN_DIR_ADMIN . '/views/content_data.php';
}

/**
 * Save.
 *
 * @param  int     $post_id
 * @param  object  $post
 * @param  bool    $is_updated
 * @return void
 */
function uhmi_content_data__save($post_id, $post, $is_updated)
{
	if ( ! current_user_can( 'publish_posts' )) {
		return;
	}

	if ( ! Uhmi_Helper::is_post_type_allowed($post->post_type)) {
		return;
	}

	if ( ! isset($_POST['uhmi_content_data_nonce']) || ! wp_verify_nonce( $_POST['uhmi_content_data_nonce'], '_uhmi_content_data_nonce' )) {
		return;
	}

	$is_active    = 'no';
	$content_data = uhmi_content_data__get_post_data($post);
	$payment_data = uhmi_content_data__get_payment_data($content_data);

	if (uhmi_content_data__should_save_uhmi_payment($post)) {

        $payment = uhmi_content_data__save_uhmi_payment($payment_data, $post);

		if ( ! is_null($payment)) {

			// Set payment id
			$content_data['payment_id'] = array(
				'value'   => $payment['payment_id'],
				'default' => $payment['payment_id']
			);

			$is_active = $content_data['price']['value']; // instead bool, set a price to check if active
		}
	}

	update_post_meta( $post_id, 'uhmi_is_active', $is_active );

	uhmi_content_data__save_post_meta($content_data, $post_id);
}

add_action( 'save_post', 'uhmi_content_data__save', 10, 3 );

/**
 * Should save payment at Uhmi?
 *
 * @param  object  $post
 * @return bool
 */
function uhmi_content_data__should_save_uhmi_payment($post)
{
	if (has_shortcode($post->post_content, 'uhmi')) {
		return true;
	}

	return false;
}

/**
 * Save payment at Uhmi.
 *
 * @param  array   $payment_data
 * @param  object  $post
 * @return mixed
 */
function uhmi_content_data__save_uhmi_payment($payment_data, $post)
{
	$uhmi = new Uhmi;
	$uhmi->setApiKey(UHMI_PRIVATE_KEY);

	$payment_id = get_post_meta( $post->ID, 'uhmi_content_payment_id', true );

    // Check if payment exists by trying to update it.
    // If error returns – meaning it doesn't exist - create a new payment.

    $payment = $uhmi->updatePayment($payment_id, $payment_data);

	if ($uhmi->hasUpdatedSuccessfully($payment)) {
        return $payment;
    }

    $payment = $uhmi->createPayment($payment_data);

    if ($uhmi->hasCreatedSuccessfully($payment)) {
        return $payment;
    }

	uhmi_content_data__save_uhmi_payment__error($payment);

	return null;
}

/**
 * Save post.
 *
 * @param  array   $content_data
 * @param  int     $post_id
 * @return void
 */
function uhmi_content_data__save_post_meta($content_data, $post_id)
{
	$prefix = 'uhmi_content_';

	$content_data['button'] = uhmi_content_data__get__button();
	$content_data['note'] = uhmi_content_data__get__note();

	// Save the content data as post meta in WP database
	foreach ($content_data as $key => $data) {

		if ($key === 'title' || $key === 'success_url') {
			continue;
		}

		if ($key === 'pwyw') {
			update_post_meta( $post_id, $prefix . $key, ($data['value'] ? 'yes' : 'no') );
			continue;
		}

		if ($key === 'cover') {
			update_post_meta( $post_id, $prefix . $key, esc_url_raw( $data['value'] ) );
			continue;
		}

		if ($key === 'refundable') {
			update_post_meta( $post_id, $prefix . $key, ($data['value'] ? 'yes' : 'no') );
			continue;
		}

		if ($key === 'repeatable') {
			update_post_meta( $post_id, $prefix . $key, ($data['value'] ? 'yes' : 'no') );
			continue;
		}

		update_post_meta( $post_id, $prefix . $key, $data['value'] );
	}
}

/**
 * Get payment data.
 *
 * @param  array  $content_data
 * @return array
 */
function uhmi_content_data__get_payment_data($content_data)
{
	$payment_data   = array();
	$payment_values = uhmi_content_data__get_payment_values();

	// Set the payment data with the content data
	foreach ($payment_values as $key => $value) {

		if (is_array($value)) {

			foreach ($value as $child) {

				$payment_data[$key][$child] = $content_data[$child]['value'];
			}

			continue;
		}

		$payment_data[$value] = $content_data[$value]['value'];
	}

	return $payment_data;
}

/**
 * Get payment values.
 *
 * @return array
 */
function uhmi_content_data__get_payment_values()
{
	return array(
		'type',
		'title',
		'price',
		'pwyw',
	    'refundable',
	    'repeatable',
	    'category',
	    'cover',
	    'success_url',
	);
}

/**
 * Show error when saving payment at Uhmi.
 *
 * @param  array  $payment
 * @return void
 */
function uhmi_content_data__save_uhmi_payment__error($payment)
{
	$notice = __( 'Could not save content at Uhmi. Please, try again.', 'uhmi' );

	if (isset($payment['error']['message'])) {
		$notice .= ' (Message: ' . $payment['error']['message'] . ')';
	}

    add_filter('redirect_post_location', function($location) use ($notice) {
        return add_query_arg('uhmi_error_notice', urlencode($notice), $location);
    });
}
