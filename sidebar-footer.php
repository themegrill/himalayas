<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'himalayas_footer_sidebar_one' ) &&
   !is_active_sidebar( 'himalayas_footer_sidebar_two' ) &&
   !is_active_sidebar( 'himalayas_footer_sidebar_three' ) ) {
   return;
}
?>
<div id="top-footer">
	<div class="tg-container">
		<div class="tg-column-wrapper">

         <?php if( is_active_sidebar( 'himalayas_footer_sidebar_one' ) ): ?>
         	<div class="tg-column-3">
		         <?php
		         // Calling the footer sidebar one if it exists.
		         if ( !dynamic_sidebar( 'himalayas_footer_sidebar_one' ) ):
		         endif; ?>
		      </div>
		   <?php endif; ?>

		   <?php if( is_active_sidebar( 'himalayas_footer_sidebar_two' ) ): ?>
         	<div class="tg-column-3">
		         <?php
		         // Calling the footer sidebar two if it exists.
		         if ( !dynamic_sidebar( 'himalayas_footer_sidebar_two' ) ):
		         endif; ?>
		      </div>
		   <?php endif; ?>

		   <?php if( is_active_sidebar( 'himalayas_footer_sidebar_three' ) ): ?>
         	<div class="tg-column-3">
		         <?php
		         // Calling the footer sidebar three if it exists.
		         if ( !dynamic_sidebar( 'himalayas_footer_sidebar_three' ) ):
		         endif; ?>
		      </div>
		   <?php endif; ?>

      </div> <!-- .tg-column-wrapper -->
   </div> <!-- .tg-container -->
</div> <!-- .top-footer -->