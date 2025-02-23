<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
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

wc_print_notices(); ?>

<div class="grid-module module mpt-lb-1 mpb-lb-0">
	<div class="column-module-inner">
		<div class="item col col-50 push-50 left">
			<div class="col-inner-hori">
				<div class="default lb-0-5">
					<p class="myaccount_user">
						<?php
						printf(
							__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
							$current_user->display_name,
							wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
						);
						?>
					</p>

					<p class="mycount_user">
						<?php
						printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your details</a>.', 'woocommerce' ),
							wc_customer_edit_account_url()
						);
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="grid-module module mpt-lb-1 mpb-lb-0">
	<div class="column-module-inner">
	<?php do_action( 'woocommerce_before_my_account' ); ?>


	<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

	<div class="item col col-100 push-0 left ">
		<div class="col-inner-hori">
			<div class="default lb-1-5"><hr></div>					
		</div>
	</div>

	<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

	<div class="item col col-100 push-0 left ">
		<div class="col-inner-hori">
			<div class="default lb-1-5"><hr></div>					
		</div>
	</div>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>


	<?php do_action( 'woocommerce_after_my_account' ); ?>
	</div>

</div>