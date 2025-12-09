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

<!-- hero --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-hero relative mt-20 {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative grid grid-cols-1 md:grid-cols-2 gap-8">
		<div class="__headers">
			<h1 data-gsap-element="header" class="text-white m-header">{{ $g_hero['header'] }}</h1>
			<h2 data-gsap-element="header" class="text-white m-header">{{ $g_hero['title'] }}</h2>
		</div>

		<div class="__content">
			<div data-gsap-element="txt" class="__txt text-white">
				{!! $g_hero['txt'] !!}
			</div>
			@if (!empty($g_hero['button1']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="main-btn left-btn"
					href="{{ $g_hero['button1']['url'] }}"
					target="{{ $g_hero['button1']['target'] }}">
					{{ $g_hero['button1']['title'] }}
				</a>
				@if (!empty($g_hero['button2']))
				<a data-gsap-element="button" class="white-btn"
					href="{{ $g_hero['button2']['url'] }}"
					target="{{ $g_hero['button2']['target'] }}">
					{{ $g_hero['button2']['title'] }}
				</a>
				@endif
			</div>
			@endif
		</div>


	</div>

	@if (!empty($g_hero['image']))
	<div data-gsap-element="img" class="__img order1 mt-20">
		<img class="object-cover w-full __img img-2xl radius-img" src="{{ $g_hero['image']['url'] }}" alt="{{ $g_hero['image']['alt'] ?? '' }}">
	</div>
	@endif

</section>