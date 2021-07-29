<?php
/**
 * Template part of header.
 *
 * @author Rendy
 * @package Relawanku
 */

use Relawanku\Template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

Template::init()->render( 'header' );
