<?php
/**
 * Custom template for displaying single volunteer.
 *
 * @author Rendy
 * @package Relawanku
 */

use Relawanku\Helper;
use Relawanku\Template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$helper = Helper::init();
get_header();

while ( have_posts() ) {
	the_post();

	$volunteer_id = get_the_ID();
	$page_title = get_the_title();
	$hero_small = true;
	$skills = $helper->get_post_meta($volunteer_id,'skill');
	Template::init()->render( 'single-volunteer', compact( 'page_title', 'hero_small' ) );
}

get_footer();
