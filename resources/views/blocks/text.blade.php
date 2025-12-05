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

<!--- text -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-text relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">

		<div class="__content order2">
			@if (!empty($g_text['subtitle']))
			<p data-gsap-element="subtitle" class="__subtitle subtitle-p">{{ $g_text['subtitle'] }}</p>
			@endif
			@if (!empty($g_text['header']))
			<h2 data-gsap-element="header" class="text-white m-header">{{ $g_text['header'] }}</h2>
			@endif

			<div data-gsap-element="txt" class="__txt text-white mt-2">
				{!! $g_text['txt'] !!}
			</div>

			@if (!empty($g_text['button']))
			<a data-gsap-element="btn" class="second-btn m-btn" href="{{ $g_text['button']['url'] }}">{{ $g_text['button']['title'] }}</a>
			@endif

		</div>

</section>