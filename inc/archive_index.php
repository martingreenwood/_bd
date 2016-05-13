    <!-- Index Item -->
    <?php $pre_index_text_size = get_field('index_text_size', 'option'); ?>
    <div class="item index-item <?php echo $pre_index_text_size; ?>">
      <div class="index-separator col col-100">
        <div class="col-inner-hori">
          <hr/>
        </div>
      </div>
      <div class="index-item-inner">
        <?php
          $index_type_check = get_field('index_module_type', 'option');
          
          if ($index_type_check) {
            if ($index_type_check == '4 Columns') {
              require get_stylesheet_directory() . '/inc/archive_index_type1.php';
            } else if ($index_type_check == '4 Columns Alt.') {
              require get_stylesheet_directory() . '/inc/archive_index_type2.php';
            } else if ($index_type_check == '2 Columns') {
              require get_stylesheet_directory() . '/inc/archive_index_type3.php';
            } else if ($index_type_check == '2 Columns Alt.') {
              require get_stylesheet_directory() . '/inc/archive_index_type4.php';
            } else {
              require get_stylesheet_directory() . '/inc/archive_index_type1.php';
            }
          }
        ?>
      </div>
    </div>