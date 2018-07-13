<?php
/**
 * Service Widget section.
 */

class himalayas_service_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_service_block',
			'description' => __( 'Display some pages as services.', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Service Widget', 'himalayas' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults['service_menu_id'] = '';
		$defaults['title']           = '';
		$defaults['text']            = '';
		$defaults['number']          = '6';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$service_menu_id = esc_attr( $instance['service_menu_id'] );
		$title           = esc_attr( $instance['title'] );
		$text            = esc_textarea( $instance['text'] );
		$number          = absint( $instance['number'] ); ?>

		<p><?php esc_html_e( 'Note: Enter the Service Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'service_menu_id' ) ); ?>"><?php esc_html_e( 'Service Section ID:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'service_menu_id' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'service_menu_id' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $service_menu_id ); ?>" />
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of pages to display:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $number ); ?>"
			       size="3" />
		</p>

		<p><?php esc_html_e( 'Note: Create the pages and select Services Template to display Services pages.', 'himalayas' ); ?></p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['service_menu_id'] = sanitize_text_field( $new_instance['service_menu_id'] );
		$instance['title']           = sanitize_text_field( $new_instance['title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance['number'] = absint( $new_instance['number'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$service_menu_id = isset( $instance['service_menu_id'] ) ? $instance['service_menu_id'] : '';
		$title           = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text            = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$number          = empty( $instance['number'] ) ? 6 : $instance['number'];

		$page_array = array();
		$pages      = get_pages();

		// get the pages associated with Services Template.
		foreach ( $pages as $page ) {
			$page_id       = $page->ID;
			$template_name = get_post_meta( $page_id, '_wp_page_template', true );
			if ( $template_name == 'page-templates/template-services.php' ) {
				array_push( $page_array, $page_id );
			}
		}

		$get_featured_pages = new WP_Query( array(
			'posts_per_page' => $number,
			'post_type'      => array( 'page' ),
			'post__in'       => $page_array,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		) );

		$section_id = '';
		if ( ! empty( $service_menu_id ) ) {
			$section_id = $service_menu_id;
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

						if ( ! empty( $text ) ) {
							?>
							<h4 class="sub-title"><?php echo wp_kses_post( $text ); ?></h4>
						<?php } ?>
					</div>

					<?php
					if ( ! empty( $page_array ) ) {
						$count = 0;
						?>
						<div class="service-content-wrapper clearfix">
							<div class="tg-column-wrapper clearfix">

								<?php
								while ( $get_featured_pages->have_posts() ) :
									$get_featured_pages->the_post();

									if ( $count % 3 == 0 && $count > 1 ) {
										?>
										<div class="clearfix"></div>
									<?php } ?>

									<div class="tg-column-3 tg-column-bottom-margin">
										<?php
										$himalayas_icon = get_post_meta( $post->ID, 'himalayas_font_icon', true );
										$himalayas_icon = isset( $himalayas_icon ) ? esc_attr( $himalayas_icon ) : '';

										$icon_image_class = '';
										if ( ! empty( $himalayas_icon ) ) {
											$icon_image_class = 'service_icon_class';
											$services_top     = '<i class="fa ' . esc_attr( $himalayas_icon ) . '"></i>';
										}
										if ( has_post_thumbnail() ) {
											$icon_image_class = 'service_image_class';
											$services_top     = get_the_post_thumbnail( $post->ID, 'himalayas-services' );
										}

										if ( has_post_thumbnail() || ! empty( $himalayas_icon ) ) {
											?>

											<div class="<?php echo esc_attr( $icon_image_class ); ?>">
												<div class="image-wrap">
													<?php echo $services_top; ?>
												</div>
											</div>
										<?php } ?>

										<div class="service-desc-wrap">
											<h5 class="service-title"><a title="<?php the_title_attribute(); ?>"
											                             href="<?php the_permalink(); ?>"
											                             alt="<?php the_title_attribute(); ?>"> <?php echo esc_html( get_the_title() ); ?></a>
											</h5>

											<div class="service-content">
												<?php the_excerpt(); ?>
											</div>

											<a class="service-read-more" href="<?php the_permalink(); ?>"
											   title="<?php the_title_attribute(); ?>"> <?php esc_html_e( 'Read more', 'himalayas' ); ?>
												<i class="fa fa-angle-double-right"> </i></a>
										</div>
									</div>
									<?php
									$count ++;
								endwhile;
								?>
							</div>
						</div>
						<?php
						// Reset Post Data
						wp_reset_postdata();
					}
					?>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
