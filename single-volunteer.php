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

	// Get basic information of the volunteer.
	$volunteer_id = get_the_ID();
	$page_title   = get_the_title();
	$hero_small   = true;
	$details      = array(
		'name' => array( __( 'Full name', 'relawanku' ), $page_title ),
	);
	// Get more details of the volunteer.
	$id_card    = $helper->get_post_meta( $volunteer_id, 'id_card_number' );
	$phone      = $helper->get_post_meta( $volunteer_id, 'phone' );
	$valid_from = $helper->get_post_meta( $volunteer_id, 'valid_from' );
	$valid_from = $valid_from ? $helper->timestamp_to_date( $valid_from ) : false;
	$valid_to   = $helper->get_post_meta( $volunteer_id, 'valid_to' );
	$valid_to   = $valid_to ? $helper->timestamp_to_date( $valid_to ) : false;
	// Make sure only add the details when it is available.
	if ( $id_card ) {
		$details['id_card'] = array( __( 'Id card', 'relawanku' ), $id_card );
	}
	if ( $phone ) {
		$details['phone'] = array( __( 'Phone', 'relawanku' ), $phone );
	}
	if ( $valid_from && $valid_to ) {
		$details['validity'] = array( __( 'Valid date', 'relawanku' ), "{$valid_from} to {$valid_to}" );
	}
	// Proceed to render the template.
	Template::init()->render( 'single-volunteer', compact( 'page_title', 'hero_small', 'details' ) );
}

get_footer();
