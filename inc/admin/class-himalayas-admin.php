<?php
/**
 * Himalayas Admin Class.
 *
 * @author  ThemeGrill
 * @package himalayas
 * @since   1.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Himalayas_Admin' ) ) :

	/**
	 * Himalayas_Admin Class.
	 */
	class Himalayas_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'himalayas-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), HIMALAYAS_THEME_VERSION );

			wp_enqueue_script( 'himalayas-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), HIMALAYAS_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&himalayas-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'himalayas' ),
			);

			// Only add nonce and ajaxurl if user has appropriate capabilities
			if ( current_user_can( 'manage_options' ) ) {
				$welcome_data['nonce']   = wp_create_nonce( 'himalayas_demo_import_nonce' );
				$welcome_data['ajaxurl'] = admin_url( 'admin-ajax.php' );
			}

			wp_localize_script( 'himalayas-plugin-install-helper', 'himalayasRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new Himalayas_Admin();
