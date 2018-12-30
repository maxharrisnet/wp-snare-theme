<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class(); ?>>
	<div class="image-cell">
		<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			// do_action( 'woocommerce_before_shop_loop_item_title' );

			$thumbnail_size = 'thumbnail';

			woocommerce_template_loop_product_link_open();
			echo woocommerce_get_product_thumbnail( $thumbnail_size, true );
			woocommerce_template_loop_product_link_close();
		?>
	</div>
	<div class="title-cell">
		<?php
			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			woocommerce_template_loop_product_link_open();
			do_action( 'woocommerce_shop_loop_item_title' );
			woocommerce_template_loop_product_link_close();
		?>
	</div>
	<div class="price-cell">
		<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</div>
	<div class="tax-cell">
		<?php woocommerce_template_single_meta(); ?>
	</div>
	<div class="button-cell">

	<a class="button buy" href="<?php the_permalink(); ?>">
		<i class="fa fa-shopping-bag"></i>
	</a>

</li>