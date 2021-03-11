<?php
/**
 * Theme Header Section for our theme.
 *
 * @package    ThemeGrill
 * @subpackage Himalayas
 * @since      Himalayas 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php
	/**
	 * This hook is important for wordpress plugins and other many things
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php do_action( 'himalayas_before' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'himalayas' ); ?></a>

	<?php do_action( 'himalayas_before_header' ); ?>

	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="header-wrapper clearfix">
			<div class="tg-container">

				<?php if ( ( get_theme_mod( 'himalayas_header_logo_placement', 'header_text_only' ) == 'show_both' || get_theme_mod( 'himalayas_header_logo_placement', 'header_text_only' ) == 'header_logo_only' ) ) { ?>

					<div class="logo">

						<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
							himalayas_the_custom_logo();
						} ?>

					</div> <!-- logo-end -->
				<?php }

				$screen_reader = '';
				if ( ( get_theme_mod( 'himalayas_header_logo_placement', 'header_text_only' ) == 'header_logo_only' || get_theme_mod( 'himalayas_header_logo_placement', 'header_text_only' ) == 'disable' ) ) {
					$screen_reader = 'screen-reader-text';
				}
				?>
				<div id="header-text" class="<?php echo $screen_reader; ?>">
					<?php
					if ( is_front_page() || is_home() ) : ?>
						<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php else : ?>
						<h3 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h3>
					<?php endif;
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p id="site-description"><?php echo $description; ?></p>
					<?php endif;
					?>
				</div><!-- #header-text -->

				<div class="menu-search-wrapper">

					<div class="home-search">

						<div class="search-icon">
							<i class="fa fa-search"> </i>
						</div>

						<div class="search-box">
							<div class="close"> &times;</div>
							<?php get_search_form(); ?>
						</div>
					</div> <!-- home-search-end -->

					<nav id="site-navigation" class="main-navigation" role="navigation">
						<span class="menu-toggle hide"></span>
						<?php wp_nav_menu( array(
							'theme_location'  => 'primary',
							'container_class' => 'menu-primary-container',
						) ); ?>
					</nav> <!-- nav-end -->
				</div> <!-- Menu-search-wrapper end -->
			</div><!-- tg-container -->
		</div><!-- header-wrapepr end -->

		<?php if ( function_exists( 'the_custom_header_markup' ) && ( ( get_theme_mod( 'himalayas_slide_on_off', '' ) == 0 ) || ( ( get_theme_mod( 'himalayas_slide_on_off', '' ) == 1 ) && ! is_front_page() ) ) ) :
			do_action( 'himalayas_header_image_markup_render' );
			the_custom_header_markup();
		else :
			if ( get_theme_mod( 'himalayas_slide_on_off' ) == 0 ) {
				$header_image = get_header_image();
				?>
				<div class="header-image-wrap">
					<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
				<?php
			}

		endif; ?>

		<?php if ( get_theme_mod( 'himalayas_slide_on_off' ) == 1 && is_front_page() ) {
			himalayas_featured_image_slider();

		} ?>
	</header>

	<?php do_action( 'himalayas_after_header' ); ?>
	<?php do_action( 'himalayas_before_main' ); ?>
