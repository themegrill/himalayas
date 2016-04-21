<?php
/**
 * The template used for displaying post content.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php do_action( 'himalayas_before_post_content' );

   the_title( sprintf( '<h2 class="entry-title"><a href="%s" title="%s">', esc_url( get_permalink() ), the_title_attribute('echo=0') ), '</a></h2>' );

   himalayas_entry_meta();

   // Post thumbnail.
   if ( has_post_thumbnail() ) { ?>
      <div class="entry-thumbnail">
         <?php
            // Get the full URI of featured image
            $image_popup_id = get_post_thumbnail_id();
            $image_popup_url = wp_get_attachment_url( $image_popup_id );

            the_post_thumbnail( 'himalayas-featured-post' );
         ?>

         <div class="blog-hover-effect">
            <div class="blog-hover-link">
               <a class="image-popup" href="<?php echo $image_popup_url; ?>" class="blog-link blog-img-zoom"> <i class="fa fa-search-plus"> </i> </a>
               <a href="<?php the_permalink(); ?>" class="blog-link blog-inner-link"> <i class="fa fa-link"> </i> </a>
            </div>
         </div>
      </div> <!-- entry-thumbnail -->
   <?php } ?>

   <div class="entry-content">
      <?php
      global $more;
      $more = 0;
      if( get_theme_mod( 'himalayas_content_show', 'show_full_post_content' ) == 'show_excerpt' ) {
         the_excerpt(); ?>
         <div class="entry-btn">
            <a class="btn" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'himalayas' ); ?>
            </a>
         </div>
      <?php }
      else {
         the_content( '<span>'. __( 'Read more', 'himalayas' ) .'</span>' );
      } ?>
   </div>

   <?php do_action( 'himalayas_after_post_content' ); ?>
</article>