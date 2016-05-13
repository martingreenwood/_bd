<?php 

if (get_field('search_layout_mode', 'option') == 'Grid Masonry'):

	if ( have_posts() ): ?>

	<div class="masonry-module module masonry-holder mpt-lb-0 mpb-lb-1">
		<div class="masonry-module-inner">
			<div class="masonry packery appender">
				<?php while ( have_posts() ) : the_post();
					require get_stylesheet_directory() . '/inc/archive_grid_masonry.php';
				endwhile; ?>
			</div>
		</div>
	</div>
	
	<?php require get_stylesheet_directory() . '/inc/next-prev-nav.php';

	endif;
 	
elseif (get_field('search_layout_mode', 'option') == 'Row'): ?>
  
	<div class="row-module module row-holder">
		<div class="appender row <?php echo $row_item_overlay_text_size; ?>">
  			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				require get_stylesheet_directory() . '/inc/archive_row.php';
			endwhile; ?>
		</div>
	</div>
	
	<?php require get_stylesheet_directory() . '/inc/next-prev-nav.php';

 	endif;
 	
elseif (get_field('search_layout_mode', 'option') == 'Index'): ?>

	<div class="index-module module index-list appender">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			require get_stylesheet_directory() . '/inc/archive_index.php';
		endwhile; ?>
	</div>
	
	<?php require get_stylesheet_directory() . '/inc/next-prev-nav.php';

 	endif;
 	
elseif (get_field('search_layout_mode', 'option') == 'Full Render'):

	if ( have_posts() ) : ?>
	<div class="fullpost-module appender">
		<?php while ( have_posts() ) : the_post();
			require get_stylesheet_directory() . '/inc/archive-full-render.php';
		endwhile; ?>
	</div>
	
	<?php require get_stylesheet_directory() . '/inc/next-prev-nav.php';
 	
 	endif;

else:
  
	if ( have_posts() ) : ?>
	<div class="grid-module module mpt-lb-0 mpb-lb-1">
		<div class="appender">
			<?php while ( have_posts() ) : the_post();
				require get_stylesheet_directory() . '/inc/archive_grid_float.php';
			endwhile; ?>
		</div>
	</div>
	
	<?php require get_stylesheet_directory() . '/inc/next-prev-nav.php';

 	endif;
 	
endif;

?>
