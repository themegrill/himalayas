<?php

class Himalayas_Dashboard {
	private static $instance;

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'himalayas-admin-dashboard', get_template_directory_uri() . '/inc/admin/css/dashboard.css' );
	}

	public function create_menu() {
		$page = add_theme_page( 'himalayas Options', 'himalayas Options', 'edit_theme_options', 'himalayas-options', array(
			$this,
			'option_page'
		) );

		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	public function enqueue_styles() {
		wp_enqueue_style( 'himalayas-dashboard', HIMALAYAS_CSS_URL . '/admin/dashboard.css', array(), HIMALAYAS_THEME_VERSION );
	}

	public function option_page() {
		$theme = wp_get_theme();
		?>
		<div class="wrap">
		<div class="himalayas-header">
			<h1>
				<?php
				/* translators: %s: Theme version. */
				echo sprintf( esc_html__( 'himalayas %s', 'himalayas' ), $theme->Version );
				?>
			</h1>
		</div>
		<div class="welcome-panel">
			<div class="welcome-panel-content">
				<h2><?php esc_html_e( 'Welcome to himalayas!', 'himalayas' ); ?></h2>
				<p class="about-description">
					<?php
					/* translators: %s: Theme Name. */
					echo sprintf( esc_html__( 'Important links to get you started with %s', 'himalayas' ), $theme->Name );
					?>
				</p>

				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Get Started', 'himalayas' ); ?></h3>
						<a class="button button-primary button-hero"
						   href="<?php echo esc_url( 'https://docs.themegrill.com/himalayas/#section-1' ); ?>"
						   target="_blank"><?php esc_html_e( 'Learn Basics', 'himalayas' ); ?>
						</a>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Next Steps', 'himalayas' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-media-text">' . esc_html__( 'Documentation', 'himalayas' ) . '</a>', esc_url( 'https://docs.themegrill.com/himalayas' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-layout">' . esc_html__( 'Starter Demos', 'himalayas' ) . '</a>', esc_url( 'https://demo.themegrill.com/himalayas-demos' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon welcome-add-page">' . esc_html__( 'Premium Version', 'himalayas' ) . '</a>', esc_url( 'http://themegrill.com/themes/himalayas' ) ); ?></li>
						</ul>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Further Actions', 'himalayas' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-businesswoman">' . esc_html__( 'Got theme support question?', 'himalayas' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/himalayas/' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-thumbs-up">' . esc_html__( 'Leave a review', 'himalayas' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/himalayas/reviews/' ) ); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

Himalayas_Dashboard::instance();
