<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */
?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<div class="columns">

				<div class="col col-padd-hori col-<?php the_field('left_column_width', 'option'); ?>">
					<p class="lb-1 default align-<?php the_field('left_column_alignment', 'option'); ?>">
						<?php the_field('left_column', 'option'); ?>
					</p>
				</div>

				<div class="col col-padd-hori col-<?php the_field('right_column_width', 'option'); ?>">
					<p class="lb-1 default align-<?php the_field('right_column_alignment', 'option'); ?>">
						<?php the_field('right_column', 'option'); ?>
					</p>
				</div>

			</div>

			<?php
			/**
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit - 20
			 */
			//do_action( 'storefront_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<script>
// Settings -> js vars
var toggle_menu_speed = '<?php the_field('toggle_menu_speed', 'option'); ?>';
var module_toggle_speed = '<?php the_field('module_toggle_speed', 'option'); ?>'; 
var toggle_menu_init_state = '<?php the_field('toggle_menu_init_state', 'option'); ?>';
var taxonomy_pagination_type = '<?php the_field('taxonomy_pagination_type', 'option'); ?>';
// Layout
var max_site_width = '100%';
var site_margin_left = '<?php the_field('site_margin_left', 'option'); ?>';
var site_margin_right = '<?php the_field('site_margin_right', 'option'); ?>';
var link_decoration = '<?php the_field('link_decoration', 'option'); ?>';
var header_bottom_margin = '<?php the_field('header_bottom_margin', 'option'); ?>';
var header_background_transparency = '<?php the_field('header_background_transparency', 'option'); ?>';
// Type sizes
var slideshow_arrow_size = '<?php the_field('slideshow_arrow_size', 'option'); ?>';

// History
var history_state = '<?php the_field('history_state', 'option'); ?>';
var transition_hybrid = '<?php the_field('transition_hybrid', 'option'); ?>';
if (history_state) {
	var history_transition_speed = '<?php the_field('history_transition_speed', 'option'); ?>';
	var history_cache = '<?php the_field('history_cache', 'option'); ?>';
} else {
	var history_transition_speed = 0;
	if (history_transition_speed) {
		if (history_transition_speed && $transition_hybrid) {
			var history_transition_speed = '<?php the_field('history_transition_speed', 'option'); ?>';
		}
		var history_cache = 0;
	}
}
var page_loader = '<?php if (get_field('page_loader', 'option')){ the_field('page_loader', 'option');} else {echo 'None';} ?>';
<?php if (get_field('page_loader', 'option') == 'Type-5') { ?>
var page_loader_text = '<?php the_field('page_loader_text', 'option'); ?>';
var page_loader_text_size = '<?php the_field('page_loader_text_size', 'option'); ?>';
<?php } ?>
var focus_left_right_close_icon_size = '<?php the_field('focus_left_right_close_icon_size', 'option'); ?>';
var focus_counter_text_size = '<?php the_field('focus_counter_text_size', 'option'); ?>';

// Interface
var default_easing = '<?php the_field('default_easing', 'option'); ?>';
var image_loaded_fade_speed = '<?php the_field('image_loaded_fade_speed', 'option'); ?>';
var slideshow_speed = '<?php the_field('slideshow_speed', 'option'); ?>';
var slideshow_window_scroll_adjust = '<?php the_field('slideshow_window_scroll_adjust', 'option'); ?>';
var slideshow_arrow_icons = '<?php the_field('slideshow_arrow_icons', 'option'); ?>';
var slideshow_control_navigation = '<?php the_field('slideshow_control_navigation', 'option'); ?>';
var cover_slideshow_autoplay_delay_time = '<?php the_field('cover_slideshow_autoplay_delay_time', 'option'); ?>';
var post_next_previous_keys = '<?php the_field('post_next_previous_keys', 'option'); ?>';
var focus_mode_margin_top = '<?php the_field('focus_mode_margin_top', 'option'); ?>';
var focus_mode_margin_bottom = '<?php the_field('focus_mode_margin_bottom', 'option'); ?>';
var focus_mode_icons = '<?php the_field('focus_mode_icons', 'option'); ?>';
// Copy
var copy_6 = '<?php if (get_field('copy_6', 'option')){ the_field('copy_6', 'option');} else { echo 'Loading...';} ?>';
<?php
$detect = new Mobile_Detect();
$device = 'desktop'; 
if ($detect->isMobile()) {
	$device = 'mobile';
} 
if ($detect->isMobile() && $detect->isTablet()) {
	$device = 'tablet';
}
?>
<?php if ($device == 'mobile') { ?>
// Mobile
var mobile_main_menu = '<?php the_field('mobile_main_menu', 'option'); ?>';
var mobile_thumbnails_force_hover = '<?php the_field('mobile_thumbnails_force_hover', 'option'); ?>';
var mobile_header_bottom_margin = '<?php the_field('mobile_header_bottom_margin', 'option'); ?>';
var mobile_toggle_menu_speed = '<?php the_field('mobile_toggle_menu_speed', 'option'); ?>';

<?php } ?>
<?php if ($device == 'tablet') { ?>
// Tablet
var tablet_main_menu = '<?php the_field('tablet_main_menu', 'option'); ?>';
var tablet_thumbnails_force_hover = '<?php the_field('tablet_thumbnails_force_hover', 'option'); ?>';
var tablet_header_bottom_margin = '<?php the_field('tablet_header_bottom_margin', 'option'); ?>';
var tablet_toggle_menu_speed = '<?php the_field('tablet_toggle_menu_speed', 'option'); ?>';
<?php } ?>
</script>

<?php wp_footer(); ?>

</body>
</html>
