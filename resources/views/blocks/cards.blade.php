@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}

@endphp

<!-- cards --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="cards -smt section-py {{ $sectionClass }}">
	<div class="__wrapper c-main">

		@if (!empty($g_cards['title']))
		<div class="__top mb-16">
			@if (!empty($g_cards['subtitle']))
			<h6 class="primary">{{ $g_cards['subtitle'] }}</h6>
			@endif

			<h2 class="text-white">{!! $g_cards['title'] !!}</h2>
		</div>
		@endif

		@if (!empty($g_cards['r_cards']))
		@php
		$gridCols = $grid_cols ?? 4; // Użyj 4 jako domyślnej wartości, jeśli nic nie wybrano
		$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
		@endphp

		<div class="grid {{ $gridClass }} gap-8">
			@foreach ($g_cards['r_cards'] as $item)
			<div data-gsap-element="stagger" class="__card relative text-center">
				<div class="__title flex justify-center gap-4">
					<img class="__img" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					<h5 class=" text-white">{{ $item['header'] }}</h5>
				</div>
				<p class="text-xl text-white mt-2">{!! $item['text'] !!}</p>

				@if (!empty($item['button']))
				<a data-gsap-element="btn" class="underline-btn m-btn" href="{{ $item['button']['url'] }}" target="{{ $item['button']['target'] }}">{{ $item['button']['title'] }}</a>
				@endif
			</div>
			@endforeach
		</div>
		@endif

	</div>

</section>