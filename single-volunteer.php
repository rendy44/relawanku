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
	$volunteer_id   = get_the_ID();
	$volunteer_name = get_the_title();
	$details        = array(
		'name' => array( __( 'Full name', 'relawanku' ), $volunteer_name ),
	);

	// Get more details of the volunteer.
	$id_card              = $helper->get_post_meta( $volunteer_id, 'id_card_number' );
	$valid_from_timestamp = $helper->get_post_meta( $volunteer_id, 'valid_from' );
	$valid_from           = $valid_from_timestamp ? $helper->timestamp_to_date( $valid_from_timestamp, 'F Y' ) : false;
	$valid_to_timestamp   = $helper->get_post_meta( $volunteer_id, 'valid_to' );
	$valid_to             = $valid_to_timestamp ? $helper->timestamp_to_date( $valid_to_timestamp, 'F Y' ) : false;
	$is_valid             = false;

	// Check the status validity.
	if ( $valid_from_timestamp && $valid_to_timestamp ) {
		$current_timestamp = current_time( 'timestamp' );
		$is_valid          = $current_timestamp >= $valid_from_timestamp && $current_timestamp <= $valid_to_timestamp;
	}

	// Get position.
	$position = $helper->get_post_meta( $volunteer_id, 'position' );
	if ( $position ) {
		$position = $helper->translate_position( $position );
	}

	// Get division information.
	$divisions = $helper->get_post_meta( $volunteer_id, 'division', false );

	// Make sure only add the details when it is available.
	if ( $id_card ) {
		$details['id_card'] = array( __( 'Id card', 'relawanku' ), $id_card );
	}
	if ( $divisions ) {
		$formatted_division = array_map(
			function( $division ) use ( $helper ) {
				return $helper->translate_division( $division );
			},
			$divisions
		);

		$details['division'] = array( __( 'Division', 'relawanku' ), implode( ', ', $formatted_division ) );
	}

	if ( $valid_from && $valid_to ) {
		$details['validity'] = array( __( 'Valid date', 'relawanku' ), "{$valid_from} to {$valid_to}" );
	}

	// Get skills information.
	$skills = get_the_terms( $volunteer_id, 'skill' );
	if ( $skills ) {
		$skills = array_map(
			function( $skill ) {
				return $skill->name;
			},
			$skills
		);
	}

	// Define the section title.
	$section_information = __( 'Information', 'relawanku' );
	$section_skills      = __( 'Skills', 'relawanku' );
	$section_missions    = __( 'Mission Involvement', 'relawanku' );

	// Proceed to render the template.
	Template::init()->render(
		'single-volunteer2',
		compact(
			'is_valid',
			'volunteer_name',
			'position',
			'skills',
			'section_information',
			'section_skills',
			'section_missions',
			'details'
		)
	);
}

get_footer();
