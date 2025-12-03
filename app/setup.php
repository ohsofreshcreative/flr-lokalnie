<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
	$style = Vite::asset('resources/css/editor.css');

	$settings['styles'][] = [
		'css' => "@import url('{$style}')",
	];

	return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
	if (! get_current_screen()?->is_block_editor()) {
		return;
	}

	$dependencies = json_decode(Vite::content('editor.deps.json'));

	foreach ($dependencies as $dependency) {
		if (! wp_script_is($dependency)) {
			wp_enqueue_script($dependency);
		}
	}

	echo Vite::withEntryPoints([
		'resources/js/editor.js',
	])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
	return $file === 'theme.json'
		? public_path('build/assets/theme.json')
		: $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {

	// Dodaj wsparcie dla WooCommerce
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');

	/**
	 * Disable full-site editing support.
	 *
	 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
	 */
	remove_theme_support('block-templates');

	/**
	 * Register the navigation menus.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'sage'),
	]);

	/**
	 * Disable the default block patterns.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
	 */
	remove_theme_support('core-block-patterns');

	/**
	 * Enable plugins to manage the document title.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support('title-tag');

	/**
	 * Enable post thumbnail support.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Enable responsive embed support.
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
	 */
	add_theme_support('responsive-embeds');

	/**
	 * Enable HTML5 markup support.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support('html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	]);

	/**
	 * Enable selective refresh for widgets in customizer.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	 */
	add_theme_support('customize-selective-refresh-widgets');
}, 20);

/*--- WOOCOMMERCE PHP FILES ---*/

array_map(function ($file) {
  require_once $file;
}, array_merge(
  glob(get_theme_file_path('app/Woo/*.php')) ?: [],
  glob(get_theme_file_path('app/Woo/*/*.php')) ?: []
));


/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
	$defaultConfig = [
		'before_widget' => '<section class="footer_widget widget %1$s %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title text-h5 text-p-lighter mb-4 flex">',
		'after_title' => '</h4>',
	];

	register_sidebar([
		'name' => __('Primary', 'sage'),
		'id' => 'sidebar-primary',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 1', 'sage'),
		'id'   => 'sidebar-footer-1',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 2', 'sage'),
		'id'   => 'sidebar-footer-2',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 3', 'sage'),
		'id'   => 'sidebar-footer-3',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 4', 'sage'),
		'id'   => 'sidebar-footer-4',
	] + $defaultConfig);
});


/*-- CLEAN TEXT PASTE ---*/

// Wymusza plain paste w ACF WYSIWYG (także w blokach ACF)
add_filter('acf/fields/wysiwyg/settings', function ($settings) {
    // tryb: wklejaj jako czysty tekst
    $settings['paste_as_text'] = true;

    // dopalacz dla TinyMCE (czyści style/spany itd.)
    $settings['tinymce'] = array_merge($settings['tinymce'] ?? [], [
        'paste_as_text' => true,
        'paste_auto_cleanup_on_paste' => true,
        'paste_remove_styles' => true,
        'paste_remove_spans' => true,
        'valid_elements' => '', // opcjonalnie: nie pozwalaj na żadne tagi
    ]);

    return $settings;
});


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

add_filter('woocommerce_add_to_cart_redirect', function () {
    return wc_get_checkout_url();
});

add_filter('woocommerce_add_to_cart_validation', function ($passed) {
    if (! WC()->cart->is_empty()) {
        WC()->cart->empty_cart();
    }
    return $passed;
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



add_action('template_redirect', function () {
    // Sprawdzamy, czy jesteśmy na stronie produktu i czy ma ona ustawione pole "coming_soon".
    if (is_product() && get_post_meta(get_the_ID(), 'coming_soon', true)) {
        
        // Zamiast wstrzykiwać HTML, renderujemy nasz dedykowany widok Blade.
        // Funkcja \Roots\view() jest kluczowa w Sage.
        echo \Roots\view('coming-soon');
        
        // Zatrzymujemy dalsze wykonywanie skryptu, aby WordPress/WooCommerce
        // nie próbował załadować standardowego szablonu produktu.
        exit;
    }
});
