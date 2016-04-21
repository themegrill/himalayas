<?php
/**
 * Front Page Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<?php get_header(); ?>

	<div id="content" class="site-content">
		<?php
	   if( is_active_sidebar( 'himalayas_front_page_section' ) ) {
	   	if ( !dynamic_sidebar( 'himalayas_front_page_section' ) ):
	   	endif;
	   }

	   $himalayas_layout = himalayas_layout_class();

	   if( get_theme_mod( 'himalayas_hide_blog_front' , 0 ) != 1 ): ?>
		   <main id="main" class="clearfix <?php echo $himalayas_layout; ?>">
				<div class="tg-container">
					<div id="primary" class="content-area">

		            <?php if ( have_posts() ):

		               while ( have_posts() ) : the_post();

		                  if ( is_front_page() && is_home() ) {
		                  	get_template_part( 'content', '' );
		                  } elseif ( is_front_page() ) {
		                  	get_template_part( 'content', 'page' );
		                  }
		               endwhile;

		               get_template_part( 'navigation', 'none' );
		            else:
		               get_template_part( 'no-results', 'none' );
		            endif; ?>
			      </div>

			      <?php himalayas_sidebar_select(); ?>
			   </div>
			</main>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>