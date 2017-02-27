<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */

add_action( 'widgets_init', 'himalayas_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function himalayas_widgets_init() {

   /**
    * Registering widget areas for front page
    */
   // Registering main right sidebar
   register_sidebar( array(
      'name'            => esc_html__( 'Right Sidebar', 'himalayas' ),
      'id'              => 'himalayas_right_sidebar',
      'description'     => esc_html__( 'Shows widgets at Right side.', 'himalayas' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h4 class="widget-title"><span>',
      'after_title'     => '</span></h4>'
   ) );
   // Registering main left sidebar
   register_sidebar( array(
      'name'            => esc_html__( 'Left Sidebar', 'himalayas' ),
      'id'              => 'himalayas_left_sidebar',
      'description'     => esc_html__( 'Shows widgets at Left side.', 'himalayas' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h4 class="widget-title"><span>',
      'after_title'     => '</span></h4>'
   ) );
   // Registering the Front Page Sidebar
   register_sidebar( array(
      'name'            => esc_html__( 'Front Page Sidebar', 'himalayas' ),
      'id'              => 'himalayas_front_page_section',
      'description'     => esc_html__( 'Show widgets at Front Page Content Section', 'himalayas' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="main-title">',
      'after_title'     => '</h2>'
   ) );
   // Registering Error 404 Page sidebar
   register_sidebar( array(
      'name'            => esc_html__( 'Error 404 Page Sidebar', 'himalayas' ),
      'id'              => 'himalayas_error_404_page_sidebar',
      'description'     => esc_html__( 'Shows widgets on Error 404 page.', 'himalayas' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );
   // Registering Footer Sidebar One
   register_sidebar( array(
      'name'            => esc_html__( 'Footer Sidebar One', 'himalayas' ),
      'id'              => 'himalayas_footer_sidebar_one',
      'description'     => esc_html__( 'Shows widgets on footer sidebar one.', 'himalayas' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h4 class="widget-title"><span>',
      'after_title'     => '</span></h4>'
   ) );
   // Registering Footer Sidebar Two
   register_sidebar( array(
      'name'            => esc_html__( 'Footer Sidebar Two', 'himalayas' ),
      'id'              => 'himalayas_footer_sidebar_two',
      'description'     => esc_html__( 'Shows widgets on footer sidebar two.', 'himalayas' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h4 class="widget-title"><span>',
      'after_title'     => '</span></h4>'
   ) );
   // Registering Footer Sidebar Three
   register_sidebar( array(
      'name'            => esc_html__( 'Footer Sidebar Three', 'himalayas' ),
      'id'              => 'himalayas_footer_sidebar_three',
      'description'     => esc_html__( 'Shows widgets on footer sidebar three.', 'himalayas' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h4 class="widget-title"><span>',
      'after_title'     => '</span></h4>'
   ) );

   register_widget( "himalayas_about_us_widget" );
   register_widget( "himalayas_service_widget" );
   register_widget( "himalayas_call_to_action_widget" );
   register_widget( "himalayas_portfolio_widget" );
   register_widget( "himalayas_featured_posts_widget" );
   register_widget( "himalayas_our_team_widget" );
   register_widget( "himalayas_contact_widget" );
}

/**************************************************************************************/

/**
 * About us section.
 */
class himalayas_about_us_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_about_block', 'description' => __( 'Show your about page.', 'himalayas' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: About Widget', 'himalayas' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults[ 'about_menu_id' ] = '';
      $defaults[ 'title' ] = '';
      $defaults[ 'text' ] = '';
      $defaults[ 'page_id' ] = '';
      $defaults[ 'button_text' ] = '';
      $defaults[ 'button_url' ] = '';
      $defaults[ 'button_icon' ] = '';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $about_menu_id = esc_attr( $instance[ 'about_menu_id' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance['text'] );
      $page_id = absint( $instance[ 'page_id' ] );
      $button_text = esc_attr( $instance[ 'button_text' ] );
      $button_url = esc_url( $instance[ 'button_url' ] );
      $button_icon = esc_attr( $instance[ 'button_icon' ] );
      ?>
      <p><?php _e( 'Note: Enter the About Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'about_menu_id' ); ?>"><?php _e( 'About Section ID:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'about_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'about_menu_id' ); ?>" type="text" value="<?php echo $about_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <?php _e( 'Description:','himalayas' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p><?php _e('Select a page to display Title, Excerpt and Featured image.', 'himalayas') ?></p>
      <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'himalayas' ); ?>:</label>
      <?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'page_id' ), 'selected' => $instance[ 'page_id' ] ) ); ?>

      <p>
         <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Redirect Link:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'button_icon' ); ?>"><?php _e( 'Button Icon Class:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_icon' ); ?>" name="<?php echo $this->get_field_name( 'button_icon' ); ?>" placeholder="fa-cog" type="text" value="<?php echo $button_icon; ?>" />
      </p>
      <p>
         <?php
         $url = 'http://fontawesome.io/icons/';
         $link = sprintf( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'himalayas' ), esc_url( $url ) );
         echo $link;
         ?>
      </p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'about_menu_id' ] = sanitize_text_field( $new_instance[ 'about_menu_id' ] );
      $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
      $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
      $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );
      $instance[ 'button_icon' ] = sanitize_text_field( $new_instance[ 'button_icon' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $about_menu_id = isset( $instance[ 'about_menu_id' ] ) ? $instance[ 'about_menu_id' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance[ 'text' ] ) ? '' : $instance['text'], $instance );
      $page_id = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';
      $button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
      $button_url = empty( $instance[ 'button_url' ] ) ? '#' : $instance[ 'button_url' ];
      $button_icon = isset( $instance[ 'button_icon' ] ) ? $instance[ 'button_icon' ] : '';

      $section_id = '';
      if( !empty( $about_menu_id ) )
         $section_id = 'id="' . $about_menu_id . '"';

      echo $before_widget; ?>
      <div <?php echo $section_id; ?> >
         <div class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper">
                  <?php if( !empty( $title ) ) echo $before_title . esc_html( $title ) . $after_title;
                  if( !empty( $text ) ) { ?>
                     <h4 class="sub-title"><?php echo esc_textarea( $text ); ?></h4>
                  <?php } ?>
               </div>

               <?php if( $page_id ) : ?>
               <div class="about-content-wrapper tg-column-wrapper clearfix">
                  <?php
                  $the_query = new WP_Query( 'page_id='.$page_id );
                  while( $the_query->have_posts() ):$the_query->the_post();
                     $title_attribute = the_title_attribute( 'echo=0' );

                     if( has_post_thumbnail() ) { ?>
                        <div class="about-image tg-column-2">
                           <?php the_post_thumbnail( 'full' ); ?>
                        </div>
                     <?php } ?>

                     <div class="about-content tg-column-2">
                        <?php
                        $output = '<h2 class="about-title"> <a href="' . get_permalink() . '" title="' . $title_attribute . '" alt ="' . $title_attribute . '">' . get_the_title() . '</a></h2>';

                        $output .= '<div class="about-content">' . '<p>' . get_the_excerpt() . '</p></div>';

                        $output .= '<div class="about-btn"> <a href="'. get_permalink() . '">' . __( 'Read more', 'himalayas' ) . '</a>';

                        if ( !empty ( $button_text ) ) {
                           $output .= '<a href="' . $button_url . '">' . esc_html( $button_text ) . '<i class="fa ' . $button_icon . '"></i></a>';
                        }
                        $output .= '</div>';
                        echo $output;
                        ?>
                     </div>
                  <?php endwhile;

                  // Reset Post Data
                  wp_reset_query(); ?>
               </div><!-- .about-content-wrapper -->
               <?php endif; ?>
            </div><!-- .tg-container -->
         </div>
      </div>
   <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Service Widget section.
 */
class himalayas_service_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_service_block', 'description' => __( 'Display some pages as services.', 'himalayas' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Service Widget', 'himalayas' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults['service_menu_id'] = '';
      $defaults['title'] = '';
      $defaults['text'] = '';
      $defaults['number'] = '6';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $service_menu_id = esc_attr( $instance[ 'service_menu_id' ] );
      $title = esc_attr( $instance['title'] );
      $text = esc_textarea( $instance['text'] );
      $number = absint( $instance[ 'number' ] ); ?>

      <p><?php _e( 'Note: Enter the Service Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>

      <p>
         <label for="<?php echo $this->get_field_id('service_menu_id'); ?>"><?php _e( 'Service Section ID:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id('service_menu_id'); ?>" name="<?php echo $this->get_field_name('service_menu_id'); ?>" type="text" value="<?php echo $service_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <?php _e( 'Description:','himalayas' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of pages to display:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><?php _e( 'Note: Create the pages and select Services Template to display Services pages.', 'himalayas' ); ?></p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'service_menu_id' ] = sanitize_text_field( $new_instance[ 'service_menu_id' ] );
      $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $service_menu_id = isset( $instance[ 'service_menu_id' ] ) ? $instance[ 'service_menu_id' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
      $number = empty( $instance[ 'number' ] ) ? 6 : $instance[ 'number' ];

      $page_array = array();
      $pages = get_pages();
      // get the pages associated with Services Template.
      foreach ( $pages as $page ) {
         $page_id = $page->ID;
         $template_name = get_post_meta( $page_id, '_wp_page_template', true );
         if( $template_name == 'page-templates/template-services.php' ) {
            array_push( $page_array, $page_id );
         }
      }

      $get_featured_pages = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_array,
         'orderby'               => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
      ) );

      $section_id = '';
      if( !empty( $service_menu_id ) )
         $section_id = 'id="' . $service_menu_id . '"';

      echo $before_widget; ?>
      <div <?php echo $section_id; ?> >
         <div  class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper">
                  <?php if( !empty( $title ) ) echo $before_title . esc_html( $title ) . $after_title;

                  if( !empty( $text ) ) { ?>
                     <h4 class="sub-title"><?php echo esc_textarea( $text ); ?></h4>
                  <?php } ?>
               </div>

               <?php
               if( !empty( $page_array ) ) {
                  $count = 0; ?>
                  <div class="service-content-wrapper clearfix">
                     <div class="tg-column-wrapper clearfix">

                        <?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

                           if ( $count % 3 == 0 && $count > 1 ) { ?> <div class="clearfix"></div> <?php } ?>

                           <div class="tg-column-3 tg-column-bottom-margin">
                              <?php
                              $himalayas_icon = get_post_meta( $post->ID, 'himalayas_font_icon', true );
                              $himalayas_icon = isset( $himalayas_icon ) ? esc_attr( $himalayas_icon ) : '';

                              $icon_image_class = '';
                              if( !empty ( $himalayas_icon ) ) {
                                 $icon_image_class = 'service_icon_class';
                                 $services_top = '<i class="fa ' . esc_html( $himalayas_icon ) . '"></i>';
                              }
                              if( has_post_thumbnail() ) {
                                 $icon_image_class = 'service_image_class';
                                 $services_top = get_the_post_thumbnail( $post->ID, 'himalayas-services' );
                              }

                              if( has_post_thumbnail() || !empty ( $himalayas_icon ) ) { ?>

                                 <div class="<?php echo $icon_image_class; ?>">
                                    <div class="image-wrap">
                                       <?php echo $services_top; ?>
                                    </div>
                                 </div>
                              <?php } ?>

                              <div class="service-desc-wrap">
                                 <h5 class="service-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"> <?php echo esc_html( get_the_title() ); ?></a></h5>

                                 <div class="service-content">
                                    <?php the_excerpt(); ?>
                                 </div>

                                 <a class="service-read-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php  _e( 'Read more', 'himalayas' ) ?><i class="fa fa-angle-double-right"> </i></a>
                              </div>
                           </div>
                           <?php $count++;
                        endwhile; ?>
                     </div>
                  </div>
                  <?php
                  // Reset Post Data
                  wp_reset_query();
               } ?>
            </div>
         </div>
      </div>
      <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Call to action widget.
 */
class himalayas_call_to_action_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_call_to_action_block', 'description' => __( 'Use this widget to show the call to action section.', 'himalayas' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Call To Action Widget', 'himalayas' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults[ 'background_color' ] = '#32c4d1';
      $defaults[ 'background_image' ] = '';
      $defaults[ 'text_main' ] = '';
      $defaults[ 'text_additional' ] = '';
      $defaults[ 'button_text' ] = '';
      $defaults[ 'button_url' ] = '';
      $defaults[ 'new_tab' ] = '0';
      $defaults[ 'select' ] = 'cta-text-style-1';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $background_color = esc_attr( $instance[ 'background_color' ] );
      $background_image = esc_url_raw( $instance[ 'background_image' ] );
      $text_additional = esc_textarea( $instance[ 'text_additional' ] );
      $text_main = esc_textarea( $instance[ 'text_main' ] );
      $button_text = esc_attr( $instance[ 'button_text' ] );
      $button_url = esc_url( $instance[ 'button_url' ] );
      $new_tab = esc_attr( $instance[ 'new_tab' ] ? 'checked="checked"' : '');
      $select = $instance[ 'select' ];
      ?>
      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'himalayas' ); ?></strong><br />
         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'himalayas' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#32c4d1" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php esc_html_e( 'Image:', 'himalayas' ); ?> </label> <br />
         <div class="media-uploader" id="<?php echo $this->get_field_id( 'background_image' ); ?>">
	         <div class="custom_media_preview">
	            <?php if ( $background_image != '' ) : ?>
	               <img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="max-width:100%;" />
	            <?php endif; ?>
	         </div>
	         <input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="margin-top:5px;" />
	         <button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'background_image' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'himalayas' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'himalayas' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'himalayas' ); ?></button>
	      </div>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'himalayas' ); ?></strong><br />

      <?php _e( 'Call to Action Main Text','himalayas' ); ?>
      <textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>
      <?php _e( 'Call to Action Additional Text','himalayas' ); ?>
      <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('text_additional'); ?>" name="<?php echo $this->get_field_name('text_additional'); ?>"><?php echo $text_additional; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Redirect Link:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
      </p>
      <p>
      <input class="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" type="checkbox" <?php echo $new_tab; ?> />
      <label for="<?php echo $this->get_field_id('new_tab'); ?>"><?php esc_html_e( 'Check to display link in new tab.', 'himalayas' ); ?></label>
      </p>
      <?php _e( 'Choose the layout','himalayas' ); ?>
      <p>
         <select id="<?php echo $this->get_field_id('select'); ?>" name="<?php echo $this->get_field_name('select'); ?>">
            <option value="cta-text-style-1" <?php if ( $select == 'cta-text-style-1' ) echo 'selected="selected"'; ?> ><?php _e( 'Layout One', 'himalayas' );?></option>
            <option value="cta-text-style-2" <?php if ( $select == 'cta-text-style-2' ) echo 'selected="selected"';?> ><?php _e( 'Layout Two', 'himalayas' );?></option>
         </select>
      </p>
   <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance['background_color'] =  $new_instance['background_color'];
      $instance['background_image'] =  esc_url_raw( $new_instance['background_image'] );

      if ( current_user_can('unfiltered_html') )
         $instance['text_main'] =  $new_instance['text_main'];
      else
         $instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_main']) ) ); // wp_filter_post_kses() expects slashed

      if ( current_user_can('unfiltered_html') )
         $instance['text_additional'] =  $new_instance['text_additional'];
      else
         $instance['text_additional'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_additional']) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
      $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );
      $instance[ 'new_tab' ] = isset( $new_instance[ 'new_tab' ] ) ? 1 : 0;
      $instance[ 'select' ] = $new_instance[ 'select' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $text_main = empty( $instance[ 'text_main' ] ) ? '' : $instance[ 'text_main' ];
      $text_additional = empty( $instance['text_additional'] ) ? '' : $instance['text_additional'];
      $button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
      $button_url = empty( $instance[ 'button_url' ] ) ? '#' : $instance[ 'button_url' ];
      $new_tab = !empty( $instance[ 'new_tab' ] ) ? 'true' : 'false';
      $select = isset( $instance[ 'select' ] ) ? $instance[ 'select' ] : '';

      echo $before_widget;
      $target_blank = '';
      if ($new_tab== 'true') {
         $target_blank = 'target="_blank"';
      }
      $bg_image_style = '';
      if ( !empty( $background_image ) ) {
         $bg_image_style .= 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
         $bg_image_class = 'parallax-section';
      }else {
         $bg_image_style .= 'background-color:' . $background_color . ';';
         $bg_image_class = 'no-bg-image';
      }?>
      <div class="<?php echo $bg_image_class . ' ' . $select; ?> clearfix" style="<?php echo $bg_image_style; ?>">
         <div class="parallax-overlay"></div>
         <div class="section-wrapper cta-text-section-wrapper">
            <div class="tg-container">

               <div class="cta-text-content">
                  <?php if( !empty( $text_main ) ) { ?>
                     <div class="cta-text-title">
                        <h2><?php echo esc_html( $text_main ); ?></h2>
                     </div>
                  <?php }

                  if( !empty( $text_additional ) ) { ?>
                     <div class="cta-text-desc">
                        <p><?php echo esc_html( $text_additional ); ?></p>
                     </div>
                  <?php } ?>
               </div>
               <?php if( !empty( $button_text ) ) { ?>
                  <a class="cta-text-btn" href="<?php echo $button_url; ?>" <?php echo $target_blank; ?> title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
               <?php } ?>
            </div>
         </div>
      </div>
      <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Portfolio widget section
 */
class himalayas_portfolio_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_portfolio_block', 'description' => __( 'Display some pages as Portfolio', 'himalayas') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Portfolio', 'himalayas' ), $widget_ops);
   }

   function form( $instance ) {
      $defaults[ 'portfolio_menu_id' ] = '';
      $defaults[ 'title' ] = '';
      $defaults[ 'text' ] = '';
      $defaults[ 'number' ] = 8;

      $instance = wp_parse_args( (array) $instance, $defaults );

      $portfolio_menu_id = esc_attr( $instance[ 'portfolio_menu_id' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance[ 'text' ] );
      $number = absint( $instance[ 'number' ] ); ?>

      <p><?php _e( 'Note: Enter the Portfolio Section ID and use same for Menu item.', 'himalayas' ); ?></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'portfolio_menu_id' ); ?>"><?php _e( 'Portfolio Section ID:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'portfolio_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'portfolio_menu_id' ); ?>" type="text" value="<?php echo $portfolio_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <?php _e( 'Description:','himalayas' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of pages to display:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><?php _e( 'Note: Create the pages and select Portfolio Template to display Portfolio pages.', 'himalayas' ); ?></p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance[ 'portfolio_menu_id' ] = sanitize_text_field( $new_instance[ 'portfolio_menu_id' ] );
      $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes($new_instance[ 'text' ]) ) ); // wp_filter_post_kses() expects slashed
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;

      $portfolio_menu_id = isset( $instance[ 'portfolio_menu_id' ] ) ? $instance[ 'portfolio_menu_id' ] : '';
      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 8 : $instance[ 'number' ];

      $page_array = array();
      $pages = get_pages();
      // get the pages associated with Portfolio Template.
      foreach ( $pages as $page ) {
         $page_id = $page->ID;
         $template_name = get_post_meta( $page_id, '_wp_page_template', true );
         if( $template_name == 'page-templates/template-portfolio.php' ) {
            array_push( $page_array, $page_id );
         }
      }
      $get_featured_posts = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_array,
         'orderby'               => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
      ) );

      echo $before_widget;

      $section_id = '';
      if( !empty( $portfolio_menu_id ) )
         $section_id = 'id="' . $portfolio_menu_id . '"'; ?>

      <div <?php echo $section_id; ?> class="" >
         <div class="section-wrapper">
            <div class="tg-container">
               <div class="section-title-wrapper">
                  <?php
                  if( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; }
                  if( !empty( $text ) ) { ?> <h4 class="sub-title"> <?php echo esc_textarea( $text ); ?> </h4> <?php } ?>
               </div>
            </div>

            <?php if( !empty( $page_array ) ) : ?>
               <div class="Portfolio-content-wrapper clearfix">
                  <?php
                  while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>

                     <div class="portfolio-images-wrapper">
                        <?php
                        // Get the full URI of featured image
                        $image_popup_id = get_post_thumbnail_id();
                        $image_popup_url = wp_get_attachment_url( $image_popup_id ); ?>

                        <div class="port-img">
                           <?php if( has_post_thumbnail() ) {
                              the_post_thumbnail('himalayas-portfolio-image');

                           } else { $image_popup_url = get_template_directory_uri() . '/images/placeholder-portfolio.jpg';
                              echo '<img src="' . $image_popup_url . '">';
                           } ?>
                        </div>

                        <div class="portfolio-hover">
                           <div class="port-link">
                              <a class="image-popup" href="<?php echo $image_popup_url; ?>" ><i class="fa fa-search-plus"></i></a>
                              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><i class="fa fa-link"></i></a>
                           </div>

                           <div class="port-title-wrapper">
                              <h4 class="port-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h4>
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

