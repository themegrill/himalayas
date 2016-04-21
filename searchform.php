<?php
/**
 * The template for displaying search forms in himalayas
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'himalayas' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button type="submit" class="searchsubmit" name="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'himalayas' ); ?>"><i class="fa fa-search"></i></button>
</form>