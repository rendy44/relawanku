<?php
/**
 * Trait for standard result class.
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

namespace Relawanku\Traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trait_exists( 'Relawanku\Traits\Result' ) ) {

	/**
	 * Trait Result
	 *
	 * @package Relawanku\Traits
	 */
	trait Result {

		/**
		 * Success status variable.
		 *
		 * @var bool
		 */
		private $success = false;

		/**
		 * List of messages variable.
		 *
		 * @var array
		 */
		private $messages = array();

		/**
		 * List of data variable.
		 *
		 * @var array|string|int|float
		 */
		private $data;

		/**
		 * List of additional data.
		 *
		 * @var array
		 */
		private $additional_data = array();

		/**
		 * Method to set result's success status.
		 *
		 * @param bool $success whether the status is success.
		 */
		protected function set_status( $success = true ) {
			$this->success = $success;
		}

		/**
		 * Method to add a message to result's messages.
		 *
		 * @param string $message content of the message.
		 */
		protected function add_message( $message ) {
			$this->messages[] = $message;
		}

		/**
		 * Method to clean result's messages.
		 */
		protected function reset_messages() {
			$this->messages = array();
		}

		/**
		 * Method to set result's data.
		 *
		 * @param string|array|int|float $data any data that need to be saved.
		 */
		protected function set_data( $data ) {
			$this->data = $data;
		}

		/**
		 * Whether the result is success.
		 *
		 * @return bool
		 */
		public function is_success() {
			return $this->success;
		}

		/**
		 * Get data.
		 *
		 * @return array|float|int|string
		 */
		public function get_data() {
			return $this->data;
		}

		/**
		 * Get error messages.
		 *
		 * @return array
		 */
		public function get_messages() {
			return $this->messages;
		}

		/**
		 * Get result.
		 *
		 * @return array
		 */
		public function get_result() {
			return array_merge(
				$this->additional_data,
				array(
					'success'  => $this->is_success(),
					'data'     => $this->get_data(),
					'messages' => $this->get_messages(),
				)
			);
		}


		/**
		 * Method to add attribute to the result.
		 *
		 * @param string $key name of the attribute.
		 * @param mixed  $value value of the attribute.
		 *
		 * @return void
		 */
		public function add_attribute( $key, $value ) {
			$this->additional_data[ $key ] = $value;
		}
	}
}
