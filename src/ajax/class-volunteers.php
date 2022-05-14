<?php
/**
 * Volunteer download ajax class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Ajax;

use Relawanku\Abstracts\Ajax;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Ajax\Volunteers' ) ) {

	/**
	 * Class Volunteers
	 *
	 * @package Relawanku\Ajax
	 */
	final class Volunteers extends Ajax {

		/**
		 * Volunteer constructor.
		 */
		protected function __construct() {
			parent::__construct( 'volunteers' );
		}

		/**
		 * Abstract method
		 *
		 * @return array
		 */
		protected function handle() {
			$page   = $this->get( 'page', 1 );
			$output = array();

			// Query all the volunteers.
			$query_volunteers = new WP_Query(
				array(
					'post_type'     => 'volunteer',
					'paged'         => $page,
					'status'        => 'published',
					'post_per_page' => - 1,
				)
			);

			// Check the volunteers' availability.
			if ( $query_volunteers->have_posts() ) {
				$this->set_status();

				// Loop the volunteers.
				while ( $query_volunteers->have_posts() ) {
					$query_volunteers->the_post();
					$id = get_the_ID();

					// Get volunteer's details.
					$position       = $this->helpers->get_post_meta( $id, 'position' );
					$divisions      = $this->helpers->get_post_meta( $id, 'division', false );
					$divisions_tr   = array_map(
						function ( $div ) {
							return $this->helpers->translate_division( $div );
						},
						$divisions
					);
					$valid_from     = $this->helpers->get_post_meta( $id, 'valid_from' );
					$valid_to       = $this->helpers->get_post_meta( $id, 'valid_to' );
					$blood          = $this->helpers->get_post_meta( $id, 'blood_type' );
					$marital_status = $this->helpers->get_post_meta( $id, 'marital_status' );

					$output[] = array(
						'name'           => get_the_title(),
						'id_card'        => $this->helpers->get_post_meta( $id, 'id_card_number' ),
						'position'       => $this->helpers->translate_position( $position ),
						'divisions'      => implode( ', ', $divisions_tr ),
						'validity'       => $valid_from && $valid_to ? $this->helpers->timestamp_to_date( $valid_from ) . ' - ' . $this->helpers->timestamp_to_date( $valid_to ) : '-',
						'blood'          => $this->helpers->translate_blood_type( $blood ),
						'marital_status' => $this->helpers->translate_status( $marital_status ),
						'skills'         => $this->helpers->get_volunteer_skills( $id, false ),
						'contact'        => $this->helpers->get_post_meta( $id, 'phone' ),
					);
				}
			} else {
				$this->add_message( __( 'No volunteer found', 'relawanku' ) );
			}

			// Add new attributes.
			$this->add_attribute( 'total', $query_volunteers->found_posts );

			return $output;
		}
	}
}
