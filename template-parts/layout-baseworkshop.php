
<?php 

// Resets
$posttags = array();
$output = false;

$detect = new Mobile_Detect();
$device = 'desktop'; 

if ($detect->isMobile()) {
	$device = 'mobile';
} 

if ($detect->isMobile() && $detect->isTablet()) {
	$device = 'tablet';
}

$pagetype = 'index';
if (is_single()) {
	$pagetype = 'single';
} else if (is_page()) {
	$pagetype = 'page';
} else if (is_archive()) {
	$pagetype = 'archive';
}

// Title settings
$pre_title_1 = get_field("post_page_display_title_column_width", "options"); 
$pre_title_2 = get_field("post_page_display_title_column_push", "options"); 
$pre_title_3 = get_field("post_page_display_title_line_break", "options"); 
$pre_title_4 = get_field("post_page_display_title_text_align", "options"); 
$pre_title_5 = get_field("post_page_display_title_text_size", "options"); 
$pre_focus_trigger_icon_size = get_field("focus_trigger_icon_size", "options");
$pre_slideshow_arrow_size = get_field("slideshow_arrow_size", "options");

if (get_field("display_post_page_title") && get_field("default_content_editor")) { ?>

<div class="module mpt-lb-0 mpb-<?php if (get_field("default_content_module_line_break", "options")) {echo get_field("default_content_module_line_break", "options");} ?>">
	<div class="col col-50 col-padd-hori">
		<?php if ($pagetype == 'single' || $pagetype == 'page') { ?>
		<h2 class="<?php if ($pre_title_5) {echo $pre_title_5;} else {echo 'default';} ?> <?php if ($pre_title_4) {echo $pre_title_4;} else {echo 'align-left';} ?> <?php if ($pre_title_3) {echo $pre_title_3;} else {echo 'lb-1';} ?>"><?php the_title(); ?></h2>
		  <?php } else { ?>
		<a href="<?php the_permalink(); ?>" class="history <?php if ($pre_title_5) {echo $pre_title_5;} else {echo 'default';} ?> <?php if ($pre_title_4) {echo $pre_title_4;} else {echo 'align-left';} ?> <?php if ($pre_title_3) {echo $pre_title_3;} else {echo 'lb-1';} ?>"><?php the_title(); ?></a>
		  <?php } ?>
	</div>
	<div class="col col-50 col-padd-hori">
		<div class="default">
			<?php the_content(); ?>
            
          
		</div>
	</div>
</div>

<?php 
// IF display title is on
} else if (get_field("display_post_page_title")) { ?>

<div class="module mpt-lb-0 mpb-lb-0">
	<div class="col col-<?php if ($pre_title_1) {echo $pre_title_1;} else {echo '50';} ?> push-<?php if ($pre_title_2) {echo $pre_title_2;} else {echo '0';} ?> col-padd-hori">

	<?php if ($pagetype == 'single' || $pagetype == 'page') { ?>
		<h2 class="<?php if ($pre_title_5) {echo $pre_title_5;} else {echo 'default';} ?> <?php if ($pre_title_4) {echo $pre_title_4;} else {echo 'align-left';} ?> <?php if ($pre_title_3) {echo $pre_title_3;} else {echo 'lb-1';} ?>"><?php the_title(); ?></h2>
	<?php } else { ?>
		<a href="<?php the_permalink(); ?>" class="history <?php if ($pre_title_5) {echo $pre_title_5;} else {echo 'default';} ?> <?php if ($pre_title_4) {echo $pre_title_4;} else {echo 'align-left';} ?> <?php if ($pre_title_3) {echo $pre_title_3;} else {echo 'lb-1';} ?>"><?php the_title(); ?></a>
	<?php } ?>

	</div>
</div>

<?php 
// IF default content editor is on 
} else if (get_field("default_content_editor")) { ?>
<div class="module mpt-lb-0 mpb-<?php if (get_field("default_content_module_line_break", "options")) {echo get_field("default_content_module_line_break", "options");} ?>">
	<?php the_content(); ?>
</div>
<?php } ?>

<?php  

//
// Module Renders Start
//


// Gutter reset
$module_grid_gutter = false;
$override_grid_gutter = false;
$grid_diff = false;

