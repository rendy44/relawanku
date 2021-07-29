<?php
/**
 * Main file of the theme.
 *
 * @author Rendy
 * @package Relawanku
 */

use Relawanku\Relawanku;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defined( 'RELAWANKU__VERSION' ) || define( 'RELAWANKU__VERSION', '0.1.0' );
defined( 'RELAWANKU__PATH' ) || define( 'RELAWANKU__PATH', get_template_directory() );
defined( 'RELAWANKU__URL' ) || define( 'RELAWANKU__URL', get_template_directory_uri() );
defined( 'RELAWANKU__PREFIX' ) || define( 'RELAWANKU__PREFIX', 'rlw_' );

require_once RELAWANKU__PATH . '/autoload.php';

Relawanku::init();
