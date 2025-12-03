<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OfferCardsBlock extends Block
{
	public $name = 'Kafelki oferty';
	public $description = 'offer-cards-block';
	public $slug = 'offer-cards-block';
	public $category = 'formatting';
	public $icon = 'grid-view';
	public $keywords = ['offer', 'oferta', 'tabs', 'kategorie'];
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
		$offerCardsBlock = new FieldsBuilder('offer-cards-block');

		$offerCardsBlock
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kafelki oferty',
				'open' => false,
				'multi_expand' => true,
			])

			->addTab('Treść', ['placement' => 'top'])
			->addText('subtitle', ['label' => 'Śródtytuł'])
			->addText('title', ['label' => 'Tytuł'])

			->addTaxonomy('offer_categories', [
				'label' => 'Kategorie (category) do wyświetlenia jako TABS',
				'taxonomy' => 'category',
				'field_type' => 'multi_select',
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'instructions' => 'Wybierz kategorie. **Kolejność, w jakiej je wybierzesz, będzie kolejnością zakładek.** Zostaw puste, aby użyć wszystkich kategorii (posortowanych alfabetycznie).',
			])

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
			->addTrueFalse('brandbg', [
				'label' => 'Tło marki',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $offerCardsBlock->build();
	}

	public function with()
	{
		$columns        = get_field('columns') ?: '3';
		$ppp            = get_field('posts_per_page');
		$ppp            = !empty($ppp) ? (int) $ppp : 9;
		$orderby        = get_field('orderby') ?: 'date';
		$order          = get_field('order') ?: 'DESC';
		$selected_terms = get_field('offer_categories');

		// [ZMIANA] Logika pobierania i sortowania termów
		if (is_array($selected_terms) && !empty($selected_terms)) {
			// Użytkownik wybrał kategorie - pobieramy je w podanej kolejności
			$terms = get_terms([
				'taxonomy'   => 'category',
				'include'    => $selected_terms,
				'orderby'    => 'include', // <-- To jest kluczowa zmiana!
				'hide_empty' => false, // Pokaż nawet jeśli kategoria jest chwilowo pusta (bo użytkownik ją wybrał)
			]);
		} else {
			// Użytkownik nie wybrał kategorii - pobieramy wszystkie z przypisanymi ofertami, sortując alfabetycznie
			$terms = get_terms([
				'taxonomy'   => 'category',
				'hide_empty' => true,
				'orderby'    => 'name',
				'order'      => 'ASC',
				'object_ids' => get_posts([
					'post_type' => 'offer',
					'fields' => 'ids',
					'posts_per_page' => -1,
				]),
			]);
		}

		$tabs = [];


		// Zakładki per kategoria
		if (!empty($terms) && is_array($terms)) {
			foreach ($terms as $term) {
				$posts = get_posts([
					'post_type'      => 'offer',
					'posts_per_page' => $ppp,
					'orderby'        => $orderby,
					'order'          => $order,
					'tax_query'      => [[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $term->term_id,
					]],
					'suppress_filters' => false,
				]);

				if (!empty($posts)) {
					$tabs[] = [
						'id'    => 'cat-' . $term->term_id,
						'label' => $term->name,
						'posts' => $this->mapPosts($posts),
					];
				}
			}
		}

		return [
			'subtitle' => get_field('subtitle'),
			'title' => get_field('title'),
			'content'     => get_field('content'),
			'columns'     => $columns,
			'tabs'        => $tabs,
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'lightbg' => get_field('lightbg'),
			'graybg' => get_field('graybg'),
			'whitebg' => get_field('whitebg'),
			'brandbg' => get_field('brandbg'),
		];
	}

	/**
	 * Ujednolicenie danych postów na potrzeby widoku.
	 */
	protected function mapPosts($posts)
	{
		// ... (ta metoda pozostaje bez zmian)
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
				'id'      => $id,
				'title'   => get_the_title($id),
				'permalink' => get_permalink($id),
				'image'   => get_the_post_thumbnail($id, 'medium', ['class' => 'img-fluid']),
				'excerpt' => $excerpt,
			];
		}, $posts);
	}

    public function enqueue()
    {
        // Pozostaw tę metodę pustą.
    }
}
