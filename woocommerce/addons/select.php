<?php

$loop = 0;
$current_value = isset( $_POST['addon-' . sanitize_title( $addon['field-name'] ) ] ) ? wc_clean( $_POST[ 'addon-' . sanitize_title( $addon['field-name'] ) ] ) : '';
?>
<p class="form-row form-row-wide addon-wrap-<?php echo sanitize_title( $addon['field-name'] ); ?>">
	<select class="addon addon-select" name="addon-<?php echo sanitize_title( $addon['field-name'] ); ?>">

		<?php if ( ! isset( $addon['required'] ) ) : ?>
			<option value=""><?php _e('None', 'woocommerce-product-addons'); ?></option>
		<?php else : ?>
			<option value="">Select <?php echo wptexturize( $name ); ?></option>
		<?php endif; ?>

		<?php foreach ( $addon['options'] as $option ) :
			$loop ++;
			$price = $option['price'] > 0 ? ' (' . wc_price( get_product_addon_price_for_display( $option['price'] ) ) . ')' : '';
			?>
			<option data-raw-price="<?php echo esc_attr( $option['price'] ); ?>" data-price="<?php echo get_product_addon_price_for_display( $option['price'] ); ?>" value="<?php echo sanitize_title( $option['label'] ) . '-' . $loop; ?>" <?php selected( $current_value, sanitize_title( $option['label'] ) . '-' . $loop ); ?>><?php echo wptexturize( $option['label'] ) . $price ?></option>
		<?php endforeach; ?>

	</select>
</p>