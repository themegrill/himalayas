<?php
/**
 * The template used for displaying page content.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php do_action( 'himalayas_before_post_content' ); ?>

   <?php if ( is_front_page() ):
      the_title( '<h2 class="entry-title">', '</h2>' );
   else:
      the_title( '<h1 class="entry-title">', '</h1>' );
   endif; ?>

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