<?php
/**
 * This file contains the recommended plugin lists to this theme
 */

add_action( 'tgmpa_register', 'himalayas_register_required_plugins' );

/**
 * Register the recommended plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function himalayas_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(

		// Include ThemeGrill Demo Importer as recommended
		array(
			'name'     => 'ThemeGrill Demo Importer',
			'slug'     => 'themegrill-demo-importer',
			'required' => false,
		),

		// Include Everest Forms as recommended
		array(
			'name'     => 'Everest Forms – Easy Contact Form and Form Builder',
			'slug'     => 'everest-forms',
			'required' => false,
		),

	);

	$config = array(
		'id'           => 'himalayas',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.

		'strings' => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'himalayas' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'himalayas' ),
			/* translators: %s: plugin name. */
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'himalayas' ),
			/* translators: %s: plugin name. */
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'himalayas' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'himalayas' ),
			'notice_can_install_required'     => _n_noop(
			/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'himalayas'
			),
			'notice_can_install_recommended'  => _n_noop(
			/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'himalayas'
			),
			'notice_ask_to_update'            => _n_noop(
			/* translators: 1: plugin name(s). */
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'himalayas'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
			/* translators: 1: plugin name(s). */
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'himalayas'
			),
			'notice_can_activate_required'    => _n_noop(
			/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'himalayas'
			),
			'notice_can_activate_recommended' => _n_noop(
			/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'himalayas'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'himalayas'
			),
			'update_link'                     => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'himalayas'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'himalayas'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'himalayas' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'himalayas' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'himalayas' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'himalayas' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'himalayas' ),
			/* translators: 1: dashboard link. */
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'himalayas' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'himalayas' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'himalayas' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'himalayas' ),

			'nag_type' => '',
			// Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa( $plugins, $config );
}
