<?php
/**
 * Class to modify mission table view.
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

if ( ! class_exists( 'Relawanku\Tables\Mission' ) ) {

	/**
	 * Mission class.
	 */
	final class Mission extends Table {

		/**
		 * Define post type name.
		 *
		 * @var string
		 */
		protected $post_type = 'mission';

		/**
		 * Method to modify table columns.
		 *
		 * @param array $columns current columns.
		 *
		 * @return array
		 */
		protected function columns( $columns ) {
			unset( $columns['date'] );
			$columns['location'] = __( 'Location', 'relawanku' );
			$columns['period']   = __( 'Period', 'relawanku' );

			return $columns;
		}

		/**
		 * Method to modify column value.
		 *
		 * @param int $post_id post id.
		 *
		 * @return array
		 */
		protected function column_fields( $post_id ) {
			$columns = array();

			// Assign location.
			$columns['location'] = $this->helpers->get_post_meta( $post_id, 'location' );

			// Assign period.
			$date_start = $this->helpers->get_post_meta( $post_id, 'date_start' );
			$date_end   = $this->helpers->get_post_meta( $post_id, 'date_end' );
			if ( $date_start && $date_end ) {
				$columns['period'] = $this->helpers->timestamp_to_date( $date_start ) . ' - ' . $this->helpers->timestamp_to_date( $date_end );
			}

			return $columns;
		}
	}
}