// Column Modules
while(has_sub_field("module_column")):
  
	// Reset
	$module_grid_layout_type = false;
	
	// Module
	$module_padding_top = get_sub_field('module_padding_top');
	$module_padding_bottom = get_sub_field('module_padding_bottom');
	$module_toggle = get_sub_field('module_toggle');
	$module_grid_gutter = get_sub_field('grid_gutter');
	$grid_layout_type = get_sub_field('grid_layout_type');
	
	// If Module Grid Gutter Override
	if ($module_grid_gutter) {
		$override_grid_gutter = $module_grid_gutter;
		if ($override_grid_gutter == '0px') {
			$override_grid_gutter = '0.0';
			$grid_diff = $grid_gutter - $override_grid_gutter; 
		} else {
			$override_grid_gutter = str_replace('px', '', $override_grid_gutter);
			$grid_diff = $grid_gutter - $override_grid_gutter; 
		}
	}

	if ($device == 'mobile' || $device == 'tablet') {
	  $module_grid_gutter = false;
	  $override_grid_gutter = false;
	  $grid_diff = false;
	}
	
	// Float render
	if ($grid_layout_type == 'Float') { ?>
	
	<div class="grid-module module <?php if ($module_padding_top) {echo 'mpt-' .$module_padding_top;} ?> <?php if ($module_padding_bottom) {echo 'mpb-' .$module_padding_bottom;} ?>" style="<?php if ($override_grid_gutter) {echo 'margin-left: '.$grid_diff.'px !important; margin-right: '.$grid_diff.'px !important; overflow: auto;';} ?>">
	  <div class="column-module-inner">
	
	<?php

	if(get_sub_field('column_repeater')):

	?>

	  <?php while(has_sub_field('column_repeater')): ?>
		 
		<?php 
		$width = get_sub_field("width"); 
		$width = str_replace('%', '', $width);
		$push = get_sub_field("push");
		$push = str_replace('%', '', $push);
		$clear = get_sub_field("clear");
		$float = get_sub_field("float");
		?>
		<div class="item col col-<?php echo $width ?> push-<?php echo $push ?> <?php echo $float ?> <?php if ($clear == true) { echo 'clear';} ?>">
		  <div class="col-inner-hori" <?php if ($override_grid_gutter) {echo 'style="margin-left: '.$override_grid_gutter.'px !important; margin-right: '.$override_grid_gutter.'px !important;"';} ?>>
		  
			<?php while(has_sub_field('content')): ?>
		  
			<?php
			
			if(get_row_layout() == "text"): 
			
			  // Text
			  $text = get_sub_field('text');
			  $text_color = get_sub_field('text_color');
			  $text_size = get_sub_field('text_size');
			  $text_align = get_sub_field('text_align');
			  $line_break = get_sub_field('line_break');
			  
			  echo '<div class="'.$text_size.' '.$text_align.' '.$line_break.'" style="color:'.$text_color.';">';
			  if ($text) {
				echo '<div class="text-item">';
				echo $text;
				echo '</div>';
			  }
			  echo '</div>'; 

			elseif(get_row_layout() == "button"): 
			
			  // Text
			  $text = get_sub_field('text');
			  $text_color = get_sub_field('text_color');
			  $text_size = get_sub_field('text_size');
			  $text_align = get_sub_field('text_align');
			  $line_break = get_sub_field('line_break');
			  $background_colour = get_sub_field('background_colour');
			  $page_link = get_sub_field('page_link');
			  
			  echo '<div class="'.$text_size.' '.$text_align.' '.$line_break.'" style="background-color:'.$background_colour.'">';
			  if ($text) {
				echo '<div class="text-item">';
				echo '<a class="button" rel="product" style="color:'.$text_color.';" href="'.$page_link.'">'.$text.'</a>';
				echo '</div>';
			  }
			  echo '</div>'; 

			elseif(get_row_layout() == "social_icons"): 
			
			  
			  
			elseif(get_row_layout() == "add_to_cart"):

			  $line_break = get_sub_field('line_break');

			  echo '<div class="large '.$line_break.'">';
			  //if ($text) {
				echo '<div class="text-item">';
				woocommerce_template_single_add_to_cart();
				echo '</div>';
			  //}
			  echo '</div>'; 

			elseif(get_row_layout() == "product_price"):

			  $line_break = get_sub_field('line_break');
			  $text_size = get_sub_field('text_size');
			  
			  echo '<div class="'.$line_break.' '.$text_size.'">';
			  //if ($text) {
				echo '<div class="text-item">';
				woocommerce_template_loop_price();
				echo '</div>';
			  //}
			  echo '</div>'; 


			elseif(get_row_layout() == "mailchimp_form"):

			  $line_break = get_sub_field('line_break');
			  $text_size = get_sub_field('text_size');
			  
			  echo '<div class="'.$line_break.' '.$text_size.'">';

				echo '<div class="text-item">';
				?>

					<div id="mc_embed_signup">
					<form action="//bendodge.us1.list-manage.com/subscribe/post?u=ab42ab472d&amp;id=bd96b32f03" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					    <div id="mc_embed_signup_scroll">
							
							<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ab42ab472d_bd96b32f03" tabindex="-1" value=""></div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>

							<div class="mc-field-group large align-center lb-0-5">
								<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name">
							</div>
							<div class="mc-field-group large align-center lb-0-5">
								<input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name">
							</div>
							<div class="mc-field-group large align-center lb-0-5">
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
							</div>
						    <div class="mc-field-group large align-center lb-0-5">
						    	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						    </div>
					    </div>
					</form>
					</div>

				<?php 
				echo '</div>';

			  echo '</div>'; 

			elseif(get_row_layout() == "image"):
			
			  // Image
			  $image = get_sub_field('image');
			  $caption_text = get_sub_field('caption_text');
			  if ($caption_text) {
				$caption_text_color = get_sub_field('caption_text_color');
				$caption_text_size = $captions_text_size;
				$caption_text_align = get_sub_field('caption_text_align');
			  }
			  $image_focus_button = get_sub_field('image_focus_button');
			  if ($image_focus_button != 'Off') {
				$image_focus_button_color = get_sub_field('image_focus_button_color');
			  }
			  $line_break = get_sub_field('line_break');

			  // OVERLAY and lINK
			  $page_post_link = get_sub_field('page_post_link');
			  $taxonomy_obj = get_sub_field('taxonomy_link');
			  $overlay_color = get_sub_field('overlay_color');
			  $overlay_colorRGB = hex2rgb($overlay_color);
			  $overlayA = implode(", ", $overlay_colorRGB);
			  $overlay_tranparently = get_sub_field('overlay_tranparently');
			  $overlay_title = get_sub_field('overlay_title');
			  $overlay_sub_title = get_sub_field('overlay_sub_title');
			  $overlay_title_color = get_sub_field('title_color');
			  $overlay_sub_title_color = get_sub_field('sub_title_color');
			  
			  echo '<div class="default '.$line_break.'">';
			  if ($image) {

				$attachment_id = $image;
				
				if ($detect->isMobile()) {
				  if($detect->isTablet()){
					$size = "medium";
				  } else {
					$size = "thumbnail";
				  }
				} else {
				  if ($image_focus_button != 'Off') {
					$size = "large";
				  } else {
					if ($width > '50') {
					  $size = "large";
					} else {
					  $size = "medium";
					}
				  }
				}
				
				require get_stylesheet_directory() . '/inc/grab-image-src.php';
				
				echo '<div class="img-holder">';

				  if ($image_focus_button != 'Off') { ?>

					<div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
					  <span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
					</div>
				  
				  <?php }

				  //echo '<img src="'  . $image[0] . '" data-width="'  . $image[1] . '" data-height="'  . $image[2] . '" />';

						// add page link
						if ($page_post_link){
							echo '<a class="page-post-link" href="'.$page_post_link.'">';
						}
						else if ($taxonomy_obj) {
							echo '<a class="tax-link" href="'.get_category_link($taxonomy_obj->term_id).'">';
						}

						  echo '<img src="'  . $image[0] . '" data-width="'  . $image[1] . '" data-height="'  . $image[2] . '" />';

						  // continue page link
						  if ($page_post_link || $taxonomy_obj) {

							// overlay div
							if ($overlayA) {
							  if (is_array($overlayA)) {
								echo '<div class="link-cover" style="background-color: rgba('.$overlayA[0].','.$overlayA[1].','.$overlayA[2].','.$overlay_tranparently.')">';
							  } else {
								echo '<div class="link-cover" style="background-color: rgba('.$overlayA.','.$overlay_tranparently.')">';
							  }
							}

							// overlay title
							if ($overlay_title) {
							  echo '<div class="overlay-title">';
							  echo '<h3 style="color:'.$overlay_title_color.'">' .$overlay_title. '</h3>';
							  if ($overlay_sub_title) {
								echo '<h4 style="color:'.$overlay_sub_title_color.'">' .$overlay_sub_title. '</h4>';
							  }
							  echo '</div>';
							}

						  // close overlay title
						  if ($overlay_color) {
						  echo '</div>';
						  }                        
						
						// close page link
						echo '</a>';
						}                
				echo '</div>';

			  } else {
					  echo '<div class="img-holder">';
						if ($image_focus_button != 'Off') { ?>
						  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
							<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
						  </div>
						<?php }
					  echo '<img src="'  . get_bloginfo('stylesheet_directory') . '/images/slide.png" data-width="1600" data-height="900" />';
					  echo '</div>';
			  }
			  if ($caption_text) {
				echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
			  }
			  echo '</div>'; 
			  
			elseif(get_row_layout() == "slideshow"):
			
			  require get_stylesheet_directory() . '/inc/slideshow.php';
							
			elseif(get_row_layout() == "embed"):
			  
			  // Embed
			  $html = get_sub_field('html');
			  $caption_text = get_sub_field('caption_text');
			  if ($caption_text) {
				$caption_text_color = get_sub_field('caption_text_color');
				$caption_text_size = $captions_text_size;
				$caption_text_align = get_sub_field('caption_text_align');
			  }
			  $line_break = get_sub_field('line_break');
			  
			  echo '<div class="default '.$line_break.'">';
			  if ($html) {
				echo '<div class="html-embed">';
				echo $html;
				echo '</div>';
			  }
			  if ($caption_text) {
				echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
			  }
			  echo '</div>'; 
			  
			elseif(get_row_layout() == "html"):
			  
			  // HTML
			  $html = get_sub_field('html');
			  
			  echo '<div class="break default lb-1">';
			  if ($html) {
				echo $html;
			  }
			  echo '</div>'; 
			  
			elseif(get_row_layout() == "separator"):
			  
			  // Separator
			  $line_break = get_sub_field('line_break');
			  echo '<div class="default '.$line_break.'">';
			  	echo '<hr>';
			  echo '</div>'; 
	
			elseif(get_row_layout() == "taxonomy_list"):
			  
			  // Taxonomy List
			  $type = get_sub_field('type');
			  $text_size = get_sub_field('text_size');
			  $line_break = get_sub_field('line_break');

			  
			  if ($type == 'Tags') {
			  
				echo '<div class="'.$text_size.' '.$line_break.'">';

				  if (get_field('taxonomy_pre', 'option')) {
					$before = get_field('taxonomy_pre', 'option');
				  } else {
					$before = '';
				  }
				  if (get_field('taxonomy_display_type', 'option') == 'List') {
					$separator = '<br/>';
				  } else {
					$separator = ', '; 
					$inject_css = 'display: inline; float: left;';
				  }
				  
				  $posttags = array();
				  $posttags = get_the_tags();
				  
				  if ($posttags) {
				  
					echo '<span>Tags:<br/></span>';
				  
					if (get_the_tags()) {
					  foreach((get_the_tags()) as $tag) {
					  
						if (get_field('taxonomy_count', 'option')) {
						  $count = ' (' . $tag->count . ')';
						  $inject = $count . $separator;
						} else {
						  $count = '';
						  $inject = $count . $separator;
						}
						
						$output .= $before.'<a href="'.get_tag_link( $tag->term_id ).'" class="history">'.$tag->name.'</a>'.$inject;
					  }
					}
					
					echo rtrim($output, ', ');
				  
				  } else {
					echo '<span>No tags.<br/></span>';
				  }

				echo '</div>';
			  
			  } else {
				
				echo '<div class="'.$text_size.' '.$line_break.'">';
				  
				  if (get_field('taxonomy_pre', 'option')) {
					$before = get_field('taxonomy_pre', 'option');
				  } else {
					$before = '';
				  }
				  
				  if (get_field('taxonomy_display_type', 'option') == 'List') {
					$separator = '<br/>';
				  } else {
					$separator = ', '; 
				  }

				  if (get_the_category()) {
				  
					echo 'Categories:<br/>';
				  
					foreach((get_the_category()) as $category) {
					
					  if (get_field('taxonomy_count', 'option')) {
						$count = ' (' . $category->count . ')';
						$inject = $count . $separator;
					  } else {
						$count = '';
						$inject = $count . $separator;
					  }
					
					  if($taxonomy_display_depth == 'Parent Categories') {
						if($category->category_parent  == 0) {
						  $output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
						}
					  } else if($taxonomy_display_depth == 'Sub Categories') {
						if($category->category_parent  != 0) {
						  $output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
						}
					  } else {
						$output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
					  }
	
					}
				  } else {
					echo '<span>No categories.<br/></span>';
				  }
				  
				  echo rtrim($output, ', ');


				echo '</div>';
				
			  }


	
			endif; 
			
			?>
			
			<?php endwhile; ?>
			
		  </div>
		</div>  
	
	  <?php endwhile; ?>

	<?php
 
	endif;
	
	?>
	
	  </div>
	  
	  <?php if ($module_toggle) { ?>
	  <div class="left hundred">
		<div class="col col-100">
		  <div class="col-inner-hori" <?php if ($override_grid_gutter) {echo 'style="margin-left: '.$override_grid_gutter.'px !important; margin-right: '.$override_grid_gutter.'px !important;"';} ?>>
			<div class="default lb-0-5"><hr/></div>
			<a class="float-module-toggle" data-show-copy="<?php echo get_field('copy_26', 'option'); ?>" data-hide-copy="<?php echo get_field('copy_27', 'option'); ?>" href="#"><?php echo get_field('copy_27', 'option'); ?></a>
		  </div>
		</div>
	  </div>
	  <?php } ?>
	  
	</div>
	
	
	
	
	
	
	<?php } else { // Masonry render ?>
	  
	  
	<div class="column-module column-masonry-module module masonry-holder <?php if ($module_padding_top) {echo 'mpt-' .$module_padding_top;} ?> <?php if ($module_padding_bottom) {echo 'mpb-' .$module_padding_bottom;} ?>">

	  <div class="masonry-module-inner" <?php if ($override_grid_gutter) {echo 'style="margin-left: '.$grid_diff.'px !important; margin-right: '.$grid_diff.'px !important;"';} ?>>

		<div class="masonry packery isotope">
				  <?php if(get_sub_field('column_repeater')): ?>
			<?php while(has_sub_field('column_repeater')): ?>
		 
			  <?php 
				$width = get_sub_field('width');
				$width = str_replace('%','', $width);
			  ?>
			  
			  
			  <div class="masonry-item wsmasonry-item item col col-<?php echo $width; ?>">
				
				<div class="item-content col-inner-hori" style="<?php if ($override_grid_gutter) {echo 'margin-left: '.$override_grid_gutter.'px !important; margin-right: '.$override_grid_gutter.'px !important;';} ?> <?php if ($override_grid_gutter) {echo 'margin-top: '.$override_grid_gutter.'px !important;';} ?> <?php if ($override_grid_gutter) {echo 'margin-bottom: '.$override_grid_gutter.'px !important;';} ?>">
		
				  <?php while(has_sub_field('content')): ?>
				
				  <?php if(get_row_layout() == "text"): 
				  
					// Text
				  
					$text = get_sub_field('text');
					$text_color = get_sub_field('text_color');
					$text_size = get_sub_field('text_size');
					$text_align = get_sub_field('text_align');
					$line_break = get_sub_field('line_break');
					
					
					echo '<div class="'.$text_size.' '.$text_align.' '.$line_break.'" style="color:'.$text_color.';">';
					if ($text) {
					  echo '<div class="text-item">';
					  echo $text;
					  echo '</div>';
					}
					echo '</div>';


					
				  elseif(get_row_layout() == "image"):
				  
					// Image
					
					$image = get_sub_field('image');
					$caption_text = get_sub_field('caption_text');
					if ($caption_text) {
					  $caption_text_color = get_sub_field('caption_text_color');
					  $caption_text_size = $captions_text_size;
					  $caption_text_align = get_sub_field('caption_text_align');
					}
					$image_focus_button = get_sub_field('image_focus_button');
					if ($image_focus_button != 'Off') {
					  $image_focus_button_color = get_sub_field('image_focus_button_color');
					}
					$line_break = get_sub_field('line_break');
					$page_post_link = get_sub_field('page_post_link');
					$taxonomy_obj = get_sub_field('taxonomy_link');
					$overlay_color = get_sub_field('overlay_color');
					$overlay_colorRGB = hex2rgb($overlay_color);
					$overlayA = implode(", ", $overlay_colorRGB);
					$overlay_tranparently = get_sub_field('overlay_tranparently');
					$overlay_title = get_sub_field('overlay_title');
					$overlay_sub_title = get_sub_field('overlay_sub_title');
					$overlay_title_color = get_sub_field('title_color');
					$overlay_sub_title_color = get_sub_field('sub_title_color');
					
					echo '<div class="default '.$line_break.'">';
					if ($image) {
	  
					  $attachment_id = $image;
					  
					  if ($detect->isMobile()) {
						if($detect->isTablet()){
						  $size = "medium";
						} else {
						  $size = "thumbnail";
						}
					  } else {
						if ($image_focus_button != 'Off') {
						  $size = "large";
						} else {
						  if ($width > '50') {
							$size = "large";
						  } else {
							$size = "medium";
						  }
						}
					  }
					  
					  require get_stylesheet_directory() . '/inc/grab-image-src.php';
					  
					  echo '<div class="img-holder">';
			  
					  if ($image_focus_button != 'Off') { ?>
						  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
							<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
						  </div>
						<?php }


						  echo '<img src="'  . $image[0] . '" data-width="'  . $image[1] . '" data-height="'  . $image[2] . '" />';

						  // continue oage link
						  if ($page_post_link || $taxonomy_obj) {

							// overlay div
							if ($overlayA) {
							  if (is_array($overlayA)) {
								echo '<div class="link-cover" style="background-color: rgba('.$overlayA[0].','.$overlayA[1].','.$overlayA[2].','.$overlay_tranparently.')">';
							  } else {
								echo '<div class="link-cover" style="background-color: rgba('.$overlayA.','.$overlay_tranparently.')">';
							  }
							}

								// overlay title
								if ($overlay_title) {
							  	echo '<div class="overlay-title">';

							  	echo '<div class="table">';

								// add page link
								if ($page_post_link){
									echo '<a class="cell middle post-page-link" href="'.$page_post_link.'">';
								}
								else if ($taxonomy_obj) {
									echo '<a class="cell middle tax-link" href="'.get_category_link($taxonomy_obj->term_id).'">';
								}


								echo '<h3 style="color:'.$overlay_title_color.'">' .$overlay_title. '</h3>';
								if ($overlay_sub_title) {
									echo '<h4 style="color:'.$overlay_sub_title_color.'">' .$overlay_sub_title. '</h4>';
								}

								// close page link
								echo '</a>';
								}


							  	echo '</div>'; // end table 
							  
							  	echo '</div>'; // end overlay title

							  // close link cover
							  echo '</div>';           

							}
						

					  echo '</div>';
	  
					  } else {
					
					  echo '<div class="img-holder">';
						if ($image_focus_button != 'Off') { ?>
						  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
							<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
						  </div>
						<?php }
					  echo '<img src="'  . get_bloginfo('stylesheet_directory') . '/images/slide.png" data-width="1600" data-height="900" />';
					  echo '</div>';
					  
					}
					if ($caption_text) {
					  echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
					}
					echo '</div>'; 
					
				  elseif(get_row_layout() == "slideshow"):
				  
					require get_stylesheet_directory() . '/inc/slideshow.php';
					
				  elseif(get_row_layout() == "embed"):
					
					// Embed
					
					$html = get_sub_field('html');
					$caption_text = get_sub_field('caption_text');
					if ($caption_text) {
					  $caption_text_color = get_sub_field('caption_text_color');
					  $caption_text_size = $captions_text_size;
					  $caption_text_align = get_sub_field('caption_text_align');
					}
					$line_break = get_sub_field('line_break');
					
					echo '<div class="default '.$line_break.'">';
					if ($html) {
					  echo '<div class="html-embed">';
					  echo $html;
					  echo '</div>';
					}
					if ($caption_text) {
					  echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
					}
					echo '</div>'; 
					
				  elseif(get_row_layout() == "html"):
					
					// HTML
					
					$html = get_sub_field('html');
					
					echo '<div class="break default lb-1">';
					if ($html) {
					  echo $html;
					}
					echo '</div>'; 
					
				  elseif(get_row_layout() == "separator"):
					
					// Separator
					
					$line_break = get_sub_field('line_break');
					echo '<div class="default '.$line_break.'">';
					echo '<hr/>';
					echo '</div>'; 
		  
				  elseif(get_row_layout() == "taxonomy_list"):
					


					// Taxonomy List
					
					$type = get_sub_field('type');
					$text_size = get_sub_field('text_size');
					$line_break = get_sub_field('line_break');

					
					if ($type == 'Tags') {
					
					  echo '<div class="'.$text_size.' '.$line_break.'">';
	  
						if (get_field('taxonomy_pre', 'option')) {
						  $before = get_field('taxonomy_pre', 'option');
						} else {
						  $before = '';
						}
						if (get_field('taxonomy_display_type', 'option') == 'List') {
						  $separator = '<br/>';
						} else {
						  $separator = ', '; 
						  $inject_css = 'display: inline; float: left;';
						}
						
						$posttags = get_the_tags();
						
						if ($posttags) {
						
						  echo '<span>Tags:<br/></span>';
						
						  if (get_the_tags()) {
							foreach((get_the_tags()) as $tag) {
							
							  if (get_field('taxonomy_count', 'option')) {
								$count = ' (' . $tag->count . ')';
								$inject = $count . $separator;
							  } else {
								$count = '';
								$inject = $count . $separator;
							  }
							  
							  $output .= $before.'<a href="'.get_tag_link( $tag->term_id ).'" class="history">'.$tag->name.'</a>'.$inject;
							}
						  }
						  
						  echo rtrim($output, ', ');
						
						} else {
						  echo '<span>No tags.<br/></span>';
						}
	  
					  echo '</div>';
					
					} else {
					  
					  echo '<div class="'.$text_size.' '.$line_break.'">';
						
						if (get_field('taxonomy_pre', 'option')) {
						  $before = get_field('taxonomy_pre', 'option');
						} else {
						  $before = '';
						}
						
						if (get_field('taxonomy_display_type', 'option') == 'List') {
						  $separator = '<br/>';
						} else {
						  $separator = ', '; 
						}
	  
						if (get_the_category()) {
						
						  echo 'Categories:<br/>';
						
						  foreach((get_the_category()) as $category) {
						  
							if (get_field('taxonomy_count', 'option')) {
							  $count = ' (' . $category->count . ')';
							  $inject = $count . $separator;
							} else {
							  $count = '';
							  $inject = $count . $separator;
							}
						  
							if($taxonomy_display_depth == 'Parent Categories') {
							  if($category->category_parent  == 0) {
								$output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
							  }
							} else if($taxonomy_display_depth == 'Sub Categories') {
							  if($category->category_parent  != 0) {
								$output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
							  }
							} else {
							  $output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
							}
		  
						  }
						} else {
						  echo '<span>No categories.<br/></span>';
						}
						
						echo rtrim($output, ', ');
	  
	  
					  echo '</div>';
					  
					}

				    endif;
				  endwhile; ?>
		
				</div> <!-- end item content -->
			  
			  </div> <!-- end masonry item -->
			<?php endwhile; ?>
		  <?php endif; ?>
		
		</div> <!-- end packery, manry, isotope -->
	  
	  </div> <!-- end masonry inner -->
	  
	  <?php if ($module_toggle) { ?>
	  <div class="left hundred">
		<div class="col col-100">
		  <div class="col-inner-hori" <?php if ($override_grid_gutter) {echo 'style="margin-left: '.$override_grid_gutter.'px !important; margin-right: '.$override_grid_gutter.'px !important;"';} ?>>
			<div class="default lb-0-5"><hr/></div>
			<a class="masonry-module-toggle" data-show-copy="<?php echo get_field('copy_26', 'option'); ?>" data-hide-copy="<?php echo get_field('copy_27', 'option'); ?>" href="#"><?php echo get_field('copy_27', 'option'); ?></a>
		  </div>
		</div>
	  </div>
	  <?php } ?>
	  
	</div>
	  
	<?php }
 
  endwhile; 
  
  
  
  
  


