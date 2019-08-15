jQuery( document ).ready( function () {
	//******************** sticky header *********************//
	var stickyNavTop = jQuery( '.header-wrapper' ).height();

	var stickyNav = function () {
		var scrollTop = jQuery( window ).scrollTop();

		if ( scrollTop > stickyNavTop ) {
			jQuery( '.header-wrapper' ).addClass( 'stick' );
		} else {
			jQuery( '.header-wrapper' ).removeClass( 'stick' );
		}
	};

	stickyNav();

	jQuery( window ).scroll( function () {
		stickyNav();
	} );


	//************************ one page nav ***********************************//

	jQuery( '#site-navigation' ).onePageNav( {
		currentClass    : 'current-one-page-item',
		changeHash      : false,
		scrollSpeed     : 1500,
		scrollThreshold : 0.5,
		filter          : '',
		easing          : 'swing',
		begin           : function () {
			//I get fired when the animation is starting
			var height = jQuery( '.header-wrapper' ).height();

			jQuery( '[id^=himalayas]' ).children( 'div' ).css( {
				'padding-top' : height,
				'margin-top'  : - height
			} )
		},
		end             : function () {
			//I get fired when the animation is ending
			var height = jQuery( '.header-wrapper' ).height();

			jQuery( '[id^=himalayas]' ).children( 'div' ).css( {
				'padding-top' : 0,
				'margin-top'  : 0
			} )
		},
		scrollChange    : function () {
			//I get fired when you enter a section and I pass the list item of the section
		}
	} );

	//******************************* Scroll to top *************************//

	jQuery( '.scrollup' ).click( function () {
		jQuery( 'html, body' ).animate( {
			scrollTop : 0
		}, 2000 );
		return false;
	} );

	jQuery( window ).scroll( function () {
		if ( jQuery( this ).scrollTop() > 100 ) {
			jQuery( '.scrollup' ).fadeIn();
		} else {
			jQuery( '.scrollup' ).fadeOut();
		}
	} );

	jQuery( '.map-btn' ).click( function () {
		jQuery( '#map iframe' ).slideToggle( 'slow' );
		jQuery( '.map-btn i' ).toggleClass( 'fa-angle-double-up' );
		jQuery( '.map-btn i' ).toggleClass( 'fa-angle-double-down' );
	} );


	jQuery( '.search-icon' ).click( function () {
		jQuery( '.search-box' ).toggleClass( 'active' );
	} );

	jQuery( '.search-box .close' ).click( function () {
		jQuery( '.search-box' ).removeClass( 'active' );
	} );

	//menu toggle
	jQuery( window ).on( 'load', function () {

		var width = Math.max( window.innerWidth, document.documentElement.clientWidth );

		if ( width && width <= 768 ) {
			jQuery( '.menu-toggle,#site-navigation a' ).click( function () {
				jQuery( '#site-navigation .menu-primary-container,#site-navigation div.menu' ).slideToggle();
			} );
		}
	} );

	jQuery( '#site-navigation .menu-item-has-children' ).append( '<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>' );

	jQuery( '#site-navigation .sub-toggle' ).click( function () {
		jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
		jQuery( this ).children( '.fa-angle-right' ).first().toggleClass( 'fa-angle-down' );
	} );

	// For Image popup
	if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {
		jQuery( '.image-popup' ).magnificPopup( { type : 'image' } );
	}

	//********************* bx-slider call *********************//
	if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {
		jQuery( '.bxslider' ).bxSlider( {
			auto           : true,
			pager          : false,
			mode           : 'fade',
			speed          : 900,
			pause          : 5000,
			adaptiveHeight : true,
			autoHover      : true
		} );
	}
} );

( function() {
	var container, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();
