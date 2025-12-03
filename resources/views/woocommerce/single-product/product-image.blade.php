<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior.
// This check protects against theme overrides being used on older versions of WC.
if (! function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	[
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	]
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">

	<div class="woocommerce-product-gallery__wrapper">
		<?php
		if ($post_thumbnail_id) {
			$html = wc_get_gallery_image_html($post_thumbnail_id, true);
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
			$html .= '</div>';
		}

		echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);

		do_action('woocommerce_product_thumbnails');
		?>
	</div>

	<div class="datetime">
		<?php if (get_field('programis')) : ?>
			<div class="stroke-btn">
				<a target="_blank" href="<?php the_field('programis'); ?>">Pobierz program</a>
			</div>
		<?php endif; ?>

		<?php if (get_field('miejsce')) : ?>
			<h5 class="text-border">Miejsce</h5>
			<p class=""><?php the_field('miejsce'); ?></p>
		<?php endif; ?>

		<?php if (get_field('event_date')) : ?>
			<h5 class="text-border">Termin</h5>
			<p class=" "><?php the_field('event_date'); ?></p>
		<?php endif; ?>
	</div>

	<h5 class="text-border">Organizatorzy</h5>
	<div class="logos flex flex-wrap a-items-c">
		<div class="__img"><img src="https://infu.pl/wp-content/uploads/2024/11/ptpi.svg" alt="PTPI" /></div>
		<div class="__img"><img src="https://infu.pl/wp-content/uploads/2024/11/eve.svg" alt="EVE" /></div>
		<?php if (get_field('partner')) : ?>
			<div class="__img"><img src="<?php the_field('partner'); ?>" alt="Partner" /></div>
		<?php endif; ?>
	</div>


</div>