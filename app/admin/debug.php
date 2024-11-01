<?php
	
/*
 * Debug
 */
function uhmi_footer_db_queries(){
	// define('SAVEQUERIES', true)
    global $wpdb;
	echo "<pre style='padding-left: 200px; width: 1150px; white-space: pre-wrap;'>";
	print_r($wpdb->queries);
	echo "</pre>";
}

//add_action('shutdown', 'uhmi_footer_db_queries');