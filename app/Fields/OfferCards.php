<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OfferCards extends Field
{
	public $name = 'Kafelki oferty';
	public $description = 'OfferCards';
	public $slug = 'offer-cards';
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
		$offerCards = new FieldsBuilder('offer-cards');

		$offerCards
			->setLocation('options_page', '==', 'offer-cards')
			->addRepeater('offer-cards', [
				'label' => 'Oferta',
				'layout' => 'table',
				'min' => 1,
				'button_label' => 'Dodaj element oferty',
				'collapsed' => 'offer_title',
			])
			->addImage('offer_image', [
				'label' => 'Obraz',
				'return_format' => 'array',
				'preview_size' => 'small',
				'wrapper' => [
					'width' => '20',
				],
			])
			->addText('offer_title', [
				'label' => 'Nagłówek',
				'wrapper' => [
					'width' => '20',
				],
			])
			->addTextarea('offer_description', [
				'label' => 'Opis',
			])
			->addLink('cta', [
				'label' => 'Link CTA',
				'return_format' => 'array',
			])
			->endRepeater();

		return [$offerCards];
	}
}
