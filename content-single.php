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

   the_title( '<h1 class="entry-title">', '</h1>' );

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
            </div>
         </div>
      </div><!-- entry-thumbnail -->
   <?php } ?>

   <div class="entry-content">
      <?php
         the_content();
         wp_link_pages( array(
            'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'himalayas' ),
            'after'             => '</div>',
            'link_before'       => '<span>',
            'link_after'        => '</span>'
         ) );
      ?>
   </div>

   <?php do_action( 'himalayas_after_post_content' ); ?>
</article>