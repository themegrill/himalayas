<?php
/**
 * Himalayas functions and definitions
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */

add_action( 'wp_enqueue_scripts', 'himalayas_scripts' );
/**
 * Enqueue scripts and styles.
 */
function himalayas_scripts() {
	// Load Google fonts
	wp_enqueue_style( 'himalayas-google-fonts', '//fonts.googleapis.com/css?family=Crimson+Text:700|Roboto:400,700,900,300' );

	// Load fontawesome
	wp_enqueue_style( 'himalayas-fontawesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	/**
	* Loads our main stylesheet.
	*/
	wp_enqueue_style( 'himalayas-style', get_stylesheet_uri() );

	// Register magnific popup script
	wp_register_script( 'himalayas-featured-image-popup', HIMALAYAS_JS_URL. '/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_style( 'himalayas-featured-image-popup-css', HIMALAYAS_JS_URL.'/magnific-popup/magnific-popup.css', array(), '1.0.0' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register bxslider Script
	wp_register_script( 'himalayas-bxslider', HIMALAYAS_JS_URL . '/jquery.bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.2.12', true );

	$slider = 0;
	for( $i=1; $i<=4; $i++ ) {
		$page_id = get_theme_mod( 'himalayas_slide'.$i );
		if ( !empty ( $page_id ) )  $slider++;
	}

	if( ( $slider > 1 ) && get_theme_mod( 'himalayas_slide_on_off', 0 ) == 1 && is_front_page() ) {
		wp_enqueue_script( 'himalayas-slider', HIMALAYAS_JS_URL . '/slider-setting.js', array( 'himalayas-bxslider' ), false, true );
	}
	// For smooth scrolling
	wp_enqueue_script( 'himalayas-onepagenav', HIMALAYAS_JS_URL . '/jquery.nav.js', array( 'jquery' ), '3.0.0', true );

	// Parallax effect
	wp_register_script( 'himalayas-parallax', HIMALAYAS_JS_URL . '/jquery.parallax-1.1.3.js', array( 'jquery' ), '1.1.3', true );

	if( is_front_page() ) {
		wp_enqueue_script( 'himalayas-background-parallax', HIMALAYAS_JS_URL . '/parallax-setting.js', array( 'himalayas-parallax' ), false, true );
	}

	// Magific popup setting
	wp_enqueue_script( 'himalayas-featured-image-popup-setting', HIMALAYAS_JS_URL. '/magnific-popup/image-popup-setting.js', array( 'himalayas-featured-image-popup' ), '1.0.0', true );

	$himalayas_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$himalayas_user_agent)) {
		wp_enqueue_script( 'html5', HIMALAYAS_JS_URL . '/html5shiv.min.js', true );
	}

	// Register Custom Script
	wp_enqueue_script( 'himalayas-custom', HIMALAYAS_JS_URL . '/himalayas.js', array( 'jquery' ), false, true );
}

/**************************************************************************************/

/**
 * Add admin scripts
 */

add_action('admin_enqueue_scripts', 'himalayas_image_uploader');

function himalayas_image_uploader( $hook ) {
	global $post_type;
	if( $hook == 'widgets.php' || $hook == 'customize.php' ) {
		 //For image uploader
		 wp_enqueue_media();
		 wp_enqueue_script( 'himalayas-script', HIMALAYAS_JS_URL . '/image-uploader.js', false, '1.0', true );

		 //For Color Picker
		 wp_enqueue_style( 'wp-color-picker' );
		 wp_enqueue_script( 'himalayas-color-picker', HIMALAYAS_JS_URL . '/color-picker.js', array( 'wp-color-picker' ), false);
	 }
	if( $post_type == 'page' ) {
		wp_enqueue_script( 'himalayas-meta-toggle', HIMALAYAS_JS_URL . '/metabox-toggle.js', false, '1.0', true );
	}
}

/****************************************************************************************/

/*
 * Related posts.
 */
if ( ! function_exists( 'himalayas_related_posts_function' ) ) {

	function himalayas_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);

		// Related by categories.
		if ( get_theme_mod( 'himalayas_related_posts', 'categories' ) == 'categories' ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( get_theme_mod( 'himalayas_related_posts', 'categories' ) == 'tags' ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}
}

/****************************************************************************************/

add_filter( 'excerpt_length', 'himalayas_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function himalayas_excerpt_length( $length ) {
	return 25;
}

add_filter( 'excerpt_more', 'himalayas_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function himalayas_continue_reading() {
	return '';
}

/**************************************************************************************/

if ( ! function_exists( 'himalayas_excerpt' ) ) :
/**
 * Returns the varying excerpt length.
 */
