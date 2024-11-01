<?php
/**
 * The Uhmi plugin.
 *
 * @package   Uhmi
 * @copyright Copyright (C) 2019, Uhmi BV - dev@uhmi.io
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 *
 * Plugin Name: Uhmi
 * Plugin URI: 	https://uhmi.io/wordpress/
 * Version:     1.1
 * Description: Monetize your content by selling your articles, videos, music, podcasts and any other type of content for any price you want – from 1 cent. Amp up your service with features such as donations, Pay What You Want, subscriptions and many more.
 * Author:      Uhmi
 * Author URI:  https://uhmi.io/
 * Text Domain: uhmi
 * Domain Path: /languages/
 * License:     GPLv3
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'UHMI_PLUGIN', __FILE__ );

define( 'UHMI_PLUGIN_BASENAME', plugin_basename( UHMI_PLUGIN ) );

define( 'UHMI_PLUGIN_NAME', trim( dirname( UHMI_PLUGIN_BASENAME ), '/' ) );

define( 'UHMI_PLUGIN_DIR', untrailingslashit( dirname( UHMI_PLUGIN ) ) );

define( 'UHMI_PLUGIN_DIR_ADMIN', UHMI_PLUGIN_DIR . '/app/admin' );

define( 'UHMI_PLUGIN_DIR_PUBLIC', UHMI_PLUGIN_DIR . '/app/public' );

define( 'UHMI_WEBSITE', 'https://uhmi.io' );


include UHMI_PLUGIN_DIR . '/app/class-uhmi-helper.php';

define( 'UHMI_PUBLIC_KEY', Uhmi_Helper::get_option('public_key') );

define( 'UHMI_PRIVATE_KEY', Uhmi_Helper::get_option('private_key') );

define( 'UHMI_API_KEYS', ((UHMI_PRIVATE_KEY && UHMI_PUBLIC_KEY) ? true : false) );


if ( is_admin() ) {
	include UHMI_PLUGIN_DIR_ADMIN . '/admin.php';
} else {
	include UHMI_PLUGIN_DIR_PUBLIC . '/public.php';
}

include UHMI_PLUGIN_DIR . '/languages/load_textdomain.php';
