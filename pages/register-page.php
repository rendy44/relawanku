<?php
/**
 * Template Name: Volunteer Registration Page
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

use Relawanku\Template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'rlw_register_page' );

get_header();

while ( have_posts() ) {
	the_post();

	Template::init()->render( 'pages.register' );
}

get_footer();
