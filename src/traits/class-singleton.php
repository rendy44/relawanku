<?php
/**
 * Trait for singleton.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trait_exists( 'Relawanku\Traits\Singleton' ) ) {

	/**
	 * Trait Singleton
	 *
	 * @package Relawanku\Traits
	 */
	trait Singleton {

		/**
		 * Collection of instance class.
		 *
		 * @var array
		 */
		protected static $instance = array();

		/**
		 * Singleton constructor.
		 */
		protected function __construct() {
			// Just prevent for direct constructor.
		}

		/**
		 * Singleton clone.
		 */
		final protected function __clone() {
			// Prevent for cloning the class directly.
		}

		/**
		 * Initiator method.
		 *
		 * @return self
		 */
		public static function init() {
			// Get name of the class where the method being called.
			$called_class = get_called_class();

			if ( ! isset( static::$instance[ $called_class ] ) ) {
				static::$instance[ $called_class ] = new $called_class();
			}

			return static::$instance[ $called_class ];
		}
	}
}
