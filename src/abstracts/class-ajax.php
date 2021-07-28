<?php
/**
 * Abstract class for ajax custom endpoint.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Abstracts;

use Relawanku\Traits\Result;
use Relawanku\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Abstracts\Ajax' ) ) {

	/**
	 * Class Ajax
	 *
	 * @package Relawanku\Abstracts
	 */
	abstract class Ajax {
		use Singleton;
		use Result;

		/**
		 * Variable to control whether the endpoint is public.
		 *
		 * @var bool
		 */
		protected $no_privilege = false;

		/**
		 * Ajax endpoint variable.
		 *
		 * @var string
		 */
		private $endpoint;

		/**
		 * Ajax constructor.
		 *
		 * @param string $endpoint new ajax endpoint.
		 */
		protected function __construct( $endpoint ) {
			$this->endpoint = $endpoint;

			// Register new ajax endpoint.
			add_action(
				'wp_ajax_' . RELAWANKU__PREFIX . "{$this->endpoint}",
				function () {
					wp_send_json( $this->result() );
				}
			);

			// Maybe register the non-privilege endpoint.
			if ( $this->no_privilege ) {
				add_action(
					'wp_ajax_nopriv_' . RELAWANKU__PREFIX . "{$this->endpoint}",
					function () {
						wp_send_json( $this->result() );
					}
				);
			}
		}

		/**
		 * Abstract method
		 *
		 * @return mixed
		 */
		abstract protected function handle();

		/**
		 * Method to formatting ajax result.
		 *
		 * @return array
		 */
		private function result() {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				$this->set_data( $this->handle() );
			} else {
				$this->set_status( false );
				$this->add_message( esc_html__( 'Ajax validation is failed', 'relawanku' ) );
			}

			return $this->get_result();
		}

		/**
		 * Get posted obj.
		 *
		 * @param string $key specific key for submitted object.
		 *
		 * @return array|false|mixed
		 */
		protected function post( $key = '' ) {

			// Maybe filter by key.
			if ( $key ) {
				return isset( $_POST[ $key ] ) ? $_POST[ $key ] : false; // phpcs:ignore.WordPress.Security
			}

			return $_POST; // phpcs:ignore.WordPress.Security.NonceVerification
		}

		/**
		 * Get posted obj.
		 *
		 * @param string $key specific key for submitted object.
		 *
		 * @return array|false|mixed
		 */
		protected function get( $key = '' ) {

			// Maybe filter by key.
			if ( $key ) {
				return isset( $_REQUEST[ $key ] ) ? $_REQUEST[ $key ] : false; // phpcs:ignore.WordPress.Security
			}

			return $_REQUEST; // phpcs:ignore.WordPress.Security.NonceVerification
		}
	}
}
