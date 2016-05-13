<?php 
$pre_secondary_menu_render_type = get_field('secondary_menu_render_type', 'option');
$pre_secondary_menu_text_size = get_field('secondary_menu_text_size', 'option');

// Secondary menu
$secondary_menu_state = get_field("secondary_menu_state");

if ($secondary_menu_state) {
	$secondary_menu_nav_select = get_field("secondary_menu_nav_select");
	$secondary_menu_title = get_field("secondary_menu_title");
	$secondary_menu_margin_bottom = get_field("secondary_menu_margin_bottom");
}

if ($secondary_menu_state):
	$menu_id = $secondary_menu_nav_select; 	
	$nav_menu = wp_get_nav_menu_object($menu_id->slug); ?>

	<div id="secondary_menu_holder" <?php if ($nav_menu): ?>data-menu-name="<?php echo $nav_menu->name; ?>"<?php endif; ?> class="module mpt-lb-0 mpb-<?php echo $secondary_menu_margin_bottom; ?> <?php echo str_replace(' ', '-', strtolower($pre_secondary_menu_render_type)); ?> <?php echo $pre_secondary_menu_text_size; ?>">

	<?php
		$title = '';

		if ($secondary_menu_title):
			$title = '<div class="col col-100 col-padd-hori"><h2 class="' . $pre_secondary_menu_text_size . ' lb-1">'. $secondary_menu_title .'</h2></div>';
		endif;

		$defaults = array(
			'menu' => $menu_id->ID,
			'items_wrap' => $title . '<ul id="secondary-menu-holder" class="menu">%3$s</ul>'
		);

		wp_nav_menu($defaults);
	?>

	</div>            

<?php endif; ?>
