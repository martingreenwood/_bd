<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="variation">
	<p>
		<?php foreach ( $item_data as $data ) : ?>
			<span class="variation-<?php echo sanitize_html_class( $data['key'] ); ?>">
				<strong><?php echo strip_tags(wp_kses_post( $data['key'] )); ?>:</strong> 
				<?php echo strip_tags(wp_kses_post( wpautop( $data['display'] ) )); ?> <em>|</em>
			</span>
		<?php endforeach; ?>
	</p>
</div>
