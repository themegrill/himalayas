<?php
/**
 * Functions for configuring demo importer.
 *
 * @author   ThemeGrill
 * @category Admin
 * @package  Importer/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup demo importer packages.
 *
 * @param  array $packages
 * @return array
 */
function himalayas_demo_importer_packages( $packages ) {
	$new_packages = array(
		'himalayas-free' => array(
			'name'    => esc_html__( 'Himalayas', 'himalayas' ),
			'preview' => 'https://demo.themegrill.com/himalayas/',
		),
	);

	return array_merge( $new_packages, $packages );
}
add_filter( 'themegrill_demo_importer_packages', 'himalayas_demo_importer_packages' );
