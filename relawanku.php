<?php
/**
 * Plugin Name: Relawanku - Simple Volunteers Management
 * Description: Lightweight and simple custom plugin for volunteers management
 * Version: 0.1.0
 * Author: Rendy
 * Author URI: https://fb.com/rendy.444444
 * Text Domain: relawanku
 * Domain Path: /languages
 *
 * @package Relawanku
 */

use Relawanku\Relawanku;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defined( 'RELAWANKU__VERSION' ) || define( 'RELAWANKU__VERSION', '0.1.0' );
defined( 'RELAWANKU__MINIMUM_WP_VERSION' ) || define( 'RELAWANKU__MINIMUM_WP_VERSION', '5.0' );
defined( 'RELAWANKU__PLUGIN_PATH' ) || define( 'RELAWANKU__PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
defined( 'RELAWANKU__PLUGIN_URL' ) || define( 'RELAWANKU__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
defined( 'RELAWANKU__PREFIX' ) || define( 'RELAWANKU__PREFIX', 'rlw_' );

defined( 'RELAWANKU__BASE' ) || define( 'RELAWANKU__BASE', plugin_basename( __FILE__ ) );

require_once RELAWANKU__PLUGIN_PATH . 'autoload.php';

Relawanku::init();

add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain( 'relawanku', false, dirname( RELAWANKU__BASE ).'/languages' );
	}
);
