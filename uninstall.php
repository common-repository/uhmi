<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	status_header( 404 );
	exit;
}

delete_option( 'uhmi_options' );
delete_site_option( 'uhmi_options' );

wp_cache_flush(); // Clear any cached data that has been removed