function himalayas_excerpt( $limit ) {
 	$excerpt = explode(' ', get_the_excerpt(), $limit);
 	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
endif;

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function himalayas_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'size' => 'medium',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'himalayas_gallery_atts', 10, 3 );

/****************************************************************************************/


add_filter( 'body_class', 'himalayas_body_class' );
/*
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function himalayas_body_class( $himalayas_header_class ) {
	if( get_theme_mod( 'himalayas_sticky_on_off', 0 ) == 1 ) {
		$himalayas_header_class[] = 'non-stick';
	}
	else {
		$himalayas_header_class[] = 'stick';
	}
	if( ( get_theme_mod( 'himalayas_slide_on_off', 0 ) == 1 && is_front_page() && get_theme_mod( 'himalayas_trans_off', 0 ) != 1 ) || ( function_exists( 'the_custom_header_markup' ) && is_front_page() && (has_header_video() || has_header_image()) && get_theme_mod( 'himalayas_trans_off', 0 ) != 1 ) ) {
		$himalayas_header_class[] = ' transparent';
	}
	else {
		$himalayas_header_class[] = ' non-transparent';
	}
	if( get_theme_mod( 'himalayas_header_logo_placement', 'header_text_only' ) == 'show_both' ) {
		$himalayas_header_class[] = ' show-both';
	}

	return $himalayas_header_class;
}

/****************************************************************************************/

if ( ! function_exists( 'himalayas_entry_meta' ) ) :
/**
 * Shows meta information of post.
 */
