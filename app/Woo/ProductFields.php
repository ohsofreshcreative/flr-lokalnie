<?php

namespace App;

/**
 * -------------------------------------------------------------------------
 * SEKCJA 2: MODYFIKACJE WYGLĄDU STRONY PRODUKTU
 * -------------------------------------------------------------------------
 */

// 1. Usuń domyślny tytuł produktu
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// 2. Dodaj własny szablon tytułu, przekazując mu dane z ACF
add_action('woocommerce_single_product_summary', function () {
	echo \Roots\view('woocommerce.single-product.custom-title', [
		'custom_text' => get_field('event_date'), // Używamy pola z datą wydarzenia
		'certificate_link' => get_field('cert-link'),
		'certificate_img' => get_field('cert-img'),
	])->render();
}, 5);


/**
 * -------------------------------------------------------------------------
 * SEKCJA 3: REJESTRACJA WSZYSTKICH PÓL ACF DLA PRODUKTÓW
 * -------------------------------------------------------------------------
 */
add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group([
		'key' => 'group_product_master_details',
		'title' => 'Szczegółowe Dane Produktu',
		'fields' => [
			// AKORDEON 1: Dane wydarzenia
			[
				'key' => 'field_accordion_event',
				'label' => 'Dane Wydarzenia',
				'type' => 'accordion',
			],
			[
				'key' => 'field_event_date',
				'label' => 'Data wydarzenia',
				'name' => 'event_date',
				'type' => 'date_picker',
				'instructions' => 'Data pojawi się pod tytułem produktu.',
				'display_format' => 'd F Y',
				'return_format' => 'Ymd',
			],
			[
				'key' => 'field_event_place',
				'label' => 'Miejsce wydarzenia',
				'name' => 'miejsce',
				'type' => 'text',
				'instructions' => 'Podaj lokalizację wydarzenia.',
			],
			[
				'key' => 'field_is_registration_open',
				'label' => 'Rejestracja otwarta?',
				'name' => 'is_registration_open',
				'type' => 'true_false',
				'instructions' => 'Zaznacz, jeśli przycisk "Dodaj do koszyka" ma być widoczny.',
				'ui' => 1,
				'default_value' => 1,
			],
			// === POCZĄTEK: PRZYWRÓCONE POLE TEKSTOWE ===
			[
				'key' => 'field_registration_closed_text',
				'label' => 'Tekst, gdy rejestracja jest zamknięta',
				'name' => 'registration_closed_text',
				'type' => 'text',
				'instructions' => 'Wpisz tekst, który pojawi się zamiast przycisku, np. "Zapisy wkrótce", "Rejestracja zakończona".',
				'conditional_logic' => [
					[
						[
							'field' => 'field_is_registration_open',
							'operator' => '!=',
							'value' => '1',
						],
					],
				],
			],
			// === KONIEC: PRZYWRÓCONE POLE TEKSTOWE ===

			// AKORDEON 2: Program i Partnerzy
			[
				'key' => 'field_accordion_program',
				'label' => 'Program i Partnerzy',
				'type' => 'accordion',
			],
			[
				'key' => 'field_program_url',
				'label' => 'Link do programu',
				'name' => 'programis',
				'type' => 'file',
			],
			[
				'key' => 'field_partner_logo',
				'label' => 'Logo partnera',
				'name' => 'partner',
				'type' => 'image',
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
			],

			// AKORDEON 3: Certyfikat
			[
				'key' => 'field_accordion_certificate',
				'label' => 'Certyfikat',
				'type' => 'accordion',
			],
			[
				'key' => 'field_cert_link',
				'label' => 'Link do certyfikatu',
				'name' => 'cert-link',
				'type' => 'url',
			],
			[
				'key' => 'field_cert_img',
				'label' => 'Obrazek certyfikatu',
				'name' => 'cert-img',
				'type' => 'image',
				'return_format' => 'url',
			],
		],
		'location' => [
			[['param' => 'post_type', 'operator' => '==', 'value' => 'product']],
		],
		'position' => 'normal',
		'style' => 'default',
		'active' => true,
	]);
});
