<?php

class Himalayas_Upsell_Custom_Control extends WP_Customize_Control {

	public $type = "himalayas-upsell-control";

	public function enqueue() {
		wp_enqueue_style( 'himalayas-customizer', get_template_directory_uri() . '/inc/customize-controls/assets/css/customizer-upsell.css', array(), HIMALAYAS_THEME_VERSION   );
	}

	public function render_content() {
		?>
		<div class="himalayas-upsell-wrapper">
			<ul class="upsell-features">
				<h3 class="upsell-heading"><?php esc_html_e( 'More Awesome Features', 'himalayas' ); ?></h3>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Header Options', 'himalayas' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Footer Options', 'himalayas' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'More Blog Layouts', 'himalayas' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'More WooCommerce ', 'himalayas' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'More Customizer Options', 'himalayas' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Typography Options', 'himalayas' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'More Page Settings', 'himalayas' ); ?>
				</li>
			</ul>

			<div class="launch-offer">
				<?php
				printf(
				/* translators: %1$s discount coupon code., %2$s discount percentage */
					esc_html__( 'Use the coupon code %1$s to get %2$s discount (limited time offer). Enjoy!', 'himalayas' ),
					'<span class="coupon-code">save10</span>',
					'10%'
				);
				?>
			</div>
		</div> <!-- /.himalayas-upsell-wrapper -->

		<a class="upsell-cta" target="_blank"
		   href="<?php echo esc_url( 'https://themegrill.com/himalayas-pricing/?utm_source=himalayas-customizer&utm_medium=view-pricing-link&utm_campaign=upgrade' ); ?>"><?php esc_html_e( 'View Pricing', 'himalayas' ); ?></a>
		<?php
	}

}