function himalayas_entry_meta() {
	if ( 'post' == get_post_type() ) :
		echo '<div class="entry-meta">';

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if (  ( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"> %3$s</a></span>', 'himalayas' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		); ?>

		<span class="byline author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>

		<?php
		if ( ! post_password_required() && comments_open() ) { ?>
			<span class="comments-link"><?php comments_popup_link( __( '0 Comment', 'himalayas' ), __( '1 Comment', 'himalayas' ), __( ' % Comments', 'himalayas' ) ); ?></span>
		<?php }

		if( has_category() ) { ?>
			<span class="cat-links"><?php the_category(', '); ?></span>
		 <?php }

		$tags_list = get_the_tag_list( '<span class="tag-links">', ', ', '</span>' );
		if ( $tags_list ) echo $tags_list;

		edit_post_link( __( 'Edit', 'himalayas' ), '<span class="edit-link">', '</span>' );

		echo '</div>';
	endif;
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'himalayas_layout_class' ) ) :
/**
 * Return the layout as selected by user
 */
function himalayas_layout_class() {
	global $post;
	$classes = '';

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'himalayas_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'himalayas_page_layout', true );
	}
	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

	$himalayas_default_layout = get_theme_mod( 'himalayas_default_layout', 'right_sidebar' );
	$himalayas_default_page_layout = get_theme_mod( 'himalayas_default_page_layout', 'right_sidebar' );
	$himalayas_default_post_layout = get_theme_mod( 'himalayas_default_single_posts_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $himalayas_default_page_layout == 'right_sidebar' ) { $classes = 'right_sidebar'; }
			elseif( $himalayas_default_page_layout == 'left_sidebar' ) { $classes = 'left-sidebar'; }
			elseif( $himalayas_default_page_layout == 'no_sidebar_full_width' ) { $classes = 'no-sidebar-full-width'; }
			elseif( $himalayas_default_page_layout == 'no_sidebar_content_centered' ) { $classes = 'no-sidebar'; }
		}
		elseif( is_single() ) {
			if( $himalayas_default_post_layout == 'right_sidebar' ) { $classes = 'right_sidebar'; }
			elseif( $himalayas_default_post_layout == 'left_sidebar' ) { $classes = 'left-sidebar'; }
			elseif( $himalayas_default_post_layout == 'no_sidebar_full_width' ) { $classes = 'no-sidebar-full-width'; }
			elseif( $himalayas_default_post_layout == 'no_sidebar_content_centered' ) { $classes = 'no-sidebar'; }
		}
		elseif( $himalayas_default_layout == 'right_sidebar' ) { $classes = 'right_sidebar'; }
		elseif( $himalayas_default_layout == 'left_sidebar' ) { $classes = 'left-sidebar'; }
		elseif( $himalayas_default_layout == 'no_sidebar_full_width' ) { $classes = 'no-sidebar-full-width'; }
		elseif( $himalayas_default_layout == 'no_sidebar_content_centered' ) { $classes = 'no-sidebar'; }
	}
	elseif( $layout_meta == 'right_sidebar' ) { $classes = 'right_sidebar'; }
	elseif( $layout_meta == 'left_sidebar' ) { $classes = 'left-sidebar'; }
	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes = 'no-sidebar-full-width'; }
	elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes = 'no-sidebar'; }

	return $classes;
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'himalayas_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
function himalayas_sidebar_select() {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'himalayas_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'himalayas_page_layout', true );
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

	$himalayas_default_layout = get_theme_mod( 'himalayas_default_layout', 'right_sidebar' );
	$himalayas_default_page_layout = get_theme_mod( 'himalayas_default_page_layout', 'right_sidebar' );
	$himalayas_default_post_layout = get_theme_mod( 'himalayas_default_single_posts_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $himalayas_default_page_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $himalayas_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		elseif( is_single() ) {
			if( $himalayas_default_post_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $himalayas_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		elseif( $himalayas_default_layout == 'right_sidebar' ) { get_sidebar(); }
		elseif ( $himalayas_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
	}
	elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
	elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/**************************************************************************************/

if ( ! function_exists( 'himalayas_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function himalayas_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'himalayas' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'himalayas' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 74 );
					printf( '<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'himalayas' ) . '</span>' : ''
					);
					printf( '<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
						sprintf( __( '%1$s at %2$s', 'himalayas' ), get_comment_date(), get_comment_time() )
					);
					printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
					edit_comment_link();
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'himalayas' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'himalayas' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**************************************************************************************/

add_action( 'himalayas_footer_copyright', 'himalayas_footer_copyright', 10 );
/**
 * Function to show the footer info, copyright information
 */
if ( ! function_exists( 'himalayas_footer_copyright' ) ) :
function himalayas_footer_copyright() {
	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>';

	$wp_link = '<a href="http://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'himalayas' ) . '">' . __( 'WordPress', 'himalayas' ) . '</a>';

	$tg_link =  '<a href="'. 'https://themegrill.com/themes/himalayas' .'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'himalayas' ).'" rel="author">'.__( 'ThemeGrill', 'himalayas') .'</a>';

	$default_footer_value = '<span class="copyright-text">' . sprintf( __( 'Copyright &copy; %1$s %2$s.', 'himalayas' ), date( 'Y' ), $site_link ).' '.sprintf( __( 'Theme: %1$s by %2$s.', 'himalayas' ), 'Himalayas', $tg_link ).' '.sprintf( __( 'Powered by %s.', 'himalayas' ), $wp_link ) . '</span>';

	$himalayas_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
	echo $himalayas_footer_copyright;
}
endif;

/**************************************************************************************/

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
function himalayas_hex2rgb($hexstr) {
    $int = hexdec($hexstr);
    $rgb = array("red" => 0xFF & ($int >> 0x10), "green" => 0xFF & ($int >> 0x8), "blue" => 0xFF & $int);
    $r = $rgb['red'];
    $g = $rgb['green'];
    $b = $rgb['blue'];

    return "rgba($r,$g,$b, 0.85)";
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function himalayas_darkcolor($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

add_action( 'wp_head', 'himalayas_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function himalayas_custom_css() {
   $primary_color   = get_theme_mod( 'himalayas_primary_color', '#32c4d1' );
   $primary_dark    = himalayas_darkcolor($primary_color, -40);
   $primary_opacity = himalayas_hex2rgb($primary_color);

   $himalayas_internal_css = '';
   if( $primary_color != '#32c4d1' ) {
      $himalayas_internal_css = ' .about-btn a:hover,.bttn:hover,.icon-img-wrap:hover,.navigation .nav-links a:hover,.service_icon_class .image-wrap:hover i,.slider-readmore:before,.subscribe-form .subscribe-submit .subscribe-btn,button,input[type=button]:hover,input[type=reset]:hover,input[type=submit]:hover,.contact-form-wrapper input[type=submit],.default-wp-page a:hover,.team-desc-wrapper{background:'.$primary_color.'}a, .cta-text-btn:hover,.blog-readmore:hover, .entry-meta a:hover,.entry-meta > span:hover::before,#content .comments-area article header cite a:hover, #content .comments-area a.comment-edit-link:hover, #content .comments-area a.comment-permalink:hover,.comment .comment-reply-link:hover{color:'.$primary_color.'}.comments-area .comment-author-link span{background-color:'.$primary_color.'}.slider-readmore:hover{border:1px solid '.$primary_color.'}.icon-wrap:hover,.image-wrap:hover,.port-link a:hover{border-color:'.$primary_color.'}.main-title:after,.main-title:before{border-top:2px solid '.$primary_color.'}.blog-view,.port-link a:hover{background:'.$primary_color.'}.port-title-wrapper .port-desc{color:'.$primary_color.'}#top-footer a:hover,.blog-title a:hover,.entry-title a:hover,.footer-nav li a:hover,.footer-social a:hover,.widget ul li a:hover,.widget ul li:hover:before{color:'.$primary_color.'}.scrollup{background-color:'.$primary_color.'}#stick-navigation li.current-one-page-item a,#stick-navigation li:hover a,.blog-hover-link a:hover,.entry-btn .btn:hover{background:'.$primary_color.'}#secondary .widget-title:after,#top-footer .widget-title:after{background:'.$primary_color.'}.widget-tags a:hover,.sub-toggle{background:'.$primary_color.';border:1px solid '.$primary_color.'}#site-navigation .menu li.current-one-page-item > a,#site-navigation .menu li:hover > a,.about-title a:hover,.caption-title a:hover,.header-wrapper.no-slider #site-navigation .menu li.current-one-page-item > a,.header-wrapper.no-slider #site-navigation .menu li:hover > a,.header-wrapper.no-slider .search-icon:hover,.header-wrapper.stick #site-navigation .menu li.current-one-page-item > a,.header-wrapper.stick #site-navigation .menu li:hover > a,.header-wrapper.stick .search-icon:hover,.scroll-down,.search-icon:hover,.service-title a:hover,.service-read-more:hover,.num-404,blog-readmore:hover{color:'.$primary_color.'}.error{background:'.$primary_color.'}.blog-view:hover,.scrollup:hover,.contact-form-wrapper input[type="submit"]:hover{background:'.$primary_dark.'}.blog-view{border-color:'.$primary_dark.'}.posted-date span a:hover, .copyright-text a:hover,.contact-content a:hover,.logged-in-as a:hover, .logged-in-as a hover{color:'.$primary_dark.'}.widget_call_to_action_block .parallax-overlay,.search-box,.scrollup,.sub-toggle:hover{background-color:'.$primary_opacity.'}.author-box{border:1px solid ' . $primary_color . '}';
   }

   if( !empty( $himalayas_internal_css ) ) {
      ?>
      <style type="text/css"><?php echo $himalayas_internal_css; ?></style>
      <?php
   }

   $himalayas_custom_css = get_theme_mod( 'himalayas_custom_css' );
   if( $himalayas_custom_css && ! function_exists( 'wp_update_custom_css_post' ) ) {
      echo '<!-- '.get_bloginfo('name').' Custom Styles -->';
      ?><style type="text/css"><?php echo esc_html( $himalayas_custom_css ); ?></style><?php
   }
}

/**************************************************************************************/

if ( ! function_exists( 'himalayas_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function himalayas_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'himalayas' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'himalayas' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'himalayas' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'himalayas' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'himalayas' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'himalayas' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'himalayas' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'himalayas' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'himalayas' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'himalayas' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'himalayas' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'himalayas' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'himalayas' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'himalayas' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'himalayas_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function himalayas_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'himalayas_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'himalayas_wrapper_end', 10);

add_action( 'woocommerce_sidebar', 'himalayas_get_sidebar', 10 );

function himalayas_wrapper_start() {
   $himalayas_woo_layout = himalayas_layout_class();

  echo '<div id="content" class="site-content"><main id="main" class="clearfix ' . $himalayas_woo_layout . '"><div class="tg-container"><div id="primary">';
}

function himalayas_wrapper_end() {
  echo '</div>';
}
function himalayas_get_sidebar() {
   himalayas_sidebar_select();
   echo '</div></main></div>';
}

// Displays the site logo
if ( ! function_exists( 'himalayas_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function himalayas_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' )  && ( get_theme_mod( 'himalayas_logo','' ) == '') ) {
			the_custom_logo();
		}
	}
}

/**
  * Migrate any existing theme CSS codes added in Customize Options to the core option added in WordPress 4.7
  */
 function himalayas_custom_css_migrate() {

 	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$custom_css = get_theme_mod( 'himalayas_custom_css' );
		if ( $custom_css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return = wp_update_custom_css_post( $core_css . $custom_css );
			if ( ! is_wp_error( $return ) ) {
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				remove_theme_mod( 'himalayas_custom_css' );
			}
		}
	}
}

add_action( 'after_setup_theme', 'himalayas_custom_css_migrate' );

/**
 * Function to transfer the Header Logo added in Customizer Options of theme to Site Logo in Site Identity section
 */
function himalayas_site_logo_migrate() {
	if ( function_exists( 'the_custom_logo' ) && ! has_custom_logo( $blog_id = 0 ) ) {
		$logo_url = get_theme_mod( 'himalayas_logo' );

		if ( $logo_url ) {
			$customizer_site_logo_id = attachment_url_to_postid( $logo_url );
			set_theme_mod( 'custom_logo', $customizer_site_logo_id );

			// Delete the old Site Logo theme_mod option.
			remove_theme_mod( 'himalayas_logo' );
		}
	}
}

add_action( 'after_setup_theme', 'himalayas_site_logo_migrate' );
