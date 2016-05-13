<?php 
$i=0;
if (get_field('frontpage_layout_mode', 'option') == 'Grid Masonry'):

	if (have_posts()):
		echo '<div class="masonry-module module masonry-holder mpt-lb-0 mpb-lb-1">';
		echo '<div class="masonry-module-inner">';
		echo '<div class="masonry packery appender">';
		while ( have_posts() ) : the_post();
			require get_stylesheet_directory() . '/inc/archive_grid_masonry.php';
		endwhile;
		echo '</div></div></div>';
		require get_stylesheet_directory() . '/inc/next-prev-nav.php';
	endif;
 	
elseif (get_field('frontpage_layout_mode', 'option') == 'Row'):
  
	echo '<div class="row-module module row-holder"><div class="appender row '.$row_item_overlay_text_size.'">';
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		require get_stylesheet_directory() . '/inc/archive_row.php';
		endwhile;
		echo '</div></div>';
		include('snippets/next-prev-nav.php');
	endif;
 	
elseif (get_field('frontpage_layout_mode', 'option') == 'Index'):

	echo '<div class="index-module module index-list appender">';
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		require get_stylesheet_directory() . '/inc/archive_index.php';
		endwhile;
		echo '</div>';
		require get_stylesheet_directory() . '/inc/next-prev-nav.php';
	endif;
 	
elseif (get_field('frontpage_layout_mode', 'option') == 'Full Render'):

	if ( have_posts() ) :
		echo '<div class="fullpost-module appender">';
		while ( have_posts() ) : the_post();
			require get_stylesheet_directory() . '/inc/archive-full-render.php';
		endwhile;
		echo '</div>';
		require get_stylesheet_directory() . '/inc/next-prev-nav.php';
	endif;

else:
  
	echo '<div class="grid-module module appender mpt-lb-0 mpb-lb-1">';
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		require get_stylesheet_directory() . '/inc/archive_grid_float.php';
		endwhile;
		echo '</div>'; 
		require get_stylesheet_directory() . '/inc/next-prev-nav.php';
	endif;
 	
endif;

wp_reset_query();

?>