<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Jobs extends Block
{
	public $name = 'Oferty pracy';
	public $description = 'jobs';
	public $slug = 'jobs';
	public $category = 'formatting';
	public $icon = 'feedback';
	public $keywords = ['jobs'];
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
		$jobs = new FieldsBuilder('jobs');

		$jobs
			->setLocation('block', '==', 'acf/jobs') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('jobs1', [
				'label' => 'Oferty pracy',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- TAB #1 ---*/
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_jobs', ['label' => ''])
			->addText('title', ['label' => 'Tytuł'])

			->addAccordion('jobs1', [
				'label' => 'Nie widzisz oferty dla siebie?',
				'open' => false,
				'multi_expand' => true,
			])
			->addText('subtitle', ['label' => 'Ciemny nagłówek'])
			->addText('header', ['label' => 'Jasny nagłówek'])
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endGroup()

			/*--- TAB #2 ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addRepeater('repeater', [
				'label' => 'jobs',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'button_label' => 'Dodaj pytanie'
			])
			->addText('title', [
				'label' => 'Pytanie',
			])
			->addWysiwyg('txt', [
				'label' => 'Odpowiedź',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			
			->addTrueFalse('darkbg', [
				'label' => 'Ciemne tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			
			->addTrueFalse('bgimage', [
				'label' => 'Grafika w tle',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $jobs;
	}

	public function with()
	{
		return [
			'g_jobs' => get_field('g_jobs'),
			'repeater' => get_field('repeater'),
			'flip' => get_field('flip'),
			'darkbg' => get_field('darkbg'),
			'bgimage' => get_field('bgimage'),
		];
	}
}
