<?php

/**
 * Show Uhmi shortcode.
 *
 * @param  object  $post
 * @param  string  $shortcode
 * @param  array   $attributes
 * @param  string  $content
 * @return mixed
 */
function uhmi_shortcodes__show($post, $shortcode, $attributes, $content)
{
	$post_id = $post->ID;
	$payment_id = get_post_meta( $post_id, 'uhmi_content_payment_id', true );

	if ( ! $payment_id) {
		return;
	}

	$price 	= get_post_meta( $post_id, 'uhmi_content_price', true );
	$button = Uhmi_Helper::get_button($post, $price); // [text] is escaped
	$note 	= Uhmi_Helper::get_note($post);

	wp_enqueue_style( 'uhmi_public_styles' );
    wp_enqueue_script( 'uhmi_public_javascript' );

    Uhmi_Helper::add_loaded_payment_id($payment_id);
    wp_localize_script( 'uhmi_public_javascript', 'UHMI_PRELOAD', Uhmi_Helper::$loaded_payment_ids );

    ob_start();
    include UHMI_PLUGIN_DIR_PUBLIC . '/views/uhmi_content.php';
    $output = ob_get_clean();

    return apply_filters( 'uhmi_show_paywall', $output, $post, $shortcode );
}
