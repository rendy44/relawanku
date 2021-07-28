<?php
/**
 * Class to manage assets.
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

if ( ! class_exists( 'Relawanku\Assets' ) ) {

	/**
	 * Class Assets
	 *
	 * @package Relawanku
	 */
	final class Assets {
		use Singleton;

		/**
		 * Front-end css variable.
		 *
		 * @var array
		 */
		private $front_css;

		/**
		 * Assets constructor.
		 */
		protected function __construct() {
//			$this->map_assets();
			$this->metabox_assets();
//			$this->front_end_assets();
		}

		/**
		 * Map front-end's assets.
		 */
		private function map_assets() {
			$this->front_css = array( 'admin' );
		}

		/**
		 * Enqueue front-end's assets.
		 */
		private function front_end_assets() {
			add_action( 'wp_enqueue_scripts', function () {

				// Front-end's css.
				foreach ( $this->front_css as $css ) {
					wp_enqueue_style( $css, RELAWANKU__PLUGIN_URL . "assets/css/{$css}.css", array(), RELAWANKU__VERSION );
				}
			} );
		}

		/**
		 * Load assets for metabox editor.
		 */
		private function metabox_assets() {
			add_action(
				'rwmb_enqueue_scripts',
				function () {
					wp_enqueue_script( 'metabox', RELAWANKU__PLUGIN_URL . 'assets/js/metabox.js', array( 'jquery' ), RELAWANKU__VERSION, true );
					wp_localize_script( 'metabox', 'rlw', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

					wp_enqueue_style( 'metabox', RELAWANKU__PLUGIN_URL . 'assets/css/admin/metabox.css', array(), RELAWANKU__VERSION );
				}
			);
		}
	}
}
