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
use Exception;
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
		 * Functions list that will be added as directive.
		 *
		 * @var array
		 */
		private $directives;

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
			$this->blade = new BladeOne(
				$views,
				$cache,
				BladeOne::MODE_DEBUG
			); // MODE_DEBUG allows to pinpoint troubles.

			// Register the directives.
			$this->register_directive();
		}

		/**
		 * Map directives.
		 */
		private function map_directives() {
			$this->directives = array(
				'wp_head',
				'wp_footer',
				'language_attributes',
				'bloginfo',
				'body_class',
				'wp_body_open',
				'do_action',
				'wp_nav_menu',
				'dynamic_sidebar',
				'get_header',
				'get_footer',
				'get_template_part',
				'the_post',
				'post_class',
				'the_content',
				'the_archive_title',
				'the_archive_description',
				'the_permalink',
				'comments_template',
				'the_excerpt',
				'edit_post_link',
				'the_title',
				'the_content',
				'get_the_title',
				'get_the_content',
				'the_post_thumbnail',
				'get_the_post_thumbnail',
			);
		}

		/**
		 * Register the directives.
		 */
		private function register_directive() {
			// Map the directives.
			$this->map_directives();

			// Loop all directives.
			foreach ( $this->directives as $fnc ) {
				$this->blade->directiveRT( $fnc, $fnc );
			}
		}

		/**
		 * Render the template.
		 *
		 * @param string $template_name name of the template file.
		 * @param array  $vars variable collections that will be injected into blade.
		 * @param bool   $echo whether echo the output.
		 *
		 * @return string
		 */
		public function render( $template_name, $vars = array(), $echo = true ) {
			try {
				$output = $this->blade->run( $template_name, $vars );
			} catch ( Exception $e ) {
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
