<?php
/**
 * Cluster taxonomy class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Taxonomies;

use Relawanku\Abstracts\Taxonomy;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Taxonomies\Cluster' ) ) {

	/**
	 * Class Cluster
	 *
	 * @package Relawanku\Taxonomies
	 */
	final class Cluster extends Taxonomy {

		/**
		 * Define taxonomy slug.
		 *
		 * @var string
		 */
		protected $slug = 'cluster';

		/**
		 * Define where the taxonomy should be applied to.
		 *
		 * @var string
		 */
		protected $post_types = 'volunteer';

		/**
		 * Override taxonomy args.
		 *
		 * @return array
		 */
		protected function args() {
			return array(
				'public'             => true,
				'publicly_queryable' => false,
				'description'        => esc_html__( 'Cluster or region where the volunteer lives in', 'relawanku' ),
			);
		}
	}
}
