<?php
/**
 * Language words ajax class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Ajax;

use Relawanku\Abstracts\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Relawanku\Ajax\Languages' ) ) {

	/**
	 * Languages class.
	 */
	final class Languages extends Ajax {

		/**
		 * Abstract method
		 *
		 * @return array
		 */
		protected function handle() {
			$this->set_status();

			return array(
				'personal_title' => __( 'Personal Information', 'relawanku' ),
				'skills_title'   => __( 'Skills Information', 'relawanku' ),
				'name'           => __( 'Full name', 'relawanku' ),
				'gender'         => __( 'Gender', 'relawanku' ),
				'male'           => __( 'Male', 'relawanku' ),
				'female'         => __( 'Female', 'relawanku' ),
				'place_ob'       => __( 'Place of birth', 'relawanku' ),
				'date_ob'        => __( 'Date of birth', 'relawanku' ),
				'address'        => __( 'Current address', 'relawanku' ),
				'blood'          => __( 'Blood type', 'relawanku' ),
				'marital'        => __( 'Marital status', 'relawanku' ),
				'single'         => __( 'Single', 'relawanku' ),
				'married'        => __( 'Married', 'relawanku' ),
				'widowed'        => __( 'Widowed', 'relawanku' ),
				'citizenship'    => __( 'Citizenship', 'relawanku' ),
				'indonesian'     => __( 'Indonesian', 'relawanku' ),
				'foreigner'      => __( 'Foreigner', 'relawanku' ),
				'continue'       => __( 'Continue', 'relawanku' ),
				'back'           => __( 'Back', 'relawanku' ),
			);
		}

		/**
		 * Languages constructor
		 */
		protected function __construct() {
			parent::__construct( 'languages' );
		}
	}
}