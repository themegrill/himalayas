<?php
/**
 * Contact us section.
 */

class himalayas_contact_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_contact_block',
			'description' => __( 'Show your Contact page.', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Contact Us Widget', 'himalayas' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults['contact_menu_id'] = '';
		$defaults['title']           = '';
		$defaults['text']            = '';
		$defaults['page_id']         = '';
		$defaults['shortcode']       = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$contact_menu_id = $instance['contact_menu_id'];
		$title           = $instance['title'];
		$text            = $instance['text'];
		$page_id         = $instance['page_id'];
		$shortcode       = $instance['shortcode'];
		?>
		<p><?php esc_html_e( 'Note: Enter the Contact Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_menu_id' ) ); ?>"><?php esc_html_e( 'Contact Section ID:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contact_menu_id' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'contact_menu_id' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $contact_menu_id ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php esc_html_e( 'Description:', 'himalayas' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p><?php esc_html_e( 'Select a Contact page.', 'himalayas' ) ?></p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Page', 'himalayas' );
			?>:</label>
		<?php wp_dropdown_pages( array(
			'show_option_none' => ' ',
			'name'             => esc_attr( $this->get_field_name( 'page_id' ) ),
			'selected'         => absint( $page_id ),
		) ); ?>

		<p><?php esc_html_e( 'Use Contact Form Plugin and enter the shortcode here:', 'himalayas' ) ?></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shortcode' ) ); ?>"><?php esc_html_e( 'Shortcode', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'shortcode' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'shortcode' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $shortcode ); ?>" />
		</p>
	<?php }

	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['contact_menu_id'] = sanitize_text_field( $new_instance['contact_menu_id'] );
		$instance['title']           = sanitize_text_field( $new_instance['title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance['page_id']   = absint( $new_instance['page_id'] );
		$instance['shortcode'] = sanitize_text_field( $new_instance['shortcode'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$contact_menu_id = isset( $instance['contact_menu_id'] ) ? $instance['contact_menu_id'] : '';
		$title           = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text            = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$page_id         = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
		$shortcode       = isset( $instance['shortcode'] ) ? $instance['shortcode'] : '';

		$section_id = '';
		if ( ! empty( $contact_menu_id ) ) {
			$section_id = 'id="' . $contact_menu_id . '"';
		}

		echo $before_widget; ?>
		<div <?php echo $section_id; ?>>
			<div class="section-wrapper">
				<div class="tg-container">

					<div class="section-title-wrapper">
						<?php if ( ! empty( $title ) ) {
							echo $before_title . esc_html( $title ) . $after_title;
						}

						if ( ! empty( $text ) ) { ?>
							<h4 class="sub-title"><?php echo wp_kses_post( $text ); ?></h4>
						<?php } ?>
					</div>

					<div class="contact-form-wrapper tg-column-wrapper clearfix">
						<?php if ( $page_id ) :
							$the_query = new WP_Query( 'page_id=' . $page_id );
							while ( $the_query->have_posts() ):$the_query->the_post(); ?>

								<div class="tg-column-2">

									<h2 class="contact-title"> <?php the_title(); ?> </h2>

									<div class="contact-content"> <?php the_content(); ?> </div>
								</div>
							<?php endwhile;
						endif;
						// Reset Post Data
						wp_reset_query();
						if ( ! empty( $shortcode ) ) { ?>
							<div class="tg-column-2">
								<?php echo do_shortcode( $shortcode ); ?>
							</div>
						<?php } ?>
					</div><!-- .contact-content-wrapper -->
				</div><!-- .tg-container -->
			</div>
		</div>
		<?php echo $after_widget;
	}
}
