<?php 

/*=================================
=            SITE VARS            =
=================================*/

$detect = new Mobile_Detect();
$device = 'desktop'; 

if ($detect->isMobile()) {
	$device = 'mobile';
} 

if ($detect->isMobile() && $detect->isTablet()) {
	$device = 'tablet';
}

// BASE
$posts_per_page = get_option('posts_per_page', 'option');
$site_title = get_field('site_title', 'option');

// LOGO
$svg_logo = get_field('svg_logo', 'option');
$png_logo = get_field('png_logo', 'option');
$logo_height = get_field('logo_height', 'option');
$logo_width = get_field('logo_width', 'option');

// LAYOUT
$site_left_right_border = get_field('site_left_right_border', 'option');
$header_position = get_field('header_position', 'option');
$header_background_transparency = get_field('header_background_transparency', 'option');
$grid_gutter = get_field('grid_gutter', 'option') . "px";
$link_decoration = get_field('link_decoration', 'option');
$separator_height = get_field('separator_height', 'option');
$separator_height_alt = get_field('separator_height_alt', 'option');

// Menus
$main_menu_type = get_field('main_menu_type', 'option');
$main_menu_width = get_field('main_menu_width', 'option');
$main_menu_text_replacer = get_field('main_menu_text_replacer', 'option');
$toggle_menu_render_type = get_field('toggle_menu_render_type', 'option');
$toggle_menu_line_height = get_field('toggle_menu_line_height', 'option');
$sidebar_menu_position = get_field('sidebar_menu_position', 'option');
$sidebar_menu_left_or_right = get_field('sidebar_menu_left_or_right', 'option');
$sidebar_menu_items_text_align = get_field('sidebar_menu_items_text_align', 'option');
$sidebar_menu_side_border = get_field('sidebar_menu_side_border', 'option');

// TYPOGRAPHY
$main_title_text_size = get_field('main_title_text_size', 'option');
$main_menu_text_size = get_field('main_menu_text_size', 'option');
$footer_text_size = get_field('footer_text_size', 'option');
$captions_text_size = get_field('captions_text_size', 'option');
$thumbnails_title_text_size = get_field('thumbnails_title_text_size', 'option');
$row_item_overlay_text_size = get_field('row_item_overlay_text_size', 'option');
$slideshow_arrow_size = get_field('slideshow_arrow_size', 'option');

// INTERFACE
$taxonomy_pagination_type = get_field('taxonomy_pagination_type', 'option');
$thumbnail_text_color = get_field('thumbnail_text_color', 'option');
$thumbnail_hover_text_color = get_field('thumbnail_hover_text_color', 'option');
$row_item_hover_background_color = get_field('row_item_hover_background_color', 'option');
$row_item_hover_text_color = get_field('row_item_hover_text_color', 'option');
$media_focus_icon = get_field('media_focus_icon', 'option');
$slideshow_default_transition_type = get_field('slideshow_default_transition_type', 'option');
$slideshow_arrow_icons = get_field('slideshow_arrow_icons', 'option');
$slideshow_control_navigation = get_field('slideshow_control_navigation', 'option');
$cover_slideshow_autoplay_delay_time = get_field('cover_slideshow_autoplay_delay_time', 'option');
$focus_mode_icons = get_field('focus_mode_icons', 'option');

// BUTTONS

$button_padding	= get_field('button_padding', 'option');
$button_color = get_field('button_color', 'option');
$button_text_color = get_field('button_text_color', 'option');
$button_font_size = get_field('button_font_size', 'option');


// MENUS
$main_menu_type = get_field('main_menu_type', 'option');
$main_menu_float_gutter = get_field('main_menu_float_gutter', 'option');
$main_menu_width = get_field('main_menu_width', 'option');
$toggle_menu_margin_top = get_field('toggle_menu_margin_top', 'option') . 'px';
$toggle_menu_margin_bottom = get_field('toggle_menu_margin_bottom', 'option') . 'px';
$toggle_menu_items_width = get_field('toggle_menu_items_width', 'option');
$toggle_menu_render_type = get_field('toggle_menu_render_type', 'option');
$toggle_menu_line_height = get_field('toggle_menu_line_height', 'option');
$toggle_menu_items_padding_top = get_field('toggle_menu_items_padding_top', 'option') . 'px';
$toggle_menu_items_padding_bottom = get_field('toggle_menu_items_padding_bottom', 'option') . 'px';
$sidebar_menu_render_type = get_field('sidebar_menu_render_type', 'option');
$sidebar_menu_line_height = get_field('sidebar_menu_line_height', 'option');
$sidebar_menu_items_padding_top = get_field('sidebar_menu_items_padding_top', 'option') . 'px';
$sidebar_menu_items_padding_bottom = get_field('sidebar_menu_items_padding_bottom', 'option') . 'px';
$sidebar_menu_side_border_width = get_field('sidebar_menu_side_border_width', 'option') . 'px';
$secondary_menu_items_width = get_field('secondary_menu_items_width', 'option');
$secondary_menu_render_type = get_field('secondary_menu_render_type', 'option');
$secondary_menu_line_height = get_field('secondary_menu_line_height', 'option');
$secondary_menu_items_padding_top = get_field('secondary_menu_items_padding_top', 'option') . 'px';
$secondary_menu_items_padding_bottom = get_field('secondary_menu_items_padding_bottom', 'option') . 'px';

