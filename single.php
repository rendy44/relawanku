<?php
/**
 * Custom template for displaying single post.
 *
 * @author Rendy
 * @package Relawanku
 */

use Relawanku\Template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) {
	the_post();

	Template::init()->render( 'single' );
}

get_footer();
