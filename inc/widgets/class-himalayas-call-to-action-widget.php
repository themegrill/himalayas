<?php
/**
 * Call to action widget.
 */

class himalayas_call_to_action_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_call_to_action_block',
			'description' => __( 'Use this widget to show the call to action section.', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Call To Action Widget', 'himalayas' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults['background_color'] = '#32c4d1';
		$defaults['background_image'] = '';
		$defaults['text_main']        = '';
		$defaults['text_additional']  = '';
		$defaults['button_text']      = '';
		$defaults['button_url']       = '';
		$defaults['new_tab']          = '0';
		$defaults['select']           = 'cta-text-style-1';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$background_color = $instance['background_color'];
		$background_image = $instance['background_image'];
		$text_additional  = $instance['text_additional'];
		$text_main        = $instance['text_main'];
		$button_text      = $instance['button_text'];
		$button_url       = $instance['button_url'];
		$new_tab          = $instance['new_tab'] ? 'checked="checked"' : '';
		$select           = $instance['select'];
		?>
		<p>
			<strong><?php esc_html_e( 'DESIGN SETTINGS :', 'himalayas' ); ?></strong><br />
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Background Color:', 'himalayas' ); ?></label><br />
			<input class="my-color-picker" type="text" data-default-color="#32c4d1"
			       id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>"
			       value="<?php echo esc_attr( $background_color ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>"> <?php esc_html_e( 'Image:', 'himalayas' ); ?> </label>
			<br />
		<div class="media-uploader" id="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>">
			<div class="custom_media_preview">
				<?php if ( $background_image != '' ) : ?>
					<img class="custom_media_preview_default"
					     src="<?php echo esc_url( $background_image ); ?>" style="max-width:100%;" />
				<?php endif; ?>
			</div>
			<input type="text" class="widefat custom_media_input"
			       id="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'background_image' ) ); ?>"
			       value="<?php echo esc_url( $instance['background_image'] ); ?>" style="margin-top:5px;" />
			<button class="custom_media_upload button button-secondary button-large"
			        id="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>"
			        data-choose="<?php esc_attr_e( 'Choose an image', 'himalayas' ); ?>"
			        data-update="<?php esc_attr_e( 'Use image', 'himalayas' ); ?>"
			        style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'himalayas' ); ?></button>
		</div>
		</p>

		<strong><?php esc_html_e( 'OTHER SETTINGS :', 'himalayas' ); ?></strong><br />

		<?php esc_html_e( 'Call to Action Main Text', 'himalayas' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text_main' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text_main' ) ); ?>"><?php echo esc_textarea( $text_main ); ?></textarea>
		<?php esc_html_e( 'Call to Action Additional Text', 'himalayas' ); ?>
		<textarea class="widefat" rows="4" cols="20"
		          id="<?php echo esc_attr( $this->get_field_id( 'text_additional' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text_additional' ) ); ?>"><?php echo esc_textarea( $text_additional ); ?></textarea>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button Redirect Link:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text"
			       value="<?php echo esc_url( $button_url ); ?>" />
		</p>
		<p>
			<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'new_tab' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'new_tab' ) ); ?>"
			       type="checkbox" <?php echo esc_attr( $new_tab ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'new_tab' ) ); ?>"><?php esc_html_e( 'Check to display link in new tab.', 'himalayas' ); ?></label>
		</p>
		<?php esc_html_e( 'Choose the layout', 'himalayas' ); ?>
		<p>
			<select id="<?php echo esc_attr( $this->get_field_id( 'select' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'select' ) ); ?>">
				<option value="cta-text-style-1" <?php echo ( 'cta-text-style-1' === $select ) ? 'selected="selected"' : ''; ?>
				><?php esc_html_e( 'Layout One', 'himalayas' ); ?></option>
				<option value="cta-text-style-2" <?php echo ( 'cta-text-style-2' === $select ) ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Layout Two', 'himalayas' ); ?></option>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['background_color'] = $new_instance['background_color'];
		$instance['background_image'] = esc_url_raw( $new_instance['background_image'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text_main'] = $new_instance['text_main'];
		} else {
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text_main'] ) ) );
		} // wp_filter_post_kses() expects slashed

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text_additional'] = $new_instance['text_additional'];
		} else {
			$instance['text_additional'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text_additional'] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_url']  = esc_url_raw( $new_instance['button_url'] );
		$instance['new_tab']     = isset( $new_instance['new_tab'] ) ? 1 : 0;
		$instance['select']      = $new_instance['select'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$background_color = isset( $instance['background_color'] ) ? $instance['background_color'] : '';
		$background_image = isset( $instance['background_image'] ) ? $instance['background_image'] : '';
		$text_main        = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
		$text_additional  = empty( $instance['text_additional'] ) ? '' : $instance['text_additional'];
		$button_text      = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_url       = empty( $instance['button_url'] ) ? '#' : $instance['button_url'];
		$new_tab          = ! empty( $instance['new_tab'] ) ? 'true' : 'false';
		$select           = isset( $instance['select'] ) ? $instance['select'] : '';

		echo $before_widget;
		$target_blank = '';
		if ( $new_tab == 'true' ) {
			$target_blank = 'target="_blank"';
		}
		$bg_image_style = '';
		if ( ! empty( $background_image ) ) {
			$bg_image_style .= 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
			$bg_image_class = 'parallax-section';
		} else {
			$bg_image_style .= 'background-color:' . $background_color . ';';
			$bg_image_class = 'no-bg-image';
		} ?>
		<div class="<?php echo $bg_image_class . ' ' . $select; ?> clearfix" style="<?php echo $bg_image_style; ?>">
			<div class="parallax-overlay"></div>
			<div class="section-wrapper cta-text-section-wrapper">
				<div class="tg-container">

					<div class="cta-text-content">
						<?php if ( ! empty( $text_main ) ) { ?>
							<div class="cta-text-title">
								<h2><?php echo wp_kses_post( $text_main ); ?></h2>
							</div>
						<?php }

						if ( ! empty( $text_additional ) ) { ?>
							<div class="cta-text-desc">
								<p><?php echo wp_kses_post( $text_additional ); ?></p>
							</div>
						<?php } ?>
					</div>
					<?php if ( ! empty( $button_text ) ) { ?>
						<a class="cta-text-btn" href="<?php echo $button_url; ?>" <?php echo $target_blank; ?>
						   title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php echo $after_widget;
	}
}

