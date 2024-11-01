<?php

/**
 * Set Uhmi footer text.
 *
 * @param  string  $text
 * @return string
 */
function uhmi_footer_text($text)
{
	$screen = get_current_screen();
	$uhmi_screens = Uhmi_Helper::get_screen_ids();
	
	if ( ! in_array($screen->id, $uhmi_screens)) {
		return $text;
	}
	
	$uhmi_footer = sprintf( '<span class="uhmi-footer">%s <a target="_blank" href="%s">%s Uhmi</a>.</span>',
		esc_html__( 'Thank you for using', 'uhmi' ),
		esc_url( UHMI_WEBSITE ),
		'<svg class="uhmi-logo-symbol" viewBox="0 0 150 130"><path d="M75,0L0,130h150L75,0z M75,51.087l30.802,53.417H44.214L75,51.087z"></path></svg>'
	);
	
	return "$text | $uhmi_footer";
}

add_filter( 'admin_footer_text', 'uhmi_footer_text' ); 