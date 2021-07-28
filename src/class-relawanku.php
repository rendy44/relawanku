<?php
/**
 * Main class to trigger all dependency classes.
 *
 * @author Rendy
 * @package relawanku
 * @version 0.1.0
 */

namespace Relawanku;

use Relawanku\Metaboxes\Mission\Basic;
use Relawanku\Metaboxes\Volunteer\Community;
use Relawanku\Metaboxes\Volunteer\Contact;
use Relawanku\Metaboxes\Volunteer\Missions;
use Relawanku\Metaboxes\Volunteer\Personal;
use Relawanku\Metaboxes\Volunteer\QRCode;
use Relawanku\Taxonomies\Cluster;
use Relawanku\Taxonomies\Skill;
use Relawanku\Traits\Singleton;
use Relawanku\Types\Mission;
use Relawanku\Types\Volunteer;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Relawanku' ) ) {

	/**
	 * Class Relawanku
	 *
	 * @package Relawanku
	 */
	final class Relawanku {
		use Singleton;

		/**
		 * Relawanku constructor.
		 */
		protected function __construct() {

			// Load assets.
			$this->load_assets();

			// Register custom post types.
			$this->reg_post_types();

			// Register custom metaboxes.
			$this->reg_metaboxes();

			// Register custom taxonomies.
			$this->reg_taxonomies();

			// Register custom ajax endpoints.
			$this->reg_ajax();

			// Load text domain.
			$this->load_text_domain();
		}

		/**
		 * Method to instance assets.
		 */
		private function load_assets() {
			Assets::init();
		}

		/**
		 * Method to instance post types.
		 */
		private function reg_post_types() {
			Volunteer::init();
			Mission::init();
		}

		/**
		 * Method to instance metaboxes.
		 */
		private function reg_metaboxes() {

			// Volunteer's metaboxes.
			Personal::init();
			Community::init();
			Contact::init();
			QRCode::init();
			Missions::init();

			// Mission's metaboxes.
			Basic::init();
		}

		/**
		 * Method to instance taxonomies.
		 */
		private function reg_taxonomies() {
			Cluster::init();
			Skill::init();
		}

		/**
		 * Method to instance ajax endpoints.
		 */
		private function reg_ajax() {
			Ajax\QRCode::init();
		}

		/**
		 * Method to load plugin's text domain.
		 */
		private function load_text_domain() {
			add_action(
				'plugins_loaded',
				function () {
					load_plugin_textdomain( 'relawanku', false, RELAWANKU__PLUGIN_PATH . 'lang' );
				}
			);
		}
	}
}
