<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$product_button_text_size = get_field('product_button_text_size', 'option');

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="item col variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<div class="stock out-of-stock">
			<div class="<?php echo $product_button_text_size; ?> lb-0-5">
				<p><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
			</div>
		</div>
	<?php else : ?>
		<div class="item col col-100 variations" cellspacing="0">
		<!--<?php foreach ( $attributes as $attribute_name => $options ) : ?>
			<tr>
				<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
				<td class="value">
					<?php
						$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
						wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
						echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
					?>
				</td>
			</tr>
        <?php endforeach;?> -->

		<?php 
		$variations_arr = array();
		foreach ( $attributes as $attribute_name => $options ) : 
		    ob_start(); ?>
		    <div class="">
		        <div class="<?php echo $product_button_text_size; ?> lb-0-5 value">
		            <?php $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
		            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
		            echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . __( 'Clear selection', 'woocommerce' ) . '</a>' : ''; ?>
		        </div>
		    </div>
		    <?php $variations_ob = ob_get_clean();
		    $variations_arr[wc_attribute_label($attribute_name)] = $variations_ob;
		endforeach;

		foreach ($variations_arr as $name => $ob) {
		    echo str_ireplace('choose an option', 'Select '.$name, $ob );
		} ?>
		</div>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="item col col-100 single_variation_wrap">
			<div class="">
				<div class="<?php echo $product_button_text_size; ?> lb-0-5 value">
				<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
				?>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
