<?php
/**
 * Volunteer's community information metabox configuration.
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

if ( ! class_exists( 'Relawanku\Metaboxes\Volunteer\Community' ) ) {

	/**
	 * Class Community
	 *
	 * @package Relawanku\Metaboxes\Volunteer
	 */
	final class Community extends Metabox {

		/**
		 * Community constructor.
		 */
		protected function __construct() {
			parent::__construct( 'community', __( 'Community Information', 'relawanku' ), array( 'volunteer' ) );

			$this
				->add_field(
					array(
						'type'        => 'text',
						'name'        => esc_html__( 'ID card number', 'relawanku' ),
						'id'          => 'id_card_number',
						'placeholder' => esc_html_x( 'YPM-Division-Position-Number', 'idcard_placholder', 'relawanku' ),
					)
				)
				->add_field(
					array(
						'type'        => 'select_advanced',
						'name'        => esc_html__( 'Division', 'relawanku' ),
						'id'          => 'division',
						'options'     => array(
							'brd' => esc_html_x( 'Board', 'division', 'relawanku' ),
							'amb' => esc_html_x( 'Ambulance', 'division', 'relawanku' ),
							'vfk' => esc_html_x( 'Verificator', 'division', 'relawanku' ),
							'adv' => esc_html_x( 'Advance', 'division', 'relawanku' ),
							'urc' => esc_html_x( 'URC', 'division', 'relawanku' ),
							'vol' => esc_html_x( 'Volunteer', 'division', 'relawanku' ),
						),
						'placeholder' => esc_html__( 'Select division', 'relawanku' ),
						'multiple'    => true,
					)
				)
				->add_field(
					array(
						'type'        => 'select',
						'name'        => esc_html__( 'Position', 'relawanku' ),
						'id'          => 'position',
						'options'     => array(
							'dir' => esc_html_x( 'Director', 'position', 'relawanku' ),
							'trs' => esc_html_x( 'Treasurer', 'position', 'relawanku' ),
							'sec' => esc_html_x( 'Secretary', 'position', 'relawanku' ),
							'act' => esc_html_x( 'Accountant', 'position', 'relawanku' ),
							'chf' => esc_html_x( 'Chief', 'position', 'relawanku' ),
							'mmb' => esc_html_x( 'Member', 'position', 'relawanku' ),
							'adm' => esc_html_x( 'Administrator', 'position', 'relawanku' ),
						),
						'placeholder' => esc_html_x( 'Select position', 'relawanku' ),
					)
				)
				->add_field(
					array(
						'type'       => 'date',
						'name'       => esc_html__( 'Valid from', 'relawanku' ),
						'id'         => 'valid_from',
						'timestamp'  => true,
						'js_options' => array(
							'defaultDate' => 0,
						),
					)
				)
				->add_field(
					array(
						'type'       => 'date',
						'name'       => esc_html__( 'Valid to', 'relawanku' ),
						'id'         => 'valid_to',
						'timestamp'  => true,
						'js_options' => array(
							'defaultDate' => '+1y',
						),
					)
				)
				->add_field(
					array(
						'type'        => 'select',
						'name'        => esc_html__( 'Availability', 'relawanku' ),
						'id'          => 'availability',
						'options'     => array(
							'hour'      => esc_html__( 'Within hours', 'relawanku' ),
							'day'       => esc_html__( 'Within days', 'relawanku' ),
							'week'      => esc_html__( 'Within weeks', 'relawanku' ),
							'month'     => esc_html__( 'Within months', 'relawanku' ),
							'year'      => esc_html__( 'Within years', 'relawanku' ),
							'unlimited' => esc_html__( 'No limitation', 'relawanku' ),
						),
						'placeholder' => esc_html__( 'Select time', 'relawanku' ),
						'desc'        => esc_html__( 'Maximum time of leaving family for emergency missions', 'relawanku' ),
					)
				)
				->add_field(
					array(
						'type' => 'number',
						'name' => esc_html__( 'Amount of availability', 'relawanku' ),
						'id'   => 'amount',
						'std'  => 1,
						'min'  => 1,
						'step' => 1,
					)
				)
				->add_field(
					array(
						'type' => 'checkbox',
						'name' => esc_html__( 'Readiness', 'relawanku' ),
						'id'   => 'readiness',
						'desc' => esc_html__( 'Ready for long-term emergency missions', 'relawanku' ),
					)
				);
		}
	}
}