// HISTORY
$history_state = get_field('history_state', 'option');
if ($history_state) {
	$history_transition_speed = get_field('history_transition_speed', 'option');
	$history_cache = get_field('history_cache', 'option');
} else {
	$transition_hybrid = get_field('transition_hybrid', 'option');
	if ($transition_hybrid) {
		$history_transition_speed = get_field('history_transition_speed', 'option');
	}
}


// WOOCOMMERCE

$product_button_bg_color					= get_field('product_button_bg_color', 'option');
$product_button_text_color					= get_field('product_button_text_color', 'option');
$product_button_padding						= get_field('product_button_padding', 'option');
$product_button_text_size					= get_field('product_button_text_size', 'option');
$add_to_cart_button_bg_color				= get_field('add_to_cart_button_bg_color', 'option');
$add_to_cart_button_text_color				= get_field('add_to_cart_button_text_color', 'option');
$add_to_cart_button_bg_color_hover			= get_field('add_to_cart_button_bg_color_hover', 'option');
$add_to_cart_button_text_color_hover		= get_field('add_to_cart_button_text_color_hover', 'option');

$link_hover_title_size						= get_field('link_hover_title_size', 'option');
$link_hover_sub_title_size					= get_field('link_hover_sub_title_size', 'option');

$info_bg_color								= get_field('info_bg_color', 'option');
$info_text_colour							= get_field('info_text_colour', 'option');
$info_font_size								= get_field('info_font_size', 'option');

$message_bg_color							= get_field('message_bg_color', 'option');
$message_text_color							= get_field('message_text_color', 'option');
$message_font_size							= get_field('message_font_size', 'option');

$error_bg_color								= get_field('error_bg_color', 'option');
$error_text_color							= get_field('error_text_color', 'option');	
$error_font_size							= get_field('error_font_size', 'option');


// SEARCH PAGE
$search_identifier = get_field('search_identifier', 'option');

//if ($device == "mobile") {
	// MOBILE
	$mobile_main_menu = get_field('mobile_main_menu', 'option');
	$mobile_header_position = get_field('mobile_header_position', 'option');
	$mobile_header_border = get_field('mobile_header_border', 'option');
	$mobile_header_bottom_margin = get_field('mobile_header_bottom_margin', 'option');
	$mobile_toggle_menu_speed = get_field('mobile_toggle_menu_speed', 'option');
	$mobile_thumbnails_force_hover = get_field('mobile_thumbnails_force_hover', 'option'); 
	$mobile_forms_border_width = get_field('mobile_forms_border_width', 'option');
	$mobile_column_response = get_field('mobile_column_response', 'option');
//}  

//if ($device == "tablet") {
	// TABLET
	$tablet_main_menu = get_field('tablet_main_menu', 'option');  
	$tablet_header_position = get_field('tablet_header_position', 'option');
	$tablet_header_border = get_field('tablet_header_border', 'option');
	$tablet_header_bottom_margin = get_field('tablet_header_bottom_margin', 'option');
	$tablet_toggle_menu_speed = get_field('tablet_toggle_menu_speed', 'option');
	$tablet_thumbnails_force_hover = get_field('tablet_thumbnails_force_hover', 'option');
	$tablet_column_response = get_field('tablet_column_response', 'option');
//}

// Extras 
$stylesheet_dir = get_bloginfo('stylesheet_directory'); 
$home = get_bloginfo('url');

$pagetype = 'index';
if (is_single()) {
	$pagetype = 'single';
} else if (is_page()) {
	$pagetype = 'page';
} else if (is_archive()) {
	$pagetype = 'archive';
}

// Sidebar menu
$sidebar_menu_state = get_field("sidebar_menu_state", "option");

if ($sidebar_menu_state) {
	$sidebar_menu_nav_select = get_field("sidebar_menu_nav_select", "option");
	$sidebar_menu_title = get_field("sidebar_menu_title", "option");
}

// Secondary menu
$secondary_menu_state = get_field("secondary_menu_state", "option");

if ($secondary_menu_state) {
	$secondary_menu_nav_select = get_field("secondary_menu_nav_select", "option");
	$secondary_menu_title = get_field("secondary_menu_title", "option");
	$secondary_menu_margin_bottom = get_field("secondary_menu_margin_bottom", "option");
}