<?php if ($device == 'tablet') { ?>
  
    <?php if ($tablet_main_menu == 'Slide Toggle') { ?>
    <nav id="menu" class="default">
      <?php if (has_nav_menu('primary')) { ?>
      
        <?php $separator = ''; $before = ''; $menu = wp_nav_menu( array('menu' => 'primary','menu_id' => 'mmenu-main-menu', 'menu_class' => 'mmenu-main-menu', 'before' => $before, 'after' => ''.$separator.'', 'container' => false, 'echo' => false, 'depth' => -1  )); $menu = str_replace('<a',"<a class='history'",$menu);
          // Output Menu
          echo $menu;
        ?>

      <?php } ?>
    </nav>
    <?php } ?>

<?php } else if ($device == 'mobile') { ?>
  
    <?php if ($mobile_main_menu == 'Slide Toggle') { ?>
    <nav id="menu" class="default">
      <?php if (has_nav_menu('primary')) { ?>
      
        <?php $separator = ''; $before = ''; $menu = wp_nav_menu( array('menu' => 'primary','menu_id' => 'mmenu-main-menu', 'menu_class' => 'mmenu-main-menu', 'before' => $before, 'after' => ''.$separator.'', 'container' => false, 'echo' => false, 'depth' => -1  )); $menu = str_replace('<a',"<a class='history'",$menu);
          // Output Menu
          echo $menu;
        ?>

      <?php } ?>
    </nav>
    <?php } ?>
    
<?php } ?>