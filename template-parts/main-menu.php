      <?php 
      if ($main_menu_type == 'Float Left Long' || $main_menu_type == 'Float Right Long' || $main_menu_type == 'Gridded Long') {
        $header_col_1 = '25';
        $header_col_2 = '75';
      } else {
        $header_col_1 = '50';
        $header_col_2 = '50';
      } 
      ?>
      
      <div class="col col-<?php echo $header_col_1; ?> col-padd-hori">
        <?php if ($svg_logo) { ?>
        <h1 id="logo-h1" class="<?php echo $main_title_text_size; ?>">
          <a style="background-image: url(<?php echo $svg_logo; ?>);" id="logo-image" href="<?php echo $home; ?>/" class="history no-underline"></a>
        </h1>
        <?php } else { ?>
        <h1 id="logo-text-h1" class="<?php echo $main_title_text_size; ?>">
          <a id="logo-link" href="<?php echo $home; ?>/" class="history <?php if (is_home()) {echo 'marked';} ?>">
            <?php if ($site_title) {
              echo $site_title;
            } else {
              bloginfo('title');
            } ?>
          </a>
        </h1>
        <?php } ?>
      </div>
    
      <div id="menu-holder" class="col col-<?php echo $header_col_2; ?> <?php echo $main_menu_text_size; ?> <?php if ($main_menu_width == 'Wide') {echo 'wide';} ?> <?php if ($main_menu_type == 'Float Right' || $main_menu_type == 'Float Right Long') {echo 'float-right';} else if ($main_menu_type == 'Float Left' || $main_menu_type == 'Float Left Long') {echo 'float-left';} else if ($main_menu_type == 'None') {echo 'none';} ?>">
      
      
        <?php if ($main_menu_type == 'None') { ?>
          <div class="col right col-padd-hori default">
            <?php echo $main_menu_text_replacer; ?>
          </div>
        <?php } else if (has_nav_menu('primary')) {
 
            $depth = -1;
            if ($main_menu_type == 'Gridded') {
              $depth = 2;
            }
            
          
            $toggle_menu_icons = get_field('toggle_menu_icons', 'option');
            
            if ($toggle_menu_icons == "2") {
              // Thick
              $hamburger_icon = 'j';
              $close_icon = 'p';
            } else {
              // Thin
              $hamburger_icon = 'i';
              $close_icon = 'g';
            }

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
                $menu_item = '<li class="cart_menu_item menu-item menu-item-type-post_type menu-item-object-page"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $start_shopping .'">';
              } else {
                $menu_item = '<li class="cart_menu_item menu-item menu-item-type-post_type menu-item-object-page"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
              }
              if ($cart_contents_count == 0) {
                $menu_item .= '<span><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="cart-contents"> 0 / </span>';
              } else {
                $menu_item .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="cart-contents red"> '.$cart_contents.' / </span>';
              }
              $menu_item .= '<span class="cart_total red"> '.$cart_total.'</span>';
              $menu_item .= '</a></li>';
            
            // Uncomment the line below to hide nav menu cart item when there are no items in the cart
            //}

          ?>
          
          <a href="#" id="menu-icon" class="icons default" data-icon="<?php echo $hamburger_icon; ?>" data-icon-hover="<?php echo $close_icon; ?>"><?php echo $hamburger_icon; ?></a>
          <a href="<?php echo $cart_url; ?>" id="cart-icon" class="icons default"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
          <?php 
            $separator = ''; 
            $before = ''; 
          
            if ($device == 'desktop') {
              if ($main_menu_type == 'Float Right Long' || $main_menu_type == 'Float Right') {
                $menu = wp_nav_menu( array('reverse' => true, 'menu' => 'primary','menu_id' => 'menu-main-menu', 'menu_class' => 'menu-main-menu', 'before' => $before, 'after' => ''.$separator.'', 'container' => false, 'depth' => $depth, 'echo' => false, 'items_wrap' => '<ul id="menu-main-menu" class="menu-main-menu">%3$s'.$menu_item.'</ul>' )); 
              } else {
                $menu = wp_nav_menu( array('reverse' => false, 'menu' => 'primary','menu_id' => 'menu-main-menu', 'menu_class' => 'menu-main-menu', 'before' => $before, 'after' => ''.$separator.'', 'container' => false, 'depth' => $depth, 'echo' => false, 'items_wrap' => '<ul id="menu-main-menu" class="menu-main-menu">%3$s'.$menu_item.'</ul>' )); 
              }
              
            } else {
              $menu = wp_nav_menu( array('reverse' => false, 'menu' => 'primary','menu_id' => 'menu-main-menu', 'menu_class' => 'menu-main-menu', 'before' => $before, 'after' => ''.$separator.'', 'container' => false, 'depth' => $depth, 'echo' => false, 'items_wrap' => '<ul id="menu-main-menu" class="menu-main-menu">%3$s'.$menu_item.'</ul>' )); 
            }

            // Output Menu
            echo $menu;

          ?>
    
        <?php } else { // Fallback if the menu has not been set yet ?>
          <div id="menu" class="right align-right">
            <a href="<?php echo get_admin_url('','nav-menus.php',''); ?>">Set your menu</a>
          </div>
        <?php } ?>
      </div>