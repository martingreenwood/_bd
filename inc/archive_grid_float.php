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

<?php 
  
if (is_archive()) {
  if (get_sub_field("thumbs_width")) {
    // Is stacked
    $thumbswidth = get_sub_field("thumbs_width");
    $thumbswidth = str_replace('%', '', $thumbswidth);
    $thumbs_title_style = get_sub_field("thumbs_title_style");
    $thumbnails_title_position = get_sub_field("thumbs_overlay_title_position");
    $thumbnails_title_align = get_sub_field("thumbs_below_align");
  } else {
    // Default Archives
    $thumbswidth = get_field('thumbs_width', $taxonomy . '_' . $term_id);
    
    if ($thumbswidth == '12.5%') {
      $thumbswidth = 12;
    } else if ($thumbswidth == '20%') {
      $thumbswidth = 20;
    } else if ($thumbswidth == '25%') {
      $thumbswidth = 25;
    } else if ($thumbswidth == '33%') {
      $thumbswidth = 33;
    } else if ($thumbswidth == '50%') {
      $thumbswidth = 50;
    } else {
      $thumbswidth = 25;
    }
      
    $thumbs_title_style = get_field('thumbs_title_style', $taxonomy . '_' . $term_id);
    $thumbnails_title_position = get_field('thumbs_overlay_title_position', $taxonomy . '_' . $term_id);
    $thumbnails_title_align = get_field('thumbs_below_align', $taxonomy . '_' . $term_id);
  }
}

if (is_home()) {
  // Frontpage
  $thumbswidth = get_field('frontpage_thumbnails_width', 'option');
  
    if ($thumbswidth == '12.5%') {
      $thumbswidth = 12;
    } else if ($thumbswidth == '20%') {
      $thumbswidth = 20;
    } else if ($thumbswidth == '25%') {
      $thumbswidth = 25;
    } else if ($thumbswidth == '33%') {
      $thumbswidth = 33;
    } else if ($thumbswidth == '50%') {
      $thumbswidth = 50;
    } else {
      $thumbswidth = 25;
    }

  
  $thumbs_title_style = get_field('frontpage_thumbnails_title_style', 'option');
  $thumbnails_title_position = get_field('frontpage_thumbnails_overlay_title_position', 'option');
  $thumbnails_title_align = get_field('frontpage_thumbnails_below_align', 'option');
}

if (is_search()) {
  // Searchpage
  $thumbswidth = get_field('search_thumbnails_width', 'option');

    if ($thumbswidth == '12.5%') {
      $thumbswidth = 12;
    } else if ($thumbswidth == '20%') {
      $thumbswidth = 20;
    } else if ($thumbswidth == '25%') {
      $thumbswidth = 25;
    } else if ($thumbswidth == '33%') {
      $thumbswidth = 33;
    } else if ($thumbswidth == '50%') {
      $thumbswidth = 50;
    } else {
      $thumbswidth = 25;
    }


  $thumbs_title_style = get_field('search_thumbnails_title_style', 'option');
  $thumbnails_title_position = get_field('search_thumbnails_overlay_title_position', 'option');
  $thumbnails_title_align = get_field('search_thumbnails_below_align', 'option');
}

?>

