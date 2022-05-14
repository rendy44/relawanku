<?php
/**
 * Trait for collecting utilities class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Traits;

use Relawanku\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trait_exists( 'Relawanku\Traits\Utilities' ) ) {

	/**
	 * Utilities trait.
	 */
	trait Utilities {

		/**
		 * Helper class variable.
		 *
		 * @var Helper
		 */
		protected $helpers;

		/**
		 * Class constructor.
		 */
		private function __construct() {
			// Nothing here.
		}

		/**
		 * Method to instance helper.
		 *
		 * @return void
		 */
		protected function instance_helpers() {
			$this->helpers = Helper::init();
		}
	}
}
