<?php
/**
 * Mission's basic information metabox configuration.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Metaboxes\Mission;

use Relawanku\Abstracts\Metabox;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Metaboxes\Mission\Basic' ) ) {

	/**
	 * Class Basic
	 *
	 * @package Relawanku\Metaboxes\Mission
	 */
	final class Basic extends Metabox {

		/**
		 * Basic constructor.
		 */
		protected function __construct() {
			parent::__construct( 'basic', __( 'Basic Information', 'relawanku' ), array( 'mission' ) );

			$this
				->add_field(
					array(
						'type'       => 'date',
						'name'       => esc_html__( 'Date start', 'relawanku' ),
						'id'         => 'date_start',
						'timestamp'  => true,
						'js_options' => array(
							'defaultDate' => '0',
						),
					)
				)
				->add_field(
					array(
						'type'       => 'date',
						'name'       => esc_html__( 'Date end', 'relawanku' ),
						'id'         => 'date_end',
						'timestamp'  => true,
						'desc'       => esc_html__( 'Leave empty if the mission only takes a single day', 'relawanku' ),
						'js_options' => array(
							'defaultDate' => '0',
						),
					)
				)
				->add_field(
					array(
						'type' => 'text',
						'name' => esc_html__( 'Location', 'relawanku' ),
						'id'   => 'location',
						'desc' => esc_html__( 'Where the event is held', 'relawanku' ),
					)
				)
				->add_field(
					array(
						'type'        => 'post',
						'name'        => esc_html__( 'Volunteer', 'online-generator' ),
						'id'          => 'volunteer',
						'post_type'   => 'volunteer',
						'field_type'  => 'select_advanced',
						'multiple'    => true,
						'desc'        => esc_html__( 'Select multiple volunteers who is participating in this mission', 'relawanku' ),
						'placeholder' => esc_html__( 'Select volunteer', 'relawanku' ),
					)
				);
		}
	}
}