<?php if(get_field("thumbnail_image")) { ?>
    
    <!-- Grid Item -->
    <div class="item thumb-item col col-<?php if ($thumbswidth) {echo $thumbswidth;} else {echo '25';} ?>">
      <div class="col-inner">
      
      <?php
      
        if (get_field("advanced_thumbnail")) {
      
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
          $opacitycalc = '1';
        }
        
      ?>
        
        <a href="<?php the_permalink(); ?>" class="history thumb <?php if ($pagetype == 'single' || $pagetype == 'page') { if ($wp_query->post->ID == $postid || $wp_query->post->ID == $this_page_id) {echo 'active';} } ?> <?php if (get_field("advanced_thumbnail")) {echo 'advanced';} ?>" <?php if ($opacitycalc) {echo 'data-opacity="'.$opacitycalc.'"';} ?> <?php if ($color) {echo 'data-bg-color="'.$color.'"';} ?> <?php if ($textcolor) {echo 'data-text-color="'.$textcolor.'"';} ?> <?php if ($hovertextcolor) {echo 'data-hover-text-color="'.$hovertextcolor.'"';} ?>>
          
          <div class="img-holder">
            <?php

            $attachment_id = get_the_post_thumbnail();
            $attachment_id_2 = get_the_post_thumbnail();

       	    if ($detect->isMobile()) {
              if($detect->isTablet()){
                if ($thumbswidth == 25) {
                  $size = "medium";
                } else {
                  $size = "large";
                }
       	      } else {
                if ($thumbswidth == 25) {
                  $size = "thumbnail";
                } else {
                  $size = "medium";
                }
       	      }
            } else {
              if ($thumbswidth == 25) {
                $size = "thumbnail";
              } else {
                $size = "medium";
              }
            }

            require get_stylesheet_directory() . '/inc/grab-image-src.php';
            require get_stylesheet_directory() . '/inc/grab-hover-src.php';
            
            ?>
            
            <?php the_post_thumbnail('full'); ?>
            
            <?php if ($color) { ?>
            <div class="thumb-hover" style="background:<?php echo $color; ?>;-ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacitycalc *100; ?>)';filter: alpha(opacity=<?php echo $opacitycalc *100; ?>);-moz-opacity: <?php echo $opacitycalc; ?>;-khtml-opacity: <?php echo $opacitycalc; ?>;opacity: <?php echo $opacitycalc; ?>;">
              &nbsp;
            </div>
            <?php } else { ?>
            <div class="thumb-hover" style="background:transparent !important;">
              &nbsp;
            </div>
            <?php } ?>
            
            <?php if ($image_hover[0]) { ?>
            <div class="hover-image">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <?php } ?>
            
            <?php if ($thumbs_title_style == 'Overlay') { ?>
            <div class="figcaption <?php echo $thumbnails_title_text_size; ?>">
              <?php if ($thumbnails_title_position == 'Center') { ?>
                  <?php if (get_field('thumbnail_title')) { ?>
                    <div class="vcenter p0 <?php echo $thumbnails_title_position; ?>">
                      <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
                    </div>
                  <?php } else { ?>
                    <div class="vcenter p0 <?php echo $thumbnails_title_position; ?>">
                      <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php the_title(); ?></span>
                    </div>
                  <?php } ?>

                <?php } else { ?>
                  <?php if (get_field('thumbnail_title')) { ?>
                    <div class="<?php echo $thumbnails_title_position; ?>">
                      <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
                    </div>
                  <?php } else { ?>
                    <div class="<?php echo $thumbnails_title_position; ?>">
                      <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php the_title(); ?></span>
                    </div>
                  <?php } ?>
              <?php } ?>
              
            </div>
            <?php } ?>
            
          </div>
        
          <?php if ($thumbs_title_style == 'Below') { ?>
            <?php if (get_field('thumbnail_title')) { ?>
              <div class="figcaption stick <?php echo $thumbnails_title_text_size; ?> <?php echo $thumbnails_title_align; ?>">
                <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
              </div>
            <?php } else { ?>
              <div class="figcaption stick <?php echo $thumbnails_title_text_size; ?> <?php echo $thumbnails_title_align; ?>">
                <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php the_title(); ?></span>
              </div>
            <?php } ?>
          <?php } ?>
        
        </a>
        
      </div>
    </div>

<?php } else { ?>
  
    <!-- Grid Item -->
    <div class="item thumb-item col col-<?php if ($thumbswidth) {echo $thumbswidth;} else {echo '25';} ?>">
      <div class="col-inner">
    
      <?php
      
        if (get_field("advanced_thumbnail")) {
      
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
          $opacitycalc = '1';
        }
        
      ?>
      
      <a href="<?php the_permalink(); ?>" class="history thumb <?php if ($pagetype == 'single' || $pagetype == 'page') { if ($wp_query->post->ID == $postid || $wp_query->post->ID == $this_page_id) {echo 'active';} } ?> <?php if (get_field("advanced_thumbnail")) {echo 'advanced';} ?>" <?php if ($opacitycalc) {echo 'data-opacity="'.$opacitycalc.'"';} ?> <?php if ($color) {echo 'data-bg-color="'.$color.'"';} ?> <?php if ($textcolor) {echo 'data-text-color="'.$textcolor.'"';} ?> <?php if ($hovertextcolor) {echo 'data-hover-text-color="'.$hovertextcolor.'"';} ?>>
        
        <div class="img-holder">
          
          <?php the_post_thumbnail('full'); ?>
          
            <?php

            $attachment_id = get_the_post_thumbnail();
            $attachment_id_2 = get_the_post_thumbnail();

       	    if ($detect->isMobile()) {
              if($detect->isTablet()){
                if ($thumbswidth == 25) {
                  $size = "medium";
                } else {
                  $size = "large";
                }
       	      } else {
                if ($thumbswidth == 25) {
                  $size = "thumbnail";
                } else {
                  $size = "medium";
                }
       	      }
            } else {
              if ($thumbswidth == 25) {
                $size = "thumbnail";
              } else {
                $size = "medium";
              }
            }

      require get_stylesheet_directory() . '/inc/grab-image-src.php';
      require get_stylesheet_directory() . '/inc/grab-hover-src.php';
            
            ?>
          
          <?php if ($color) { ?>
          <div class="thumb-hover" style="background:<?php echo $color; ?>;-ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacitycalc *100; ?>)';filter: alpha(opacity=<?php echo $opacitycalc *100; ?>);-moz-opacity: <?php echo $opacitycalc; ?>;-khtml-opacity: <?php echo $opacitycalc; ?>;opacity: <?php echo $opacitycalc; ?>;">
            &nbsp;
          </div>
          <?php } else { ?>
          <div class="thumb-hover" style="background:transparent !important;">
            &nbsp;
          </div>
          <?php } ?>
          
          <?php if ($image_hover[0]) { ?>
          <div class="hover-image">
            <?php the_post_thumbnail('full'); ?>
          </div>
          <?php } ?>
          
          <?php if ($thumbs_title_style == 'Overlay') { ?>
          <div class="figcaption <?php echo $thumbnails_title_text_size; ?>">
            <?php if ($thumbnails_title_position == 'Center') { ?>
              <?php if (get_field('thumbnail_title')) { ?>
                <div class="vcenter p0 <?php echo $thumbnails_title_position; ?>">
                  <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
                </div>
              <?php } else { ?>
                <div class="vcenter p0 <?php echo $thumbnails_title_position; ?>">
                  <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php the_title(); ?></span>
                </div>
              <?php } ?>
            <?php } else { ?>
              <?php if (get_field('thumbnail_title')) { ?>
                <div class="<?php echo $thumbnails_title_position; ?>">
                  <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
                </div>
              <?php } else { ?>
                <div class="<?php echo $thumbnails_title_position; ?>">
                  <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php the_title(); ?></span>
                </div>
              <?php } ?>
            <?php } ?>
            
          </div>
          <?php } ?>
          
        </div>
      
        <?php if ($thumbs_title_style == 'Below') { ?>
          <?php if (get_field('thumbnail_title')) { ?>
            <div class="figcaption stick <?php echo $thumbnails_title_text_size; ?> <?php echo $thumbnails_title_align; ?>">
              <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php echo get_field('thumbnail_title'); ?></span>
            </div>
          <?php } else { ?>
            <div class="figcaption stick <?php echo $thumbnails_title_text_size; ?> <?php echo $thumbnails_title_align; ?>">
              <span class="underline" style="<?php if ($textcolor) {echo 'color:'.$textcolor.';';if ($link_decoration == '1px always' || $link_decoration == '1px on mouseover and marked') {echo 'border-bottom: 1px solid '.$textcolor.';';} else { echo 'border-bottom: 1px solid transparent'; }} ?>"><?php the_title(); ?></span>
            </div>
          <?php } ?>
        <?php } ?>
      
      </a>
      
    </div>
  </div>

<?php } ?>

<?php } ?>