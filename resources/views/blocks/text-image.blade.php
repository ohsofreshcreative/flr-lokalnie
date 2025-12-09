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

<!--- text-image -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-text-image relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			@if (!empty($g_textimg['image']))
			<div data-gsap-element="{{ $flip ? 'img-right' : 'img-left' }}" class="image-reveal-wrapper __img order1 h-full">
				<img class="object-cover w-full __img radius-img h-full" src="{{ $g_textimg['image']['url'] }}" alt="{{ $g_textimg['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2 py-0 md:py-8">
				@if (!empty($g_textimg['subtitle']))
				<p data-gsap-element="subtitle" class="subtitle-s">{{ $g_textimg['subtitle'] }}</p>
				@endif
				<h2 data-gsap-element="header" class="text-white m-header">{{ $g_textimg['title'] }}</h2>

				<div data-gsap-element="txt" class="__txt text-white">
					{!! $g_textimg['txt'] !!}
				</div>

				@if (!empty($g_textimg['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_textimg['button']['url'] }}" target="{{ $g_textimg['button']['target'] }}">{{ $g_textimg['button']['title'] }}</a>
				@endif

			</div>

		</div>
	</div>

</section>