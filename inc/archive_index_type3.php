      <?php if (in_category('Inactive')) { ?>
      
        <div class="col col-50 dimmed">
          <div class="col-inner-hori">
            <h2 class="<?php echo $pre_index_text_size; ?>">
              <?php the_title(); ?>
            </h2>
          </div>
        </div>
        <div class="col col-50 dimmed">
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

      <?php } else if ($wp_query->post->ID == $postid || $wp_query->post->ID == $this_page_id) { ?>

        <div class="col col-50 <?php if ($pagetype == 'page' || $pagetype == 'single') {echo 'active';} ?>">
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
        <div class="col col-50 <?php if ($pagetype == 'page' || $pagetype == 'single') {echo 'active';} ?>">
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

      <?php } else { ?>
      
        <div class="col col-50">
          <div class="col-inner-hori">
            <h2 class="<?php echo $pre_index_text_size; ?>">
              <a href="<?php the_permalink(); ?>" class="history">
                <?php the_title(); ?>
              </a>
            </h2>
          </div>
        </div>
        <div class="col col-50">
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
      
      <?php } ?>
