<?php

	// this function places a cart icon with number of 
	// items and total cost in the menu bar.

	function wcmenucart($menu, $args) {

		// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
			return $menu;

			// turn on output buffering
			ob_start();

			// setup woocommerce
			global $woocommerce;

			// label vars
			$viewing_cart = __('View your shopping cart', 'stormfront');
			$start_shopping = __('Start shopping', 'stormfront');

			// get cart contents
			$cart_url = $woocommerce->cart->get_cart_url();

			// get the shop page link
			$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

			// count the items in the cart
			$cart_contents_count = $woocommerce->cart->cart_contents_count;

			// build string
			$cart_contents = sprintf(_n('%d', '%d', $cart_contents_count, 'stormfront'), $cart_contents_count);

			// get cart total
			$cart_total = $woocommerce->cart->get_cart_total();

			// uncomment the line below to hide nav menu cart item when there are no items in the cart
			// if ( $cart_contents_count > 0 ) {

				// build the li item
				if ($cart_contents_count == 0) {
					$menu_item = '<li class="cart_meniu_item"><a class="wcmenucart-contents" href="'. $$cart_url .'" title="'. $start_shopping .'">';
				} else {
					$menu_item = '<li class="cart_meniu_item"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
				}
				$menu_item .= '<div class="cart_icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>';
				$menu_item .= '<span class="cart_contents">'.$cart_contents.'</span>';
				$menu_item .= '</a></li>';
			
			// Uncomment the line below to hide nav menu cart item when there are no items in the cart
			// }
			
			// echo it
			echo $menu_item;

		//  tet current buffer contents and delete current output buffer
		$social = ob_get_clean();

		// retunn menu
		return $menu . $social;

	}

	// add function to wp nav menu items filter
	add_filter('wp_nav_menu_items','wcmenucart', 10, 2);
