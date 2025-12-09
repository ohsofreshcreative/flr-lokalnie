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

<!-- slides --->

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
				<div class="__card border-p p-10 min-h-[400px]">
					<div class="__rectangle absolute"></div>

					<div class="__number text-h1">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>

					@if(!empty($card['title']))
					<h5 class="text-white m-title">{{ $card['title'] }}</h5>
					@endif

					@if(!empty($card['txt']))
					<div class="__txt text-white mt-4">{{ $card['txt'] }}</div>
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

		<div data-gsap-element="arrows" class="absolute top-1/2 left-0 w-full -translate-y-1/2 z-10 flex justify-between items-center pointer-events-none">
			<div class="__prev rounded-full bg-p-light h-14 w-14 flex items-center justify-center pointer-events-auto -translate-x-1/2 cursor-pointer transition-all duration-400">
				<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
					<path d="M0.270429 5.31498C0.270706 5.31469 0.270937 5.31435 0.27126 5.31406L5.08882 0.281803C5.44973 -0.0951806 6.03348 -0.0937777 6.39273 0.285093C6.75194 0.663916 6.75055 1.27664 6.38964 1.65367L3.15514 5.03226L12.078 5.03226C12.5872 5.03226 13 5.46552 13 6C13 6.53448 12.5872 6.96774 12.078 6.96774L3.15518 6.96774L6.3896 10.3463C6.75051 10.7234 6.75189 11.3361 6.39269 11.7149C6.03344 12.0938 5.44963 12.0951 5.08877 11.7182L0.271213 6.68594C0.270936 6.68565 0.270706 6.68531 0.270383 6.68502C-0.0907122 6.30673 -0.08956 5.69202 0.270429 5.31498Z" fill="#c80000" />
				</svg>
			</div>
			<div class="__next rounded-full bg-p-light h-14 w-14 flex items-center justify-center pointer-events-auto translate-x-1/2 cursor-pointer transition-all duration-300">
				<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
					<path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24945 1.27664 6.61036 1.65367L9.84486 5.03226L0.921985 5.03226C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774L9.84482 6.96774L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96657 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#c80000" />
				</svg>
			</div>
		</div>
	</div>



</section>