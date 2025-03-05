<?php

/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok.
																																																																																																																																											?>">
	<div class="price-and-size-guide-trigger">
		<?php do_action('woocommerce_before_variations_form'); ?>
		<button class="size-guide-trigger" id="size-guide-trigger" type="button">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#151922">
				<path d="m264-569-61 36q-12 8-26 4t-21-17L96-652q-7-12-4.5-25t16.5-21l206-122h56q11 0 17.5 6.5T394-796v12q0 36 25 61t61 25q36 0 61-25t25-61v-12q0-11 6.5-17.5T590-820h56l206 122q14 8 16.5 21t-4.5 25l-60 106q-7 13-21.5 17t-25.5-4l-61-38v397q0 15-9.5 24.5T662-140H298q-15 0-24.5-9.5T264-174v-395Zm54-91v466h324v-466l124 69 42-71-161-96h-33q-9 50-46.5 82T480-644q-53 0-89-32t-45-82h-33l-161 96 42 71 124-69Zm162 184Z"></path>
			</svg> Size guide
		</button>
	</div>

	<button id="newsletter-dialog-trigger" type="button" class="save-button product-page-save-button">Save an extra 10%</button>

	<?php if (empty($available_variations) && false !== $available_variations) : ?>
		<p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0" role="presentation">
			<tbody>
				<?php foreach ($attributes as $attribute_name => $options) : ?>
					<tr>
						<td class="full-width" colspan="2">
							<div class="variation-container">
								<?php $lower_case_attribute_name =  strtolower(wc_attribute_label($attribute_name)); ?>
								<div class="label" data-variation="<?php echo $lower_case_attribute_name; ?>">
									Select <?php echo $lower_case_attribute_name; ?>
								</div>

								<div class="value">
									<?php
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										)
									);
									?>
								</div>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
		<?php do_action('woocommerce_after_variations_table'); ?>

		<div class="single_variation_wrap">
			<?php
			/**
			 * Hook: woocommerce_before_single_variation.
			 */
			do_action('woocommerce_before_single_variation');

			/**
			 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
			 *
			 * @since 2.4.0
			 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
			 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
			 */
			do_action('woocommerce_single_variation');

			/**
			 * Hook: woocommerce_after_single_variation.
			 */
			do_action('woocommerce_after_single_variation');
			?>
		</div>
	<?php endif; ?>

	<?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php
do_action('woocommerce_after_add_to_cart_form');
