<?php

  // Slideshow
  $slide_repeater = get_sub_field('slide_repeater');
  $caption_text = get_sub_field('caption_text');
  if ($caption_text) {
    $caption_text_color = get_sub_field('caption_text_color');
    $caption_text_size = $captions_text_size;
    $caption_text_align = get_sub_field('caption_text_align');
  }
  $slideshow_override_color = get_sub_field('slideshow_override_color');
  $line_break = get_sub_field('line_break');
  
  echo '<div class="default '.$line_break.'">';
    if ($slide_repeater) {
      include('slideshow-royal.php');
    }
    if ($caption_text) {
      echo '<div class="figcaption '.$caption_text_size.' '.$caption_text_align.'" style="color:'.$caption_text_color.';">'.$caption_text.'</div>';
    }
  echo '</div>';

?>