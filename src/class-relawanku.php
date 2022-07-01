<?php
/**
 * Main class to trigger all dependency classes.
 *
 * @author Rendy
 * @package relawanku
 * @version 0.1.0
 */

namespace Relawanku;

use Relawanku\Ajax\Languages;
use Relawanku\Ajax\Skills;
use Relawanku\Ajax\Volunteers;
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
use Relawanku\Types\Volunteer as T_Volunteer;
use Relawanku\Tables\Volunteer as Tbl_Volunteer;
use Relawanku\Tables\Mission as Tbl_Mission;
use RWMB_Loader;

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

			// Register theme supports.
			$this->reg_supports();

			// Load assets.
			$this->load_assets();

			// Load libraries.
			$this->load_libraries();

			// Register custom post types.
			$this->reg_post_types();

			// Register custom admin columns.
			$this->reg_post_tables();

			// Register custom metaboxes.
			$this->reg_metaboxes();

			// Register custom taxonomies.
			$this->reg_taxonomies();

			// Register custom ajax endpoints.
			$this->reg_ajax();

			// Register custom hooks.
			$this->reg_hooks();

			// Load text domain.
			$this->load_text_domain();
		}

		/**
		 * Method to register custom supports.
		 */
		private function reg_supports() {
			add_action(
				'after_setup_theme',
				function () {
					add_theme_support( 'title-tag' );
					add_theme_support( 'menus' );
				}
			);
		}

		/**
		 * Method to instance assets.
		 */
		private function load_assets() {
			Assets::init();
		}

		/**
		 * Method to load 3rd party libraries.
		 */
		private function load_libraries() {

			// Load metabox.
			require_once RELAWANKU__PATH . '/src/libs/meta-box/inc/loader.php';
			$metabox = new RWMB_Loader();
			$metabox->init();
		}

		/**
		 * Method to instance post types.
		 */
		private function reg_post_types() {
			T_Volunteer::init();
			Mission::init();
		}

		/**
		 * Method to register custom admin columns.
		 *
		 * @return void
		 */
		private function reg_post_tables() {
			Tbl_Volunteer::init();
			Tbl_Mission::init();
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
			Volunteers::init();
			Languages::init();
			Skills::init();
		}

		/**
		 * Method for registering custom hooks.
		 *
		 * @return void
		 */
		private function reg_hooks() {
			add_filter(
				'views_edit-volunteer',
				function ( $screens ) {
					$screens['export'] = '<a href="#" id="exp-volunteer">' . __( 'Export', 'relawanku' ) . '</a>';

					return $screens;
				}
			);
		}

		/**
		 * Method to load plugin's text domain.
		 */
		private function load_text_domain() {
		}
	}
}
