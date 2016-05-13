<?php
/**
 * ACF Options
 * @package _bd
 */

/*========================================
=            ADD Options page            =
========================================*/

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'BD Settings',
		'menu_title' 	=> 'BD Settings',
		'menu_slug' 	=> 'bd-settings',
		'capability' 	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-admin-tools',
		'redirect' 		=> false,
	));
}

/*========================================
=            CUSTOM POST TYES            =
========================================*/

add_action( 'init', 'bd_create_post_type' );
function bd_create_post_type() {

	register_post_type( 'projects',
		array(
			'labels' => array(
			'name' => __( 'Projects' ),
			'singular_name' => __( 'Project' )
		),
		'public' => true,
		'rewrite' => array('slug' => 'project'),
		'has_archive' => false,
		)
	);

	register_post_type( 'services',
		array(
			'labels' => array(
			'name' => __( 'Services' ),
			'singular_name' => __( 'Services' )
		),
		'public' => true,
		'rewrite' => array('slug' => 'service'),
		'has_archive' => false,
		)
	);

	register_post_type( 'workshops',
		array(
			'labels' => array(
			'name' => __( 'Workshops' ),
			'singular_name' => __( 'Workshop' )
		),
		'public' => true,
		'rewrite' => array('slug' => 'workshop'),
		'has_archive' => false,
		)
	);

}


/*======================================
=            RECOMPILE SCSS            =
======================================*/

define('WP_SCSS_ALWAYS_RECOMPILE', true);

/*==========================================
=            SET SCSS VARIABLES            =
==========================================*/

