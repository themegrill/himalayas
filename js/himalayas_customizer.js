/**
 * Theme Customizer related js
 */

jQuery(document).ready(function() {

   jQuery('#customize-info .preview-notice').append(
		'<a class="themegrill-pro-info" href="http://themegrill.com/themes/himalayas-pro/" target="_blank">{pro}</a>'
		.replace('{pro}',himalayas_customizer_obj.pro));

});