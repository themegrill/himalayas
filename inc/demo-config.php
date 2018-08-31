<?php
/**
 * Functions for configuring demo importer.
 *
 * @package Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer config.
 *
 * @deprecated 1.5.0
 *
 * @param  array $demo_config Demo config.
 * @return array
 */
function himalayas_demo_importer_packages( $packages ) {
	$new_packages = array(
		'himalayas-free' => array(
			'name'    => esc_html__( 'Himalayas', 'himalayas' ),
			'preview' => 'https://demo.themegrill.com/himalayas/',
		),
		'himalayas-pro'  => array(
			'name'     => esc_html__( 'Himalayas Pro', 'himalayas' ),
			'preview'  => 'https://demo.themegrill.com/himalayas-pro/',
			'pro_link' => 'https://themegrill.com/themes/himalayas/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'himalayas_demo_importer_packages' );
