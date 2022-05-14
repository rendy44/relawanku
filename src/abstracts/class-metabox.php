<?php
/**
 * Abstract class for metabox configuration.
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

if ( ! class_exists( 'Relawanku\Abstracts\metabox' ) ) {

	/**
	 * Class Metabox
	 *
	 * @package Relawanku\Abstracts
	 */
	abstract class Metabox {
		use Singleton;
		use Utilities;

		/**
		 * Metabox field args.
		 *
		 * @var array
		 */
		private $fields;

		/**
		 * Metabox configuration args.
		 *
		 * @var array
		 */
		private $metabox_args;

		/**
		 * Custom field prefix.
		 *
		 * @var string
		 */
		private $prefix = RELAWANKU__PREFIX;

		/**
		 * Metabox position variable.
		 *
		 * @var string
		 */
		protected $position = 'normal';

		/**
		 * Metabox constructor.
		 *
		 * @param string   $id id of the metabox.
		 * @param string   $title title of the metabox.
		 * @param string[] $post_types where the metabox should be displayed.
		 */
		protected function __construct( $id, $title = '', array $post_types = array( 'post' ) ) {
			// Save the config.
			$this->instance( $id, $title, $post_types );

			// Instance helpers.
			$this->instance_helpers();

			// Trigger the filter.
			add_filter(
				'rwmb_meta_boxes',
				function ( $metabox ) {

					// Process to add the metabox.
					$this->alter_metabox_args( 'fields', $this->fields );

					$metabox[] = $this->get_metabox_args();

					return $metabox;
				}
			);
		}

		/**
		 * Method to instance metabox.
		 *
		 * @param string   $id id of the metabox.
		 * @param string   $title title of the metabox.
		 * @param string[] $post_types where the metabox should be displayed.
		 */
		private function instance( $id, $title = '', array $post_types = array( 'post' ) ) {
			$this->set_metabox_args(
				array(
					'title'      => $title ?: $this->generate_default_title( sanitize_title( $id ) ), // phpcs:ignore
					'id'         => sanitize_title( $id ),
					'post_types' => $post_types,
					'context'    => $this->position,
					'autosave'   => true,
					'fields'     => array(),
				)
			);
		}

		/**
		 * Method to save metabox args.
		 *
		 * @param array $metabox_args metabox configuration.
		 *
		 * @return Metabox
		 */
		private function set_metabox_args( array $metabox_args ) {
			$this->metabox_args = $metabox_args;

			return $this;
		}

		/**
		 * Update metabox args.
		 *
		 * @param string $key args key.
		 * @param array  $args value of the args.
		 */
		private function alter_metabox_args( $key, array $args ) {
			foreach ( $this->get_metabox_args() as $key_args => $value_arg ) {
				if ( $key_args === $key ) {
					$this->metabox_args[ $key ] = $args;
					break;
				}
			}
		}

		/**
		 * Get metabox args.
		 *
		 * @return array
		 */
		private function get_metabox_args() {
			return $this->metabox_args;
		}

		/**
		 * Method to add a metabox field.
		 *
		 * @param array $args metabox field args.
		 *
		 * @return Metabox
		 */
		protected function add_field( array $args ) {

			// Create field id based on field number.
			$field_id = ! empty( $this->fields ) ? count( $this->fields ) : 0;

			$default_arg = array(
				'id'   => $field_id,
				'type' => 'text',
			);

			// Build the field args.
			$args = wp_parse_args( $args, $default_arg );

			// Always put a prefix on the field.
			$args['id'] = $this->prefix . $args['id'];

			// Finally, save the field.
			$this->fields[] = $args;

			return $this;
		}

		/**
		 * Method to generate default field title.
		 *
		 * @param string $id id of the title.
		 *
		 * @return string
		 */
		private function generate_default_title( $id ) {
			/* translators: %s id of the title. */
			return sprintf( __( 'Field %s', 'relawanku' ), $id );
		}
	}
}