// Gallery Modules
  while(has_sub_field("module_gallery")):
  
	// Reset
	$module_grid_layout_type = false;
	
	// Module
	$module_padding_top = get_sub_field('module_padding_top');
	$module_padding_bottom = get_sub_field('module_padding_bottom');
	$module_grid_gutter = get_sub_field('grid_gutter');
	$module_grid_layout_type = get_sub_field('grid_layout_type');
	
	// If Module Grid Gutter Override
	if ($module_grid_gutter) {
	  $override_grid_gutter = $module_grid_gutter;
	  if ($override_grid_gutter == '0px') {
		$override_grid_gutter = '0.0';
		$grid_diff = $grid_gutter - $override_grid_gutter; 
	  } else {
		$override_grid_gutter = str_replace('px', '', $override_grid_gutter);
		$grid_diff = $grid_gutter - $override_grid_gutter; 
	  }
	}
	
	if ($device == 'mobile' || $device == 'tablet') {
	  $module_grid_gutter = false;
	  $override_grid_gutter = false;
	  $grid_diff = false;
	}
	
	// Row rendered
	if ($module_grid_layout_type == 'Row') {
	
	
	?>
	
	<div class="gallery-module row-module module row-holder <?php if ($module_padding_top) {echo 'mpt-' .$module_padding_top;} ?> <?php if ($module_padding_bottom) {echo 'mpb-' .$module_padding_bottom;} ?>">
	  <div class="row <?php echo $row_item_overlay_text_size; ?>" <?php if ($override_grid_gutter) {echo 'style="margin-top: '.$override_grid_gutter.'px !important;"';} ?>>
  
		<?php
	  
		if(get_sub_field('item_repeater')):
	 
		  while(has_sub_field('item_repeater')): ?>
	 
			<?php 
			
			$image_focus_button = get_sub_field('image_focus_button'); 
			$image_focus_button_color = get_sub_field('image_focus_button_color'); 
			
			?>
				
			<?php if(get_row_layout() == "image"): ?>
			
			  <?php 
			  
			  if ($image_focus_button == 'On') {
				// Grab full image value
				$attachment_id = get_sub_field("image"); 
				$size = "large"; 
				require get_stylesheet_directory() . '/inc/grab-image-src.php';
			  }
			  
			  ?>
			
			  <a href="#" <?php if($image_focus_button == 'On' && $image) {echo 'data-focus-image="'.$image[0].'" '; echo 'data-focus-image-width="'.$image[1].'" '; echo 'data-focus-image-height="'.$image[2].'" ';} ?> class="row-item item row-item-default left preventDefault">
				<div class="col-inner <?php if (get_sub_field('clear')) {echo 'clear';} ?>" <?php if ($override_grid_gutter) {echo 'style="margin-right: '.$override_grid_gutter.'px !important; margin-bottom: '.$override_grid_gutter.'px !important;"';} ?>>
				
				  <div class="img-holder">
						
					<?php if ($image_focus_button != 'Off') { ?>
					  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
						<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
					  </div>
					<?php } ?>
						
					<?php if (get_sub_field('caption_text')) { ?>
					<div class="figcaption-bg" style="<?php if (get_sub_field('caption_background_color')) {echo 'background: '.get_sub_field('caption_background_color').';';} ?>;">&nbsp;</div>
					<div class="figcaption" style="<?php if (get_sub_field('caption_text_color')) {echo 'color: '.get_sub_field('caption_text_color').';';} ?>">
					  <div><?php echo get_sub_field('caption_text'); ?></div>
					</div>
					<?php } ?>
				  
					<?php
		
					$attachment_id = get_sub_field('image');
		
					if (get_sub_field('image')) { 
		
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

					  echo '<img class="reverse" src="'  . $image[0] . '" data-width="'  . $image[1] . '" data-height="'  . $image[2] . '" />';
					
					} else {
					  
					  $img = 'row-square-white.png';
					  echo '<img class="reverse" src="'  . get_bloginfo('stylesheet_directory') . '/images/'.$img.'" data-width="400" data-height="400" />';
					  
					}
		
					?>          
				  </div>
				  
				</div>
			  </a>
				
			<?php elseif(get_row_layout() == "embed"): ?>
			  <a href="#" class="row-item item <?php if($image_focus_button == 'On') {echo 'focus-mode';} ?> row-item-default left preventDefault">
				<div class="col-inner <?php if (get_sub_field('clear')) {echo 'clear';} ?>" <?php if ($override_grid_gutter) {echo 'style="margin-right: '.$override_grid_gutter.'px !important; margin-bottom: '.$override_grid_gutter.'px !important;"';} ?>>
				
				  <div class="img-holder">
					<?php if (get_sub_field('caption_text')) { ?>
					<div class="figcaption-bg" style="<?php if (get_sub_field('caption_background_color')) {echo 'background: '.get_sub_field('caption_background_color').';';} ?>;">&nbsp;</div>
					<div class="figcaption" style="<?php if (get_sub_field('caption_text_color')) {echo 'color: '.get_sub_field('caption_text_color').';';} ?>">
					  <div><?php echo get_sub_field('caption_text'); ?></div>
					</div>
					<?php } ?>
					
					<?php
					
					// Embed
					$html = get_sub_field('html');
					$caption_text = get_sub_field('caption_text');
					if ($caption_text) {
					  $caption_text_color = get_sub_field('caption_text_color');
					  $caption_text_size = $captions_text_size;
					  $caption_text_align = get_sub_field('caption_text_align');
					}
					$line_break = get_sub_field('line_break');

					if ($html) {
					  echo '<div class="html-embed">';
					  echo $html;
					  echo '</div>';
					}
					
					?>
				  
		  
				  </div>
				  
				</div>
			  </a>
					
			<?php elseif(get_row_layout() == "slideshow"): ?>

			  <a href="#" class="row-item <?php if($image_focus_button == 'On') {echo 'focus';} ?> row-item-default left preventDefault">
				<div class="col-inner <?php if (get_sub_field('clear')) {echo 'clear';} ?>" <?php if ($override_grid_gutter) {echo 'style="margin-right: '.$override_grid_gutter.'px !important; margin-bottom: '.$override_grid_gutter.'px !important;"';} ?>>
					
				  <div class="img-holder">
					<?php if (get_sub_field('caption_text')) { ?>
					<div class="figcaption-bg" style="<?php if (get_sub_field('caption_background_color')) {echo 'background: '.get_sub_field('caption_background_color').';';} ?>;">&nbsp;</div>
					<div class="figcaption" style="<?php if (get_sub_field('caption_text_color')) {echo 'color: '.get_sub_field('caption_text_color').';';} ?>">
					  <div>Slideshow support for Gallery:Row layout is coming soon.</div>
					</div>
					<?php } ?>
					<?php require get_stylesheet_directory() . '/inc/slideshow.php'; ?>
				  </div>
				  
				</div>
			  </a>
	
			<?php endif; ?>


	 
		  <?php endwhile;
	 
		endif; 
		
		?>
	
	  </div>
	</div>

	
	<?php
	
	} else {
	  // Masonry render 
	  
	?>
	 
	<div class="gallery-module gallery-masonry-module module masonry-holder <?php if ($module_padding_top) {echo 'mpt-' .$module_padding_top;} ?> <?php if ($module_padding_bottom) {echo 'mpb-' .$module_padding_bottom;} ?>">
	  <div class="masonry-module-inner" <?php if ($override_grid_gutter) {echo 'style="margin-left: '.$grid_diff.'px !important; margin-right: '.$grid_diff.'px !important;"';} ?>>
		<div class="masonry packery isotope">
		
		  <?php if(get_sub_field('item_repeater')): ?>
			<?php while(has_sub_field('item_repeater')): ?>
			  <?php 
			  $width = get_sub_field('width'); 
			  $image_focus_button = get_sub_field('image_focus_button');
			  ?>
			  <div class="masonry-item wsmasonry-item item col col-<?php echo $width; ?>">
				<div class="item-content col-inner" style="<?php if ($override_grid_gutter) {echo 'margin-left: '.$override_grid_gutter.'px !important; margin-right: '.$override_grid_gutter.'px !important;';} ?> <?php if ($override_grid_gutter) {echo 'margin-top: '.$override_grid_gutter.'px !important;';} ?> <?php if ($override_grid_gutter) {echo 'margin-bottom: '.$override_grid_gutter.'px !important;';} ?>">
				  <?php if(get_row_layout() == "image"): ?>

					<?php
					// Image
					$image_focus_button = get_sub_field('image_focus_button');
					
					$image = get_sub_field('image');
					$caption_text = get_sub_field('caption_text');
					if ($caption_text) {
					  $caption_text_color = get_sub_field('caption_text_color');
					  $caption_text_size = $captions_text_size;
					  $caption_text_align = get_sub_field('caption_text_align');
					}
					if ($image_focus_button != 'Off') {
					  $image_focus_button_color = get_sub_field('image_focus_button_color');
					}
					$line_break = get_sub_field('line_break');
					
					echo '<div class="default '.$line_break.'">';
					if ($image) {
	  
					  $attachment_id = $image;
					  
					  if ($detect->isMobile()) {
						if($detect->isTablet()){
						  $size = "medium";
						} else {
						  $size = "thumbnail";
						}
					  } else {
						if ($image_focus_button != 'Off') {
						  $size = "large";
						} else {
						  if ($width > '50') {
							$size = "large";
						  } else {
							$size = "medium";
						  }
						}
					  }
					  
					  require get_stylesheet_directory() . '/inc/grab-image-src.php';
					  
					  echo '<div class="img-holder">';
			  
						if ($image_focus_button != 'Off') { ?>
						  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
							<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
						  </div>
						<?php }
			  
						echo '<img src="'  . $image[0] . '" data-width="'  . $image[1] . '" data-height="'  . $image[2] . '" />';
					  echo '</div>';
	  
					} else {
					 echo '<div class="img-holder">';
			  
						if ($image_focus_button != 'Off') { ?>
						  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
							<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
						  </div>
						  <?php }
						  echo '<img src="'  . get_bloginfo('stylesheet_directory') . '/images/slide.png" data-width="1600" data-height="900" />';
					  echo '</div>';
					}
					if ($caption_text) {
					  echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
					}
					echo '</div>'; ?>
				  
				  <?php elseif(get_row_layout() == "embed"): ?>

					<?php
					
					// Embed
					
					$html = get_sub_field('html');
					$caption_text = get_sub_field('caption_text');
					if ($caption_text) {
					  $caption_text_color = get_sub_field('caption_text_color');
					  $caption_text_size = $captions_text_size;
					  $caption_text_align = get_sub_field('caption_text_align');
					}
					$line_break = get_sub_field('line_break');
					
					echo '<div class="default '.$line_break.'">';
					if ($html) {
					  echo '<div class="html-embed">';
					  echo $html;
					  echo '</div>';
					}
					if ($caption_text) {
					  echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
					}
					echo '</div>';
					
					?>
					
					
				  <?php elseif(get_row_layout() == "slideshow"): ?>
				  
					<?php require get_stylesheet_directory() . '/inc/slideshow.php'; ?>
					
				  <?php endif; ?>

				</div>
			  </div>
			  
			<?php endwhile; ?>
		  <?php endif; ?>
		</div>
	  </div>
	</div>
	  
	  
	<?php
	}
	
  endwhile;
  
  
  
  
  
  
  
  
