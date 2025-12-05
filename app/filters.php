<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/*--- CHANGE ADD TO CART TITLE ---*/

add_filter('woocommerce_product_single_add_to_cart_text', function () {
    return __('Zarejestruj się', 'sage');
});

/*--- CHANGE CHECKOUT TITLE ---*/

add_filter('gettext', function ($translated_text, $text, $domain) {
    if (is_checkout() && $domain === 'woocommerce' && $text === 'Billing details') {
        $translated_text = 'Zarejestruj się';
    }
    return $translated_text;
}, 20, 3);

/*--- CHANGE BUY BUTTON TEXT ---*/

add_filter('woocommerce_order_button_text', function () {
    return __('Zarejestruj się', 'sage');
});

/*--- CHANGE FORM FIELD ARGUMENTS ---*/

add_filter('woocommerce_form_field_args', function ($args, $key, $value) {
    // Remove "(optional)" text from the label
    $args['label_class'][] = 'sans-optional';
    return $args;
}, 10, 3);

/*--- ADD BEFORE PRODUCT TITLE ---*/
/* 
add_action('init', function () {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

    add_action('woocommerce_single_product_summary', function () {
        $custom_text = 'Rejestracja: '; // <-- Zmień ten tekst na dowolny
        echo '<h1 class="product_title entry-title">' . esc_html($custom_text) . get_the_title() . '</h1>';
    }, 5);
}); */

/*--- CHANGE BILLING ADDRESS HEADING ---*/

add_filter('gettext', function ($translated, $text, $domain) {
    // Interesuje nas tylko WooCommerce
    if ($domain === 'woocommerce' && $translated === 'Adres rozliczeniowy') {
        return 'Dane do faktury';
    }

    return $translated;
}, 10, 3);

/*--- DISABLE AUTOCOMPLETE (HTML Injection) ---*/

add_filter('woocommerce_form_field', function ($field, $key, $args, $value) {
    // jeśli pole zawiera input i nie ma jeszcze autocomplete
    if (strpos($field, '<input') !== false && strpos($field, 'autocomplete=') === false) {
        $field = str_replace('<input', '<input autocomplete="off"', $field);
    }

    return $field;
}, 10, 4);

/*--- CUSTOMIZE CHECKOUT FIELDS (All in one filter) ---*/

add_filter('woocommerce_checkout_fields', function ($fields) {
    
    // 1. Zmiana etykiety imienia
    if (isset($fields['billing']['billing_first_name'])) {
        $fields['billing']['billing_first_name']['label'] = 'Imię';
    }

    // 2. Wyłączenie autocomplete dla wszystkich pól
    // Używamy 'new-password' lub losowego ciągu, bo Chrome ignoruje 'off'
    $random_string = 'nope-' . time(); 

    foreach ($fields as $category => &$fieldset) {
        foreach ($fieldset as $key => &$field) {
            // Hack: Chrome często respektuje 'new-password' nawet dla pól tekstowych
            $field['autocomplete'] = 'new-password'; 
            
            // Alternatywa: jeśli 'new-password' nie zadziała, odkomentuj linię poniżej:
            // $field['autocomplete'] = $random_string;
        }
    }

    // 3. Zmiana uwag do zamówienia
    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['placeholder'] = '';
        $fields['order']['order_comments']['label'] = 'Uwagi do rejestracji';
    }

    return $fields;
});

/*--- ADD CENA BEFORE PRICE ---*/

add_filter('woocommerce_get_price_html', function ($price_html, $product) {
    // Sprawdzamy, czy jesteśmy na stronie pojedynczego produktu,
    // aby etykieta nie pojawiła się np. na stronie sklepu.
    if (is_product()) {
        // Zwracamy nowy HTML z dodaną etykietą.
        // Używamy tagu <span>, aby można było go łatwo stylować w CSS.
        return '<span class="price-label">Cena: </span>' . $price_html;
    }

    // Na wszystkich innych stronach zwracamy cenę bez zmian.
    return $price_html;
}, 10, 2);