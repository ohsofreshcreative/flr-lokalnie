<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class EventsList extends Block
{
    public $name = 'Lista Wydarzeń';
    public $description = 'events-list';
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

			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Lista Wydarzeń',
				'open' => false,
				'multi_expand' => true,
			])
            /* --- Sekcja Newslettera --- */
            ->addTab('Newsletter', ['placement' => 'top'])
            ->addTrueFalse('show_newsletter', [
                'label' => 'Pokaż sekcję newslettera?',
                'ui' => 1,
                'default_value' => 1,
            ])
            ->addImage('newsletter_image', [
                'label' => 'Obraz',
                'return_format' => 'array',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])
            ->addText('newsletter_title', [
                'label' => 'Tytuł',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])
            ->addTextarea('newsletter_subtitle', [
                'label' => 'Opis',
                'rows' => 2,
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])
            ->addText('newsletter_shortcode', [
                'label' => 'Shortcode formularza',
                'conditional_logic' => [['field' => 'show_newsletter', 'operator' => '==', 'value' => '1']],
            ])

            /* --- Sekcja Listy Wydarzeń --- */
            ->addTab('Lista Wydarzeń', ['placement' => 'top'])
            ->addText('events_subheader', [
                'label' => 'Tytuł',
            ])
            ->addText('events_header', [
                'label' => 'Nagłówek',
            ])
            ->addTaxonomy('events_category', [
                'label' => 'Wybierz kategorię',
                'taxonomy' => 'product_cat',
                'field_type' => 'select',
                'return_format' => 'slug',
                'allow_null' => 1,
            ])
            ->addTrueFalse('order_by_date', [
                'label' => 'Sortuj po dacie',
                'instructions' => 'Wymaga istnienia pola ACF "data" w produktach. Domyślnie sortuje po dacie publikacji.',
                'ui' => 1,
                'default_value' => 0,
            ])
			
			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('wide', [
				'label' => 'Szeroka kolumna',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addSelect('background', [
                'label' => 'Kolor tła',
                'choices' => [
                    'none' => 'Brak (domyślne)',
                    'section-white' => 'Białe',
                    'section-light' => 'Jasne',
                    'section-gray' => 'Szare',
                    'section-brand' => 'Marki',
                    'section-gradient' => 'Gradient',
                    'section-dark' => 'Ciemne',
                ],
                'default_value' => 'none',
                'ui' => 0, // Ulepszony interfejs
                'allow_null' => 0,
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

			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'gap' => get_field('gap'),
			'background' => get_field('background'),
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