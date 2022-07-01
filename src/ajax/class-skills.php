<?php
/**
 * Skills ajax class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Ajax;

use Relawanku\Abstracts\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Ajax\Skills' ) ) {

	/**
	 * Skills class.
	 */
	final class Skills extends Ajax {

		/**
		 * Abstract method
		 *
		 * @return array
		 */
		protected function handle() {
			$results = array();
			$skills  = get_terms(
				array(
					'taxonomy'   => 'skill',
					'hide_empty' => false,
				)
			);

			if ( ! is_wp_error( $skills ) ) {
				$results = array_map(
					function ( $skill ) {
						$skill->label = $skill->name;
						$skill->value = $skill->term_id;

						return $skill;
					},
					$skills
				);
				$this->set_status();
			} else {
				$this->add_message( $skills->get_error_message() );
			}

			return $results;
		}

		/**
		 * Skills constructor.
		 */
		protected function __construct() {
			parent::__construct( 'skills' );
		}
	}
}
