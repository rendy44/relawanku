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
		public function get_post_meta( int $post_id, string $key, $single = true ) {
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
		public function add_post_meta( int $post_id, string $key, $value, $unique = true ) {
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
		public function timestamp_to_date( string $timestamp, $format = '' ) {

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
		 * Transate division key into readable name.
		 *
		 * @param string $key key of the division.
		 * @return string|bool
		 */
		public function translate_division( $key ) {
			$divisions = $this->get_divisions();

			return ! empty( $divisions[ $key ] ) ? $divisions[ $key ] : false;
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
		 * @param string $key key of the position.
		 * @return string|bool
		 */
		public function translate_position( $key ) {
			$positions = $this->get_positions();

			return ! empty( $positions[ $key ] ) ? $positions[ $key ] : false;
		}
	}
}
