<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<div class="shop_table shop_table_responsive">

		<div class="cart-titles">
			<div class="col-100 push-0 left">
				<div class="col-inner-hori">
					<div class="default lb-0-5">
						<h2 class="large lb-0-5"><?php _e( 'Cart Totals', 'woocommerce' ); ?></h2>
					</div>
				</div>
			</div>
		</div>

		<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
			<div class="separator-hr col col-100 col-padd-hori">
				<hr style="">
			</div>
		</div>

		<div class="cart-subtotal">
			<div class="col-50 push-0 left">
				<div class="col-inner-hori">
					<div class="default lb-0-5">
						<p><?php _e( 'Subtotal', 'woocommerce' ); ?></p>
					</div>
				</div>
			</div>
			<div class="col-50 push-0 left">
				<div class="col-inner-hori">
					<div class="default lb-0-5">
						<p><?php wc_cart_totals_subtotal_html(); ?></p>
					</div>
				</div>
			</div>

		</div>

		<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
			<div class="separator-hr col col-100 col-padd-hori">
				<hr style="">
			</div>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default lb-0-5">
							<p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
						</div>
					</div>
				</div>
				<div class="col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default lb-0-5">
							<p><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
						</div>
					</div>
				</div>
			</div>

			<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
				<div class="separator-hr col col-100 col-padd-hori">
					<hr style="">
				</div>
			</div>

		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
				<div class="separator-hr col col-100 col-padd-hori">
					<hr style="">
				</div>
			</div>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="shipping">
				<div class="col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default lb-0-5">
							<p><?php _e( 'Shipping', 'woocommerce' ); ?></p>
						</div>
					</div>
				</div>
				<div class="col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default lb-0-5">
							<p><?php woocommerce_shipping_calculator(); ?></p>
						</div>
					</div>
				</div>
			</div>

			<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
				<div class="separator-hr col col-100 col-padd-hori">
					<hr style="">
				</div>
			</div>


		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee">
				<div class="col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default lb-0-5">
							<p><?php echo esc_html( $fee->name ); ?></p>
						</div>
					</div>
				</div>
				<div class="col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default lb-0-5">
							<p><?php wc_cart_totals_fee_html( $fee ); ?></p>
						</div>
					</div>
				</div>
			</div>

			<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
				<div class="separator-hr col col-100 col-padd-hori">
					<hr style="">
				</div>
			</div>

		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>(' . __( 'estimated for %s', 'woocommerce' ) . ')</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<div class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<div class="col-50 push-0 left">
							<div class="col-inner-hori">
								<div class="default lb-0-5">
									<p><?php echo esc_html( $tax->label ) . $estimated_text; ?></p>
								</div>
							</div>
						</div>
						<div class="col-50 push-0 left">
							<div class="col-inner-hori">
								<div class="default lb-0-5">
									<p><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
								</div>
							</div>
						</div>
					</div>

					<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
						<div class="separator-hr col col-100 col-padd-hori">
							<hr style="">
						</div>
					</div>

				<?php endforeach; ?>
			<?php else : ?>
				<div class="tax-total">
					<div class="col-50 push-0 left">
						<div class="col-inner-hori">
							<div class="default lb-0-5">
								<p><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></p>
							</div>
						</div>
					</div>
					<div class="col-50 push-0 left">
						<div class="col-inner-hori">
							<div class="default lb-0-5">
								<p><?php wc_cart_totals_taxes_total_html(); ?></p>
							</div>
						</div>
					</div>
				</div>

				<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
					<div class="separator-hr col col-100 col-padd-hori">
						<hr style="">
					</div>
				</div>

			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="order-total">
			<div class="col-50 push-0 left">
				<div class="col-inner-hori">
					<div class="default lb-0-5">
						<p><?php _e( 'Total', 'woocommerce' ); ?></p>
					</div>
				</div>
			</div>
			<div class="col-50 push-0 left">
				<div class="col-inner-hori">
					<div class="default lb-0-5">
						<p><?php wc_cart_totals_order_total_html(); ?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="separator-module module mpt-lb-0 mpb-lb-0-5">
			<div class="separator-hr col col-100 col-padd-hori">
				<hr style="">
			</div>
		</div>
		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>

	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
