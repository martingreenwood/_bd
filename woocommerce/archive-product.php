<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(  ); ?>

	<div id="helper">
		
		<div id="mainside">
			<div id="mainside-fix">
				<div id="mainside-inner">
					<div id="primary" class="content-area hundred">
					
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						//remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
						//do_action( 'woocommerce_before_main_content' );
						$secondary_menu_render_type = get_field('secondary_menu_render_type', 'option');

						$wc_secondary_menu_nav_select = get_field('wc_secondary_menu_nav_select','option');
						$wc_secondary_menu_title = get_field('wc_secondary_menu_title','option');
						$wc_secondary_menu_text_size = get_field('wc_secondary_menu_text_size','option');
						$wc_secondary_menu_margin_bottom = get_field('wc_secondary_menu_margin_bottom','option');

						$menu_id = $wc_secondary_menu_nav_select; 	
						$nav_menu = wp_get_nav_menu_object($menu_id->slug); ?>

						<div id="secondary_menu_holder" <?php if ($nav_menu): ?>data-menu-name="<?php echo $nav_menu->name; ?>"<?php endif; ?> class="module mpt-lb-0 mpb-<?php echo $wc_secondary_menu_margin_bottom; ?> <?php echo str_replace(' ', '-', strtolower($secondary_menu_render_type)); ?> <?php echo $wc_secondary_menu_text_size; ?>">

						<?php
							$title = '';

							if ($wc_secondary_menu_title):
								$title = '<div class="col col-100 col-padd-hori"><h2 class="' . $wc_secondary_menu_text_size . ' lb-1">'. $wc_secondary_menu_title .'</h2></div>';
							endif;

							$defaults = array(
								'menu' => $menu_id->ID,
								'items_wrap' => $title . '<ul id="secondary-menu-holder" class="menu">%3$s</ul>'
							);

							wp_nav_menu($defaults);
						?>

						</div>
	      
						<div class="column-module column-masonry-module module masonry-holder mpt-lb-0 mpb-lb-0">
							<div class="masonry-module-inner" >
								<div id="main" class="masonry packery isotope">

									<?php
										/**
										 * woocommerce_archive_description hook
										 *
										 * @hooked woocommerce_taxonomy_archive_description - 10
										 * @hooked woocommerce_product_archive_description - 10
										 */
										//do_action( 'woocommerce_archive_description' );
									?>

									<?php if ( have_posts() ) : ?>

										<?php
											/**
											 * woocommerce_before_shop_loop hook
											 *
											 * @hooked woocommerce_result_count - 20
											 * @hooked woocommerce_catalog_ordering - 30
											 */
											//do_action( 'woocommerce_before_shop_loop' );
										?>

										<?php woocommerce_product_loop_start(); ?>

											<?php woocommerce_product_subcategories(); ?>

											<?php while ( have_posts() ) : the_post(); ?>

												<?php wc_get_template_part( 'content', 'product' ); ?>

											<?php endwhile; // end of the loop. ?>

										<?php woocommerce_product_loop_end(); ?>

									<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

										<?php wc_get_template( 'loop/no-products-found.php' ); ?>

									<?php endif; ?>

									<?php
										/**
										 * woocommerce_after_main_content hook
										 *
										 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the 	content)
										 */
										//do_action( 'woocommerce_after_main_content' );
									?>

									<?php
										/**
										 * woocommerce_sidebar hook
										 *
										 * @hooked woocommerce_get_sidebar - 10
										 */
										//do_action( 'woocommerce_sidebar' );
									?>
								</div>
							</div>
						</div>

						<?php
							/**
							 * woocommerce_after_shop_loop hook
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>

					</div>
				</div>
			</div>
		</div>
    
	</div>


<?php get_footer(  ); ?>
