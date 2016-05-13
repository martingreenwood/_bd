<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="item col col-50 push-0 left">
	<div class="col-inner-hori">
		<div class="large align-left lb-1">
			<div class="text-item">
				<p><?php _e( 'Customer Details', 'woocommerce' ); ?></p>
			</div>
		</div>
	</div>
</div>

<div class="item col col-50 push-0 left">
	<div class="col-inner-hori">
		<div class="default align-left lb-1">
			<div class="text-item">
				<table class="shop_table customer_details">
					<?php if ( $order->customer_note ) : ?>
						<tr>
							<th><?php _e( 'Note:', 'woocommerce' ); ?></th>
							<td><?php echo wptexturize( $order->customer_note ); ?></td>
						</tr>
					<?php endif; ?>

					<?php if ( $order->billing_email ) : ?>
						<tr>
							<th><?php _e( 'Email:', 'woocommerce' ); ?></th>
							<td><?php echo esc_html( $order->billing_email ); ?></td>
						</tr>
					<?php endif; ?>

					<?php if ( $order->billing_phone ) : ?>
						<tr>
							<th><?php _e( 'Telephone:', 'woocommerce' ); ?></th>
							<td><?php echo esc_html( $order->billing_phone ); ?></td>
						</tr>
					<?php endif; ?>

					<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="item col col-50 push-0 left">
	<div class="col-inner-hori">
		<div class="large align-left lb-1">
			<div class="text-item">

				<p><?php _e( 'Billing Address', 'woocommerce' ); ?></p>

			</div>
		</div>
	</div>
</div>

<div class="item col col-50 push-0 left">
	<div class="col-inner-hori">
		<div class="default align-left lb-1">
			<div class="text-item">

				<address>
					<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
				</address>

			</div>
		</div>
	</div>
</div>