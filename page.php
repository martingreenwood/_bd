<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

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

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php do_action( 'storefront_page_before' ); ?>

				<?php if (isset($search_identifier) && is_page($search_identifier->ID)): ?>
					<?php get_template_part( '/template-parts/layout', 'base' ); ?>
					<?php get_search_form(); ?>
				<?php else: ?>
					<?php get_template_part( '/template-parts/layout', 'base' ); ?>
				<?php endif; ?>

				<!-- Grab child page structure -->
				<?php $this_page_id = $wp_query->post->ID; ?>
				<?php query_posts(array('orderby' => 'menu_order', 'order' => 'ASC', 'post_parent' => $this_page_id, 'post_type' => 'page')); while (have_posts()): the_post(); ?>
				<div class="stack-childpage">
				<?php 
					if (get_field('full_render_separator_border', 'option')): 
						get_template_part( '/template-parts/', 'separator' );
					endif;
				?>
					<?php get_template_part( '/template-parts/layout', 'base' ); ?>
				</div>
				<?php endwhile; ?>

				<?php wp_reset_query(); ?>

				<?php
				/**
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );
				?>
  
			<?php endwhile; else: ?>
			<div class="col col-100">
				<div class="col-inner-hori">
					<p>Sorry, no pages matched your criteria.</p>
				</div>
			</div>
			<?php endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

</section>

<?php get_footer(); ?>
