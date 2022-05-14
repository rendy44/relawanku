<?php
/**
 * Abstract class for admin custom columns.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Abstracts;

use Relawanku\Traits\Singleton;
use Relawanku\Traits\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Abstracts\Table' ) ) {

	/**
	 * Class Table
	 *
	 * @package Relawanku\Abstracts
	 */
	abstract class Table {
		use Singleton;
		use Utilities;

		/**
		 * Variable of the post type name.
		 *
		 * @var string
		 */
		protected $post_type;

		/**
		 * Table constructor.
		 */
		protected function __construct() {

			// Instance helper class.
			$this->instance_helpers();

			// Manage table header.
			add_filter(
				"manage_{$this->post_type}_posts_columns",
				function ( $columns ) {
					return $this->columns( $columns );
				}
			);

			// Manage column content.
			add_action(
				"manage_{$this->post_type}_posts_custom_column",
				function ( $column, $post_id ) {
					echo $this->column_field( $column, $post_id ); // phpcs:ignore
				},
				10,
				2
			);
		}

		/**
		 * Method to modify the columns.
		 *
		 * @param array $columns list of the current columns.
		 *
		 * @return array
		 */
		protected function columns( $columns ) {
			return $columns;
		}

		/**
		 * Method to modify column content.
		 *
		 * @param string $column column name.
		 * @param int    $post_id post id.
		 *
		 * @return string
		 */
		private function column_field( $column, $post_id ) {
			$columns = $this->column_fields( $post_id );
			if ( ! empty( $columns[ $column ] ) ) {
				return $columns[ $column ];
			}

			return '';
		}

		/**
		 * Method to define columns content.
		 *
		 * @param int $post_id post id.
		 *
		 * @return array
		 */
		protected function column_fields( $post_id ) {
			return array();
		}
	}
}
