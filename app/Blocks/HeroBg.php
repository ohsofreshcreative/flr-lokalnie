<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroBg extends Block
{
	public $name = 'Hero - Tło';
	public $description = 'hero-bg';
	public $slug = 'hero-bg';
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
		$hero_bg = new FieldsBuilder('hero-bg');

		$hero_bg
			->setLocation('block', '==', 'acf/hero-bg') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Hero - Realizacje',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treść', ['placement' => 'top']) 
			->addGroup('g_herobg', ['label' => 'Hero - Tło'
			])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->addText('title', ['label' => 'Tytuł'])

			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top']) 

			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $hero_bg;
	}

	public function with()
	{
		return [
			'g_herobg' => get_field('g_herobg'),
			'flip' => get_field('flip'),
		];
	}
}
