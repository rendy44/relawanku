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
		 * @param int $post_id id of the post.
		 * @param string $key key of the post meta.
		 * @param bool $single whether value is single.
		 *
		 * @return mixed
		 */
		public function get_post_meta( $post_id, $key, $single = true ) {
			return get_post_meta( $post_id, RELAWANKU__PREFIX . $key, $single );
		}

		/**
		 * Save post meta.
		 *
		 * @param int $post_id id of the post.
		 * @param string $key key of the post meta.
		 * @param mixed $value value of the post meta.
		 * @param bool $unique whether the meta is unique.
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
	}
}
