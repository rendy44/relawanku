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
use WP_Post;
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
					'post_type' => 'volunteer',
					'paged'     => $page,
					'status'    => 'published',
				)
			);

			// Check the volunteers' availability.
			if ( $query_volunteers->have_posts() ) {
				$this->set_status();

				// Loop the volunteers.
				while ( $query_volunteers->have_posts() ) {
					$query_volunteers->the_post();
					$id       = get_the_ID();
					$output[] = array(
						'name'    => get_the_title(),
						'id_card' => $this->helper->get_post_meta( $id, 'id_card_number' ),
						'blood'   => $this->helper->get_post_meta( $id, 'blood_type' ),
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
