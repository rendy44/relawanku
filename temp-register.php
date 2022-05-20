<?php
/**
 * Template Name: Register Page
 * Template Post Type: page
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

use Relawanku\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$helper = Helper::init();
get_header();

while ( have_posts() ) {
	the_post();
}

get_footer();
