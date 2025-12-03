<?php

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'product_about',
        'title' => 'Data i miejsce',
        'menu_order' => 2, 
        'fields' => [
            [
                'key' => 'field_product_about',
                'label' => '',
                'name' => 'product_about',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_product_about_main_name', // Zmieniony klucz dla unikalności
                        'label' => 'Nazwa',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_product_about_main_date', // Zmieniony klucz dla unikalności
                        'label' => 'Data',
                        'name' => 'date',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_product_about_main_place', // Zmieniony klucz dla unikalności
                        'label' => 'Miejsce',
                        'name' => 'place',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [[
            ['param' => 'post_type', 'operator' => '==', 'value' => 'product'],
        ]],
        'position' => 'normal',
        'active' => true,
    ]);
});