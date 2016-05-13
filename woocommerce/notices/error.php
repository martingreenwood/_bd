<?php
/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

$error_font_size = get_field('error_font_size', 'option');

?>

<div class="item col col-100 push-0 left">
	<div class="col-inner-hori">
		<div class="<?php echo $error_font_size; ?> align-left lb-1">
			<div class="text-item">
				<ul class="woocommerce-error">
					<?php foreach ( $messages as $message ) : ?>
					<li><?php echo wp_kses_post( $message ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
