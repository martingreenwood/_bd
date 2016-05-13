<!--
* Built by Pixel Pudu 
* http://www.pixelpudu.com/
-->
<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

require get_stylesheet_directory() . '/inc/vars.php';

?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php storefront_html_tag_schema(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class($device); ?>>

<?php require get_stylesheet_directory() . '/template-parts/toggle-menu.php'; ?>

<?php //require get_stylesheet_directory() . '/template-parts/slide-toggle-menu.php'; ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="header" <?php if (isset($grab_header_background_color)) {echo 'data-color="'.$grab_header_background_color.'"';} else {echo 'data-color="'.get_field('header_background_color', 'option').'"';} ?> class="<?php if ($detect->isTablet()) {echo $tablet_header_position;} else if ($detect->isMobile()) { echo $mobile_header_position;} else {echo $header_position;} ?>">
		<div id="header-fix">
			<div class="header-inner">

				<?php require get_stylesheet_directory() . '/template-parts/seperator-head.php'; ?>
				<?php require get_stylesheet_directory() . '/template-parts/main-menu.php'; ?>

			</div>
		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1" <?php if ($detect->isTablet()): ?>data-col-response="<?php echo $tablet_column_response; ?>"<?php elseif ($detect->isMobile()): ?>data-col-response="<?php echo $mobile_column_response; ?>"<?php endif; ?>>
		<div class="col-full">

		<?php
		/**
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' ); ?>
