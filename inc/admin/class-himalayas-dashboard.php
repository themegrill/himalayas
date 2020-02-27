<?php

class Himalayas_Dashboard {
	private static $instance;

	public static function instance( $config ) {

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
		wp_enqueue_style( 'himalayas-admin-dashboard', get_template_directory_uri() . '/css/admin/dashboard.css' );
	}

	public function create_menu() {
		add_theme_page( 'himalayas Options', 'About Himalayas', 'edit_theme_options', 'himalayas-options', array(
			$this,
			'option_page'
		) );
	}

	public function option_page() {
		$theme        = wp_get_theme();
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
                <p class="about-description"><?php esc_html_e( 'Important links to help you on working with himalayas', 'himalayas' ); ?></p>

                <div class="welcome-panel-column-container">
                    <div class="welcome-panel-column">
                        <h3><?php esc_html_e( 'Get Started', 'himalayas' ); ?></h3>
                        <a class="button button-primary button-hero"
                           href="<?php echo esc_url( 'https://docs.themegrill.com/himalayas/' ); ?>"
                           target="_blank"><?php esc_html_e( 'Learn Basics', 'himalayas' ); ?>
                        </a>
                    </div>

                    <div class="welcome-panel-column">
                        <h3><?php esc_html_e( 'Next Steps', 'himalayas' ); ?></h3>
                        <ul>
                            <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-media-text">' . esc_html__( 'Documentation', 'himalayas' ) . '</a>', esc_url( 'https://docs.themegrill.com/himalayas/' ) ); ?></li>
                            <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-layout">' . esc_html__( 'Starter Demos', 'himalayas' ) . '</a>', esc_url( 'https://demo.themegrill.com/himalayas-demos' ) ); ?></li>
                            <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon welcome-add-page">' . esc_html__( 'Premium Version', 'himalayas' ) . '</a>', esc_url( 'https://themegrill.com/themes/himalayas' ) ); ?></li>
                        </ul>
                    </div>

                    <div class="welcome-panel-column">
                        <h3><?php esc_html_e( 'Further Actions', 'himalayas' ); ?></h3>
                        <ul>
                            <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-businesswoman">' . esc_html__( 'Got theme support question?', 'himalayas' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/zakra/' ) ); ?></li>
                            <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-thumbs-up">' . esc_html__( 'Leave a review', 'himalayas' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/himalayas/reviews/' ) ); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

$config = array(
	'menu_name'       => __( 'About himalayas', 'himalayas' ),
	'page_name'       => __( 'About himalayas', 'himalayas' ),
	'welcome_content' => __( 'Himalayas is modern style free one page parallax responsive WordPress theme. Inform your visitors all they need to know right from your home page without requiring to go to the other pages. Himalayas can be used for business, portfolio, corporate, agency, photography, freelancers and almost any kind of sites. Comes with various demos for various purposes, which you can easily import with the help of ThemeGrill Demo Importer plugin.', 'himalayas' ),
	/* translators: s - theme name */
	'welcome_title'   => sprintf( __( 'Welcome to %s! : Version ', 'himalayas' ), 'himalayas' ),
	'tabs'            => array(
		'site_library'        => __( 'Site Library', 'himalayas' ),
		'getting_started'     => __( 'Getting Started', 'himalayas' ),
		'recommended_plugins' => __( 'Recommended Plugins', 'himalayas' ),
		'support'             => __( 'Support', 'himalayas' ),
		'changelog'           => __( 'Changelog', 'himalayas' ),
	),

	'site_library' => array(
		'one' => array(),
	),

);

Himalayas_Dashboard::instance( apply_filters( 'himalayas_about_page_array', $config ) );

