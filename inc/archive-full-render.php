<?php 
$detect = new Mobile_Detect(); $device = 'desktop'; 
if ($detect->isMobile()) { $device = 'mobile'; } 
if ($detect->isMobile() && $detect->isTablet()) { $device = 'tablet'; }

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

$thumbnails_title_text_size = get_field('thumbnails_title_text_size', 'option');


$i++;
if (in_category('Inactive')):

  // Escape

else:
	
	if (get_field('full_render_separator_border', 'option')) { 
		if ($i > 1) {
			require get_stylesheet_directory() . '/inc/seperator.php';
		}
	}
	get_template_part( '/template-parts/layout', 'base' );
	$postid = get_the_id();

endif;

?>