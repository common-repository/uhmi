<?php
	
/**
 * Load textdomain
 */
function uhmi_load_plugin_textdomain()
{
	load_plugin_textdomain( 'uhmi', false, UHMI_PLUGIN_NAME . '/languages/' );
}

add_action( 'plugins_loaded', 'uhmi_load_plugin_textdomain' );