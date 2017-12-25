/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ( $ ) {
	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Primary color option
	wp.customize( 'himalayas_primary_color', function ( value ) {
		value.bind( function ( primaryColor ) {
			// Store internal style for primary color
			var primaryColorStyle = '<style id="himalayas-internal-primary-color"> .about-btn a:hover,.bttn:hover,.icon-img-wrap:hover,' +
			'.navigation .nav-links a:hover,.service_icon_class .image-wrap:hover i,.slider-readmore:before,.subscribe-form .subscribe-submit .subscribe-btn,' +
			'button,input[type=button]:hover,input[type=reset]:hover,input[type=submit]:hover,.contact-form-wrapper input[type=submit],.default-wp-page a:hover,' +
			'.team-desc-wrapper{background:' + primaryColor + '}' +
			'a, .cta-text-btn:hover,.blog-readmore:hover, .entry-meta a:hover,.entry-meta > span:hover::before,' +
			'#content .comments-area article header cite a:hover, #content .comments-area a.comment-edit-link:hover, #content .comments-area a.comment-permalink:hover,' +
			'.comment .comment-reply-link:hover{color:' + primaryColor + '}' +
			'.comments-area .comment-author-link span{background-color:' + primaryColor + '}' +
			'.slider-readmore:hover{border:1px solid ' + primaryColor + '}' +
			'.icon-wrap:hover,.image-wrap:hover,.port-link a:hover{border-color:' + primaryColor + '}' +
			'.main-title:after,.main-title:before{border-top:2px solid ' + primaryColor + '}' +
			'.blog-view,.port-link a:hover{background:' + primaryColor + '}' +
			'.port-title-wrapper .port-desc{color:' + primaryColor + '}' +
			'#top-footer a:hover,.blog-title a:hover,.entry-title a:hover,.footer-nav li a:hover,.footer-social a:hover,' +
			'.widget ul li a:hover,.widget ul li:hover:before{color:' + primaryColor + '}' +
			'.scrollup{background-color:' + primaryColor + '}' +
			'#stick-navigation li.current-one-page-item a,#stick-navigation li:hover a,.blog-hover-link a:hover,' +
			'.entry-btn .btn:hover{background:' + primaryColor + '}' +
			'#secondary .widget-title:after,#top-footer .widget-title:after{background:' + primaryColor + '}' +
			'.widget-tags a:hover,.sub-toggle{background:' + primaryColor + ';border:1px solid ' + primaryColor + '}' +
			'#site-navigation .menu li.current-one-page-item > a,#site-navigation .menu li:hover > a,.about-title a:hover,' +
			'.caption-title a:hover,.header-wrapper.no-slider #site-navigation .menu li.current-one-page-item > a,' +
			'.header-wrapper.no-slider #site-navigation .menu li:hover > a,.header-wrapper.no-slider .search-icon:hover,' +
			'.header-wrapper.stick #site-navigation .menu li.current-one-page-item > a,.header-wrapper.stick #site-navigation .menu li:hover > a,' +
			'.header-wrapper.stick .search-icon:hover,.scroll-down,.search-icon:hover,.service-title a:hover,.service-read-more:hover,' +
			'.num-404,blog-readmore:hover{color:' + primaryColor + '}' +
			'.error{background:' + primaryColor + '}</style>';

			// Remove previously create internal style and add new one.
			$( 'head #himalayas-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );
		}
		);
	} );
})( jQuery );