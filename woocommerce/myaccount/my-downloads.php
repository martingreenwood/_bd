<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-downloads.php.
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

if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>

	<?php do_action( 'woocommerce_before_available_downloads' ); ?>

	<div class="item col col-50 push-0 left">
		<div class="col-inner-hori">
			<div class="large lb-0-5">
				<p><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available Downloads', 'woocommerce' ) ); ?></h2>
			</p>
		</div>
	</div>


	<div class="item col col-50 push-o left">
		<div class="col-inner-hori">
			<div class="default lb-0-5">
				<ul class="digital-downloads">
					<?php foreach ( $downloads as $download ) : ?>
						<li>
							<?php
								do_action( 'woocommerce_available_download_start', $download );

								if ( is_numeric( $download['downloads_remaining'] ) )
									echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );

								echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );

								do_action( 'woocommerce_available_download_end', $download );
							?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php endif; ?>
