<?php

namespace App;



/*-- HIDE QUANTITY ---*/

add_filter('woocommerce_is_sold_individually', '__return_true');

add_filter('woocommerce_quantity_input_type', function ($type) {
    if (is_singular('product')) {
        return 'hidden';
    }
    return $type;
}, 10, 1);

add_filter('woocommerce_quantity_input_args', function ($args, $product) {
    if (is_singular('product')) {
        $args['input_value'] = 1;
        $args['min_value'] = 1;
        $args['max_value'] = 1;
    }
    return $args;
}, 10, 2);

add_filter('woocommerce_cart_item_quantity', function ($product_quantity) {
    return '';
}, 10, 1);

add_filter('woocommerce_add_to_cart_validation', function ($passed, $product_id, $quantity) {
    $cart_id = WC()->cart->generate_cart_id($product_id);
    if (WC()->cart->find_product_in_cart($cart_id)) {
        wc_add_notice(__('Możesz posiadać tylko jedną sztukę tego produktu w koszyku.'), 'error');
        return false;
    }
    return $passed;
}, 10, 3);


/*--- CART BEHAVIOR ---*/

add_action('woocommerce_add_to_cart_handler', function ($product_id) {
    if (!isset($product_id)) {
        return;
    }
    if (WC()->cart && !WC()->cart->is_empty()) {
        WC()->cart->empty_cart();
    }
});

add_filter('woocommerce_add_to_cart_json', function ($data) {
    $data['redirect'] = wc_get_checkout_url();
    return $data;
});

add_filter('woocommerce_add_to_cart_redirect', function ($url) {
    return wc_get_checkout_url();
});

/*--- SET PAYU AS DEFAULT ---*/

// 1. Ustaw PayU jako domyślną opcję
add_filter('woocommerce_default_gateway', function () {
    return 'payulistbanks';
});

// 2. Przesuń PayU na samą górę listy (to kluczowe dla poprawnego wyświetlania boxa)
add_filter('woocommerce_available_payment_gateways', function ($gateways) {
    // Sprawdź czy PayU jest dostępne
    if (isset($gateways['payulistbanks'])) {
        $payu = $gateways['payulistbanks'];
        unset($gateways['payulistbanks']);
        // Wstaw na początek tablicy
        return array_merge(['payulistbanks' => $payu], $gateways);
    }
    return $gateways;
});

// 3. Wymuś ustawienie sesji przy wejściu na checkout
// (Naprawia problem, gdy WC pamięta "Przelew" z poprzedniej wizyty)
add_action('template_redirect', function () {
    if (is_checkout() && !is_wc_endpoint_url()) {
        // Jeśli sesja WC istnieje i wybrana metoda jest inna niż PayU
        if (WC()->session && WC()->session->get('chosen_payment_method') !== 'payulistbanks') {
            WC()->session->set('chosen_payment_method', 'payulistbanks');
        }
    }
});



