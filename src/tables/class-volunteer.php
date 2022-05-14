<?php
/**
 * Class for modifying volunteer table.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Tables;

use Relawanku\Abstracts\Table;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Tables\Volunteer' ) ) {

	/**
	 * Class Volunteer.
	 */
	final class Volunteer extends Table {

		/**
		 * Post type variable.
		 *
		 * @var string
		 */
		protected $post_type = 'volunteer';

		/**
		 * Define custom columns.
		 *
		 * @param array $columns current columns.
		 *
		 * @return array
		 */
		protected function columns( $columns ) {
			unset( $columns['date'] );
			$columns['id_card']  = __( 'ID Card Number', 'relawanku' );
			$columns['position'] = __( 'Position', 'relawanku' );
			$columns['division'] = __( 'Division(s)', 'relawanku' );
			$columns['validity'] = __( 'Validity', 'relawanku' );

			return $columns;
		}

		/**
		 * Method to define columns content.
		 *
		 * @param int $post_id post id.
		 *
		 * @return array
		 */
		protected function column_fields( $post_id ) {
			$columns = array();

			// Assign id card.
			$columns['id_card'] = $this->helpers->get_post_meta( $post_id, 'id_card_number' );

			// Assign position.
			$position            = $this->helpers->get_post_meta( $post_id, 'position' );
			$columns['position'] = $this->helpers->translate_position( $position );

			// Assign division.
			$divisions = $this->helpers->get_post_meta( $post_id, 'division', false );
			if ( ! empty( $divisions ) ) {
				$divisions_tr        = array_map(
					function ( $arr ) {
						return $this->helpers->translate_division( $arr );
					},
					$divisions
				);
				$columns['division'] = implode( ', ', $divisions_tr );
			}

			// Assign validity.
			$valid_from = $this->helpers->get_post_meta( $post_id, 'valid_from' );
			$valid_to   = $this->helpers->get_post_meta( $post_id, 'valid_to' );
			if ( $valid_from && $valid_to ) {
				$columns['validity'] = $this->helpers->timestamp_to_date( $valid_from ) . ' - ' . $this->helpers->timestamp_to_date( $valid_to );
			}

			return $columns;
		}
	}
}
