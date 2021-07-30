<?php
/**
 * Volunteer's qrcode metabox.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Metaboxes\Volunteer;

use Relawanku\Abstracts\Metabox;
use Relawanku\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Metaboxes\Volunteer\QRCode' ) ) {

	/**
	 * Class QRCode
	 *
	 * @package Relawanku\Metaboxes\Volunteer
	 */
	final class QRCode extends Metabox {

		/**
		 * Override metabox position.
		 *
		 * @var string
		 */
		protected $position = 'side';

		/**
		 * QRCode constructor.
		 */
		protected function __construct() {
			parent::__construct( 'qrcode', esc_html__( 'QRCode', 'relawanku' ), array( 'volunteer' ) );

			$this->add_field(
				array(
					'type'     => 'custom_html',
					'id'       => 'layout',
					'callback' => function () {
						global $post_id;
						if ( $post_id ) {
							$qrcode = Helper::init()->get_post_meta( $post_id, 'qrcode_url' );

							// Validate qrcode.
							if ( $qrcode ) {
								return "<div style='text-align: center'><img src='{$qrcode}' class='attachment-post-thumbnail size-post-thumbnail' alt='' style='max-width: 100%'><br/><a href='{$qrcode}' target='_blank'>" . esc_html__( 'Download', 'relawanku' ) . '</a></div>';
							} else {
								return "<div style='text-align: center'><button type='button' class='button' id='gen-qrcode'>" . esc_html__( 'Click to generate', 'relawanku' ) . '</button></div>';
							}
						} else {
							return false;
						}
					},
				)
			);
		}
	}
}
