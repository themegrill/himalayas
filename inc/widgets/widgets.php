<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage Himalayas
 * @since      Himalayas 1.0
 */

add_action( 'widgets_init', 'himalayas_widgets_init' );
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function himalayas_widgets_init() {

	/**
	 * Registering widget areas for front page
	 */
	// Registering main right sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'himalayas' ),
		'id'            => 'himalayas_right_sidebar',
		'description'   => esc_html__( 'Shows widgets at Right side.', 'himalayas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	// Registering main left sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'himalayas' ),
		'id'            => 'himalayas_left_sidebar',
		'description'   => esc_html__( 'Shows widgets at Left side.', 'himalayas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	// Registering the Front Page Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Sidebar', 'himalayas' ),
		'id'            => 'himalayas_front_page_section',
		'description'   => esc_html__( 'Show widgets at Front Page Content Section', 'himalayas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="main-title">',
		'after_title'   => '</h2>',
	) );
	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Error 404 Page Sidebar', 'himalayas' ),
		'id'            => 'himalayas_error_404_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'himalayas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	// Registering Footer Sidebar One
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'himalayas' ),
		'id'            => 'himalayas_footer_sidebar_one',
		'description'   => esc_html__( 'Shows widgets on footer sidebar one.', 'himalayas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	// Registering Footer Sidebar Two
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Two', 'himalayas' ),
		'id'            => 'himalayas_footer_sidebar_two',
		'description'   => esc_html__( 'Shows widgets on footer sidebar two.', 'himalayas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	// Registering Footer Sidebar Three
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Three', 'himalayas' ),
		'id'            => 'himalayas_footer_sidebar_three',
		'description'   => esc_html__( 'Shows widgets on footer sidebar three.', 'himalayas' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_widget( 'himalayas_about_us_widget' );
	register_widget( 'himalayas_service_widget' );
	register_widget( 'himalayas_call_to_action_widget' );
	register_widget( 'himalayas_portfolio_widget' );
	register_widget( 'himalayas_featured_posts_widget' );
	register_widget( 'himalayas_our_team_widget' );
	register_widget( 'himalayas_contact_widget' );
}

/**
 * Include Himalayas widgets class.
 */
// Class: TG: About Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-about-us-widget.php';

// Class: TG: Call To Action Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-call-to-action-widget.php';

// Class: TG: Featured Posts Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-featured-posts-widget.php';

// Class: TG: Our Team Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-our-team-widget.php';

// Class: TG: Contact Us Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-contact-widget.php';

// Class: TG: Portfolio Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-portfolio-widget.php';

// Class: TG: Service Widget.
require_once get_template_directory() . '/inc/widgets/class-himalayas-service-widget.php';
