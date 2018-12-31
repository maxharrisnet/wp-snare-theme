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
<section class="featured-product-player">
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
			<div class="product-info">
				<div class="product-name">
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
				<div class="product-purchase">
					<?php
						/**
						 * Hook: woocommerce_after_shop_loop_item_title.
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					<a class="button buy" href="<?php the_permalink(); ?>">
						<i class="fa fa-shopping-bag"></i>Purchase Lease
					</a>
				</div>
			</div>

			<div class="product-image">
				<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
			</div>
			<div class="summary entry-summary">
				<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */

						// TODO: Reset These Values
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );

					 do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div>
</section>