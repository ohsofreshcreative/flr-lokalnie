<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class EventsList extends Block
{
    public $name = 'Lista Wydarzeń';
    public $description = 'Blok wyświetlający listę wydarzeń (produktów) z opcjonalnym newsletterem.';
    public $slug = 'events-list';
    public $category = 'formatting';
    public $icon = 'calendar-alt';
    public $keywords = ['wydarzenia', 'lista', 'kalendarz', 'newsletter'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
    ];

    public function fields()
    {
        $eventsList = new FieldsBuilder('events_list');

        $eventsList
            ->setLocation('block', '==', 'acf/events-list')
            /* --- Sekcja Newslettera --- */
            ->addTab('Newsletter', ['placement' => 'top'])
            ->addTrueFalse('show_newsletter', [
                'label' => 'Pokaż sekcję newslettera?',
                'ui' => 1,
                'default_value' => 1,
            ])
            ->addImage('newsletter_image', [
                'label' => 'Obrazek w newsletterze',
                'return_format' => 'array',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])
            ->addText('newsletter_title', [
                'label' => 'Tytuł newslettera',
                'default_value' => 'Bądź na bieżąco',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])
            ->addTextarea('newsletter_subtitle', [
                'label' => 'Podtytuł newslettera',
                'rows' => 2,
                'default_value' => 'Zapisz się do newslettera i otrzymuj informacje o najbliższych terminach rejestracji',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])
            ->addText('newsletter_shortcode', [
                'label' => 'Shortcode formularza (np. Contact Form 7)',
                'instructions' => 'Wklej tutaj shortcode formularza, np. [contact-form-7 id="..."]',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])

            /* --- Sekcja Listy Wydarzeń --- */
            ->addTab('Lista Wydarzeń', ['placement' => 'top'])
            ->addText('events_subheader', [
                'label' => 'Nadtytuł listy',
            ])
            ->addText('events_header', [
                'label' => 'Główny tytuł listy',
            ])
            ->addTaxonomy('events_category', [
                'label' => 'Wybierz kategorię wydarzeń',
                'taxonomy' => 'product_cat',
                'field_type' => 'select',
                'return_format' => 'slug',
                'allow_null' => 1,
                'instructions' => 'Wybierz kategorię produktów, które mają być wyświetlane jako wydarzenia. Pozostaw puste, aby wyświetlić wszystkie.',
            ])
            ->addTrueFalse('order_by_date', [
                'label' => 'Sortuj po dacie wydarzenia (pole "data")?',
                'instructions' => 'Wymaga istnienia pola ACF "data" w produktach. Domyślnie sortuje po dacie publikacji.',
                'ui' => 1,
                'default_value' => 0,
            ]);

        return $eventsList->build();
    }

    public function with()
    {
        $events_query = $this->getEventsQuery();

        return [
            'show_newsletter' => get_field('show_newsletter'),
            'newsletter' => [
                'image' => get_field('newsletter_image'),
                'title' => get_field('newsletter_title'),
                'subtitle' => get_field('newsletter_subtitle'),
                'shortcode' => get_field('newsletter_shortcode'),
            ],
            'events' => [
                'subheader' => get_field('events_subheader'),
                'header' => get_field('events_header'),
                'category' => get_field('events_category'),
            ],
            'events_query' => $events_query,
        ];
    }

    public function getEventsQuery()
    {
        // Przywracamy logikę, ale z poprawkami
        $category = get_field('events_category');
        $orderByDate = get_field('order_by_date');

        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1, // Pokaż wszystkie pasujące
            'post_status' => 'publish', // Pokaż tylko opublikowane
        ];

        // Sortowanie po dacie wydarzenia (z pola ACF 'data') lub po dacie publikacji
        if ($orderByDate && get_field('data')) { // Dodano sprawdzenie, czy pole 'data' istnieje
            $args['meta_key'] = 'data';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'ASC'; // Rosnąco, od najbliższego wydarzenia
        } else {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC'; // Malejąco, od najnowszego
        }
        
        return new WP_Query($args);
    }
}