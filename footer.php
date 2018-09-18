<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #page div.
 *
 * @package    ThemeGrill
 * @subpackage Himalayas
 * @since      Himalayas 1.0
 */
?>
<?php $himalayas_footer_layout = get_theme_mod( 'himalayas_footer_layout', 'footer-layout-one' ); ?>

<footer id="colophon" class="footer-with-widget <?php echo $himalayas_footer_layout; ?>">
	<?php get_sidebar( 'footer' );

	if ( $himalayas_footer_layout == 'footer-layout-two' && function_exists( 'the_custom_logo' ) ) { ?>
		<div class="footer-logo">
			<?php the_custom_logo(); ?>
		</div>
	<?php } ?>

	<div id="bottom-footer">
		<div class="tg-container">

			<?php do_action( 'himalayas_footer_copyright' ); ?>

			<div class="footer-nav">
				<?php if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container_id'   => $himalayas_footer_layout,
						'depth'          => - 1,
						'fallback_cb'    => false,
					) );
				} ?>
			</div>
		</div>
	</div>
</footer>
<a href="#" class="scrollup"><i class="fa fa-angle-up"> </i> </a>

</div> <!-- #Page -->
<?php wp_footer(); ?>
</body>
</html>
