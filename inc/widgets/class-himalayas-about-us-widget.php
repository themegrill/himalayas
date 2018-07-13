<?php
/**
 * About us section.
 */

class himalayas_about_us_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_about_block',
			'description' => __( 'Show your about page.', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: About Widget', 'himalayas' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults['about_menu_id'] = '';
		$defaults['title']         = '';
		$defaults['text']          = '';
		$defaults['page_id']       = '';
		$defaults['button_text']   = '';
		$defaults['button_url']    = '';
		$defaults['button_icon']   = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$about_menu_id = esc_attr( $instance['about_menu_id'] );
		$title         = esc_attr( $instance['title'] );
		$text          = esc_textarea( $instance['text'] );
		$page_id       = absint( $instance['page_id'] );
		$button_text   = esc_attr( $instance['button_text'] );
		$button_url    = esc_url( $instance['button_url'] );
		$button_icon   = esc_attr( $instance['button_icon'] );
		?>
		<p><?php esc_html_e( 'Note: Enter the About Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'about_menu_id' ) ); ?>"><?php esc_html_e( 'About Section ID:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'about_menu_id' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'about_menu_id' ) ); ?>"
			       type="text" value="<?php echo esc_attr( $about_menu_id ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php esc_html_e( 'Description:', 'himalayas' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_html( $text ); ?></textarea>

		<p>
			<?php esc_html_e( 'Select a page to display Title, Excerpt and Featured image.', 'himalayas' ); ?>
		</p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Page :', 'himalayas' ); ?></label>
		<?php
		wp_dropdown_pages( array(
			'show_option_none' => ' ',
			'name'             => esc_attr( $this->get_field_name( 'page_id' ) ),
			'selected'         => esc_attr( $instance['page_id'] ),
		) );
		?>

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
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_icon' ) ); ?>"><?php esc_html_e( 'Button Icon Class:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'button_icon' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'button_icon' ) ); ?>" placeholder="fa-cog"
			       type="text"
			       value="<?php echo esc_attr( $button_icon ); ?>" />
		</p>
		<p>
			<?php
			$url = 'http://fontawesome.io/icons/';

			/* translators: %s */
			$link = sprintf( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'himalayas' ), esc_url( $url ) );
			echo $link;
			?>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
		$instance['about_menu_id'] = sanitize_text_field( $new_instance['about_menu_id'] );
		$instance['title']         = sanitize_text_field( $new_instance['title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance['page_id']     = absint( $new_instance['page_id'] );
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_url']  = esc_url_raw( $new_instance['button_url'] );
		$instance['button_icon'] = sanitize_text_field( $new_instance['button_icon'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$about_menu_id = isset( $instance['about_menu_id'] ) ? $instance['about_menu_id'] : '';
		$title         = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text          = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$page_id       = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
		$button_text   = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_url    = empty( $instance['button_url'] ) ? '#' : $instance['button_url'];
		$button_icon   = isset( $instance['button_icon'] ) ? $instance['button_icon'] : '';

		$section_id = '';
		if ( ! empty( $about_menu_id ) ) {
			$section_id = $about_menu_id;
		}

		echo $before_widget; ?>
		<div id="<?php echo esc_attr( $section_id ); ?>">
			<div class="section-wrapper">
				<div class="tg-container">

					<div class="section-title-wrapper">
						<?php
						if ( ! empty( $title ) ) {
							echo $before_title . esc_html( $title ) . $after_title;
						}
						if ( ! empty( $text ) ) { ?>
							<h4 class="sub-title"><?php echo wp_kses_post( $text ); ?></h4>
						<?php } ?>
					</div>

					<?php if ( $page_id ) : ?>
						<div class="about-content-wrapper tg-column-wrapper clearfix">
							<?php
							$the_query = new WP_Query( 'page_id=' . $page_id );
							while ( $the_query->have_posts() ) :
								$the_query->the_post();
								$title_attribute = the_title_attribute( 'echo=0' );

								if ( has_post_thumbnail() ) {
									?>
									<div class="about-image tg-column-2">
										<?php the_post_thumbnail( 'full' ); ?>
									</div>
								<?php } ?>

								<div class="about-content tg-column-2">
									<?php
									$output = '<h2 class="about-title"> <a href="' . get_permalink() . '" title="' . $title_attribute . '" alt ="' . $title_attribute . '">' . get_the_title() . '</a></h2>';

									$output .= '<div class="about-content"><p>' . get_the_excerpt() . '</p></div>';

									$output .= '<div class="about-btn"> <a href="' . get_permalink() . '">' . __( 'Read more', 'himalayas' ) . '</a>';

									if ( ! empty( $button_text ) ) {
										$output .= '<a href="' . $button_url . '">' . esc_html( $button_text ) . '<i class="fa ' . $button_icon . '"></i></a>';
									}
									$output .= '</div>';
									echo $output;
									?>
								</div>
							<?php
							endwhile;

							// Reset Post Data.
							wp_reset_postdata();
							?>
						</div><!-- .about-content-wrapper -->
					<?php endif; ?>
				</div><!-- .tg-container -->
			</div>
		</div>
		<?php echo $after_widget;
	}
}
