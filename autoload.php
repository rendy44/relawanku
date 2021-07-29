<?php
/**
 * Handle class autoload
 *
 * @author Rendy
 * @package Relawanku
 * @version 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

spl_autoload_register(
	function ( $class ) {

		// Change path into array.
		$paths = explode( '\\', $class );

		// Make sure, the class belongs to Relawanku namespace.
		if ( 'Relawanku' === $paths[0] ) {

			// Remove parent namespace.
			array_shift( $paths );

			// Modify last array.
			$file_name_location           = count( $paths ) - 1;
			$paths[ $file_name_location ] = 'class-' . $paths[ $file_name_location ];

			// Build the path based on the found namespaces.
			$final_path = implode( '/', $paths );

			// Require the file.
			require_once RELAWANKU__PATH . '/src/' . strtolower( $final_path ) . '.php';
		}
	}
);
