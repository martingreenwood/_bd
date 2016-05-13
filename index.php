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

			<?php do_action( 'storefront_loop_before' ); ?>

			<?php get_template_part( '/template-parts/layout', 'index' ); ?>

			<?php do_action( 'storefront_loop_after' ); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

</section>

<?php get_footer(); ?>
