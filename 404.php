<?php
/**
 * The template for displaying 404 pages (not found).
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

			<section class="error-404 not-found">

				<div class="page-content">

					<header class="large page-header">
						<p class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'storefront' ); ?></p>
					</header><!-- .page-header -->

					<p><?php esc_html_e( 'Nothing was found at this location.', 'storefront' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->

	</div><!-- #primary -->

</section>

<?php get_footer(); ?>
