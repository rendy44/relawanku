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
		$current_timestamp = current_time( 'timestamp' ); // phpcs:ignore
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
			function ( $division ) use ( $helper ) {
				return $helper->translate_division( $division );
			},
			$divisions
		);

		$details['division'] = array( __( 'Division', 'relawanku' ), implode( ', ', $formatted_division ) );
	}

	if ( $valid_from && $valid_to ) {
		$details['validity'] = array( __( 'Valid date', 'relawanku' ), "$valid_from to $valid_to" );
	}

	// Get skills information.
	$skills = $helper->get_volunteer_skills( $volunteer_id );

	// Select missions.
	$missions       = array();
	$missions_query = new WP_Query(
		array(
			'post_type'      => 'mission',
			'posts_per_page' => -1,
			'meta_query'     => array( // phpcs:ignore
				array(
					'key'     => 'rlw_volunteer',
					'value'   => $volunteer_id,
					'compare' => '=',
				),
			),
		)
	);

	if ( $missions_query->have_posts() ) {
		while ( $missions_query->have_posts() ) {
			$missions_query->the_post();

			// Get few details.
			$mission_id       = get_the_ID();
			$start_date       = $helper->get_post_meta( $mission_id, 'date_start' );
			$end_date         = $helper->get_post_meta( $mission_id, 'date_end' );
			$volunteers       = $helper->get_post_meta( $mission_id, 'volunteer', false );
			$volunteers_count = $volunteers ? count( $volunteers ) : 0;
			$volunteers_label = '';
			if ( $volunteers_count > 1 ) {
				$other_volunteers_count = $volunteers_count - 1;
				$volunteers_label       = sprintf( _n( 'Alongside %s other volunteer', 'Alongside %s other volunteers', $other_volunteers_count, 'relawanku' ), $other_volunteers_count ); // phpcs:ignore
			}

			// Build the array.
			$missions[ $mission_id ] = array(
				'title'      => get_the_title(),
				'start'      => $start_date ? $helper->timestamp_to_date( $start_date, 'F Y' ) : false,
				'end'        => $end_date ? $helper->timestamp_to_date( $end_date, 'F Y' ) : false,
				'location'   => $helper->get_post_meta( $mission_id, 'location' ),
				'volunteers' => $volunteers_label,
			);
		}
	}
	wp_reset_postdata();

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
			'missions',
			'section_information',
			'section_skills',
			'section_missions',
			'details'
		)
	);
}

get_footer();
