jQuery(document).ready(function() {
    //******************** sticky header *********************//
    var stickyNavTop = jQuery('.header-wrapper').height();

    var stickyNav = function() {
        var scrollTop = jQuery(window).scrollTop();

        if (scrollTop > stickyNavTop) {
            jQuery('.header-wrapper').addClass('stick');
        } else {
            jQuery('.header-wrapper').removeClass('stick');
        }
    };

    stickyNav();

    jQuery(window).scroll(function() {
        stickyNav();
    });


    //************************ one page nav ***********************************//

    jQuery('#site-navigation').onePageNav({
        currentClass: 'current-one-page-item',
        changeHash: false,
        scrollSpeed: 1500,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',
        begin: function() {
            //I get fired when the animation is starting
        },
        end: function() {
            //I get fired when the animation is ending
        },
        scrollChange: function(jQuerycurrentListItem) {
            //I get fired when you enter a section and I pass the list item of the section
        }
    });

    //******************************* Scroll to top *************************//

    jQuery('.scrollup').click(function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    });


    jQuery('.map-btn').click(function() {
        jQuery('#map iframe').slideToggle('slow');
        jQuery('.map-btn i').toggleClass('fa-angle-double-up');
        jQuery('.map-btn i').toggleClass('fa-angle-double-down');
    });


    jQuery('.search-icon').click(function() {
        jQuery('.search-box').toggleClass('active');
    });

    jQuery('.search-box .close').click(function() {
        jQuery('.search-box').removeClass('active');
    });

	//menu toggle
	jQuery(window).on('load', function() {

			var width = Math.max(window.innerWidth, document.documentElement.clientWidth);

        	 if (width && width <= 768) {
	        jQuery('.menu-toggle,#site-navigation a').click(function() {
	            jQuery('#site-navigation .menu-primary-container,#site-navigation div.menu').slideToggle();
	        });
	    	}
	});

   jQuery('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

   jQuery('#site-navigation .sub-toggle').click(function() {
      jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
      jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
   });
});