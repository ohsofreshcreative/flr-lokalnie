@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

@endphp

<!--- opinion -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="opinion relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			@if (!empty($g_opinion['image']))
			<div data-gsap-element="{{ $flip ? 'img-right' : 'img-left' }}" class="image-reveal-wrapper __img order1">
				<img class="object-cover w-full __img img-2xl radius-img" src="{{ $g_opinion['image']['url'] }}" alt="{{ $g_opinion['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2">
				<h5 data-gsap-element="header" class="">{{ $g_opinion['title'] }}</h5>

				<img data-gsap-element="image" class="__quote opacity-10 my-4" src="/wp-content/uploads/2025/10/quote.svg" />

				<div data-gsap-element="txt" class="__txt text-gray text-sm mt-2">
					{!! $g_opinion['txt'] !!}
				</div>

				<b data-gsap-element="txt" class="block mt-4">{{ $g_opinion['signature'] }}</b>

				@if (!empty($g_opinion['lightbox_image']))
				<a data-gsap-element="btn" class="main-btn m-btn glightbox" href="{{ esc_url($g_opinion['lightbox_image']['url']) }}">
					Zobacz referencję
				</a>
				@endif

			</div>

		</div>

</section>