function wp_scss_set_variables(){
    $variables = array(

		//COLOUR
		'news_background_colour'			=> get_field("news_background_colour", "option"),
		
		'color__background' 				=> '#000',
		'color__background-screen' 			=> '#f1f1f1',
		'color__background-hr' 				=> '#ccc',
		'color__background-button' 			=> '#e6e6e6',
		'color__background-pre' 			=> '#eee',
		'color__background-ins' 			=> '#fff9c0',

		'color__text-screen' 				=> '#21759b',
		'color__text-input' 				=> '#666',
		'color__text-input-focus' 			=> '#111',
		'color__link' 						=> 'blue',
		'color__link-visited' 				=> 'purple',
		'color__link-hover' 				=> 'midnightblue', 
		'color__text-main' 					=> '#404040',

		'color__border-button' 				=> '#ccc #ccc #bbb',
		'color__border-button-hover' 		=> '#ccc #bbb #aaa',
		'color__border-button-focus' 		=> '#aaa #bbb #bbb',
		'color__border-input' 				=> '#ccc',
		'color__border-abbr' 				=> '#666',

		// TYPE
		'font__main' 						=> get_field("default_font", "option"),
		'font__main-size' 					=> get_field("default_font_size", "option"),
		'font__main-line-height'			=> get_field("default_line_height", "option"),

		'font__main-small' 					=> get_field("small_font", "option"),
		'font__main-small-size' 			=> get_field("small_font_size", "option"),
		'font__main-small-line-height' 		=> get_field("small_line_height", "option"),

		'font__main-large' 					=> get_field("large_font", "option"),
		'font__main-large-size' 			=> get_field("large_font_size", "option"),
		'font__main-large-line-height' 		=> get_field("large_line_height", "option"),

		'font__main-huge' 					=> get_field("huge_font", "option"),
		'font__main-huge-size' 				=> get_field("huge_font_size", "option"),
		'font__main-huge-line-height' 		=> get_field("huge_line_height", "option"),

		'font__main-mega' 					=> get_field("mega_font", "option"),
		'font__main-mega-size' 				=> get_field("mega_font_size", "option"),
		'font__main-mega-line-height' 		=> get_field("mega_line_height", "option"),

		'font__code' 						=> 'Monaco, Consolas, Andale Mono, DejaVu Sans Mono, monospace',
		'font__pre' 						=> 'Courier 10 Pitch, Courier, monospace',
		'font__line-height-body' 			=> '1.5',
		'font__line-height-pre' 			=> '1.6',

		'main_title_text_size'				=> get_field("main_title_text_size", "option"),
		'main_menu_text_size'				=> get_field("main_menu_text_size", "option"),
		'toggle_menu_text_size'				=> get_field("toggle_menu_text_size", "option"),
		'sidebar_menu_text_size'			=> get_field("sidebar_menu_text_size", "option"),
		'secondary_menu_text_size'			=> get_field("secondary_menu_text_size", "option"),
		'footer_text_size'					=> get_field("footer_text_size", "option"),
		'captions_text_size'				=> get_field("captions_text_size", "option"),
		'thumbnails_title_text_size'		=> get_field("thumbnails_title_text_size", "option"),
		'row_item_overlay_text_size'		=> get_field("row_item_overlay_text_size", "option"),
		'index_text_size'					=> get_field("index_text_size", "option"),
		'slideshow_arrow_size'				=> get_field("slideshow_arrow_size", "option"),
		'focus_trigger_icon_size'			=> get_field("focus_trigger_icon_size", "option"),
		'focus_left_right_close_icon_size'	=> get_field("focus_left_right_close_icon_size", "option"),
		'focus_counter_text_size'			=> get_field("focus_counter_text_size", "option"),
		'comments_text_size_1'				=> get_field("comments_text_size_1", "option"),
		'comments_text_size_2'				=> get_field("comments_text_size_2", "option"),

		// Text definitions
		'default_font' 						=> get_field("default_font", "option"),
		'default_font_size' 				=> get_field("default_font_size", "option"),
		'default_font_line_height' 			=> get_field("default_line_height", "option"),
		'small_font'	 					=> get_field("small_font", "option"),
		'small_font_size' 					=> get_field("small_font_size", "option"),
		'small_font_line_height' 			=> get_field("small_line_height", "option"),
		'large_font' 						=> get_field("large_font", "option"),
		'large_font_size' 					=> get_field("large_font_size", "option"),
		'large_font_line_height' 			=> get_field("large_line_height", "option"),
		'huge_font' 						=> get_field("huge_font", "option"),
		'huge_font_size' 					=> get_field("huge_font_size", "option"),
		'huge_font_line_height' 			=> get_field("huge_line_height", "option"),
		'mega_font' 						=> get_field("mega_font", "option"),
		'mega_font_size' 					=> get_field("mega_font_size", "option"),
		'mega_font_line_height' 			=> get_field("mega_line_height", "option"),

		// STRUCTURE
		'padd__left'						=> '2%',
		'padd__right'						=> '2%',
		'header__spacing'					=> get_field("header_spacing", "option"),
		'size__site-main' 					=> '100%',
		'size__site-sidebar' 				=> '25%',
		'grid__gutter'						=> '7px',

		// LOGO
		'svg_logo'							=> get_field("svg_logo", "option"),
		'logo__width' 						=> get_field("logo_width", "option").'px',
		'logo__height' 						=> get_field("logo_height", "option").'px',
		
		// ROW MODULE
		'row_item_hover_background_color'	=> '',
		'row_item_default_height'			=> '',
		
		// INDEX MODULE
		'index_item_padding_top'			=> '',
		'index_item_padding_bottom'			=> '',
		'separator_height_alt'				=> '',
		'borders_color'						=> '',

		/* Extras */
		'slideshow_inner_margin' 			=> '16px',

		// BASE
		'posts_per_page' 					=> get_option("posts_per_page"),
		'site_title' 						=> get_field("site_title", "option"),
		'logo_state' 						=> get_field("logo_state", "option"),
		'logo' 								=> get_field("logo", "option"),
		'logo_retina' 						=> get_field("logo_retina", "option"),
		'logo_height' 						=> get_field("logo_height", "option"),
		'logo_width' 						=> get_field("logo_width", "option"),
		'footer_column_1'					=> get_field("footer_column_1", "option"),
		'footer_column_2' 					=> get_field("footer_column_2", "option"),
		
		// LAYOUT
		'max_site_width' 					=> get_field("max_site_width", "option"),
		'site_margin_left' 					=> get_field("site_margin_left", "option"),
		'site_margin_right' 				=> get_field("site_margin_right", "option"),
		'site_left_right_border'		 	=> get_field("site_left_right_border", "option"),
		'site_left_right_border_width' 		=> get_field("site_left_right_border_width", "option"),
		'site_left_right_border_margin' 	=> get_field("site_left_right_border_margin", "option"),
		'header_position' 					=> get_field("header_position", "option"),
		'header_background_transparency' 	=> get_field("header_background_transparency", "option"),
		'header_top_padding' 				=> get_field("header_top_padding", "option").'px',
		'header_bottom_padding' 			=> get_field("header_bottom_padding", "option").'px',
		'header_bottom_margin' 				=> get_field("header_bottom_margin", "option") .'px',
		'footer_top_padding' 				=> get_field("footer_top_padding", "option"),
		'footer_bottom_padding' 			=> get_field("footer_bottom_padding", "option"),
		'grid_gutter' 						=> get_field("grid_gutter", "option") . 'px',
		'paragraph_inner_right_padding' 	=> get_field("paragraph_inner_right_padding", "option").'px',
		'header_separator_height' 			=> get_field("header_separator_height", "option"),
		'header_separator_bottom_margin' 	=> get_field("header_separator_bottom_margin", "option"),
		'separator_height' 					=> get_field("separator_height", "option") .'px',
		'separator_height_alt' 				=> get_field("separator_height_alt", "option"),
		'index_module_type' 				=> get_field("index_module_type", "option"),
		'index_item_padding_top' 			=> get_field("index_item_padding_top", "option"),
		'index_item_padding_bottom' 		=> get_field("index_item_padding_bottom", "option"),
		'index_item_taxonomy_count' 		=> get_field("index_item_taxonomy_count", "option"),
		'forms_padding' 					=> get_field("forms_padding", "option"),
		'forms_margin_bottom' 				=> get_field("forms_margin_bottom", "option"),
		'forms_border_width' 				=> get_field("forms_border_width", "option"),
		'link_decoration' 					=> get_field("link_decoration", "option"),
		'post_next_previous_links' 			=> get_field("post_next_previous_links", "option"),
		'post_next_fixed_style' 			=> get_field("post_next_fixed_style", "option"),

		// COLORS
		'site_background_color' 			=> get_field("site_background_color", "option"),
		'text_color' 						=> get_field("text_color", "option"),
		'link_color'						=> get_field("link_color", "option"),
		'link_marked_color'					=> get_field("link_marked_color", "option"),
		'borders_color'						=> get_field("borders_color", "option"),
		'header_background_color'			=> get_field("header_background_color", "option"),
		'menu_background_color' 			=> get_field("menu_background_color", "option"),
		'loader_color'						=> get_field("loader_color", "option"),
		'media_loader_bg_color'				=> get_field("media_loader_bg_color", "option"),
		'thumbnail_text_color'				=> get_field("thumbnail_text_color", "option"),
		'thumbnail_hover_text_color'		=> get_field("thumbnail_hover_text_color", "option"),
		'index_item_dimmed_color'			=> get_field("index_item_dimmed_color", "option"),
		'index_item_active_color'			=> get_field("index_item_active_color", "option"),
		'forms_border_color'				=> get_field("forms_border_color", "option"),
		'forms_background_color'			=> get_field("forms_background_color", "option"),
		'forms_text_color'					=> get_field("forms_text_color", "option"),
		'forms_focus_border_color'			=> get_field("forms_focus_border_color", "option"),
		'button_background_color'			=> get_field("button_background_color", "option"),
		'button_text_color' 				=> get_field("button_text_color", "option"),
		'button_hover_background_color'		=> get_field("button_hover_background_color", "option"),
		'button_hover_text_color'			=> get_field("button_hover_text_color", "option"),

		// MENUS
		'main_menu_type' 								=> get_field("main_menu_type", "option"),
		'main_menu_float_gutter' 						=> get_field("main_menu_float_gutter", "option"),
		'main_menu_width' 								=> get_field("main_menu_width", "option"),
		'toggle_menu_margin_top' 						=> get_field("toggle_menu_margin_top", "option") . 'px',
		'toggle_menu_margin_bottom' 					=> get_field("toggle_menu_margin_bottom", "option") . 'px',
		'toggle_menu_items_width' 						=> get_field("toggle_menu_items_width", "option"),
		'toggle_menu_render_type' 						=> get_field("toggle_menu_render_type", "option"),
		'toggle_menu_line_height' 						=> get_field("toggle_menu_line_height", "option"),
		'toggle_menu_items_padding_top' 				=> get_field("toggle_menu_items_padding_top", "option") . 'px',
		'toggle_menu_items_padding_bottom' 				=> get_field("toggle_menu_items_padding_bottom", "option") . 'px',
		'sidebar_menu_render_type' 						=> get_field("sidebar_menu_render_type", "option"),
		'sidebar_menu_line_height' 						=> get_field("sidebar_menu_line_height", "option"),
		'sidebar_menu_items_padding_top' 				=> get_field("sidebar_menu_items_padding_top", "option") . 'px',
		'sidebar_menu_items_padding_bottom' 			=> get_field("sidebar_menu_items_padding_bottom", "option") . 'px',
		'sidebar_menu_side_border_width' 				=> get_field("sidebar_menu_side_border_width", "option"),
		'secondary_menu_items_width' 					=> get_field("secondary_menu_items_width", "option"),
		'secondary_menu_render_type' 					=> get_field("secondary_menu_render_type", "option"),
		'secondary_menu_line_height' 					=> get_field("secondary_menu_line_height", "option"),
		'secondary_menu_items_padding_top' 				=> get_field("secondary_menu_items_padding_top", "option") . 'px',
		'secondary_menu_items_padding_bottom' 			=> get_field("secondary_menu_items_padding_bottom", "option") . 'px',

		// BUTTONS

		'button_padding'								=> get_field("button_padding", "option"),
		'button_color'									=> get_field("button_color", "option"),
		'button_text_color'								=> get_field("button_text_color", "option"),
		'button_font_size'								=> get_field("button_font_size", "option"),

		// INTERFACE
		'taxonomy_pagination_type' 						=> get_field("taxonomy_pagination_type", "option"),
		'default_easing' 								=> get_field("default_easing", "option"),
		'image_loaded_fade_speed' 						=> get_field("image_loaded_fade_speed", "option"),
		'slideshow_speed' 								=> get_field("slideshow_speed", "option"),
		'toggle_menu_speed' 							=> get_field("toggle_menu_speed", "option"),
		'thumbnail_text_color' 							=> get_field("thumbnail_text_color", "option"),
		'thumbnail_hover_text_color' 					=> get_field("thumbnail_hover_text_color", "option"),
		'row_item_hover_background_color' 				=> get_field("row_item_hover_background_color", "option"),
		'row_item_hover_text_color' 					=> get_field("row_item_hover_text_color", "option"),
		'row_item_default_height' 						=> get_field("row_item_default_height", "option"),
		'media_focus_inner_padding' 					=> get_field("media_focus_inner_padding", "option") ,
		'caption_padding' 								=> get_field("caption_padding", "option"),
		'row_item_caption_padding' 						=> get_field("row_item_caption_padding", "option"),
		'thumbnail_text_padding' 						=> get_field("thumbnail_text_padding", "option"),

		// HISTORY
		'history_state' 								=> get_field("history_state", "option"),
		'history_transition_speed' 						=> get_field("history_transition_speed", "option"),
		'history_cache' 								=> get_field("history_cache", "option"),
		'page_loader' 									=> get_field("page_loader", "option"),

		// TABLET
		'tablet_grid_gutter' 							=> get_field("tablet_grid_gutter", "option"),
		'tablet_column_response' 						=> get_field("tablet_column_response", "option"),
		'tablet_slide_toggle_background_color' 			=> get_field("tablet_slide_toggle_background_color", "option"),
		'tablet_slide_toggle_link_text_color' 			=> get_field("tablet_slide_toggle_link_text_color", "option"),
		'tablet_slide_toggle_active_background_color' 	=> get_field("tablet_slide_toggle_active_background_color", "option"),
		'tablet_slide_toggle_active_link_text_color' 	=> get_field("tablet_slide_toggle_active_link_text_color", "option"),
		'tablet_slide_toggle_separator_color' 			=> get_field("tablet_slide_toggle_separator_color", "option"),
		'tablet_slide_toggle_separator_height' 			=> get_field("tablet_slide_toggle_separator_height", "option"),
		'tablet_header_position' 						=> get_field("tablet_header_position", "option"),
		'tablet_header_top_padding' 					=> get_field("tablet_header_top_padding", "option").'px',
		'tablet_header_bottom_padding' 					=> get_field("tablet_header_bottom_padding", "option").'px',
		'tablet_header_border' 							=> get_field("tablet_header_border", "option") . 'px',
		'tablet_site_margin_left' 						=> get_field("tablet_site_margin_left", "option"),
		'tablet_site_margin_right' 						=> get_field("tablet_site_margin_right", "option"),
		'tablet_header_bottom_margin' 					=> get_field("tablet_header_bottom_margin", "option"),
		'tablet_index_item_padding_top'					=> get_field("tablet_index_item_padding_top", "option"),
		'tablet_index_item_padding_bottom' 				=> get_field("tablet_index_item_padding_bottom", "option"),
		'tablet_forms_border_width' 					=> get_field("tablet_forms_border_width", "option"),
		'tablet_caption_padding' 						=> get_field("tablet_caption_padding", "option"),
		'tablet_thumbnails_force_hover' 				=> get_field("tablet_thumbnails_force_hover", "option"),
		'tablet_toggle_menu_speed' 						=> get_field("tablet_toggle_menu_speed", "option"),
		'tablet_menu_items_padding_top' 				=> get_field("tablet_menu_items_padding_top", "option").'px',
		'tablet_menu_items_padding_bottom' 				=> get_field("tablet_menu_items_padding_bottom", "option").'px',
		'tablet_footer_padding_top' 					=> get_field("tablet_footer_padding_top", "option") .'px',
		'tablet_footer_padding_bottom' 					=> get_field("tablet_footer_padding_bottom", "option") . 'px',
		'tablet_small_font_size' 						=> get_field("tablet_small_font_size", "option"),
		'tablet_small_font_line_height' 				=> get_field("tablet_small_font_line_height", "option"),
		'tablet_default_font_size' 						=> get_field("tablet_default_font_size", "option"),
		'tablet_default_font_line_height' 				=> get_field("tablet_default_font_line_height", "option"),
		'tablet_large_font_size' 						=> get_field("tablet_large_font_size", "option"),
		'tablet_large_font_line_height' 				=> get_field("tablet_large_font_line_height", "option"),
		'tablet_huge_font_size' 						=> get_field("tablet_huge_font_size", "option"),
		'tablet_huge_font_line_height'	 				=> get_field("tablet_huge_font_line_height", "option"),
		'tablet_mega_font_size' 						=> get_field("tablet_mega_font_size", "option"),
		'tablet_mega_font_line_height' 					=> get_field("tablet_mega_font_line_height", "option"),

		// MOBILE
		'mobile_grid_gutter' 							=> get_field("mobile_grid_gutter", "option").'px',
		'mobile_column_response' 						=> get_field("mobile_column_response", "option"),
		'mobile_slide_toggle_background_color' 			=> get_field("mobile_slide_toggle_background_color", "option"),
		'mobile_slide_toggle_link_text_color' 			=> get_field("mobile_slide_toggle_link_text_color", "option"),
		'mobile_slide_toggle_active_background_color' 	=> get_field("mobile_slide_toggle_active_background_color", "option"),
		'mobile_slide_toggle_active_link_text_color' 	=> get_field("mobile_slide_toggle_active_link_text_color", "option"),
		'mobile_slide_toggle_separator_color' 			=> get_field("mobile_slide_toggle_separator_color", "option"),
		'mobile_slide_toggle_separator_height'			=> get_field("mobile_slide_toggle_separator_height", "option"),
		'mobile_header_position' 						=> get_field("mobile_header_position", "option"),
		'mobile_header_top_padding' 					=> get_field("mobile_header_top_padding", "option").'px',
		'mobile_header_bottom_padding' 					=> get_field("mobile_header_bottom_padding", "option").'px',
		'mobile_header_border' 							=> get_field("mobile_header_border", "option") .'px',
		'mobile_site_margin_left' 						=> get_field("mobile_site_margin_left", "option"),
		'mobile_site_margin_right' 						=> get_field("mobile_site_margin_right", "option"),
		'mobile_header_bottom_margin' 					=> get_field("mobile_header_bottom_margin", "option").'px',
		'mobile_index_item_padding_top' 				=> get_field("mobile_index_item_padding_top", "option"),
		'mobile_index_item_padding_bottom' 				=> get_field("mobile_index_item_padding_bottom", "option"),
		'mobile_forms_border_width' 					=> get_field("mobile_forms_border_width", "option"),
		'mobile_caption_padding' 						=> get_field("mobile_caption_padding", "option"),
		'mobile_thumbnails_force_hover' 				=> get_field("mobile_thumbnails_force_hover", "option"),
		'mobile_toggle_menu_speed' 						=> get_field("mobile_toggle_menu_speed", "option"),
		'mobile_menu_items_padding_top' 				=> get_field("mobile_menu_items_padding_top", "option").'px',
		'mobile_menu_items_padding_bottom' 				=> get_field("mobile_menu_items_padding_bottom", "option").'px',
		'mobile_footer_padding_top' 					=> get_field("mobile_footer_padding_top", "option") .'px',
		'mobile_footer_padding_bottom' 					=> get_field("mobile_footer_padding_bottom", "option") .'px',
		'mobile_small_font_size' 						=> get_field("mobile_small_font_size", "option"),
		'mobile_small_font_line_height' 				=> get_field("mobile_small_font_line_height", "option"),
		'mobile_default_font_size' 						=> get_field("mobile_default_font_size", "option"),
		'mobile_default_font_line_height' 				=> get_field("mobile_default_font_line_height", "option"),
		'mobile_large_font_size' 						=> get_field("mobile_large_font_size", "option"),
		'mobile_large_font_line_height' 				=> get_field("mobile_large_font_line_height", "option"),
		'mobile_huge_font_size' 						=> get_field("mobile_huge_font_size", "option"),
		'mobile_huge_font_line_height' 					=> get_field("mobile_huge_font_line_height", "option"),
		'mobile_mega_font_size' 						=> get_field("mobile_mega_font_size", "option"),
		'mobile_mega_font_line_height' 					=> get_field("mobile_mega_font_line_height", "option"),

		// WOOCOMMERCE

		'product_button_bg_color'						=> get_field("product_button_bg_color", "option"),
		'product_button_text_color'						=> get_field("product_button_text_color", "option"),
		'product_button_padding'						=> get_field("product_button_padding", "option"),
		'product_button_text_size'						=> get_field("product_button_text_size", "option"),
		'add_to_cart_button_bg_color'					=> get_field("add_to_cart_button_bg_color", "option"),
		'add_to_cart_button_text_color'					=> get_field("add_to_cart_button_text_color", "option"),
		'add_to_cart_button_bg_color_hover'				=> get_field("add_to_cart_button_bg_color_hover", "option"),
		'add_to_cart_button_text_color_hover'			=> get_field("add_to_cart_button_text_color_hover", "option"),

		'link_hover_title_size'							=> get_field("link_hover_title_size", "option"),
		'link_hover_sub_title_size'						=> get_field("link_hover_sub_title_size", "option"),

		'info_bg_color'									=> get_field("info_bg_color", "option"),
		'info_text_colour'								=> get_field("info_text_colour", "option"),
		'info_font_size'								=> get_field("info_font_size", "option"),

		'message_bg_color'								=> get_field("message_bg_color", "option"),
		'message_text_color'							=> get_field("message_text_color", "option"),
		'message_font_size'								=> get_field("message_font_size", "option"),

		'error_bg_color'								=> get_field("error_bg_color", "option"),
		'error_text_color'								=> get_field("error_text_color", "option"),
		'error_font_size'								=> get_field("error_font_size", "option"),


    );
    return $variables;
}
add_filter('wp_scss_variables','wp_scss_set_variables');
