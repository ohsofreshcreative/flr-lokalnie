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

<!--- duo -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-duo relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center gap-10">

			<div class="__content order2">
				@if (!empty($g_duo['image']))
				<p data-gsap-element="subtitle" class="subtitle-p">{{ $g_duo['subtitle'] }}</p>
				@endif
				<h2 data-gsap-element="header" class="text-white m-header">{{ $g_duo['title'] }}</h2>

				<div data-gsap-element="txt" class="__txt text-white">
					{!! $g_duo['txt'] !!}
				</div>

				@if (!empty($g_duo['button']))
				<a data-gsap-element="btn" class="second-btn m-btn" href="{{ $g_duo['button']['url'] }}" target="{{ $g_duo['button']['target'] }}">{{ $g_duo['button']['title'] }}</a>
				@endif

			</div>

			<div class="__imgs flex gap-8">
				@if (!empty($g_duo['image']))
				<div data-gsap-element="{{ $flip ? 'img-right' : 'img-left' }}" class="image-reveal-wrapper __img order1">
					<img class="object-cover w-full __img img-2xl radius-img" src="{{ $g_duo['image']['url'] }}" alt="{{ $g_duo['image']['alt'] ?? '' }}">
				</div>
				@endif
				@if (!empty($g_duo['image2']))
				<div data-gsap-element="{{ $flip ? 'img-right' : 'img-left' }}" class="image-reveal-wrapper __img order1">
					<img class="object-cover w-full __img img-2xl radius-img" src="{{ $g_duo['image2']['url'] }}" alt="{{ $g_duo['image2']['alt'] ?? '' }}">
				</div>
				@endif
			</div>

		</div>
	</div>

</section>