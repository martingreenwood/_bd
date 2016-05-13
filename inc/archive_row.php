<?php 
$detect = new Mobile_Detect(); $device = 'desktop'; 
if ($detect->isMobile()) { $device = 'mobile'; } 
if ($detect->isMobile() && $detect->isTablet()) { $device = 'tablet'; }

if ( is_front_page() && get_option('show_on_front') == 'posts' ) {
  $pagetype =  'front-page';
} else if ( is_home() && get_option('show_on_front') == 'page' ) {
  $pagetype =  'front-page';
} else if ( is_attachment() ) {
  $pagetype =  'attachment';          // must be before is_single(), otherwise detects as 'single'
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
  $pagetype =  'cp_archive';        // must be before is_archive(), otherwise detects as 'archive' in WP 3.1.0
} else if ( function_exists('is_tax') && is_tax() ) {
  $pagetype =  'tax_archive';
} else if ( is_archive() && ! is_category() && ! is_author() && ! is_tag() ) {
  $pagetype =  'archive';
} else if ( function_exists('bbp_is_single_user') && (bbp_is_single_user() || bbp_is_single_user_edit()) ) {  // must be before is_404(), otherwise bbPress profile page is detected as 'e404'.
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

if (in_category('Inactive')) { 
  // If post is 'dimmed'
?>
  
<?php } else { ?>

<?php if(get_field("thumbnail_image")) { ?>
    
    <!-- Row Item -->
    <div class="item row-item left">
      <div class="col-inner">
      
      <?php
      
        if (get_the_post_thumbnail()) {
      
          // Thumb vars
          $color = get_field("hover_background_color");
          $textcolor = get_field("text_color");
          $hovertextcolor = get_field("hover_text_color");
          $opacity = get_field("hover_background_opacity");
          
          if ($opacity == '0%') {
            //$opacitycalc = '1';
            $opacitycalc = '0.0';
          } else if ($opacity == '10%') {
            //$opacitycalc = '0.9';
            $opacitycalc = '0.1';
          } else if ($opacity == '20%') {
            //$opacitycalc = '0.8';
            $opacitycalc = '0.2';
          } else if ($opacity == '30%') {
            //$opacitycalc = '0.7';
            $opacitycalc = '0.3';
          } else if ($opacity == '40%') {
            //$opacitycalc = '0.6';
            $opacitycalc = '0.4';
          } else if ($opacity == '50%') {
            //$opacitycalc = '0.5';
            $opacitycalc = '0.5';
          } else if ($opacity == '60%') {
            //$opacitycalc = '0.4';
            $opacitycalc = '0.6';
          } else if ($opacity == '70%') {
            //$opacitycalc = '0.3';
            $opacitycalc = '0.7';
          } else if ($opacity == '80%') {
            //$opacitycalc = '0.2';
            $opacitycalc = '0.8';
          } else if ($opacity == '90%') {
            //$opacitycalc = '0.1';
            $opacitycalc = '0.9';
          } else if ($opacity == '100%') {
            //$opacitycalc = '0.0';
            $opacitycalc = '1';
          } else {
            $opacitycalc = '1';
          }
        
        } else {
          // Thumb vars
          $color = 0;
          $textcolor = 0;
          $hovertextcolor = 0;
          $opacitycalc = '1.0';
        }
        
      ?>
        
        <a href="<?php the_permalink(); ?>" class="history thumb row-thumb row-thumb-archive <?php if ($pagetype == 'single' || $pagetype == 'page') { if ($wp_query->post->ID == $postid || $wp_query->post->ID == $this_page_id) {echo 'active';} } ?> <?php if (get_field("advanced_thumbnail")) {echo 'advanced';} ?>" <?php if ($opacitycalc) {echo 'data-opacity="'.$opacitycalc.'"';} ?> <?php if ($color) {echo 'data-bg-color="'.$color.'"';} ?> <?php if ($textcolor) {echo 'data-text-color="'.$textcolor.'"';} ?> <?php if ($hovertextcolor) {echo 'data-hover-text-color="'.$hovertextcolor.'"';} ?>>
          
          <div class="img-holder row-img">
          
            <?php

            $attachment_id = get_the_post_thumbnail();
            $attachment_id_2 = get_the_post_thumbnail();

       	    if ($detect->isMobile()) {
              if($detect->isTablet()){
                $size = "thumbnail";
       	      } else {
           	 	  $size = "thumbnail";
       	      }
            } else {
              $size = "thumbnail";
            }

      require get_stylesheet_directory() . '/inc/grab-image-src.php';
      require get_stylesheet_directory() . '/inc/grab-hover-src.php';

            
            ?>
          
            <?php if ($image_hover[0]) { ?>
            <div class="hover-image">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <?php } ?>
            <div class="figcaption-bg" style="<?php if ($color) { echo 'background:' . $color .';'; } ?> -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacitycalc *100; ?>)';filter: alpha(opacity=<?php echo $opacitycalc *100; ?>);-moz-opacity: <?php echo $opacitycalc; ?>;-khtml-opacity: <?php echo $opacitycalc; ?>;opacity: <?php echo $opacitycalc; ?>;">&nbsp;</div>
          <?php if (get_field('thumbnail_title')) { ?>
            <div class="figcaption <?php echo $row_item_overlay_text_size; ?>">
              <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 0px solid transparent; text-decoration: underline;';} else { echo 'border-bottom: 0px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
            </div>
          <?php } else { ?>
            <div class="figcaption <?php echo $row_item_overlay_text_size; ?>">
              <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 0px solid transparent; text-decoration: underline;';} else { echo 'border-bottom: 0px solid transparent'; }} ?>"><?php echo the_title(); ?></span>
            </div>
          <?php } ?>
            
            <?php the_post_thumbnail('full'); ?>
            
         
          </div>
        
        </a>
        
      </div>
    </div>

<?php } else { ?>
  
  <!-- Row Item -->
  <div class="item row-item left">
    <div class="col-inner">
    
      <?php
      
        if (get_the_post_thumbnail()) {
      
          // Thumb vars
          $color = get_field("hover_background_color");
          $textcolor = get_field("text_color");
          $hovertextcolor = get_field("hover_text_color");
          $opacity = get_field("hover_background_opacity");
          
          if ($opacity == '0%') {
            //$opacitycalc = '1';
            $opacitycalc = '0.0';
          } else if ($opacity == '10%') {
            //$opacitycalc = '0.9';
            $opacitycalc = '0.1';
          } else if ($opacity == '20%') {
            //$opacitycalc = '0.8';
            $opacitycalc = '0.2';
          } else if ($opacity == '30%') {
            //$opacitycalc = '0.7';
            $opacitycalc = '0.3';
          } else if ($opacity == '40%') {
            //$opacitycalc = '0.6';
            $opacitycalc = '0.4';
          } else if ($opacity == '50%') {
            //$opacitycalc = '0.5';
            $opacitycalc = '0.5';
          } else if ($opacity == '60%') {
            //$opacitycalc = '0.4';
            $opacitycalc = '0.6';
          } else if ($opacity == '70%') {
            //$opacitycalc = '0.3';
            $opacitycalc = '0.7';
          } else if ($opacity == '80%') {
            //$opacitycalc = '0.2';
            $opacitycalc = '0.8';
          } else if ($opacity == '90%') {
            //$opacitycalc = '0.1';
            $opacitycalc = '0.9';
          } else if ($opacity == '100%') {
            //$opacitycalc = '0.0';
            $opacitycalc = '1';
          } else {
            $opacitycalc = '1';
          }
        
        } else {
          // Thumb vars
          $color = 0;
          $textcolor = 0;
          $hovertextcolor = 0;
          $opacitycalc = '1.0';
        }
        
      ?>
      
      <a href="<?php the_permalink(); ?>" class="history thumb row-thumb row-thumb-archive <?php if ($pagetype == 'single' || $pagetype == 'page') { if ($wp_query->post->ID == $postid || $wp_query->post->ID == $this_page_id) {echo 'active';} } ?> <?php if (get_field("advanced_thumbnail")) {echo 'advanced';} ?>" <?php if ($opacitycalc) {echo 'data-opacity="'.$opacitycalc.'"';} ?> <?php if ($color) {echo 'data-bg-color="'.$color.'"';} ?> <?php if ($textcolor) {echo 'data-text-color="'.$textcolor.'"';} ?> <?php if ($hovertextcolor) {echo 'data-hover-text-color="'.$hovertextcolor.'"';} ?>>
        
        <div class="img-holder row-img">
        
            <?php

            $attachment_id = get_the_post_thumbnail();
            $attachment_id_2 = get_the_post_thumbnail();

       	    if ($detect->isMobile()) {
              if($detect->isTablet()){
                $size = "thumbnail";
       	      } else {
           	 	  $size = "thumbnail";
       	      }
            } else {
              $size = "thumbnail";
            }

      require get_stylesheet_directory() . '/inc/grab-image-src.php';
      require get_stylesheet_directory() . '/inc/grab-hover-src.php';

            
            ?>
        
          <?php if ($image_hover[0]) { ?>
          <div class="hover-image">
            <?php the_post_thumbnail('full'); ?>
          </div>
          <?php } ?>
          <div class="figcaption-bg" style="<?php if ($color) { echo 'background:' . $color .';'; } ?> -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacitycalc *100; ?>)';filter: alpha(opacity=<?php echo $opacitycalc *100; ?>);-moz-opacity: <?php echo $opacitycalc; ?>;-khtml-opacity: <?php echo $opacitycalc; ?>;opacity: <?php echo $opacitycalc; ?>;">&nbsp;</div>
          <?php if (get_field('thumbnail_title')) { ?>
            <div class="figcaption <?php echo $row_item_overlay_text_size; ?>">
              <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 0px solid transparent; text-decoration: underline;';} else { echo 'border-bottom: 0px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
            </div>
          <?php } else { ?>
            <div class="figcaption <?php echo $row_item_overlay_text_size; ?>">
              <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 0px solid transparent; text-decoration: underline;';} else { echo 'border-bottom: 0px solid transparent'; }} ?>"><?php echo the_title(); ?></span>
            </div>
          <?php } ?>

          <?php

         		  $rand = rand(0,2);
         		  $img = '';

         		  if ($rand == 0) {
         		    $img = 'row-portrait-white.png';
         		  } else if ($rand == 1) {
           		  $img = 'row-square-white.png';
         		  } else if ($rand == 2) {
           		  $img = 'row-landscape-white.png';
         		  } else if ($rand == 3) {
           		  $img = 'row-portrait-grey.png';
         		  } else if ($rand == 4) {
           		  $img = 'row-square-black.png';
         		  } else if ($rand == 5) {
           		  $img = 'row-landscape-black.png';
         		  } else if ($rand == 6) {
           		  $img = 'row-portrait-blue.png';
         		  } else if ($rand == 7) {
           		  $img = 'row-square-blue.png';
         		  } else if ($rand == 8) {
           		  $img = 'row-landscape-blue.png';
         		  } else if ($rand == 9) {
           		  $img = 'row-portrait-grey.png';
         		  } else if ($rand == 10) {
           		  $img = 'row-square-grey.png';
         		  } else if ($rand == 11) {
           		  $img = 'row-landscape-grey.png';
         		  }
         		  
         		  echo '<img class="reverse" src="'  . get_bloginfo('stylesheet_directory') . '/images/'.$img.'" data-width="400" data-height="400" />' ;

          ?>          
        </div>
      
      </a>
      
    </div>
  </div>
  
<?php } ?>

<?php } ?>