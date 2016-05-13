<?php
/**
 * The template for displaying search results pages.
 *
 * @package storefront
 */

get_header(); ?>

  <?php 
  
  /* Search PAGE */
  $search_page_id = $search_identifier->ID;
  $term_obj = get_field("inherit_template", $search_page_id);
  $term_id = $term_obj->term_id;
  $taxonomy = $term_obj->taxonomy; 
    
  ?>

<section id="page_content">

	<?php if (isset($sidebar_menu_state)): ?>
	<div 
	id="secondary"
	class="
	<?php if ($sidebar_menu_left_or_right == 'right'): ?>right <?php endif; ?>
	<?php if ($sidebar_menu_items_text_align == 'align-right'):?>align-right <?php endif; ?>
	<?php if ($sidebar_menu_side_border): ?>border <?php endif; ?>
	<?php if ($sidebar_menu_position): echo $sidebar_menu_position; endif; ?>
	">
		<?php get_template_part( '/template-parts/sidebar', 'menu' ); ?>
	</div>
	<?php endif; ?>

	<div id="primary" class="content-area <?php if (!isset($sidebar_menu_state)): ?>hundred<?php endif ?> <?php if (isset($sidebar_menu_left_or_right) == 'right'): ?>right<?php endif; ?> <?php if (isset($sidebar_menu_side_border) && $sidebar_menu_state): ?>border<?php endif; ?>">

		<?php get_template_part( '/template-parts/secondary', 'menu' ); ?>

		<main id="main" class="site-main" role="main">

			<?php

			if($search_page_id): query_posts('page_id='.$search_page_id.'');
	
				while (have_posts ()): the_post();
        	  
					get_template_part( '/template-parts/layout', 'base' );
        	    
        	    	get_search_form();
        	  
				endwhile;
				
			endif;
			
			wp_reset_query(); 

			get_template_part( '/template-parts/layout', 'search' );
			
			?>

		</main><!-- #main -->

	</div><!-- #primary -->

</section>

<?php get_footer(); ?>
