<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="large align-left lb-1">
					<div class="text-item">
						<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="default align-left lb-1">
					<div class="text-item">
						<p class="woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
							<?php endif; ?>
						</p>
					</div>
				</div>
			</div>
		</div>

	<?php else : ?>

		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="large align-left lb-1">
					<div class="text-item">
						<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="default align-left lb-1">
					<div class="text-item">
						<ul class="woocommerce-thankyou-order-details order_details">
							<li class="order">
								<div class="item col col-50 push-0 left">
									<?php _e( 'Order Number:', 'woocommerce' ); ?>
								</div>
								<div class="item col col-50 push-0 left">
									<strong><?php echo $order->get_order_number(); ?></strong>
								</div>
							</li>
							<li class="date">
								<div class="item col col-50 push-0 left">
									<?php _e( 'Date:', 'woocommerce' ); ?>
								</div>
								<div class="item col col-50 push-0 left">
									<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
								</div>
							</li>
							<li class="total">
								<div class="item col col-50 push-0 left">
									<?php _e( 'Total:', 'woocommerce' ); ?>
								</div>
								<div class="item col col-50 push-0 left">
									<strong><?php echo $order->get_formatted_order_total(); ?></strong>
								</div>
							</li>
							<?php if ( $order->payment_method_title ) : ?>
							<li class="method">
								<div class="item col col-50 push-0 left">
									<?php _e( 'Payment Method:', 'woocommerce' ); ?>
								</div>
								<div class="item col col-50 push-0 left">
									<strong><?php echo $order->payment_method_title; ?></strong>
								</div>
							</li>
							<?php endif; ?>
						</ul>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>

	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
