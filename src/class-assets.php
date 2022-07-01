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
		 * Front-end js variable.
		 *
		 * @var array
		 */
		private $front_js;

		/**
		 * Admin js variable.
		 *
		 * @var array
		 */
		private $admin_js;

		/**
		 * Assets constructor.
		 */
		protected function __construct() {
			$this->metabox_assets();
			$this->map_assets();
			$this->front_end_assets();
			$this->admin_assets();
			$this->register_page_assets();
		}

		/**
		 * Map front-end's assets.
		 */
		private function map_assets() {
			$this->front_css = array(
				'app' => 'app.css',
			);

			$this->front_js = array(
				'app' => 'app.min.js',
			);

			$this->admin_js = array(
				'admin' => 'admin.min.js',
			);
		}

		/**
		 * Enqueue front-end's assets.
		 */
		private function front_end_assets() {
			add_action(
				'wp_enqueue_scripts',
				function () {

					// Front-end's css.
					foreach ( $this->front_css as $css_key => $css_url ) {
						wp_enqueue_style( $css_key, RELAWANKU__URL . '/assets/css/' . $css_url, array(), RELAWANKU__VERSION );
					}

					// Front-end's js.
					foreach ( $this->front_js as $js_key => $js_url ) {
						wp_enqueue_script( $js_key, RELAWANKU__URL . '/assets/js/' . $js_url, array( 'jquery' ), RELAWANKU__VERSION, true );
					}
				}
			);
		}

		/**
		 * Enqueue admin's assets.
		 *
		 * @return void
		 */
		private function admin_assets() {
			add_action(
				'admin_enqueue_scripts',
				function () {

					// Admin js.
					foreach ( $this->admin_js as $js_key => $js_url ) {
						wp_enqueue_script(
							$js_key,
							RELAWANKU__URL . '/assets/js/' . $js_url,
							array(
								'jquery',
								'wp-util',
							),
							RELAWANKU__VERSION,
							true
						);
					}

					wp_localize_script(
						'admin',
						'rlw',
						array(
							'ajax_url' => admin_url( 'admin-ajax.php' ),
							'prefix'   => RELAWANKU__PREFIX,
						)
					);
				}
			);
		}

		/**
		 * Enqueue assets for register page.
		 *
		 * @return void
		 */
		private function register_page_assets() {
			add_action(
				'rlw_register_page',
				function () {
					add_action(
						'wp_enqueue_scripts',
						function () {
							wp_enqueue_script(
								'register_page',
								RELAWANKU__URL . '/assets/js/reactRegister.min.js',
								array(
									'jquery',
									'wp-util',
									'wp-element',
								),
								RELAWANKU__VERSION,
								true
							);
							wp_localize_script( 'register_page', 'rlw', array( 'prefix' => RELAWANKU__PREFIX ) );
						}
					);
				}
			);
		}

		/**
		 * Load assets for metabox editor.
		 */
		private function metabox_assets() {
			add_action(
				'rwmb_enqueue_scripts',
				function () {
					wp_enqueue_script(
						'metabox',
						RELAWANKU__URL . '/assets/js/metabox.min.js',
						array( 'jquery' ),
						RELAWANKU__VERSION,
						true
					);
					wp_localize_script( 'metabox', 'rlw', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

					wp_enqueue_style(
						'metabox',
						RELAWANKU__URL . '/assets/css/admin/metabox.css',
						array(),
						RELAWANKU__VERSION
					);
				}
			);
		}
	}
}