/**************************************************************************************/

/**
 * Featured Posts widget
 */
class himalayas_featured_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts_block', 'description' => __( 'Display latest posts or posts of specific category', 'himalayas') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts', 'himalayas' ),$widget_ops);
   }

   function form( $instance ) {
      $defaults[ 'featured_menu_id' ] = '';
      $defaults['background_color'] = '#f1f1f1';
      $defaults['background_image' ] = '';
      $defaults[ 'title' ] = '';
      $defaults[ 'text' ] = '';
      $defaults[ 'number' ] = 3;
      $defaults[ 'type' ] = 'latest';
      $defaults[ 'category' ] = '';
      $defaults['button_text'] = '';
      $defaults['button_url' ] = '';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $featured_menu_id = esc_attr( $instance[ 'featured_menu_id' ] );
      $background_color = esc_attr( $instance[ 'background_color' ] );
      $background_image = esc_url_raw( $instance[ 'background_image' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance[ 'text' ] );
      $number = absint( $instance[ 'number' ] );
      $type = $instance[ 'type' ];
      $category = $instance[ 'category' ];
      $button_text = esc_attr( $instance[ 'button_text' ] );
      $button_url = esc_url( $instance[ 'button_url' ] ); ?>

      <p><?php _e( 'Note: Enter the Featured Post Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>
       <p>
         <label for="<?php echo $this->get_field_id( 'featured_menu_id' ); ?>"><?php _e( 'Featured Post Section ID:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'featured_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'featured_menu_id' ); ?>" type="text" value="<?php echo $featured_menu_id; ?>" />
      </p>

      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'himalayas' ); ?></strong><br />
         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'himalayas' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#f1f1f1" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php esc_html_e( 'Image:', 'himalayas' ); ?> </label> <br />
         <div class="media-uploader" id="<?php echo $this->get_field_id( 'background_image' ); ?>">
	         <div class="custom_media_preview">
	            <?php if ( $background_image != '' ) : ?>
	               <img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="max-width:100%;" />
	            <?php endif; ?>
	         </div>
	         <input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="margin-top:5px;" />
	         <button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'background_image' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'himalayas' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'himalayas' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'himalayas' ); ?></button>
	      </div>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'himalayas' ); ?></strong><br />

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description:','himalayas' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'himalayas' );?><br />
         <input type="radio" <?php checked( $type,'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'himalayas' );?><br />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'himalayas' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Redirect Link:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance[ 'featured_menu_id' ] = sanitize_text_field( $new_instance[ 'featured_menu_id' ] );
      $instance[ 'background_color' ] = $new_instance[ 'background_color' ];
      $instance[ 'background_image' ] = esc_url_raw( $new_instance[ 'background_image' ] );
      $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
      if ( current_user_can( 'unfiltered_html' ) )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance[ 'text' ]) ) ); // wp_filter_post_kses() expects slashed
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];
      $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
      $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $featured_menu_id = isset( $instance[ 'featured_menu_id' ] ) ? $instance[ 'featured_menu_id' ] : '';
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 3 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
      $button_url = empty( $instance[ 'button_url' ] ) ? '#' : $instance[ 'button_url' ];

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }

      if ( !empty( $background_image ) ) {
         $bg_image_style = 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
         $bg_image_class = 'parallax-section';
      }else {
         $bg_image_style = 'background-color:' . $background_color . ';';
         $bg_image_class = 'no-bg-image';
      }

      $section_id = '';
      if( !empty( $featured_menu_id ) )
         $section_id = 'id="' . $featured_menu_id . '"';

      echo $before_widget; ?>

      <div <?php echo $section_id; ?> class="<?php echo $bg_image_class ?>" style="<?php echo $bg_image_style; ?>">
         <div class="parallax-overlay"> </div>
         <div class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper">
                  <?php if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; } ?>
                  <?php if ( !empty( $text ) ) { ?>
                     <h4 class="sub-title">
                        <?php echo esc_textarea( $text ); ?>
                     </h4>
                  <?php } ?>
               </div>

               <div class="blog-content-wrapper clearfix">
               <div class="tg-column-wrapper clearfix">

                  <?php
                  $count = 0;
                  while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

                     if ( $count % 3 == 0 && $count > 1 ) { ?> <div class="clearfix"></div> <?php } ?>

                     <div class="tg-column-3 tg-column-bottom-margin">
                     <div class="blog-block">

                        <?php if( has_post_thumbnail() ) { ?>
                           <div class="blog-img">
                              <?php the_post_thumbnail('himalayas-featured-image'); ?>
                           </div>
                         <?php } ?>

                        <div class="blog-content-wrapper">

                           <h5 class="blog-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h5>

                           <div class="posted-date">

                              <?php if( has_category() ) { ?>
                                 <span>
                                    <?php _e( 'Posted in ', 'himalayas' );
                                    the_category(', '); ?>
                                 </span>
                              <?php } ?>
                              <span>
                                 <?php _e( 'by ', 'himalayas' ); ?>
                                 <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a>
                              </span>

                              <span>
                                 <?php _e( 'on ', 'himalayas' );

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

                           <a class="blog-readmore" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php echo __( 'Read more' , 'himalayas' ) ?> <i class="fa fa-angle-double-right"> </i> </a>
                        </div>

                     </div><!-- .blog-block -->
                     </div><!-- .tg-column-3 -->

                  <?php $count++;
                  endwhile;

                  if( !empty( $button_text ) ) { ?>
                     <div class="clearfix"></div>

                     <a class="blog-view" href="<?php echo $button_url; ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
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

/**************************************************************************************/

/**
 * Our Team section.
 */
class himalayas_our_team_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_our_team_block', 'description' => __( 'Show your Team Members.', 'himalayas' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Our Team Widget', 'himalayas' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults['team_menu_id'] = '';
      $defaults[ 'background_color' ] = '#575757';
      $defaults[ 'background_image' ] = '';
      $defaults['title'] = '';
      $defaults['text'] = '';
      $defaults['number'] = '3';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $team_menu_id = esc_attr( $instance[ 'team_menu_id' ] );
      $background_color = esc_attr( $instance[ 'background_color' ] );
      $background_image = esc_url_raw( $instance[ 'background_image' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance['text'] );
      $number = absint( $instance[ 'number' ] );
      ?>

      <p><?php _e( 'Note: Enter the Our Team Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>
      <p>
         <label for="<?php echo $this->get_field_id( 'team_menu_id' ); ?>"><?php _e( 'Our Team Section ID:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'team_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'team_menu_id' ); ?>" type="text" value="<?php echo $team_menu_id; ?>" />
      </p>
      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'himalayas' ); ?></strong><br />

         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'himalayas' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#575757" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php esc_html_e( 'Background Image:', 'himalayas' ); ?> </label> <br />
         <div class="media-uploader" id="<?php echo $this->get_field_id( 'background_image' ); ?>">
	         <div class="custom_media_preview">
	            <?php if ( $background_image != '' ) : ?>
	               <img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="max-width:100%;" />
	            <?php endif; ?>
	         </div>
	         <input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="margin-top:5px;" />
	         <button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'background_image' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'himalayas' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'himalayas' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'himalayas' ); ?></button>
	      </div>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'himalayas' ); ?></strong><br />

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description:','himalayas' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of pages to display:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>
      <p><?php _e( 'Note: Create the pages and select Our Team Template to display Our Team pages.', 'himalayas' ); ?></p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'team_menu_id' ] = sanitize_text_field( $new_instance[ 'team_menu_id' ] );
      $instance['background_color'] =  $new_instance['background_color'];
      $instance['background_image'] =  esc_url_raw( $new_instance['background_image'] );
      $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $team_menu_id = isset( $instance[ 'team_menu_id' ] ) ? $instance[ 'team_menu_id' ] : '';
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance[ 'text' ] ) ? '' : $instance[ 'text' ], $instance );
      $number = empty( $instance[ 'number' ] ) ? 3 : $instance[ 'number' ];

      $page_array = array();
      $pages = get_pages();
      // get the pages associated with Our Team Template.
      foreach ( $pages as $page ) {
         $page_id = $page->ID;
         $template_name = get_post_meta( $page_id, '_wp_page_template', true );
         if( $template_name == 'page-templates/template-team.php' ) {
            array_push( $page_array, $page_id );
         }
      }

      $get_featured_pages = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_array,
         'orderby'               => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
      ) );

      if ( !empty( $background_image ) ) {
         $bg_image_style = 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
         $bg_image_class = 'parallax-section';
      }else {
         $bg_image_style = 'background-color:' . $background_color . ';';
         $bg_image_class = 'no-bg-image';
      }

      $section_id = '';
      if( !empty( $team_menu_id ) )
         $section_id = 'id="' . $team_menu_id . '"';

      echo $before_widget; ?>
      <div <?php echo $section_id; ?> class="<?php echo $bg_image_class ?> clearfix" style="<?php echo $bg_image_style; ?>">

         <div class="parallax-overlay"></div>
         <div class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper">
                  <?php if( !empty( $title ) ) echo $before_title . esc_html( $title ) . $after_title;

                  if( !empty( $text ) ) { ?>
                     <h4 class="sub-title"><?php echo esc_textarea( $text ); ?></h4>
                  <?php } ?>
               </div>

               <?php if( !empty ( $page_array ) ) :
                  $count = 0; ?>
               <div class="team-content-wrapper clearfix">
                  <div class="tg-column-wrapper clearfix">
                     <?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

                        if ( $count % 3 == 0 && $count > 1 ) { ?> <div class="clearfix"></div> <?php }

                        $title_attribute = the_title_attribute( 'echo=0' ); ?>

                        <div class="tg-column-3 tg-column-bottom-margin">
                           <div class="team-block">

                              <div class="team-img-wrapper">

                                 <div class="team-img">
                                    <?php if( has_post_thumbnail() ) {
                                       the_post_thumbnail( 'himalayas-portfolio-image' );
                                    } else { echo '<img src="' . get_template_directory_uri() . '/images/placeholder-team.jpg' . '">';
                                    } ?>
                                 </div>

                                 <div class="team-name">
                                    <?php the_title(); ?>
                                 </div>
                              </div>

                              <div class="team-desc-wrapper">
                                 <?php
                                 $output = '';
                                 $himalayas_designation = get_post_meta( $post->ID, 'himalayas_designation', true );
                                 if( !empty( $himalayas_designation ) ) {
                                    $himalayas_designation = isset( $himalayas_designation ) ? esc_attr( $himalayas_designation ) : '';
                                    $output .= '<h5 class="team-deg">' . esc_html( $himalayas_designation ) . '</h5>';
                                 }

                                 $output .= '<div class="team-content">' . '<p>' . get_the_excerpt() . '</p></div>';

                                 $output .= '<a class="team-name" href="' . get_permalink() . '" title="' . $title_attribute . '" alt ="' . $title_attribute . '">' . get_the_title() . '</a>';

                                 echo $output;
                                 $count++; ?>
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

