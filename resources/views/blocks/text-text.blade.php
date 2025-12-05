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

<!--- text-text -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-text-text relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__top c-main">
		<p class="subtitle-p m-subtitle">{{ $g1_text_text['title'] }}</p>
		<h2 class="text-white m-header w-full md:w-1/2">{{ $g1_text_text['header'] }}</h2>
	</div>

	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8 pt-6">

		<div class="__first">
			@if (!empty($g2_text_text['image']))
			<img class="m-img" src="{{ $g2_text_text['image']['url'] }}" alt="{{ $g2_text_text['image']['alt'] ?? '' }}">
			@endif
			@if (!empty($g2_text_text['title']))
			<p class="subtitle-s m-subtitle">{{ $g2_text_text['title'] }}</p>
			@endif
			<h5 class="text-white m-header">{{ $g2_text_text['header'] }}</h5>
			<div class="__txt text-white">{!! $g2_text_text['content'] !!}</div>
		</div>

		<div class="__second">
			@if (!empty($g3_text_text['image']))
			<img class="m-img" src="{{ $g3_text_text['image']['url'] }}" alt="{{ $g3_text_text['image']['alt'] ?? '' }}">
			@endif
			@if (!empty($g3_text_text['title']))
			<p class="subtitle-s m-subtitle">{{ $g3_text_text['title'] }}</p>
			@endif
			<h5 class="text-white m-header">{{ $g3_text_text['header'] }}</h5>
			<div class="__txt text-white">{!! $g3_text_text['content'] !!}</div>
		</div>
	</div>

</section>