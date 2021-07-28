<?php
/**
 * Mission post type.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Types;

use Relawanku\Abstracts\Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Types\Mission' ) ) {

	/**
	 * Class Mission
	 *
	 * @package Relawanku\Types
	 */
	final class Mission extends Type {

		/**
		 * Define post type slug.
		 *
		 * @var string
		 */
		protected $slug = 'mission';

		/**
		 * Define custom title configuration.
		 *
		 * @var bool
		 */
		protected $custom_title = true;

		/**
		 * Override args.
		 *
		 * @return array|string[]
		 */
		protected function args() {
			return array(
				'labels'             => array(
					'add_new_item' => _x( 'Add New Mission', 'mission_admin', 'relawanku' ),
					'edit_item'    => _x( 'Edit Mission', 'mission_admin', 'relawanku' ),
				),
				'publicly_queryable' => false,
				'menu_icon'          => 'dashicons-location',
				'supports'           => array( 'title' ),
			);
		}
	}
}
