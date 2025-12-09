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

<!--- workshops -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-workshops relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="">

			<div class="__top">
				@if (!empty($g_workshops['subtitle']))
				<p data-gsap-element="subtitle" class="subtitle-p">{{ $g_workshops['subtitle'] }}</p>
				@endif
				<h2 data-gsap-element="header" class="text-white m-header">{{ $g_workshops['title'] }}</h2>
			</div>

			<div class="__content flex mt-8">
				<div data-gsap-element="txt" class="__txt text-white w-full md:w-1/3 b-border-l pl-6">
					{!! $g_workshops['text1'] !!}
				</div>
				<div data-gsap-element="txt" class="__txt text-white w-full md:w-1/3 b-border-l pl-6">
					{!! $g_workshops['text2'] !!}
				</div>

				@if (!empty($g_workshops['button']))
				<a data-gsap-element="btn" class="main-btn ml-auto h-max" href="{{ $g_workshops['button']['url'] }}" target="{{ $g_workshops['button']['target'] }}">{{ $g_workshops['button']['title'] }}</a>
				@endif
			</div>

			@if (!empty($g_workshops['image']))
			<div data-gsap-element="{{ $flip ? 'img-right' : 'img-left' }}" class="image-reveal-wrapper __img order1 mt-10">
				<img class="object-cover w-full __img img-xl radius-img" src="{{ $g_workshops['image']['url'] }}" alt="{{ $g_workshops['image']['alt'] ?? '' }}">
			</div>
			@endif

		</div>
	</div>

</section>