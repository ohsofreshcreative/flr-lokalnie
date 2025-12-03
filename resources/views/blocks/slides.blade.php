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

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-slides relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-2 items-start md:items-end gap-10 pb-10">
		<div>
			<p class="subtitle-p">{{ $g_slides['title']}}</p>
			<h2 class="text-white">{{ $g_slides['header']}}</h2>
		</div>
		<div class="__txt text-[20px] text-white">{!! $g_slides['txt'] !!}</div>
	</div>

	<div class="swiper usage-swiper c-main !overflow-visible">

		<div class="swiper-wrapper">
			@if(!empty($g_slides['r_slides']))
			@foreach ($g_slides['r_slides'] as $card)
			<div class="swiper-slide">
				<div class="__card border-p p-10">
					<div class="__rectangle absolute"></div>

					<div class="__number text-h1">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>

					@if(!empty($card['title']))
					<h5 class="text-white m-title">{{ $card['title'] }}</h5>
					@endif

					@if(!empty($card['txt']))
					<div class="__txt text-white">{{ $card['txt'] }}</div>
					@endif

					@if(!empty($card['button']))
					<a href="{{ $card['button']['url'] }}" class="main-btn m-btn" target="{{ $card['button']['target'] }}">
						{{ $card['button']['title'] }}
					</a>
					@endif
				</div>
			</div>
			@endforeach
			@endif
		</div>

	</div>

	<div class="swiper-button-prev absolute top-1/2 -translate-y-1/2 left-4 z-10 cursor-pointer">

		<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
		</svg>
	</div>
	<div class="swiper-button-next absolute top-1/2 -translate-y-1/2 right-4 z-10 cursor-pointer">

		<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
		</svg>
	</div>

</section>