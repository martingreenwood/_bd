<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<div class="order_review_box">

		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="large align-left lb-1">
					<div class="text-item">
						<p id="order_review_heading"><?php _e( 'Your Order', 'woocommerce' ); ?></p>
					</div>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="" class="item col col-50 push-0 left woocommerce-checkout-review-order">
			<div class="col-inner-hori">
				<div class="default align-left lb-1">
					<?php 
					//do_action( 'woocommerce_checkout_order_review' ); 
					woocommerce_order_review();
					?>
				</div>
			</div>
		</div>
		
		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	
	</div>

	<div class="order_review_box">

		<div class="item col col-50 push-0 left">
			<div class="col-inner-hori">
				<div class="large align-left lb-1">
					<div class="text-item">
						<p id="order_review_heading"><?php _e( 'Payment', 'woocommerce' ); ?></p>
					</div>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="" class="item col col-50 push-0 left payment_options">
			<div class="col-inner-hori">
				<div class="default align-left lb-1">
					<?php 
						woocommerce_checkout_payment();
					?>
				</div>
			</div>
		</div>
		
		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
