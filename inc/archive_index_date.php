          <?php if (get_field('time_date_for_index_module', 'option') == '1') { 
            // Date
            // Time
          ?>
          
          <span class="date">
            <?php the_time(get_option('date_format')); ?><br/>
            <?php the_time(get_option('time_format')); ?>
          </span>
          
          <?php } else if (get_field('time_date_for_index_module', 'option') == '2') { 
            // Date
          ?>
          
          <span class="date">
            <?php the_time(get_option('date_format')); ?>
          </span>
          
          <?php } else { 
            // Time
          ?>
          
          <span class="date">
            <?php the_time(get_option('time_format')); ?>
          </span>
                    
          <?php } ?>