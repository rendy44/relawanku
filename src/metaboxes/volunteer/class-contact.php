<?php
/**
 * Volunteer's contact information metabox configuration.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Metaboxes\Volunteer;

use Relawanku\Abstracts\Metabox;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Metaboxes\Volunteer\Contact' ) ) {

	/**
	 * Class Volunteer
	 *
	 * @package Relawanku\Metaboxes
	 */
	final class Contact extends Metabox {

		/**
		 * Volunteer constructor.
		 */
		protected function __construct() {
			parent::__construct( 'contact', __( 'Contact Information', 'relawanku' ), array( 'volunteer' ) );

			$this
				->add_field(
					array(
						'type' => 'text',
						'name' => esc_html__( 'Phone', 'relawanku' ),
						'id'   => 'phone',
					)
				)
				->add_field(
					array(
						'type' => 'text',
						'name' => esc_html__( 'Emergency contact', 'relawanku' ),
						'id'   => 'emergency_contact',
					)
				)
				->add_field(
					array(
						'type'        => 'select',
						'name'        => esc_html__( 'Emergency relation', 'relawanku' ),
						'id'          => 'emergency_relation',
						'placeholder' => esc_html__( 'Select relation type', 'relawanku' ),
						'options'     => array(
							'spouse'   => esc_html__( 'Spouse', 'relawanku' ),
							'parent'   => esc_html__( 'Parent', 'relawanku' ),
							'child'    => esc_html__( 'Child', 'relawanku' ),
							'relative' => esc_html__( 'Relative', 'relawanku' ),
							'other'    => esc_html__( 'Other', 'relawanku' ),
						),
					)
				);
		}
	}
}
