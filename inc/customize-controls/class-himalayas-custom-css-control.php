<?php
/**
 * Extend WP_Customize_Control for custom CSS control.
 *
 * Class HIMALAYAS_Custom_CSS_Control
 *
 * @since 1.1.9
 */

class HIMALAYAS_Custom_CSS_Control extends WP_Customize_Control {

	public $type = 'custom_css';

	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
		<?php
	}
}
