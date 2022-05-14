<?php
/**
 * Helper class
 * This class contains useful functions that normally will be used in several times.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku;

use Relawanku\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Helper' ) ) {

	/**
	 * Class Helper
	 *
	 * @package Relawanku
	 */
	final class Helper {
		use Singleton;

		/**
		 * Get post meta.
		 *
		 * @param int    $post_id id of the post.
		 * @param string $key key of the post meta.
		 * @param bool   $single whether value is single.
		 *
		 * @return mixed
		 */
		public function get_post_meta( $post_id, $key, $single = true ) {
			return get_post_meta( $post_id, RELAWANKU__PREFIX . $key, $single );
		}

		/**
		 * Save post meta.
		 *
		 * @param int    $post_id id of the post.
		 * @param string $key key of the post meta.
		 * @param mixed  $value value of the post meta.
		 * @param bool   $unique whether the meta is unique.
		 *
		 * @return false|int
		 */
		public function add_post_meta( $post_id, $key, $value, $unique = true ) {
			return add_post_meta( $post_id, RELAWANKU__PREFIX . $key, $value, $unique );
		}

		/**
		 * Convert timestamp to date string.
		 *
		 * @param string $timestamp date timestamp that will be formatted.
		 * @param string $format date format, default use current setting.
		 *
		 * @return string
		 */
		public function timestamp_to_date( $timestamp, $format = '' ) {

			// Make sure timestamp is provided.
			if ( ! $timestamp ) {
				return '';
			}
			// Maybe use WordPress current time format setting.
			if ( ! $format ) {
				$format = get_option( 'date_format' );
			}

			return date_i18n( $format, $timestamp );
		}

		/**
		 * Get available divisions.
		 *
		 * @return array
		 */
		public function get_divisions() {
			return array(
				'brd' => esc_html_x( 'Board', 'division', 'relawanku' ),
				'amb' => esc_html_x( 'Ambulance', 'division', 'relawanku' ),
				'vfk' => esc_html_x( 'Verificator', 'division', 'relawanku' ),
				'adv' => esc_html_x( 'Advance', 'division', 'relawanku' ),
				'urc' => esc_html_x( 'URC', 'division', 'relawanku' ),
				'vol' => esc_html_x( 'Volunteer', 'division', 'relawanku' ),
			);
		}

		/**
		 * Translate division key into readable name.
		 *
		 * @param string      $key key of the division.
		 * @param bool|string $default default value.
		 *
		 * @return string|bool
		 */
		public function translate_division( $key, $default = false ) {
			$divisions = $this->get_divisions();

			return ! empty( $divisions[ $key ] ) ? $divisions[ $key ] : $default;
		}

		/**
		 * Get available genders.
		 *
		 * @return array
		 */
		public function get_genders() {
			return array(
				'male'   => esc_html__( 'Male', 'relawanku' ),
				'female' => esc_html__( 'Female', 'relawanku' ),
			);
		}

		/**
		 * Translate gender into readable name.
		 *
		 * @param string $key key of the gender.
		 *
		 * @return string|bool
		 */
		public function translate_gender( $key ) {
			$genders = $this->get_genders();

			return ! empty( $genders[ $key ] ) ? $genders[ $key ] : false;
		}

		/**
		 * Get available marital status.
		 *
		 * @return array
		 */
		public function get_status() {
			return array(
				'single'  => esc_html__( 'Single', 'relawanku' ),
				'married' => esc_html__( 'Married', 'relawanku' ),
				'widowed' => esc_html__( 'Widowed', 'relawanku' ),
			);
		}

		/**
		 * Translate status into readable name.
		 *
		 * @param string      $key key of the status.
		 * @param bool|string $default default value.
		 *
		 * @return string|bool
		 */
		public function translate_status( $key, $default = false ) {
			$status = $this->get_status();

			return ! empty( $status[ $key ] ) ? $status[ $key ] : $default;
		}

		/**
		 * Get available blood types.
		 *
		 * @return array
		 */
		public function get_blood_types() {
			return array(
				'a'  => esc_html_x( 'A', 'blood', 'relawanku' ),
				'b'  => esc_html_x( 'B', 'blood', 'relawanku' ),
				'ab' => esc_html_x( 'AB', 'blood', 'relawanku' ),
				'o'  => esc_html_x( 'O', 'blood', 'relawanku' ),
			);
		}

		/**
		 * Translate blood type into readable name.
		 *
		 * @param string      $key key of the status.
		 * @param bool|string $default default value.
		 *
		 * @return string|bool
		 */
		public function translate_blood_type( $key, $default = false ) {
			$blood_types = $this->get_blood_types();

			return ! empty( $blood_types[ $key ] ) ? $blood_types[ $key ] : $default;
		}

		/**
		 * Get available positions.
		 *
		 * @return array
		 */
		public function get_positions() {
			return array(
				'dir' => esc_html_x( 'Director', 'position', 'relawanku' ),
				'trs' => esc_html_x( 'Treasurer', 'position', 'relawanku' ),
				'sec' => esc_html_x( 'Secretary', 'position', 'relawanku' ),
				'act' => esc_html_x( 'Accountant', 'position', 'relawanku' ),
				'chf' => esc_html_x( 'Chief', 'position', 'relawanku' ),
				'mmb' => esc_html_x( 'Member', 'position', 'relawanku' ),
				'adm' => esc_html_x( 'Administrator', 'position', 'relawanku' ),
			);
		}

		/**
		 * Translate position into readable name.
		 *
		 * @param string      $key key of the position.
		 * @param bool|string $default default value.
		 *
		 * @return string|bool
		 */
		public function translate_position( $key, $default = false ) {
			$positions = $this->get_positions();

			return ! empty( $positions[ $key ] ) ? $positions[ $key ] : $default;
		}

		/**
		 * Method to get volunteer's skills.
		 *
		 * @param int         $id id of the volunteer.
		 * @param bool        $return_as_array whether return as array or string.
		 * @param bool|string $default default value.
		 *
		 * @return array|string
		 */
		public function get_volunteer_skills( $id, $return_as_array = true, $default = false ) {
			$skills    = get_the_terms( $id, 'skill' );
			$skills_tr = array_map(
				function ( $skill ) {
					return $skill->name;
				},
				$skills
			);
			if ( ! $return_as_array ) {
				return $skills_tr ? implode( ', ', $skills_tr ) : $default;
			}

			return $skills_tr;
		}
	}
}
