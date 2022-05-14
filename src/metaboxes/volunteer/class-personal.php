<?php
/**
 * Volunteer's personal information metabox configuration.
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

if ( ! class_exists( 'Relawanku\Metaboxes\Volunteer\Personal' ) ) {

	/**
	 * Class Volunteer
	 *
	 * @package Relawanku\Metaboxes
	 */
	final class Personal extends Metabox {

		/**
		 * Volunteer constructor.
		 */
		protected function __construct() {
			parent::__construct( 'personal', __( 'Personal Information', 'relawanku' ), array( 'volunteer' ) );

			$this
				->add_field(
					array(
						'type'    => 'select',
						'name'    => esc_html__( 'Gender', 'relawanku' ),
						'id'      => 'gender',
						'options' => $this->helpers->get_genders(),
						'std'     => 'male',
					)
				)
				->add_field(
					array(
						'type' => 'text',
						'name' => esc_html__( 'Place of birth', 'relawanku' ),
						'id'   => 'place_of_birth',
					)
				)
				->add_field(
					array(
						'type'       => 'date',
						'name'       => esc_html__( 'Date of birth', 'relawanku' ),
						'id'         => 'date_of_birth',
						'timestamp'  => true,
						'js_options' => array(
							'defaultDate' => '-20y',
						),
					)
				)
				->add_field(
					array(
						'type' => 'textarea',
						'name' => esc_html__( 'Current address', 'relawanku' ),
						'id'   => 'current_address',
						'rows' => 3,
					)
				)
				->add_field(
					array(
						'type'        => 'select',
						'name'        => esc_html__( 'Blood type', 'relawanku' ),
						'id'          => 'blood_type',
						'placeholder' => esc_html__( 'Select blood type', 'relawanku' ),
						'options'     => $this->helpers->get_blood_types(),
					)
				)
				->add_field(
					array(
						'type'    => 'select',
						'name'    => esc_html__( 'Marital status', 'relawanku' ),
						'id'      => 'marital_status',
						'options' => $this->helpers->get_status(),
						'std'     => 'single',
					)
				)
				->add_field(
					array(
						'type'    => 'select',
						'name'    => esc_html__( 'Citizenship', 'relawanku' ),
						'id'      => 'citizenship',
						'options' => array(
							'indonesian' => esc_html__( 'Indonesian', 'relawanku' ),
							'foreigner'  => esc_html__( 'Foreigner', 'relawanku' ),
						),
						'std'     => 'indonesian',
					)
				)
				->add_field(
					array(
						'type'       => 'taxonomy',
						'name'       => esc_html__( 'Skills', 'relawanku' ),
						'id'         => 'skill',
						'taxonomy'   => 'skill',
						'field_type' => 'select_advanced',
						'multiple'   => true,
					)
				);
		}
	}
}