// Blog Modules
  while(has_sub_field("module_blog")):
  
	// Reset
	$module_grid_layout_type = false;
  
	// Module
	$module_padding_top = get_sub_field('module_padding_top');
	$module_padding_bottom = get_sub_field('module_padding_bottom');
	$module_layout = get_sub_field('module_layout');
	$module_date_color = get_sub_field('module_date_color');
	
	$col_left = '25';
	$push_left = '25';
	$col_right = '50';
	$push_right = '0';
	$reverser = false;
	
	if ($module_layout == 'Left 50%') {
	  $col_left = '25';
	  $push_left = '25';
	  $col_right = '50';
	  $push_right = '0';
	  $reverser = true;
	} else if ($module_layout == 'Left 75%') {
	  $col_left = '25';
	  $push_left = '0';
	  $col_right = '75';
	  $push_right = '0';
	  $reverser = true;
	} else if ($module_layout == 'Center 50%') {
	  $col_left = '25';
	  $push_left = '0';
	  $col_right = '50';
	  $push_right = '0';
	} else if ($module_layout == 'Center 75%') {
	  $col_left = '12';
	  $push_left = '0';
	  $col_right = '75';
	  $push_right = '0';
	} else if ($module_layout == 'Right 50%') {
	  $col_left = '25';
	  $push_left = '25';
	  $col_right = '50';
	  $push_right = '0';
	} else if ($module_layout == 'Right 75%') {
	  $col_left = '25';
	  $push_left = '0';
	  $col_right = '75';
	  $push_right = '0';
	}
	
	echo '<div class="module blog-module mpt-'.$module_padding_top.' mpb-'.$module_padding_bottom.'">';
	
	  if ($reverser) {
		echo '<div class="col right col-'.$col_left.' pull-'.$push_left.' col-padd-hori">';
	  } else {
		echo '<div class="col col-'.$col_left.' push-'.$push_left.' col-padd-hori">'; 
	  }
	  
	  echo '<div class="date default lb-1" style="color:'.$module_date_color.' !important;">';

	   if (get_field('time_date_for_blog_module', 'option') == '1') { 
			// Date
			// Time
		  ?>
		  
		  <span class="date">
			<?php the_time(get_option('date_format')); ?><br/>
			<?php the_time(get_option('time_format')); ?>
		  </span>
		  
		  <?php } else if (get_field('time_date_for_blog_module', 'option') == '2') { ?>

		  <span class="date">
			<?php the_time(get_option('date_format')); ?>
		  </span>
		  
		  <?php } else { 
			// Time
		  ?>
		  
		  <span class="date">
			<?php the_time(get_option('time_format')); ?>
		  </span>
					
		  <?php }

	  echo '</div>';
	  
	  if (is_category() || is_tag()) {
		echo '<a href="' . get_permalink() . '" class="history default lb-1 permalink">';
		  if (get_field('copy_1', 'option')) {echo get_field('copy_1', 'option');}
		echo '</a><br/>';
	  }
	  
	  echo '</div>';
	  
	  echo '<div class="col col-'.$col_right.' push-'.$push_right.' col-padd-hori">';
 
		// Content
		if(get_sub_field('module_content')):
	 
		  while(has_sub_field('module_content')):
			
			if(get_row_layout() == "text"): 
			
			  // Text
			
			  $text = get_sub_field('text');
			  $text_color = get_sub_field('text_color');
			  $text_size = get_sub_field('text_size');
			  $text_align = get_sub_field('text_align');
			  $line_break = get_sub_field('line_break');
			  
			  echo '<div class="'.$text_size.' '.$text_align.' '.$line_break.'" style="color:'.$text_color.';">';
			  if ($text) {
				echo '<div class="text-item">';
				echo $text;
				echo '</div>';
			  }
			  echo '</div>'; 
			  
			elseif(get_row_layout() == "image"):
			
			  // Image
			  
			  $image = get_sub_field('image');
			  $caption_text = get_sub_field('caption_text');
			  if ($caption_text) {
				$caption_text_color = get_sub_field('caption_text_color');
				$caption_text_size = $captions_text_size;
				$caption_text_align = get_sub_field('caption_text_align');
			  }
			  $line_break = get_sub_field('line_break');
			  
			  $image_focus_button = get_sub_field('image_focus_button');
			  if ($image_focus_button != 'Off') {
				$image_focus_button_color = get_sub_field('image_focus_button_color');
				echo '<div class="item default '.$line_break.'">';
			  } else {
				echo '<div class="default '.$line_break.'">';
			  }
			  
			  
			  
			  
			  if ($image) {

				$attachment_id = $image;
				
				if ($detect->isMobile()) {
				  if($detect->isTablet()){
					$size = "medium";
				  } else {
					$size = "thumbnail";
				  }
				} else {
				  if ($image_focus_button != 'Off') {
					$size = "large";
				  } else {
					if ($col_right == '75') {
					  $size = "large";
					} else {
					  $size = "medium";
					}
				  }
				}
				
				require get_stylesheet_directory() . '/inc/grab-image-src.php';
				
				echo '<div class="img-holder">';
		
				  if ($image_focus_button != 'Off') { ?>

					<div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
					  <span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
					</div>
					
				  <?php }
		
				  echo '<img src="'  . $image[0] . '" data-width="'  . $image[1] . '" data-height="'  . $image[2] . '" />';
				echo '</div>';

			  } else {
					  echo '<div class="img-holder">';
						if ($image_focus_button != 'Off') { ?>
						  <div class="focus-mode <?php echo $pre_focus_trigger_icon_size; ?>" <?php if ($image_focus_button_color) {echo 'style="color: '.$image_focus_button_color.'"';} ?>>
							<span class="icons"><?php if ($media_focus_icon == 'Expand 1') {echo 'P';} else if ($media_focus_icon == 'Expand 2') {echo 'Q';} else {echo 'R';} ?></span>
						  </div>
						<?php }
					  echo '<img src="'  . get_bloginfo('stylesheet_directory') . '/images/slide.png" data-width="1600" data-height="900" />';
					  echo '</div>';
			  }
			  if ($caption_text) {
				echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
			  }
			  echo '</div>'; 
			  
			  
			elseif(get_row_layout() == "slideshow"):
			
			  require get_stylesheet_directory() . '/inc/slideshow.php';
			  
			elseif(get_row_layout() == "embed"):
			  
			  // Embed
			  
			  $html = get_sub_field('html');
			  $caption_text = get_sub_field('caption_text');
			  if ($caption_text) {
				$caption_text_color = get_sub_field('caption_text_color');
				$caption_text_size = $captions_text_size;
				$caption_text_align = get_sub_field('caption_text_align');
			  }
			  $line_break = get_sub_field('line_break');
			  
			  echo '<div class="default '.$line_break.'">';
			  if ($html) {
				echo '<div class="html-embed">';
				echo $html;
				echo '</div>';
			  }
			  if ($caption_text) {
				echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
			  }
			  echo '</div>'; 
			
			elseif(get_row_layout() == "separator"):
			  
			  // Separator
			  $line_break = get_sub_field('line_break');
			  echo '<div class="default '.$line_break.'">';
			  echo '<hr/>';
			  echo '</div>'; 
	
			elseif(get_row_layout() == "taxonomy_list"):

			  // Taxonomy List
			  $type = get_sub_field('type');
			  $text_size = get_sub_field('text_size');
			  $line_break = get_sub_field('line_break');
			  
			  if ($type == 'Tags') {
			  
				echo '<div class="'.$text_size.' '.$line_break.'">';

				  if (get_field('taxonomy_pre', 'option')) {
					$before = get_field('taxonomy_pre', 'option');
				  } else {
					$before = '';
				  }
				  if (get_field('taxonomy_display_type', 'option') == 'List') {
					$separator = '<br/>';
				  } else {
					$separator = ', '; 
					$inject_css = 'display: inline; float: left;';
				  }
				  
				  $posttags = get_the_tags();
				  
				  if ($posttags) {
				  
					echo '<span>Tags:<br/></span>';
				  
					if (get_the_tags()) {
					  foreach((get_the_tags()) as $tag) {
					  
						if (get_field('taxonomy_count', 'option')) {
						  $count = ' (' . $tag->count . ')';
						  $inject = $count . $separator;
						} else {
						  $count = '';
						  $inject = $count . $separator;
						}
						
						$output .= $before.'<a href="'.get_tag_link( $tag->term_id ).'" class="history">'.$tag->name.'</a>'.$inject;
					  }
					}
					
					echo rtrim($output, ', ');
				  
				  } else {
					echo '<span>No tags.<br/></span>';
				  }

				echo '</div>';
			  
			  } else {
				
				echo '<div class="'.$text_size.' '.$line_break.'">';
				  
				  if (get_field('taxonomy_pre', 'option')) {
					$before = get_field('taxonomy_pre', 'option');
				  } else {
					$before = '';
				  }
				  
				  if (get_field('taxonomy_display_type', 'option') == 'List') {
					$separator = '<br/>';
				  } else {
					$separator = ', '; 
				  }

				  if (get_the_category()) {
				  
					echo 'Categories:<br/>';
				  
					foreach((get_the_category()) as $category) {
					
					  if (get_field('taxonomy_count', 'option')) {
						$count = ' (' . $category->count . ')';
						$inject = $count . $separator;
					  } else {
						$count = '';
						$inject = $count . $separator;
					  }
					
					  if($taxonomy_display_depth == 'Parent Categories') {
						if($category->category_parent  == 0) {
						  $output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
						}
					  } else if($taxonomy_display_depth == 'Sub Categories') {
						if($category->category_parent  != 0) {
						  $output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
						}
					  } else {
						$output .= $before.'<a href="'.get_category_link( $category->term_id ).'" class="history">'.$category->cat_name.'</a>'.$inject;
					  }
	
					}
				  } else {
					echo '<span>No categories.<br/></span>';
				  }
				  
				  echo rtrim($output, ', ');


				echo '</div>';
				
			  }      
					  

	
			endif; 
 
		  endwhile;
 
		endif;
		
	  echo '</div>';
	
	echo '</div>';
 
endwhile;
  
?>