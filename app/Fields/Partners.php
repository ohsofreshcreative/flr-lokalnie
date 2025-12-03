<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Partners extends Field
{
	public $name = 'Partnerzy';
	public $description = 'Partners';
	public $slug = 'partners';
	public $category = 'formatting';
	public $icon = 'email';
	public $keywords = ['formularz', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields(): array
	{
		$partners = new FieldsBuilder('partners');

		$partners
			->setLocation('options_page', '==', 'partners')
			->addRepeater('r_partners', [
				'label' => 'Partnerzy',
				'layout' => 'table',
				'min' => 1,
				'button_label' => 'Dodaj partnera',
			])
			->addText('header', [ 'label' => 'Link',
				'wrapper' => [
					'width' => '20',
				],])
			->addRepeater('logos', [
				'label' => 'Partnerzy',
				'layout' => 'table',
				'min' => 1,
				'button_label' => 'Dodaj partnera',
			])
			->addImage('img', [
				'label' => 'Obraz',
				'return_format' => 'array',
				'preview_size' => 'small',
			])
			->addText('link', [ 'label' => 'Link' ])

			->endRepeater()
			->endRepeater();

		return [$partners];
	}
}
