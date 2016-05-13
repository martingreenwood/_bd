<?php 
  if (get_sub_field("module_padding_top")) {
    $module_padding_top = get_sub_field("module_padding_top"); 
  } else {
    $module_padding_top = 'lb-0';
  }
  if (get_sub_field("module_padding_bottom")) {
    $module_padding_bottom = get_sub_field("module_padding_bottom");
  } else {
    $module_padding_bottom = 'lb-1';
  }
?>

<div class="separator-module module <?php if ($module_padding_top) {echo 'mpt-' .$module_padding_top;} ?> <?php if ($module_padding_bottom) {echo 'mpb-' .$module_padding_bottom;} ?>">
  <div class="separator-hr col col-100 col-padd-hori">
    <hr style="<?php if (get_sub_field("override_line_color")) {echo 'border-color: '.get_sub_field("override_line_color").';';}; ?>" />
  </div>
</div>