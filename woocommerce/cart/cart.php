<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//require get_stylesheet_directory() . '/inc/mobile-detect/Mobile_Detect.php';
$detect = new Mobile_Detect();

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<div class="grid-module module mpt-lb-1 mpb-lb-0">
	<div class="column-module-inner">
		
		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="large lb-1">

					<p>Please check the contents of your shopping cart carefully and update quantities or remove any items as necessary.</p>

				</div>
			</div>
		</div>

		<div class="item col col-50 push-0 left">

			<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<div class="shop_table shop_table_responsive cart">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>

						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php $i=0; foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): $i++;

							$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
								?>
								<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

									<div class="col-25 left push-0 product-thumbnail">
										<div class="col-inner-hori">
											<div class="default lb-0-5">

												<div class="table image-holder">
													<div class="cell middle">
													<?php $thumbnailURL = get_field('checkout_image', $product_id);

													if ($thumbnailURL) {
														$thumbnail = "<img src='". $thumbnailURL . "' width='500'>";
													} else {
														$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
													}

													if ( ! $_product->is_visible() ) {
														
														echo $thumbnail;

													} else {
														printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
													}
													?>
													</div>
												</div>

											</div>
										</div>
									</div>

									<div class="<?php if ($detect->isMobile()): ?>col-25<?php elseif ($detect->isTablet()): ?>col-25<?php else: ?>col-50<?php endif; ?> left push-0 product-name">
										<div class="col-inner-hori">
											<div class="default lb-0-5 align-center">
												
												<div class="table">
													<div class="cell middle">

													<?php
														if ( ! $_product->is_visible() ) {
															echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
														} else {
															echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<p data-href="%s">%s</p>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
														}

														// Meta data
														//echo WC()->cart->get_item_data( $cart_item );

														// Backorder notification
														//if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
														//	echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
														//}
													?>
													</div>
												</div>

											</div>
										</div>
									</div>

									<?php /*<div class="item col col-25 push-0 product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</div>

									<div class="item col col-25 push-0 product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
										<div class="col-inner-hori">
											<div class="default lb-0-5">
												<?php
													if ( $_product->is_sold_individually() ) {
														$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
													} else {
														$product_quantity = woocommerce_quantity_input( array(
															'input_name'  => "cart[{$cart_item_key}][qty]",
															'input_value' => $cart_item['quantity'],
															'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
															'min_value'   => '0'
														), $_product, false );
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
												?>
											</div>
										</div>
									</div>*/ ?>

									<div class="<?php if ($detect->isMobile()): ?>col-100<?php elseif ($detect->isTablet()): ?>col-25<?php else: ?>col-25<?php endif; ?> left push-0 product-subtotal">
										<div class="col-inner-hori">

											<div class="default lb-0-5 align-center">

												<?php
													if ( $_product->is_sold_individually() ) {
														$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
													} else {
														$product_quantity = woocommerce_quantity_input( array(
															'input_name'  => "cart[{$cart_item_key}][qty]",
															'input_value' => $cart_item['quantity'],
															'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
															'min_value'   => '0'
														), $_product, false );
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
												?>
											</div>

											<div class="default lb-0-5 align-center">
												<div class="amount-box">
													<?php
														echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
													?>
												</div>
											</div>

										</div>
									</div>

									<?php if(WC()->cart->get_item_data( $cart_item )): ?>
									<div class="col-100 left push-0 product-meta">
										<div class="col-inner-hori">

											<div class="default lb-0-5 align-center">

													<?php // Meta data
													echo WC()->cart->get_item_data( $cart_item ); ?>

											</div>

										</div>
									</div>
									<?php endif; ?>

								</div>
								<?php
							
								if ($i > 0): ?>
								<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
									<div class="separator-hr col col-100 col-padd-hori">
										<hr style="">
									</div>
								</div>
								<?php endif;
							
							endif;
						
						endforeach;

						do_action( 'woocommerce_cart_contents' );
						
						?>
						
						
							<div class="col-50 left push-0 actions">
								<div class="col-inner-hori">
									<div class="large lb-0-5">

									<?php if ( wc_coupons_enabled() ) { ?>
										<div class="coupon">

											<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon Code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />

											<?php do_action( 'woocommerce_cart_coupon' ); ?>
										</div>
									<?php } ?>
									</div>	
								</div>
							</div>

							<div class="col-50 left push-0 update-cart actions">
								<div class="col-inner-hori">
									<div class="large lb-0-5">

										<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

										<?php do_action( 'woocommerce_cart_actions' ); ?>

										<?php wp_nonce_field( 'woocommerce-cart' ); ?>

									</div>
								</div>
							</div>
						

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>

					<?php do_action( 'woocommerce_after_cart_table' ); ?>

				</div>

			</form>

			<div class="col-100 push-0 left cart-collaterals">
				<div class="">
					<div class="default lb-0-5">
						<?php do_action( 'woocommerce_cart_collaterals' ); ?>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>


<?php do_action( 'woocommerce_after_cart' ); ?>
