<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Block
{
	public $name = 'Hero';
	public $description = 'Hero';
	public $slug = 'hero';
	public $category = 'formatting';
	public $icon = 'align-full-width';
	public $keywords = ['tresc', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$hero = new FieldsBuilder('hero');

		$hero
			->setLocation('block', '==', 'acf/hero') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Hero',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_hero', ['label' => 'Hero'])
			->addTrueFalse('use_video', [
  'label' => 'Użyj wideo w tle',
  'ui' => 1,
  'default_value' => 0, // domyślnie obraz
  'ui_on_text' => 'Tak',
  'ui_off_text' => 'Nie',
])

->addImage('image', [
  'label' => 'Obraz',
  'return_format' => 'array',
  'preview_size' => 'medium',
  'conditional_logic' => [
    [[ 'field' => 'use_video', 'operator' => '!=', 'value' => 1 ]] // pokazuj tylko gdy wideo = off
  ],
])

->addFile('video', [
  'label' => 'Wideo (MP4/WebM/Ogg)',
  'return_format' => 'array',
  'mime_types' => 'mp4,webm,ogv',
  'conditional_logic' => [
    [[ 'field' => 'use_video', 'operator' => '==', 'value' => 1 ]]
  ],
])

->addImage('video_poster', [
  'label' => 'Poster (obrazek startowy)',
  'return_format' => 'array',
  'preview_size' => 'medium',
  'conditional_logic' => [
    [[ 'field' => 'use_video', 'operator' => '==', 'value' => 1 ]]
  ],
])

			->addText('title', ['label' => 'Tytuł'])
			->addText('subtitle', ['label' => 'Podtytuł'])
			->addText('txt', ['label' => 'Opis'])
			->addText('date', ['label' => 'Data'])
			->addText('place', ['label' => 'Miejsce'])
			->addText('link', ['label' => 'Link do miejsca'])
			->addLink('button1', [
				'label' => 'Przycisk #1',
				'return_format' => 'array',
			])
			->addLink('button2', [
				'label' => 'Przycisk #2',
				'return_format' => 'array',
			])

			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top'])

			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			]);

		return $hero;
	}

	public function with()
	{
		return [
			'g_hero' => get_field('g_hero'),
			'flip' => get_field('flip'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
		];
	}
}
