<?php
/**
 * Portfolio widget section
 */

class himalayas_portfolio_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_portfolio_block',
			'description' => __( 'Display some pages as Portfolio', 'himalayas' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Portfolio', 'himalayas' ), $widget_ops );
	}

	function form( $instance ) {
		$defaults['portfolio_menu_id'] = '';
		$defaults['title']             = '';
		$defaults['text']              = '';
		$defaults['number']            = 8;

		$instance = wp_parse_args( (array) $instance, $defaults );

		$portfolio_menu_id = esc_attr( $instance['portfolio_menu_id'] );
		$title             = esc_attr( $instance['title'] );
		$text              = esc_textarea( $instance['text'] );
		$number            = absint( $instance['number'] ); ?>

		<p><?php esc_html_e( 'Note: Enter the Portfolio Section ID and use same for Menu item.', 'himalayas' ); ?></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'portfolio_menu_id' ) ); ?>"><?php esc_html_e( 'Portfolio Section ID:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'portfolio_menu_id' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'portfolio_menu_id' ) ); ?>" type="text"
			       value="<?php echo $portfolio_menu_id; ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'himalayas' );
				?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<?php esc_html_e( 'Description:', 'himalayas' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of pages to display:', 'himalayas' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo $number; ?>"
			       size="3" />
		</p>

		<p>
			<?php esc_html_e( 'Note: Create the pages and select Portfolio Template to display Portfolio es.', 'himalayas' ); ?>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['portfolio_menu_id'] = sanitize_text_field( $new_instance['portfolio_menu_id'] );
		$instance['title']             = sanitize_text_field( $new_instance['title'] );
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

		$portfolio_menu_id = isset( $instance['portfolio_menu_id'] ) ? $instance['portfolio_menu_id'] : '';
		$title             = isset( $instance['title'] ) ? $instance['title'] : '';
		$text              = isset( $instance['text'] ) ? $instance['text'] : '';
		$number            = empty( $instance['number'] ) ? 8 : $instance['number'];

		$page_array = array();
		$pages      = get_pages();
		// get the pages associated with Portfolio Template.
		foreach ( $pages as $page ) {
			$page_id       = $page->ID;
			$template_name = get_post_meta( $page_id, '_wp_page_template', true );
			if ( $template_name == 'page-templates/template-portfolio.php' ) {
				array_push( $page_array, $page_id );
			}
		}
		$get_featured_posts = new WP_Query( array(
			'posts_per_page' => $number,
			'post_type'      => array( 'page' ),
			'post__in'       => $page_array,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		) );

		echo $before_widget;

		$section_id = '';
		if ( ! empty( $portfolio_menu_id ) ) {
			$section_id = $portfolio_menu_id;
		} ?>

		<div id="<?php echo esc_attr( $section_id ); ?>">
			<div class="section-wrapper">
				<div class="tg-container">
					<div class="section-title-wrapper">
						<?php
						if ( ! empty( $title ) ) {
							echo $before_title . esc_html( $title ) . $after_title;
						}
						if ( ! empty( $text ) ) { ?> <h4
							class="sub-title"> <?php echo wp_kses_post( $text ); ?> </h4> <?php } ?>
					</div>
				</div>

				<?php if ( ! empty( $page_array ) ) : ?>
					<div class="Portfolio-content-wrapper clearfix">
						<?php
						while ( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); ?>

							<div class="portfolio-images-wrapper">
								<?php
								// Get the full URI of featured image
								$image_popup_id  = get_post_thumbnail_id();
								$image_popup_url = wp_get_attachment_url( $image_popup_id ); ?>

								<div class="port-img">
									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'himalayas-portfolio-image' );

									} else {
										$image_popup_url = get_template_directory_uri() . '/images/placeholder-portfolio.jpg';
										echo '<img src="' . esc_url( $image_popup_url ) . '">';
									} ?>
								</div>

								<div class="portfolio-hover">
									<div class="port-link">
										<a class="image-popup" href="<?php echo esc_url( $image_popup_url ); ?>"><i
												class="fa fa-search-plus"></i></a>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><i
												class="fa fa-link"></i></a>
									</div>

									<div class="port-title-wrapper">
										<h4 class="port-title"><a href="<?php the_permalink(); ?>"
										                          title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</h4>
										<div class="port-desc"> <?php echo himalayas_excerpt( 16 ); ?> </div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div><!-- .Portfolio-content-wrapper -->
					<?php
					// Reset Post Data
					wp_reset_query();
				endif; ?>
			</div>
		</div><!-- .section-wrapper -->

		<?php echo $after_widget;
	}
}
