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
	$id_card              = $helper->get_post_meta( $volunteer_id, 'id_card_number' );
	$phone                = $helper->get_post_meta( $volunteer_id, 'phone' );
	$blood_type           = $helper->get_post_meta( $volunteer_id, 'blood_type' );
	$valid_from_timestamp = $helper->get_post_meta( $volunteer_id, 'valid_from' );
	$valid_from           = $valid_from_timestamp ? $helper->timestamp_to_date( $valid_from_timestamp ) : false;
	$valid_to_timestamp   = $helper->get_post_meta( $volunteer_id, 'valid_to' );
	$valid_to             = $valid_to_timestamp ? $helper->timestamp_to_date( $valid_to_timestamp ) : false;

	// Check the status validity.
	if ( $valid_from_timestamp && $valid_to_timestamp ) {
		$current_timestamp = current_time( 'timestamp' );
		$page_title        = "<span>{$page_title}</span>";
		$page_title       .= $current_timestamp >= $valid_from_timestamp && $current_timestamp <= $valid_to_timestamp ? "<span class='verified' data-tooltip='" . __( 'In service', 'relawanku' ) . "'><i class='ri-checkbox-circle-line'></i></span>" : "<span class='unverified' data-tooltip='" . __( 'Out of service', 'relawanku' ) . "'><i class='ri-close-circle-line'></i></span>";
	}

	// Make sure only add the details when it is available.
	if ( $id_card ) {
		$details['id_card'] = array( __( 'Id card', 'relawanku' ), $id_card );
	}
	if ( $blood_type ) {
		$details['blood_type'] = array( __( 'Blood type', 'relawanku' ), strtoupper( $blood_type ) );
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
