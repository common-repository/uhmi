<?php

include UHMI_PLUGIN_DIR_ADMIN . '/activation.php';
include UHMI_PLUGIN_DIR_ADMIN . '/action_links.php';
include UHMI_PLUGIN_DIR_ADMIN . '/enqueue.php';
include UHMI_PLUGIN_DIR_ADMIN . '/footer.php';
include UHMI_PLUGIN_DIR_ADMIN . '/menu.php';
include UHMI_PLUGIN_DIR_ADMIN . '/api_keys.php';
include UHMI_PLUGIN_DIR_ADMIN . '/register_shortcodes.php';
include UHMI_PLUGIN_DIR_ADMIN . '/debug.php';

if ( ! UHMI_API_KEYS) {
	include UHMI_PLUGIN_DIR_ADMIN . '/is_new.php';
	include UHMI_PLUGIN_DIR_ADMIN . '/get_started.php';
}

if (UHMI_API_KEYS) {
	include UHMI_PLUGIN_DIR_ADMIN . '/blank_state.php';
	include UHMI_PLUGIN_DIR_ADMIN . '/settings.php';
	include UHMI_PLUGIN_DIR_ADMIN . '/tinymce.php';
	include UHMI_PLUGIN_DIR_ADMIN . '/gutenberg.php';
	include UHMI_PLUGIN_DIR_ADMIN . '/columns.php';
	include UHMI_PLUGIN_DIR_ADMIN . '/metaboxes/content_data.php';
}

include UHMI_PLUGIN_DIR . '/lib/Uhmi.php';
include UHMI_PLUGIN_DIR . '/lib/Uhmi-Verify.php';
