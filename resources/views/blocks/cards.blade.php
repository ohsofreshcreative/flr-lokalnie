@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="cards -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">
		<div class="">

			<div class="__top grid grid-cols-1 md:grid-cols-2 items-end gap-8">
				<div class="__header">
					<p data-gsap-element="subtitle" class="__subtitle subtitle-s">{{ strip_tags($g_cards['subtitle']) }}</p>
					<h2 data-gsap-element="header" class="text-white">{{ strip_tags($g_cards['header']) }}</h2>
				</div>
				<div data-gsap-element="txt" class="text-2xl text-white">
					{!! $g_cards['text'] !!}
				</div>
			</div>

			@if (!empty($g_cards['r_cards']))
			@php
			$gridCols = $grid_cols ?? 4; // Użyj 4 jako domyślnej wartości, jeśli nic nie wybrano
			$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
			@endphp

			<div data-gsap-element="stagger" class="grid {{ $gridClass }} gap-8 mt-14">
				@foreach ($g_cards['r_cards'] as $item)
				<div class="__card relative bg-secondary b-shadow p-8">
					<img class="mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					<h6 class="m-title text-white">{{ $item['header'] }}</h6>
					<p class="text-white">{{ $item['text'] }}</p>

					@if (!empty($item['button']))
					<a data-gsap-element="btn" class="underline-btn m-btn" href="{{ $item['button']['url'] }}" target="{{ $item['button']['target'] }}">{{ $item['button']['title'] }}</a>
					@endif
				</div>
				@endforeach
			</div>
			@endif

		</div>
	</div>

</section>