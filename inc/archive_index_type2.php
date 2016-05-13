      <?php if (in_category('Inactive')) { ?>
      
        <div class="col col-25  small-device-hide dimmed">
          <div class="col-inner-hori">
            &mdash;
          </div>
        </div>
        <div class="col col-25 dimmed">
          <div class="col-inner-hori">
            <h2 class="<?php echo $pre_index_text_size; ?>">
              <?php the_title(); ?>
            </h2>
          </div>
        </div>
        <div class="col col-25 dimmed">
          <div class="col-inner-hori">
            <span>
              <?php
              if (is_tag()) {
                require get_stylesheet_directory() . '/inc/cloud-tag.php';
              } else {
                require get_stylesheet_directory() . '/inc/cloud-cat.php';
              }
              ?>
            </span>
          </div>
        </div>
        <div class="col col-25 small-device-hide dimmed">
          <div class="col-inner-hori">
            <?php require get_stylesheet_directory() . '/inc/archive_index_date.php'; ?>
          </div>
        </div>

      <?php } else if ($wp_query->post->ID == $postid || $wp_query->post->ID == $this_page_id) { ?>

        <div class="col col-25  small-device-hide <?php if ($pagetype == 'page' || $pagetype == 'single') {echo 'active';} ?>">
          <div class="col-inner-hori">
            <?php if ($pagetype == 'page' || $pagetype == 'single') { ?> 
              <span class="icons">A</span>
            <?php } else { ?>
              <?php if (get_field('copy_1', 'option')) {echo get_field('copy_1', 'option');} ?> <a href="<?php the_permalink(); ?>" class="history"><?php if (get_field('copy_2', 'option')) {echo get_field('copy_2', 'option');} ?></a>
            <?php } ?>
          </div>
        </div>
        <div class="col col-25 <?php if ($pagetype == 'page' || $pagetype == 'single') {echo 'active';} ?>">
          <div class="col-inner-hori">
            <h2 class="<?php echo $pre_index_text_size; ?>">

                <?php if ($pagetype == 'page' || $pagetype == 'single') { ?> 
                  <?php the_title(); ?>
                <?php } else { ?>
                  <a href="<?php the_permalink(); ?>" class="history">
                    <?php the_title(); ?>
                  </a>
                <?php } ?>

            </h2>
          </div>
        </div>
        <div class="col col-25 <?php if ($pagetype == 'page' || $pagetype == 'single') {echo 'active';} ?>">
          <div class="col-inner-hori">
            <span>
              <?php
              if (is_tag()) {
                require get_stylesheet_directory() . '/inc/cloud-tag.php';
              } else {
                require get_stylesheet_directory() . '/inc/cloud-cat.php';
              }
              ?>
            </span>
          </div>
        </div>
        <div class="col col-25 small-device-hide <?php if ($pagetype == 'page' || $pagetype == 'single') {echo 'active';} ?>">
          <div class="col-inner-hori">
            <?php require get_stylesheet_directory() . '/inc/archive_index_date.php'; ?>
          </div>
        </div>
      
      <?php } else { ?>
      
        <div class="col col-25  small-device-hide">
          <div class="col-inner-hori">
            <?php if (get_field('copy_1', 'option')) {echo get_field('copy_1', 'option');} ?>
          </div>
        </div>
        <div class="col col-25">
          <div class="col-inner-hori">
            <h2 class="<?php echo $pre_index_text_size; ?>">
              <a href="<?php the_permalink(); ?>" class="history">
                <?php the_title(); ?>
              </a>
            </h2>
          </div>
        </div>
        <div class="col col-25">
          <div class="col-inner-hori">
            <span>
              <?php
              if (is_tag()) {
                require get_stylesheet_directory() . '/inc/cloud-tag.php';
              } else {
                require get_stylesheet_directory() . '/inc/cloud-cat.php';
              }
              ?>
            </span>
          </div>
        </div>
        <div class="col col-25 small-device-hide">
          <div class="col-inner-hori">
            <?php require get_stylesheet_directory() . '/inc/archive_index_date.php'; ?>
          </div>
        </div>
      
      <?php } ?>
