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
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'himalayas' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'himalayas' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'himalayas-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		global $himalayas_version;

		wp_enqueue_style( 'himalayas-welcome', get_template_directory_uri() . '/css/admin/welcome.css', array(), $himalayas_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Himalayas! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'himalayas' ), '<a href="' . esc_url( admin_url( 'themes.php?page=himalayas-welcome' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=himalayas-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php esc_html_e( 'Get started with Himalayas', 'himalayas' ); ?></a></p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $himalayas_version;
		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $himalayas_version, 0, 3 );
		?>
		<div class="himalayas-theme-info">
				<h1>
					<?php esc_html_e('About', 'himalayas'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( esc_html__( '%s', 'himalayas' ), $major_version ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="himalayas-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.jpg'; ?>" />
				</div>
			</div>
		</div>

		<p class="himalayas-actions">
			<a href="<?php echo esc_url( 'http://themegrill.com/themes/himalayas/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'himalayas' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'himalayas_pro_theme_url', 'http://demo.themegrill.com/himalayas/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'himalayas' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'himalayas_pro_theme_url', 'http://themegrill.com/themes/himalayas-pro/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'himalayas' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'himalayas_pro_theme_url', 'http://wordpress.org/support/view/theme-reviews/himalayas?filter=5' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'himalayas' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'himalayas-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'himalayas-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'himalayas-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Supported Plugins', 'himalayas' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'himalayas-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'himalayas' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'himalayas-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'himalayas' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php echo esc_html_e( 'Theme Customizer', 'himalayas' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'himalayas' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'himalayas' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Documentation', 'himalayas' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'himalayas' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/theme-instruction/himalayas/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'himalayas' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Got theme support question?', 'himalayas' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'himalayas' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/support-forum/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'himalayas' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Need more features?', 'himalayas' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'himalayas' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/themes/himalayas-pro/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View PRO version', 'himalayas' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Got sales related question?', 'himalayas' ); ?></h3>
						<p><?php esc_html_e( 'Please send it via our sales contact page.', 'himalayas' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/contact/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Contact Page', 'himalayas' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							echo esc_html_e( 'Translate', 'himalayas' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'himalayas' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'http://translate.wordpress.org/projects/wp-themes/himalayas' ); ?>" class="button button-secondary">
								<?php
								esc_html_e( 'Translate', 'himalayas' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard himalayas">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates' ) : esc_html_e( 'Return to Dashboard &rarr; Updates' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home' ) : esc_html_e( 'Go to Dashboard' ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below.', 'himalayas' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'himalayas_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	* Parse changelog from readme file.
	* @param  string $content
	* @return string
	*/
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the supported plugins screen.
	 */
	public function supported_plugins_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins.', 'himalayas' ); ?></p>
			<ol>
				<li><?php printf(__('<a href="%s" target="_blank">Contact Form 7</a>', 'himalayas'), esc_url('https://wordpress.org/plugins/contact-form-7/')); ?></li>
				<li><?php printf(__('<a href="%s" target="_blank">WP-PageNavi</a>', 'himalayas'), esc_url('https://wordpress.org/plugins/wp-pagenavi/')); ?></li>
				<li><?php printf(__('<a href="%s" target="_blank">WooCommerce</a>', 'himalayas'), esc_url('https://wordpress.org/plugins/woocommerce/')); ?></li>
				<li>
					<?php printf(__('<a href="%s" target="_blank">Polylang</a>', 'himalayas'), esc_url('https://wordpress.org/plugins/polylang/')); ?>
					<?php esc_html_e('Fully Compatible in Pro Version', 'himalayas'); ?>
				</li>
				<li>
					<?php printf(__('<a href="%s" target="_blank">WMPL</a>', 'himalayas'), esc_url('https://wpml.org/')); ?>
					<?php esc_html_e('Fully Compatible in Pro Version', 'himalayas'); ?>
				</li>
			</ol>

		</div>
		<?php
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'himalayas' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'himalayas'); ?></h3></th>
						<th><h3><?php esc_html_e('Himalayas', 'himalayas'); ?></h3></th>
						<th><h3><?php esc_html_e('Himalayas Pro', 'himalayas'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e('Use as One Page theme', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Parallax Scrolling', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Slider', 'foodhunt'); ?></h3></td>
						<td><?php esc_html_e('4 Slides', 'foodhunt'); ?></td>
						<td><?php esc_html_e('Unlimited Slides', 'foodhunt'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Slider Settings', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('Slides type, duration & delay time', 'foodhunt'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Header Video', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Slider text layout', 'foodhunt'); ?></h3></td>
						<td><?php esc_html_e('1', 'foodhunt'); ?></td>
						<td><?php esc_html_e('2', 'foodhunt'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Google Fonts', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('500+', 'foodhunt'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Color Palette', 'foodhunt'); ?></h3></td>
						<td><?php esc_html_e('Primary Color Option', 'foodhunt'); ?></span></td>
						<td><?php esc_html_e('Primary color option & 18+', 'foodhunt'); ?></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Font Size options', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WooCommerce Compatible', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WPML Compatible', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Copyright Editor', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Demo Content', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Support', 'foodhunt'); ?></h3></td>
						<td><?php esc_html_e('Forum', 'foodhunt'); ?></span></td>
						<td><?php esc_html_e('Emails/Priority Support Ticket', 'foodhunt'); ?></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: About Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Service Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Call To Action Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Portfolio', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Our Team Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Contact Us Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Image Gallery Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Testimonial Widget', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Our Clients', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Fun Facts', 'foodhunt'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new Himalayas_Admin();
