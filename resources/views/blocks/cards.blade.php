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

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="cards -smt section-py {{ $sectionClass }}">
	<div class="__wrapper c-main">

			@if (!empty($g_cards['r_cards']))
			@php
			$gridCols = $grid_cols ?? 4; // Użyj 4 jako domyślnej wartości, jeśli nic nie wybrano
			$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
			@endphp

			<div class="grid {{ $gridClass }} gap-8">
				@foreach ($g_cards['r_cards'] as $item)
				<div data-gsap-element="stagger" class="__card relative text-center">
					<div class="flex justify-center gap-4">
						<img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
						<h5 class=" text-white">{{ $item['header'] }}</h5>
					</div>
					<p class="text-xl text-white mt-2">{{ $item['text'] }}</p>

					@if (!empty($item['button']))
					<a data-gsap-element="btn" class="underline-btn m-btn" href="{{ $item['button']['url'] }}" target="{{ $item['button']['target'] }}">{{ $item['button']['title'] }}</a>
					@endif
				</div>
				@endforeach
			</div>
			@endif

	</div>

</section>