/**************************************************************************************/

/**
 * Contact us section.
 */
class himalayas_contact_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_contact_block', 'description' => __( 'Show your Contact page.', 'himalayas' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Contact Us Widget', 'himalayas' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults[ 'contact_menu_id' ] = '';
      $defaults[ 'title' ] = '';
      $defaults[ 'text' ] = '';
      $defaults[ 'page_id' ] = '';
      $defaults[ 'shortcode' ] = '';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $contact_menu_id = esc_attr( $instance[ 'contact_menu_id' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance['text'] );
      $page_id = absint( $instance[ 'page_id' ] );
      $shortcode = esc_attr( $instance[ 'shortcode' ] );
      ?>
      <p><?php _e( 'Note: Enter the Contact Section ID and use same for Menu item. Only used for One Page Menu.', 'himalayas' ); ?></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'contact_menu_id' ); ?>"><?php _e( 'Contact Section ID:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'contact_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'contact_menu_id' ); ?>" type="text" value="<?php echo $contact_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <?php _e( 'Description:','himalayas' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p><?php _e( 'Select a Contact page.', 'himalayas' ) ?></p>
      <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'himalayas' ); ?>:</label>
      <?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'page_id' ), 'selected' => $instance[ 'page_id' ] ) ); ?>

      <p><?php _e( 'Use Contact Form Plugin and enter the shortcode here:', 'himalayas' ) ?></p>
      <p>
         <label for="<?php echo $this->get_field_id( 'shortcode' ); ?>"><?php _e( 'Shortcode', 'himalayas' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'shortcode' ); ?>" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" type="text" value="<?php echo $shortcode; ?>" />
      </p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'contact_menu_id' ] = sanitize_text_field( $new_instance[ 'contact_menu_id' ] );
      $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
      $instance[ 'shortcode' ] = sanitize_text_field( $new_instance[ 'shortcode' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $contact_menu_id = isset( $instance[ 'contact_menu_id' ] ) ? $instance[ 'contact_menu_id' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance[ 'text' ] ) ? '' : $instance['text'], $instance );
      $page_id = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';
      $shortcode = isset( $instance[ 'shortcode' ] ) ? $instance[ 'shortcode' ] : '';

      $section_id = '';
      if( !empty( $contact_menu_id ) )
         $section_id = 'id="' . $contact_menu_id . '"';

      echo $before_widget; ?>
      <div <?php echo $section_id; ?> class="section-wrapper">
         <div class="tg-container">

            <div class="section-title-wrapper">
               <?php if( !empty( $title ) ) echo $before_title . esc_html( $title ) . $after_title;

               if( !empty( $text ) ) { ?>
                  <h4 class="sub-title"><?php echo esc_textarea( $text ); ?></h4>
               <?php } ?>
            </div>

            <div class="contact-form-wrapper tg-column-wrapper clearfix">
               <?php if( $page_id ) :
                  $the_query = new WP_Query( 'page_id='.$page_id );
                  while( $the_query->have_posts() ):$the_query->the_post(); ?>

                     <div class="tg-column-2">

                        <h2 class="contact-title"> <?php the_title(); ?> </h2>

                        <div class="contact-content"> <?php the_content(); ?> </div>
                     </div>
                  <?php endwhile;
               endif;
               // Reset Post Data
               wp_reset_query();
               if ( !empty ( $shortcode ) ) { ?>
                  <div class="tg-column-2">
                     <?php echo do_shortcode( $shortcode ); ?>
                  </div>
               <?php } ?>
            </div><!-- .contact-content-wrapper -->
         </div><!-- .tg-container -->
      </div>
   <?php echo $after_widget;
   }
}
