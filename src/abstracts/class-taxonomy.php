<?php
/**
 * Taxonomy abstract class.
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

if ( ! class_exists( 'Relawanku\Abstracts\Taxonomy' ) ) {

	/**
	 * Class Taxonomy
	 *
	 * @package Relawanku\Abstracts
	 */
	abstract class Taxonomy {
		use Singleton;

		/**
		 * Taxonomy slug.
		 *
		 * @var string
		 */
		protected $slug;

		/**
		 * Post type(s) where should this taxonomy applied to.
		 *
		 * @var string|array
		 */
		protected $post_types;

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

			$singular_name        = $this->slug;
			$singular_capitalized = ucfirst( $singular_name );
			$name                 = $singular_name . 's';
			$name_capitalized     = ucfirst( $name );

			// Prepare default args.
			$default_args = array(
				'hierarchical' => true,
				'labels'       => array(
					'name'                       => $name_capitalized,
					'singular_name'              => $singular_capitalized,
					/* translators: %s taxonomy name */
					'search_items'               => sprintf( _x( 'Search %s', 'taxonomy', 'relawanku' ), $name_capitalized ),
					/* translators: %s taxonomy name */
					'popular_items'              => sprintf( _x( 'Popular %s', 'taxonomy', 'relawanku' ), $name_capitalized ),
					/* translators: %s taxonomy name */
					'all_items'                  => sprintf( _x( 'All %s', 'taxonomy', 'relawanku' ), $name_capitalized ),
					/* translators: %s taxonomy name */
					'parent_item'                => sprintf( _x( 'Parent %s', 'taxonomy', 'relawanku' ), $name_capitalized ),
					/* translators: %s taxonomy singular name */
					'edit_item'                  => sprintf( _x( 'Edit %s', 'taxonomy', 'relawanku' ), $singular_capitalized ),
					/* translators: %s taxonomy singular name */
					'view_item'                  => sprintf( _x( 'View %s', 'taxonomy', 'relawanku' ), $singular_capitalized ),
					/* translators: %s taxonomy singular name */
					'update_item'                => sprintf( _x( 'Update %s', 'taxonomy', 'relawanku' ), $singular_capitalized ),
					/* translators: %s taxonomy singular name */
					'add_new_item'               => sprintf( _x( 'Add New %s', 'taxonomy', 'relawanku' ), $singular_capitalized ),
					/* translators: %s taxonomy singular name */
					'new_item_name'              => sprintf( _x( 'New %s Name', 'taxonomy', 'relawanku' ), $singular_capitalized ),
					/* translators: %s taxonomy name */
					'separate_items_with_commas' => sprintf( _x( 'Separate %s with comma', 'taxonomy', 'relawanku' ), $name ),
					/* translators: %s taxonomy name */
					'add_or_remove_items'        => sprintf( _x( 'Add or remove %s', 'taxonomy', 'relawanku' ), $name ),
					/* translators: %s taxonomy name */
					'choose_from_most_used'      => sprintf( _x( 'Choose from the most used %s', 'taxonomy', 'relawanku' ), $name ),
					/* translators: %s taxonomy name */
					'not_found'                  => sprintf( _x( 'No %s found', 'taxonomy', 'relawanku' ), $name ),
					/* translators: %s taxonomy name */
					'no_terms'                   => sprintf( _x( 'No %s', 'taxonomy', 'relawanku' ), $name ),
				),
			);

			return wp_parse_args( $this->args(), $default_args );
		}

		/**
		 * Taxonomy constructor.
		 */
		protected function __construct() {
			add_action(
				'init',
				function () {
					register_taxonomy( $this->slug, $this->post_types, $this->final_args() );
				}
			);
		}
	}
}
