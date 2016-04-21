jQuery(document).ready(function() {
    //************************ Background scroll *****************************//

    var width = Math.max(window.innerWidth, document.documentElement.clientWidth);

    if ( width && width >= 768 ) {
        jQuery('.parallax-section').each(function() {
        	jQuery(this).parallax('center', 0.2, true);
        });
	}

    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

});