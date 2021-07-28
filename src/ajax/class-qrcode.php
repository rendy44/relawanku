<?php
/**
 * QRCode creation ajax class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Ajax;

use Relawanku\Abstracts\Ajax;
use Relawanku\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Ajax\QRCode' ) ) {

	/**
	 * Class QRCode
	 *
	 * @package Relawanku\Ajax
	 */
	final class QRCode extends Ajax {

		/**
		 * Abstract method
		 *
		 * @return mixed
		 */
		protected function handle() {
			$volunteer_id = $this->get( 'volunteer' );
			// Generate qrcode.
			$qrcode = new \Relawanku\QRCode();
			$qrcode->add_data( $volunteer_id );
			$qrcode->stream_qrcode();

			// Validate qrcode.
			if ( $qrcode->is_success() ) {
				$qrcode_url = $qrcode->get_data();

				// Save qrcode to custom meta.
				Helper::init()->add_post_meta( $volunteer_id, 'qrcode', $qrcode_url );

				// Update result.
				$this->set_status( true );

				return "<img src='{$qrcode_url}' class='attachment-post-thumbnail size-post-thumbnail' alt='' style='max-width: 100%'><br/><a href='{$qrcode_url}' target='_blank'>" . esc_html__( 'Download', 'relawanku' ) . '</a>';
			} else {
				return $qrcode->get_messages();
			}
		}

		/**
		 * QRCode constructor.
		 */
		protected function __construct() {
			parent::__construct( 'qrcode' );
		}
	}
}
