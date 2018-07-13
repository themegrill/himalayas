<?php
/**
 * Featured Posts widget
 */

class himalayas_featured_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_featured_posts_block',
			'description' => __( 'Display latest posts or posts of specific category', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Featured Posts', 'himalayas' ), $widget_ops );
	}

	function form( $instance ) {
		$defaults['featured_menu_id'] = '';
		$defaults['background_color'] = '#f1f1f1';
		$defaults['background_image'] = '';
		$defaults['title']            = '';
		$defaults['text']             = '';
		$defaults['number']           = 3;
		$defaults['type']             = 'latest';
		$defaults['category']         = '';
		$defaults['button_text']      = '';
		$defaults['button_url']       = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$featured_menu_id = $instance['featured_menu_id'];
		$background_color = $instance['background_color'];
		$background_image = $instance['background_image'];
		$title            = $instance['title'];
		$text             = esc_textarea( $instance['text'] );
		$number           = absint( $instance['number'] );
		$type             = $instance['type'];
		$category         = $instance['category'];
		$button_text      = esc_attr( $instance['button_text'] );
		$button_url       = esc_url( $instance['button_url'] ); ?>

		<p><?php esc_html_e( 'Note: Enter the Featured Post Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'featured_menu_id' ) ); ?>"><?php esc_html_e( 'Featured Post Section ID:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'featured_menu_id' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'featured_menu_id' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $featured_menu_id ); ?>" />
		</p>

		<p>
			<strong><?php esc_html_e( 'DESIGN SETTINGS :', 'himalayas' ); ?></strong><br />
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Background Color:', 'himalayas' ); ?></label><br />
			<input class="my-color-picker" type="text" data-default-color="#f1f1f1"
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

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'himalayas' );
				?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php esc_html_e( 'Description:', 'himalayas' ); ?>
		<textarea class="widefat" rows="6" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to display:', 'himalayas' );
				?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo $number; ?>"
			       size="3" />
		</p>

		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>"
			       value="latest" /><?php esc_html_e( 'Show latest Posts', 'himalayas' ); ?><br />
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>"
			       value="category" /><?php esc_html_e( 'Show posts from a category', 'himalayas' ); ?><br />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select category', 'himalayas' ); ?>
				:</label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => esc_attr( $this->get_field_name( 'category' ) ),
				'selected'         => $category,
			) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text"
			       value="<?php echo $button_text; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button Redirect Link:', 'himalayas' );
				?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text"
			       value="<?php echo $button_url; ?>" />
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['featured_menu_id'] = sanitize_text_field( $new_instance['featured_menu_id'] );
		$instance['background_color'] = $new_instance['background_color'];
		$instance['background_image'] = esc_url_raw( $new_instance['background_image'] );
		$instance['title']            = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['number']      = absint( $new_instance['number'] );
		$instance['type']        = $new_instance['type'];
		$instance['category']    = $new_instance['category'];
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_url']  = esc_url_raw( $new_instance['button_url'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$featured_menu_id = isset( $instance['featured_menu_id'] ) ? $instance['featured_menu_id'] : '';
		$background_color = isset( $instance['background_color'] ) ? $instance['background_color'] : '';
		$background_image = isset( $instance['background_image'] ) ? $instance['background_image'] : '';
		$title            = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text             = isset( $instance['text'] ) ? $instance['text'] : '';
		$number           = empty( $instance['number'] ) ? 3 : $instance['number'];
		$type             = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category         = isset( $instance['category'] ) ? $instance['category'] : '';
		$button_text      = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_url       = empty( $instance['button_url'] ) ? '#' : $instance['button_url'];

		if ( $type == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'      => $number,
				'post_type'           => 'post',
				'ignore_sticky_posts' => true,
			) );
		} else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => $number,
				'post_type'      => 'post',
				'category__in'   => $category,
			) );
		}

		if ( ! empty( $background_image ) ) {
			$bg_image_style = 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
			$bg_image_class = 'parallax-section';
		} else {
			$bg_image_style = 'background-color:' . $background_color . ';';
			$bg_image_class = 'no-bg-image';
		}

		$section_id = '';
		if ( ! empty( $featured_menu_id ) ) {
			$section_id = 'id="' . $featured_menu_id . '"';
		}

		echo $before_widget; ?>

		<div <?php echo $section_id; ?> class="<?php echo $bg_image_class ?>" style="<?php echo $bg_image_style; ?>">
			<div class="parallax-overlay"></div>
			<div class="section-wrapper">
				<div class="tg-container">

					<div class="section-title-wrapper">
						<?php if ( ! empty( $title ) ) {
							echo $before_title . esc_html( $title ) . $after_title;
						} ?>
						<?php if ( ! empty( $text ) ) { ?>
							<h4 class="sub-title">
								<?php echo esc_textarea( $text ); ?>
							</h4>
						<?php } ?>
					</div>

					<div class="blog-content-wrapper clearfix">
						<div class="tg-column-wrapper clearfix">

							<?php
							$count = 0;
							while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

								if ( $count % 3 == 0 && $count > 1 ) { ?>
									<div class="clearfix"></div> <?php } ?>

								<div class="tg-column-3 tg-column-bottom-margin">
									<div class="blog-block">

										<?php if ( has_post_thumbnail() ) { ?>
											<div class="blog-img">
												<?php the_post_thumbnail( 'himalayas-featured-image' ); ?>
											</div>
										<?php } ?>

										<div class="blog-content-wrapper">

											<h5 class="blog-title"><a href="<?php the_permalink(); ?>"
											                          title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											</h5>

											<div class="posted-date">

												<?php if ( has_category() ) { ?>
													<span>
                                    <?php esc_html_e( 'Posted in ', 'himalayas' );
                                    the_category( ', ' ); ?>
                                 </span>
												<?php } ?>
												<span>
                                 <?php esc_html_e( 'by ', 'himalayas' ); ?>
													<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
													   title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a>
                              </span>

												<span>
                                 <?php esc_html_e( 'on ', 'himalayas' );

                                 $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

                                 $time_string = sprintf( $time_string,
	                                 esc_attr( get_the_date( 'c' ) ),
	                                 esc_html( get_the_date() )
                                 );
                                 printf( __( '<span><a href="%1$s" title="%2$s" rel="bookmark"> %3$s</a></span>', 'himalayas' ),
	                                 esc_url( get_permalink() ),
	                                 esc_attr( get_the_time() ),
	                                 $time_string
                                 ); ?>
                              </span>
											</div>

											<div class="blog-content">
												<?php the_excerpt(); ?>
											</div>

											<a class="blog-readmore" href="<?php the_permalink(); ?>"
											   title="<?php the_title_attribute(); ?>"> <?php echo __( 'Read more', 'himalayas' ) ?>
												<i class="fa fa-angle-double-right"> </i> </a>
										</div>

									</div><!-- .blog-block -->
								</div><!-- .tg-column-3 -->

								<?php $count ++;
							endwhile;

							if ( ! empty( $button_text ) ) { ?>
								<div class="clearfix"></div>

								<a class="blog-view" href="<?php echo $button_url; ?>"
								   title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
							<?php } ?>

						</div><!-- .tg-column-wrapper -->
					</div><!-- .blog-content-wrapper -->

				</div><!-- .tg-container -->
			</div><!-- .section-wrapper -->
		</div>

		<?php
		// Reset Post Data
		wp_reset_query();
		echo $after_widget;
	}
}
