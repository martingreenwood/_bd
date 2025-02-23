<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>

<div class="item col col-100 push-0 left">
	<div class="col-inner-hori">
		<div class="large align-left lb-1">
			<div class="text-item">
				<p class="cart-empty">
					Your Shopping Cart
				</p>

				<p class="cart-empty">
					You have no items in your shopping cart.
				</p>

				<?php do_action( 'woocommerce_cart_is_empty' ); ?>

				<p class="return-to-shop">
					<a class="" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
						<?php _e( 'Click here to continue shopping', 'woocommerce' ) ?>
					</a>
				</p>
			
			</div>
		</div>
	</div>
</div>