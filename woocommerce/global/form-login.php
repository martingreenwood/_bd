<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<div class="item col col-100 push-0 left">
		<div class="default align-left lb-1">
			<div class="text-item">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<div class="item col col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default align-left lb-1">
							<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
						</div>
					</div>
				</div>

				<div class="item col col-50 push-0 left">
					<div class="col-inner-hori">
						<div class="default align-left lb-1">
							<p>
								<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="text" class="input-text" name="username" id="username" />
							</p>
							<p>
								<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input class="input-text" type="password" name="password" id="password" />
							</p>
						</div>
					</div>
				</div>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="item col col-25 push-50 left login-button">
					<div class="col-inner-hori">
						<div class="default align-left lb-1">
							<p>
								<?php wp_nonce_field( 'woocommerce-login' ); ?>
								<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
								<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
							</p>
						</div>
					</div>
				</div>

				<div class="item col col-25 push-0 left">
					<div class="col-inner-hori">
						<div class="default align-left lb-1">
							<p>
								<label for="rememberme" class="inline">
									<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
								</label>
							</p>
						</div>
					</div>
				</div>

				<div class="item col col-50 push-50 left">
					<div class="col-inner-hori">
						<div class="default align-left lb-1">
							<p class="lost_password">
								<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
							</p>
						</div>
					</div>
				</div>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</div>
		</div>
	</div>

</form>
