<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */

if ( ! function_exists( 'himalayas_featured_image_slider') ):
/**
 * display slider
 */
function himalayas_featured_image_slider() { ?>

   <div id="home" class="slider-wrapper">

      <div class="bxslider">
         <?php
         $page_array = array();
         for ( $i=1; $i<=4; $i++ ) {
            $page_id = get_theme_mod( 'himalayas_slide'.$i );
            if ( !empty ($page_id ) )
               array_push( $page_array, $page_id );
         }

         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => -1,
            'post_type'             =>  array( 'page' ),
            'post__in'              => $page_array,
            'orderby'               => 'post__in'
         ) );

         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            $himalayas_slider_title = get_the_title();
            $himalayas_slider_description = get_the_excerpt();
            $himalayas_slider_image = get_the_post_thumbnail();

            if( !empty( $himalayas_slider_image ) ): ?>
            <div class="slides">

               <div class="parallax-overlay"> </div>

               <figure>
                  <?php echo $himalayas_slider_image; ?>
               </figure>

               <?php if( !empty( $himalayas_slider_title ) || !empty( $himalayas_slider_description ) ) { ?>
                  <div class="tg-container">

                     <?php if( !empty( $himalayas_slider_title ) ) { ?>
                        <h3 class="caption-title">
                           <span><?php echo $himalayas_slider_title; ?></span>
                        </h3>
                     <?php  }

                     if( !empty( $himalayas_slider_description ) ) { ?>
                        <div class="caption-sub">
                           <?php echo $himalayas_slider_description; ?>
                        </div>

                        <a class="slider-readmore" href="<?php echo get_permalink(); ?>"> <?php echo __( 'Read more', 'himalayas' ) ?></a>
                     <?php  } ?>
                  </div>
               <?php  } ?>
            </div>
            <?php  endif;
         endwhile;
         // Reset Post Data
         wp_reset_query(); ?>
      </div><!-- bxslider -->
   </div>
<?php }
endif;