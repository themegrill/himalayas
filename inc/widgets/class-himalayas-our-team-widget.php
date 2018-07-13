<?php
/**
 * Our Team section.
 */

class himalayas_our_team_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_our_team_block',
			'description' => __( 'Show your Team Members.', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Our Team Widget', 'himalayas' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults['team_menu_id']     = '';
		$defaults['background_color'] = '#575757';
		$defaults['background_image'] = '';
		$defaults['title']            = '';
		$defaults['text']             = '';
		$defaults['number']           = '3';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$team_menu_id     = esc_attr( $instance['team_menu_id'] );
		$background_color = esc_attr( $instance['background_color'] );
		$background_image = esc_url_raw( $instance['background_image'] );
		$title            = esc_attr( $instance['title'] );
		$text             = esc_textarea( $instance['text'] );
		$number           = absint( $instance['number'] );
		?>

		<p><?php esc_html_e( 'Note: Enter the Our Team Section ID and use same for Menu item. Only used for One Page Menu.',
				'himalayas' ); ?></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'team_menu_id' ) ); ?>"><?php esc_html_e( 'Our Team Section ID:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'team_menu_id' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'team_menu_id' ) ); ?>" type="text"
			       value="<?php echo $team_menu_id; ?>" />
		</p>
		<p>
			<strong><?php esc_html_e( 'DESIGN SETTINGS :', 'himalayas' ); ?></strong><br />

			<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Background Color:', 'himalayas' ); ?></label><br />
			<input class="my-color-picker" type="text" data-default-color="#575757"
			       id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>"
			       value="<?php echo $background_color; ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>"> <?php esc_html_e( 'Background Image:', 'himalayas' ); ?> </label>
			<br />
		<div class="media-uploader" id="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>">
			<div class="custom_media_preview">
				<?php if ( $background_image != '' ) : ?>
					<img class="custom_media_preview_default"
					     src="<?php echo esc_url( $instance['background_image'] ); ?>" style="max-width:100%;" />
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

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php esc_html_e( 'Description:', 'himalayas' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo wp_kses_post( $text ); ?></textarea>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of pages to display:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo $number; ?>"
			       size="3" />
		</p>
		<p><?php esc_html_e( 'Note: Create the pages and select Our Team Template to display Our Team pages.', 'himalayas' ); ?></p>
	<?php }

	function update( $new_instance, $old_instance ) {
		$instance                     = $old_instance;
		$instance['team_menu_id']     = sanitize_text_field( $new_instance['team_menu_id'] );
		$instance['background_color'] = $new_instance['background_color'];
		$instance['background_image'] = esc_url_raw( $new_instance['background_image'] );
		$instance['title']            = sanitize_text_field( $new_instance['title'] );

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
		$team_menu_id     = isset( $instance['team_menu_id'] ) ? $instance['team_menu_id'] : '';
		$background_color = isset( $instance['background_color'] ) ? $instance['background_color'] : '';
		$background_image = isset( $instance['background_image'] ) ? $instance['background_image'] : '';
		$title            = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text             = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$number           = empty( $instance['number'] ) ? 3 : $instance['number'];

		$page_array = array();
		$pages      = get_pages();
		// get the pages associated with Our Team Template.
		foreach ( $pages as $page ) {
			$page_id       = $page->ID;
			$template_name = get_post_meta( $page_id, '_wp_page_template', true );
			if ( $template_name == 'page-templates/template-team.php' ) {
				array_push( $page_array, $page_id );
			}
		}

		$get_featured_pages = new WP_Query( array(
			'posts_per_page' => $number,
			'post_type'      => array( 'page' ),
			'post__in'       => $page_array,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		) );

		if ( ! empty( $background_image ) ) {
			$bg_image_style = 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
			$bg_image_class = 'parallax-section';
		} else {
			$bg_image_style = 'background-color:' . $background_color . ';';
			$bg_image_class = 'no-bg-image';
		}

		$section_id = '';
		if ( ! empty( $team_menu_id ) ) {
			$section_id = $team_menu_id;
		}

		echo $before_widget; ?>
		<div id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo $bg_image_class ?> clearfix"
		     style="<?php echo esc_attr( $bg_image_style ); ?>">

			<div class="parallax-overlay"></div>
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

					<?php if ( ! empty( $page_array ) ) :
						$count = 0; ?>
						<div class="team-content-wrapper clearfix">
							<div class="tg-column-wrapper clearfix">
								<?php while ( $get_featured_pages->have_posts() ) : $get_featured_pages->the_post();

									if ( $count % 3 == 0 && $count > 1 ) { ?>
										<div class="clearfix"></div> <?php }

									$title_attribute = the_title_attribute( 'echo=0' ); ?>

									<div class="tg-column-3 tg-column-bottom-margin">
										<div class="team-block">

											<div class="team-img-wrapper">

												<div class="team-img">
													<?php if ( has_post_thumbnail() ) {
														the_post_thumbnail( 'himalayas-portfolio-image' );
													} else {
														echo '<img src="' . get_template_directory_uri() . '/images/placeholder-team.jpg' . '">';
													} ?>
												</div>

												<div class="team-name">
													<?php the_title(); ?>
												</div>
											</div>

											<div class="team-desc-wrapper">
												<?php
												$output                = '';
												$himalayas_designation = get_post_meta( $post->ID, 'himalayas_designation', true );
												if ( ! empty( $himalayas_designation ) ) {
													$himalayas_designation = isset( $himalayas_designation ) ? esc_attr( $himalayas_designation ) : '';
													$output                .= '<h5 class="team-deg">' . esc_html( $himalayas_designation ) . '</h5>';
												}

												$output .= '<div class="team-content">' . '<p>' . get_the_excerpt() . '</p></div>';

												$output .= '<a class="team-name" href="' . get_permalink() . '" title="' . $title_attribute . '" alt ="' . $title_attribute . '">' . get_the_title() . '</a>';

												echo $output;
												$count ++; ?>
											</div>
										</div><!-- .team-block -->
									</div><!-- .tg-column-3 -->
								<?php endwhile;

								// Reset Post Data
								wp_reset_query(); ?>
							</div><!-- .tg-column-wrapper -->
						</div><!-- .team-content-wrapper -->

					<?php endif; ?>

				</div><!-- .tg-container -->
			</div><!-- .section-wrapper -->
		</div>

		<?php echo $after_widget;
	}
}
