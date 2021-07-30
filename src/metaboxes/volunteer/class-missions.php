<?php
/**
 * Volunteer's missions information metabox configuration.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Metaboxes\Volunteer;

use Relawanku\Abstracts\Metabox;
use Relawanku\Template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Metaboxes\Volunteer\Missions' ) ) {

	/**
	 * Class Missions
	 *
	 * @package Relawanku\Metaboxes\Volunteer
	 */
	final class Missions extends Metabox {

		/**
		 * Missions constructor.
		 */
		protected function __construct() {
			parent::__construct( 'missions', __( 'Missions Information', 'relawanku' ), array( 'volunteer' ) );

			$this->add_field(
				array(
					'type'     => 'custom_html',
					'id'       => 'chart',
					'callback' => function () {
						global $post_id;
						if ( $post_id ) {
							$query_missions = new \WP_Query();
							$missions       = $query_missions->query(
								array(
									'post_type'      => 'mission',
									'posts_per_page' => - 1,
									'orderby'        => 'date',
									'order'          => 'desc',
									'post_status'    => 'publish',
									'meta_query'     => array(
										array(
											'key'   => 'rlw_volunteer',
											'value' => $post_id,
										),
									),
								)
							);

							if ( $query_missions->post_count > 0 ) {
								return Template::init()->render( 'missions', compact( 'missions' ) );
							} else {
								return esc_html__( 'The volunteer has not joined any missions yet', 'relawanku' );
							}
						} else {
							return __( 'Missions information will be displayed here once the volunteer data is saved', 'relawanku' );
						}
					},
				)
			);
		}
	}
}
