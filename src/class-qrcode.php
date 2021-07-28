<?php
/**
 * QRCode generator class.
 * We'll use google api to easily generate the qrcode.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 * @see https://developers.google.com/chart/infographics/docs/qr_codes?csw=1
 */

namespace Relawanku;

use Relawanku\Traits\Result;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\QRCode' ) ) {

	/**
	 * Class QRCode
	 *
	 * @package Relawanku
	 */
	final class QRCode {
		use Result;

		/**
		 * Variable to store qrcode data.
		 *
		 * @var string|int
		 */
		private $data;

		/**
		 * API root variable.
		 *
		 * @var string
		 */
		private $api_root = 'https://chart.googleapis.com/chart?';

		/**
		 * QRCode configuration variable.
		 *
		 * @var array
		 */
		private $args = array();

		/**
		 * Request body variable.
		 *
		 * @var string
		 */
		private $request_body;

		/**
		 * Method to execute api.
		 */
		private function call_api() {
			require_once ABSPATH . 'wp-load.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';

			// Get final api url.
			$api_url = $this->get_api_url();

			// Download file to temp dir.
			$temp_file = download_url( $api_url );

			// Validate the download.
			if ( ! is_wp_error( $temp_file ) ) {
				$file_arr = array(
					'name'     => wp_generate_password( 12, false ) . '.png',
					'tmp_name' => $temp_file,
				);

				// Move the temporary file into the uploads directory.
				$upload = wp_handle_sideload(
					$file_arr,
					array(
						'test_form'   => false,
						'test_size'   => true,
						'test_upload' => true,
					)
				);

				// Validate the upload.
				if ( empty( $upload['error'] ) ) {

					// Update result.
					$this->set_status();
					$this->set_data( $upload['url'] );
				} else {
					$this->add_message( $upload['error'] );
				}
			} else {
				$this->add_message( $temp_file->get_error_message() );
			}
		}

		/**
		 * Method to get api url.
		 *
		 * @return string
		 */
		private function get_api_url() {
			$args     = $this->args;
			$api_data = array(
				'cht'  => 'qr',
				'chs'  => "{$args['width']}x{$args['height']}",
				'chl'  => $this->data,
				'chld' => "{$args['correction']}|{$args['margin']}",
			);

			return $this->api_root . http_build_query( $api_data );
		}

		/**
		 * Method to save data that will be encoded into qrcode.
		 *
		 * @param string|int $data data that will be encoded.
		 */
		public function add_data( $data ) {
			$this->data = $data;
		}

		/**
		 * Update qrcode configuration.
		 *
		 * @param array $args qrcode configuration.
		 */
		public function configure( $args = array() ) {
			$default_args = array(
				'width'      => 300,
				'height'     => 300,
				'margin'     => '1',
				'correction' => 'L', // with possible value L|M|Q|H.
			);
			$this->args   = wp_parse_args( $args, $default_args );
		}

		/**
		 * Method to generate qrcode.
		 *
		 * @return $this
		 */
		public function stream_qrcode() {
			$this->configure();
			$this->call_api();

			return $this;
		}
	}
}
