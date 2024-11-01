<?php

/**
 * A Uhmi Payment.
 *
 * @request AJAX
 * @return  mixed
 */
function uhmi_payment()
{
	if ( ! isset($_POST['transaction_id'])) {
		return;
	}

	if ( ! isset($_SERVER['HTTP_X_CSRF_TOKEN'])) {
		return;
	}

	if ( ! wp_verify_nonce( $_SERVER['HTTP_X_CSRF_TOKEN'], '_uhmi_content_payment_nonce' ) ) {
		return;
	}

	if ( ! isset($_GET['uhmi'])) {
		return;
	}

	if ( ! isset($_GET['post_id'])) {
		return;
	}

	$post = get_post($_GET['post_id']);

	if ( ! $post || ! Uhmi_Helper::is_post_type_allowed($post->post_type)) {
		return;
	}

	$uhmi = new Uhmi;
	$uhmi->setApiKey(UHMI_PRIVATE_KEY);

	$transaction = $uhmi->getTransaction($_POST['transaction_id']);

	if ( ! $uhmi->hasPaid($transaction)) {
		return;
	}

	$payment_id = get_post_meta($post->ID, 'uhmi_content_payment_id', true);

	if ($payment_id !== $transaction['payment']['payment_id']) {
		return;
	}

	$content = $post->post_content;

	if (has_shortcode($content, 'uhmi')) {

		$pattern = get_shortcode_regex(array('uhmi'));

		if (preg_match("/$pattern/s", $content, $matches) && isset($matches[2]) && isset($matches[5]) && ! empty($matches[5])) {
			uhmi_payment__return_content($matches[5], $post);
			exit;
		}

		$split = preg_split("/$pattern/s", $content);

		if (is_array($split) && isset($split[1])) {
			uhmi_payment__return_content($split[1], $post);
			exit;
		}
	}

	uhmi_payment__return_content($content, $post);

	exit;
}

add_action( 'init', 'uhmi_payment' );

/**
 * Return content.
 *
 * @param  string $content
 * @param  object $post
 * @return string
 */
function uhmi_payment__return_content($content, $post)
{
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = apply_filters( 'uhmi_show_content', $content, $post );

	echo $content;
}
