<?php

/**
 * Set payment error notice.
 *
 * @param  bool  $message
 * @return void
 */
function uhmi_payment_set_notice_error($message = false)
{	
	$message = ($message ? $message : __( 'Something went wrong with the payment. Please, try again.', 'uhmi' ));
	
	uhmi_payment_set_notice( 'error', $message );
}

/**
 * Set payment notice.
 *
 * @param  string  $notice
 * @param  string  $message
 * @return array
 */
function uhmi_payment_set_notice($notice, $message)
{
	global $uhmi_payment_notice;
	
	$uhmi_payment_notice = array(
		'notice'  => $notice,
		'message' => $message
	);
}

/**
 * Get payment notice.
 *
 * @return mixed
 */
function uhmi_payment_get_notice()
{
	if ( ! isset($GLOBALS['uhmi_payment_notice'])) {
		return false;
	}
	
	$notice = $GLOBALS['uhmi_payment_notice'];
	
	?>
		
	<div class="uhmi-notice uhmi-notice-<?php esc_attr_e( $notice['notice'] ) ?>">
		
		<p><?php esc_html_e( $notice['message'] ) ?></p>
		
	</div>
	
	<?php
}