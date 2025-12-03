<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroOffer extends Block
{
    public $name = 'Hero - Oferta';
    public $description = 'hero-offer';
    public $slug = 'hero-offer';
    public $category = 'formatting';
    public $icon = 'align-full-width';
    public $keywords = ['tresc', 'zdjecie', 'hero', 'oferta'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
        'multiple' => true,
        'anchor' => true,
        'customClassName' => true,
    ];

    public function fields()
    {
        $hero_offer = new FieldsBuilder('hero-offer');

        $hero_offer
            ->addText('block-title', [
                'label' => 'Tytuł techniczny (podgląd)',
                'required' => 0,
            ])

            ->addAccordion('accordion_content', [
                'label' => 'Hero - Oferta',
                'open' => true,
                'multi_expand' => true,
            ])
                ->addTab('Treść', ['placement' => 'top'])
                ->addGroup('g_herooffer', ['label' => 'Hero - Oferta'])
                    ->addImage('image', [
                        'label' => 'Obraz',
                        'return_format' => 'array', // url/array/id
                        'preview_size' => 'medium',
                    ])
                    ->addText('title', ['label' => 'Tytuł'])
                    ->addWysiwyg('content', [
                        'label' => 'Treść',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => true,
                    ])
                ->endGroup()

                ->addTab('Odnośniki', ['placement' => 'top'])
                ->addRepeater('r_herooffer', [
                    'label' => 'Odnośniki (kategoria + anchor)',
                    'layout' => 'table',
                    'button_label' => 'Dodaj pozycję',
                ])
                    ->addTaxonomy('term', [
                        'label' => 'Kategoria',
                        'taxonomy' => 'category',
                        'field_type' => 'select',
                        'add_term' => 0,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'instructions' => 'Wybierz kategorię powiązaną z sekcją niżej.',
                    ])
                    ->addText('anchor', [
                        'label' => 'ID anchora (bez #)',
                        'instructions' => 'Np. "oferta-rolety". Musi odpowiadać atrybutowi id sekcji docelowej.',
                    ])
                ->endRepeater()

                ->addTab('Ustawienia bloku', ['placement' => 'top'])
                ->addTrueFalse('flip', [
                    'label' => 'Odwrotna kolejność',
                    'ui' => 1,
                    'ui_on_text' => 'Tak',
                    'ui_off_text' => 'Nie',
                ])
                ->addText('section_id', ['label' => 'ID sekcji'])
                ->addText('section_class', ['label' => 'Dodatkowe klasy CSS']);

        return $hero_offer;
    }

    public function with()
    {
        return [
            'g_herooffer'   => $this->withHero(),
            'nav'           => $this->mapNav(get_field('r_herooffer') ?: []),
            'flip'          => (bool) get_field('flip'),
            'section_id'    => get_field('section_id') ?: null,
            'section_class' => get_field('section_class') ?: '',
        ];
    }

    protected function withHero(): array
    {
        $data = get_field('g_herooffer') ?: [];
        return [
            'image'    => $data['image'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'title'    => $data['title'] ?? null,
            'content'  => $data['content'] ?? null,
        ];
    }

    protected function mapNav(array $rows): array
    {
        $out = [];

        foreach ($rows as $row) {
            $termId = isset($row['term']) ? (int) $row['term'] : 0;
            if (!$termId) {
                continue;
            }

            $term = get_term($termId, 'category');
            if ($term instanceof \WP_Term && !is_wp_error($term)) {
                $anchor = trim((string) ($row['anchor'] ?? ''));
                $anchor = $anchor !== '' ? sanitize_title($anchor) : sanitize_title($term->slug);

                $out[] = [
                    'term_id'   => $term->term_id,
                    'term_slug' => $term->slug,
                    'label'     => $term->name,
                    'anchor'    => $anchor,
                    'href'      => '#' . $anchor,
                ];
            }
        }

        return $out;
    }

    public function enqueue()
    {
        // brak
    }
}
