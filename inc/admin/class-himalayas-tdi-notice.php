<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Himalayas_TDI_Notice {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'admin_notices' ) );
		add_action( 'switch_theme', array( $this, 'remove_tdi_notice' ) );
	}

	public function admin_notices() {
		$plugin = 'themegrill-demo-importer/themegrill-demo-importer.php';

		if ( himalayas_plugin_version_compare( $plugin, '1.6.3' ) ) {

			add_action( 'admin_notices', array( $this, 'tdi_notice' ), 0 );
		}

		add_action( 'admin_init', array( $this, 'ignore_tdi_notice' ), 0 );
	}

	public function tdi_notice() {
		$user_id        = get_current_user_id();
		$ignored_notice = get_user_meta( $user_id, 'ignore_himalayas_tdi_notice', true );

		if ( $ignored_notice ) {
			return;
		}
		?>
		<div class="error updated tdi-notice" style="position:relative;">

			<?php
			$action_url = self_admin_url(
				'plugins.php'
			);

			$msg = sprintf(
				/* Translators: 1: Notice text 2: Plugin Name 3. CTA  */
				'<p style="max-width: 700px;">' . esc_html__( '%1$s: Please update "%2$s" plugin to latest version to make sure your site is all secure. We released a security patch in the latest version of this plugin. %3$s', 'himalayas' ) . '</p>',
				'<strong>' . esc_html__( 'Action Required', 'himalayas' ) . '</strong>',
				'<strong>' . esc_html__( 'ThemeGrill Demo Importer', 'himalayas' ) . '</strong>',
				sprintf(
					/* Translators: 1: CTA link 2: CTA text */
					'<a href="%1$s" class="">%2$s</a>',
					esc_url( $action_url ),
					esc_html__( 'Update Now', 'himalayas' )
				)
			);

			$msg .= sprintf(
				/* Translators: 1: Plugin name */
				'<p style="display: inline-block;">' . esc_html__( 'Also, if the purpose of importing the demo via "%1$s" plugin is fulfilled, you can simply delete this plugin now.', 'himalayas' ) . '</p>',
				'<strong>' . esc_html__( 'ThemeGrill Demo Importer', 'himalayas' ) . '</strong>'
			);

			echo $msg;
			?>
			<a class="notice-dismiss" style="text-decoration:none;" href="?nag_ignore_himalayas_tdi_notice=0"></a>
		</div>
		<?php
	}

	public function ignore_tdi_notice() {
		$user_id = get_current_user_id();

		if ( isset( $_GET['nag_ignore_himalayas_tdi_notice'] ) && '0' == $_GET['nag_ignore_himalayas_tdi_notice'] ) {
			add_user_meta( $user_id, 'ignore_himalayas_tdi_notice', 'true', true );
		}

	}

	public function remove_tdi_notice() {
		$get_all_users = get_users();

		foreach ( $get_all_users as $user ) {
			$ignored_notice = get_user_meta( $user->ID, 'ignore_himalayas_tdi_notice', true );

			// Delete permanent notice remove data.
			if ( $ignored_notice ) {
				delete_user_meta( $user->ID, 'ignore_himalayas_tdi_notice' );
			}
		}
	}

}

new Himalayas_TDI_Notice();
