<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Offer extends Block
{
	public $name = 'Oferta - Kafelki';
	public $description = 'offer';
	public $slug = 'offer';
	public $category = 'formatting';
	public $icon = 'grid-view';
	public $keywords = ['offer', 'oferta', 'kafelki', 'kategorie'];
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
		$offer = new FieldsBuilder('offer');

		$offer
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])

			->addAccordion('accordion', [
				'label' => 'Oferta - Kafelki',
				'open' => true,
				'multi_expand' => true,
			])

			->addTab('Elementy', ['placement' => 'top'])
			->addText('title', ['label' => 'Tytuł'])
			->addTaxonomy('offer_categories', [
				'label' => 'Kategorie (category) do filtrowania ofert',
				'taxonomy' => 'category',
				'field_type' => 'multi_select',
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'instructions' => 'Wybierz kategorie (operator OR). Zostaw puste, aby pokazać najnowsze oferty bez filtra.',
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
			->addTrueFalse('lightbg', [
				'label' => 'Jasne tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('graybg', [
				'label' => 'Szare tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('whitebg', [
				'label' => 'Białe tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('primarybg', [
				'label' => 'Tło główne',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('secondarybg', [
				'label' => 'Tło dodatkowe',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $offer->build();
	}

	public function with()
	{
		$selected_terms = get_field('offer_categories');

		$args = [
			'post_type'        => 'offer',
			'posts_per_page'   => -1,           // bez limitu
			'orderby'          => 'date',       // bez opcji w ACF
			'order'            => 'DESC',       // bez opcji w ACF
			'suppress_filters' => false,
		];

		if (is_array($selected_terms) && !empty($selected_terms)) {
			$args['tax_query'] = [[
				'taxonomy'         => 'category',
				'field'            => 'term_id',
				'terms'            => array_map('intval', $selected_terms),
				'operator'         => 'IN',
				'include_children' => true,
			]];
		}

		$posts = get_posts($args);

		return [
			'subtitle'      => get_field('subtitle'),
			'title'         => get_field('title'),
			'items'         => $this->mapPosts($posts),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'gap' => get_field('gap'),
			'lightbg' => get_field('lightbg'),
			'graybg' => get_field('graybg'),
			'whitebg' => get_field('whitebg'),
			'primarybg' => get_field('primarybg'),
			'secondarybg' => get_field('secondarybg'),
		];
	}

	protected function mapPosts($posts)
	{
		return array_map(function ($p) {
			$id = $p->ID;
			$excerpt = get_the_excerpt($id);
			if (empty($excerpt)) {
				$excerpt = wp_trim_words(
					strip_tags(get_post_field('post_content', $id, 'raw') ?: ''),
					24,
					'…'
				);
			}
			return [
				'id'        => $id,
				'title'     => get_the_title($id),
				'permalink' => get_permalink($id),
				'image'     => get_the_post_thumbnail($id, 'medium', ['class' => 'img-fluid']),
				'excerpt'   => $excerpt,
			];
		}, $posts ?: []);
	}

	public function enqueue()
	{
		// brak
	}
}
