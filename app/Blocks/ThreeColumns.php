<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ThreeColumns extends Block
{
	public $name = 'Trzy kolumny';
	public $description = 'three-columns';
	public $slug = 'three-columns';
	public $category = 'formatting';
	public $icon = 'columns';
	public $keywords = ['O nas', 'Strona glowna'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$three_columns = new FieldsBuilder('three-columns');

		$three_columns
			->setLocation('block', '==', 'acf/three-columns') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Trzy kolumny',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- GROUP ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('threecols', ['label' => ''])
			->addImage('image1', [
				'label' => 'Obraz #1',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addImage('image2', [
				'label' => 'Obraz #2',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addTextarea('content', [
				'label' => 'Opis',
				'rows' => 4,
				'placeholder' => 'Wpisz opis...',
				'new_lines' => 'br',
			])
			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);



		return $three_columns;
	}

	public function with()
	{
		return [
			'threecols' => get_field('threecols'),
			'flip' => get_field('flip'),
		];
	}
}
