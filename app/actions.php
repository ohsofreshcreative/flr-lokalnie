<?php

namespace App;

add_action('woocommerce_single_product_summary', function () {

	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);
}, 1);
