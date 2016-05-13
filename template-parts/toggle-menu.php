<div id="toggle" data-color="<?php the_field('site_background_color', 'option'); ?>">

  <div id="toggle-menu" class="<?php if ($detect->isTablet()) {echo $tablet_header_position;} else if ($detect->isMobile()) {echo $mobile_header_position;} else {echo $header_position;} ?>">
    <div id="toggle-menu-fix">
      <div id="toggle-menu-inner" class="module mpt-<?php if (! $detect->isMobile()) { echo get_field('toggle_menu_margin_top','options'); } ?> mpb-<?php if (! $detect->isMobile()) { echo get_field('toggle_menu_margin_bottom','options'); } ?> <?php echo get_field('toggle_menu_text_size', 'option'); ?>">
        <?php

            global $woocommerce;

            // label vars
            $viewing_cart = __('View your shopping basket', '');
            $start_shopping = __('Start shopping', '');

            // get cart contents
            $cart_url = $woocommerce->cart->get_cart_url();

            // get the shop page link
            $shop_page_url = home_url( '/print-shop' );

            // count the items in the cart
            $cart_contents_count = $woocommerce->cart->cart_contents_count;

            // build string
            $cart_contents = sprintf(_n('%d', '%d', $cart_contents_count, ''), $cart_contents_count);

            // get cart total
            $cart_total = $woocommerce->cart->get_cart_total();

            // uncomment the line below to hide nav menu cart item when there are no items in the cart
            //if ( $cart_contents_count > 0 ) {

              // build the li item
              if ($cart_contents_count == 0) {
                $menu_item = '<li class="cart_menu_item menu-item menu-item-type-post_type menu-item-object-page"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
              } else {
                $menu_item = '<li class="cart_menu_item menu-item menu-item-type-post_type menu-item-object-page"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
              }
              if ($cart_contents_count == 0) {
                $menu_item .= 'Cart';
              } else {
                $menu_item .= '<span class="red">Cart <span class="cart-contents show">( '.$cart_contents.' )</span>';
              }
              //$menu_item .= '<div class="cart_total">'.$cart_total.'</div>';
              $menu_item .= '</a></li>';
            
            // Uncomment the line below to hide nav menu cart item when there are no items in the cart
            //}

          $separator = '';
          $before = '';
          $menu = wp_nav_menu( array('menu' => 'primary','menu_id' => 'special', 'menu_class' => 'special', 'before' => '', 'after' => ''.$separator.'', 'container' => false, 'echo' => false, 'items_wrap' => '<ul id="menu-main-menu" class="menu-main-menu">%3$s'.$menu_item.'</ul>'  )); 
          $menu = str_replace('<a',"<a class='history ".get_field('toggle_menu_text_size', 'option')."'",$menu);
          echo $menu;
        ?>
      </div>
    </div>
  </div>
  
</div>