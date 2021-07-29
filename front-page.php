<?php
/**
 * Template for displaying homepage.
 *
 * @author Rendy
 * @package Relawanku
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) {
	the_post();
}

get_footer();
