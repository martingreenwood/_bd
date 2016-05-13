          <?php 
            
            $pre_sidebar_menu_render_type = get_field('sidebar_menu_render_type', 'option');
            $pre_sidebar_menu_text_size = get_field('sidebar_menu_text_size', 'option');
        
            if ($sidebar_menu_state) { 
            
              $menu_id = $sidebar_menu_nav_select; 
              $nav_menu = wp_get_nav_menu_object($menu_id);
              
              ?>
          
            <div id="sidebar_menu_holder" <?php if ($nav_menu) { ?>data-menu-name="<?php echo $nav_menu->name; ?>"<?php } ?> class="module mpt-lb-0 mpb-lb-0 <?php echo $pre_sidebar_menu_text_size; ?> <?php echo $sidebar_menu_items_text_align; ?>">

              <?php
              
              $title = '';
              
              if ($sidebar_menu_title) {
                $title = '<div class="col col-100 col-padd-hori"><h2 class="' . $pre_sidebar_menu_text_size . ' lb-1">'. $sidebar_menu_title .'</h2></div>';
              }
              
              $defaults = array(
                'menu' => $menu_id,
                'items_wrap' => $title . '<ul id="sidebar-menu-holder" class="menu">%3$s</ul>'
              );
              
              wp_nav_menu($defaults);
              
              ?>
              
            </div>
          
          <?php } ?>
          <div class="empty">&nbsp;</div>