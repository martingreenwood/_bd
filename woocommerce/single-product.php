<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<section id="page_content">

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		//do_action( 'woocommerce_before_main_content' );
	?>

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

				<?php //do_action( 'storefront_page_before' ); ?>

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
				//do_action( 'storefront_page_after' );
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

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action( 'woocommerce_after_main_content' );
	?>

</section>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer(); ?>
