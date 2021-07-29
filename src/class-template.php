<?php
/**
 * Simple helper class to render php file into output buffer
 *
 * @author  Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku;

use eftec\bladeone\BladeOne;
use Relawanku\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Template' ) ) {

	/**
	 * Class Template
	 *
	 * @package Relawanku
	 */
	final class Template {
		use Singleton;

		/**
		 * BladeOne instance variable.
		 *
		 * @var BladeOne
		 */
		private $blade;

		/**
		 * Template constructor.
		 */
		protected function __construct() {

			// Manually load the BladeOne lib.
			require_once RELAWANKU__PATH . '/src/libs/BladeOne/BladeOne.php';

			// Define cache and templates location.
			$views = RELAWANKU__PATH . '/templates';
			$cache = RELAWANKU__PATH . '/templates/caches';

			// Instance the blade.
			$this->blade = new BladeOne( $views, $cache, BladeOne::MODE_DEBUG ); // MODE_DEBUG allows to pinpoint troubles.
		}

		/**
		 * Render the template.
		 *
		 * @param string $template_name name of the template file.
		 * @param array  $vars variable collections that will be injected into blade.
		 * @param false  $echo whether echo the output.
		 *
		 * @return string
		 */
		public function render( string $template_name, $vars = array(), $echo = false ) {
			try {
				$output = $this->blade->run( $template_name, $vars );
			} catch ( \Exception $e ) {
				$output = $e->getMessage();
			}

			if ( $echo ) {
				echo $output; // phpcs:ignore.
			} else {
				return $output;
			}

			return false;
		}
	}
}
