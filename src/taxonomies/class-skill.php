<?php
/**
 * Skill taxonomy class.
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

if ( ! class_exists( 'Relawanku\Taxonomies\Skill' ) ) {

	/**
	 * Class Skill
	 *
	 * @package Relawanku\Taxonomies
	 */
	final class Skill extends Taxonomy {

		/**
		 * Define taxonomy slug.
		 *
		 * @var string
		 */
		protected $slug = 'skill';

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
				'hierarchical'       => false,
				'public'             => true,
				'publicly_queryable' => false,
				'description'        => esc_html__( 'Skills and preferred tasks for the volunteer', 'relawanku' ),
				'show_ui'            => true,
				'show_in_quick_edit' => false,
				'meta_box_cb'        => false,
			);
		}
	}
}
