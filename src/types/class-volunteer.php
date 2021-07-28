<?php
/**
 * Volunteer post type.
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

if ( ! class_exists( 'Relawanku\Types\Volunteer' ) ) {

	/**
	 * Class Volunteer
	 *
	 * @package Relawanku\Type
	 */
	final class Volunteer extends Type {

		/**
		 * Define the post type slug.
		 *
		 * @var string
		 */
		protected $slug = 'volunteer';

		/**
		 * Define custom title configuration.
		 *
		 * @var bool
		 */
		protected $custom_title = true;

		/**
		 * Override post type args.
		 *
		 * @return array
		 */
		protected function args() {
			return array(
				'labels'             => array(
					'add_new_item' => _x( 'Add New Volunteer', 'volunteer_admin', 'relawanku' ),
					'edit_item'    => _x( 'Edit Volunteer', 'volunteer_admin', 'relawanku' ),
				),
				'menu_icon'          => 'dashicons-nametag',
				'publicly_queryable' => false,
				'supports'           => array( 'title' ),
				'taxonomies'         => array( 'cluster', 'skill' ),
			);
		}
	}
}
