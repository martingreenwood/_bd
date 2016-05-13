<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

/*==============================================
=            DEQUEUE STOREFRONT CSS            =
==============================================*/

function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}
add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/*=========================================
=            DISABLE ADMIN BAR            =
=========================================*/

function remove_admin_bar() {
	show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar');

/*=======================================
=            REGISTER MENUES            =
=======================================*/

function _bd_menues() {
	register_nav_menu( 'shop', __( 'Shop', 'storefront' ) );
}
add_action( 'after_setup_theme', '_bd_menues' );

/*================================================
=            ENQUEUE SCRIPTS & STYLES            =
================================================*/

function bd_enqueue_jquery() {
	// Load jQuery from Google CDN, fallback to local
	if( !is_admin()){ 
	// Don't do this for admin area, since Google's jQuery isn't in noConflict mode and will interfere with WP's admin area.
	$url = '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'; // the URL to check against
	$test_url = @fopen($url,'r'); // test parameters
	
	if($test_url !== false) { // test if the URL exists
		function load_external_jQuery() { // load external file
			wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery
			wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); // register the external file
			wp_enqueue_script('jquery'); // enqueue the external file
		}
		add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function
	} else {
		function load_local_jQuery() {
			//wp_deregister_script('jquery'); // deregisters the default WordPress jQuery
			//wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); // register the local file
			wp_enqueue_script('jquery'); // enqueue the local file
		}
		add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function
		}
	}
}

add_action('wp_enqueue_scripts', 'bd_enqueue_jquery', 1);

function lvy_scripts() {
	wp_enqueue_style( 'fa', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
	wp_enqueue_style( '1412Font', get_stylesheet_directory_uri() . '/fonts//1412/1412-QNXWMI.css' );
	
	wp_enqueue_script( 'isotope', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', '', '', true );
	wp_enqueue_script( 'masonry', get_stylesheet_directory_uri() . '/assets/js/masonry.pkgd.min.js', '', '', true );
	wp_enqueue_script( 'css3MQ', get_stylesheet_directory_uri() . '/assets/js/css3-mediaqueries.js', '', '', true );
	wp_enqueue_script( 'plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.min.js', array( "jquery" ), '', true );

	wp_enqueue_script( 'history', get_stylesheet_directory_uri() . '/assets/js/jquery.history.js', '', '', true );	

	//wp_enqueue_script( 'nav', get_stylesheet_directory_uri() . '/assets/js/nav.js', array( "jquery" ), '', true );
	wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/assets/js/app.js', array( "jquery" ), '', true );
	wp_enqueue_script( 'ui', get_stylesheet_directory_uri() . '/assets/js/ui.max.js', array( "jquery" ), '', true );

}
add_action( 'wp_enqueue_scripts', 'lvy_scripts' );

/*==========================================
=            REMOVE BREADCRUMBS            =
==========================================*/

function bd_remove_storefront_breadcrumb() {
	remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 	10 );
}
add_action( 'init', 'bd_remove_storefront_breadcrumb' );

/*===================================
=            HEX to GGBA            =
===================================*/

function hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
	return $default; 
	//Sanitize $color if "#" is provided 
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	//Check if color has 6 or 3 characters and get values
	if (strlen($color) == 6) {
	        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
	        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
	        return $default;
	}
	//Convert hexadec to rgb
	$rgb =  array_map('hexdec', $hex);
	//Check if opacity is set(rgba or rgb)
	if($opacity){
		if(abs($opacity) > 1)
			$opacity = 1.0;
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}
	//Return rgb(a) color string
	return $output;
}

function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);

	return $rgb; // returns an array with the rgb values
}

/*========================================
=            DETECT PAGE TYPE            =
========================================*/

//Determine the wordpress page type
function detectPageType() {
  
  if ( is_front_page() && get_option('show_on_front') == 'posts' ) {
    $pagetype =  'front-page';
  } else if ( is_home() && get_option('show_on_front') == 'page' ) {
    $pagetype =  'front-page';
  } else if ( is_attachment() ) {
    $pagetype =  'attachment';					// must be before is_single(), otherwise detects as 'single'
  } else if ( is_single() ) {
    $pagetype =  'single';
  } else if ( is_page() ) {
    $pagetype =  'page';
  } else if ( is_author() ) {
    $pagetype =  'author';
  } else if ( is_category() ) {
    $pagetype =  'category';
  } else if ( is_tag() ) {
    $pagetype =  'tag';
  } else if ( function_exists('is_post_type_archive') && is_post_type_archive() ) {
    $pagetype =  'cp_archive';				// must be before is_archive(), otherwise detects as 'archive' in WP 3.1.0
  } else if ( function_exists('is_tax') && is_tax() ) {
    $pagetype =  'tax_archive';
  } else if ( is_archive() && ! is_category() && ! is_author() && ! is_tag() ) {
    $pagetype =  'archive';
  } else if ( function_exists('bbp_is_single_user') && (bbp_is_single_user() || bbp_is_single_user_edit()) ) {	// must be before is_404(), otherwise bbPress profile page is detected as 'e404'.
    $pagetype =  'bbp_profile';
  } else if ( is_404() ) {
    $pagetype =  'e404';
  } else if ( is_search() ) {
    $pagetype =  'search';
  } else if ( function_exists('is_pod_page') && is_pod_page() ) {
    $pagetype =  'pods';
  } else {
    $pagetype =  'undefined';
  }
  
  //echo  'Page Type: ' . $pagetype;
  return $pagetype;
}
add_action('wp_head','detectPageType');

/*======================================================
=            CHANGE NUM OF VISABLE PRODUCTS            =
======================================================*/

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 30;' ), 20 );

/*=====================================
=            MOBILE DETECT            =
=====================================*/

require get_stylesheet_directory() . '/inc/mobile-detect/Mobile_Detect.php';

/*===========================================
=            ENQUEUE ACF OPTIONS            =
===========================================*/

require get_stylesheet_directory() . '/inc/options.php';
require get_stylesheet_directory() . '/inc/vars.php';

/*====================================================
=            ENQUEUE WOOCOMMERCE NAV ITEM            =
====================================================*/

require get_stylesheet_directory() . '/inc/wordpress-woocommerce-cart-icon-nav.php';

/*============================================
=            WooCommerce Overides            =
============================================*/

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' );
function woo_custom_cart_button_text() {
	return __( 'Add to Cart', 'woocommerce' );
}

add_filter( 'woocommerce_order_button_text', create_function( '', 'return "Place Order";' ) );

