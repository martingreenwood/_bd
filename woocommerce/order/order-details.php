<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>

<div class="item col col-50 push-0 left">
	<div class="col-inner-hori">
		<div class="large align-left lb-1">
			<div class="text-item">
				<p><?php _e( 'Order Details', 'woocommerce' ); ?></p>
			</div>
		</div>
	</div>
</div>

<div class="item col col-50 push-0 left">
	<div class="col-inner-hori">
		<div class="default align-left lb-1">
			<div class="text-item">

				<div class="shop_table order_details">
	
					<div class="title">
						<div class="item col col-50 push-0 left">
							<div class="large align-left lb-1">
								<p class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></p>
							</div>
						</div>
						<div class="item col col-50 push-0 left">
							<div class="large align-left lb-1">
								<p class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></p>
							</div>
						</div>
					</div>

					<div class="items">
						<?php
							foreach( $order->get_items() as $item_id => $item ) {
								$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
								$purchase_note = get_post_meta( $product->id, '_purchase_note', true );

								wc_get_template( 'order/order-details-item.php', array(
									'order'					=> $order,
									'item_id'				=> $item_id,
									'item'					=> $item,
									'show_purchase_note'	=> $show_purchase_note,
									'purchase_note'			=> $purchase_note,
									'product'				=> $product,
								) );
							}
						?>
						<?php do_action( 'woocommerce_order_items_table', $order ); ?>
					</div>
					
					<!--<div class="total">
						<?php
							foreach ( $order->get_order_item_totals() as $key => $total ) {
								?>
								<div class="item col col-50 push-0 left">
									<div class="default align-left lb-1">
										<p><?php echo $total['label']; ?></p>
									</div>
								</div>
								<div class="item col col-50 push-0 left">
									<div class="default align-left lb-1">
										<p><?php echo $total['value']; ?></p>
									</div>
								</div>
								<?php
							}
						?>
					</div>-->
				</div>

				<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
			</div>
		</div>
	</div>
</div>


<?php if ( $show_customer_details ) : ?>
	<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
<?php endif; ?>
