<?php
/**
 * Post type abstract class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Abstracts;

use Relawanku\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Abstracts\Type' ) ) {

	/**
	 * Class Type
	 *
	 * @package Relawanku\Type
	 */
	abstract class Type {

		use Singleton;

		/**
		 * Slug variable.
		 *
		 * @var string
		 */
		protected $slug = 'custom';

		/**
		 * Define custom title placeholder.
		 *
		 * @var bool|string
		 */
		protected $custom_title = false;

		/**
		 * Custom args.
		 *
		 * @return array
		 */
		protected function args() {
			return array();
		}

		/**
		 * Get final args.
		 *
		 * @return array|object|string
		 */
		private function final_args() {

			// Prepare default args.
			$default_args = array(
				'label'  => ucfirst( $this->slug . 's' ),
				'public' => true,
			);

			return wp_parse_args( $this->args(), $default_args );
		}

		/**
		 * Type constructor.
		 */
		protected function __construct() {

			// Add action to register custom post type.
			add_action(
				'init',
				function () {

					// Do register post type.
					register_post_type( $this->slug, $this->final_args() );
				}
			);

			// Make sure custom title is used.
			if ( $this->custom_title ) {
				add_filter(
					'enter_title_here',
					function ( $title, $post ) {

						// Process to alter title name.
						if ( $post->post_type === $this->slug ) {
							/* translators: %s name of the slug */
							$title = sprintf( _x( '%s name', 'post_type_slug', 'relawanku' ), ucfirst( $this->slug ) );
						}

						return $title;
					},
					10,
					2
				);
			}
		}
	}
}
