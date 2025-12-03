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

<!--- home-about --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="home-about -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="c-main relative grid grid-cols-1 md:grid-cols-2 gap-8">

		<div class="__imgs relative order1">
			@if (!empty($g_about['image1']))
			<img class="relative w-3/4 ml-auto" src="{{ $g_about['image1']['url'] }}" alt="{{ $g_about['image1']['alt'] ?? '' }}">
			@endif
			@if (!empty($g_about['image2']))
			<img class="w-3/4 -top-20" src="{{ $g_about['image2']['url'] }}" alt="{{ $g_about['image2']['alt'] ?? '' }}">
			@endif
		</div>

		<div class="__content order2">

			<div class="bg-primary px-14 py-14">
				<p data-gsap-element="subtitle" class="__subtitle subtitle-s">{{ $g_about['subtitle'] }}</p>
				<h2 data-gsap-element="header" class="text-white">{{ $g_about['header'] }}</h2>

				<div data-gsap-element="txt" class="text-white mt-2">
					{!! $g_about['txt'] !!}
				</div>
				<div class="flex gap-8 mt-10">
					<div data-gsap-element="item" class="text-white">
						<b class="secondary">Gdzie?</b>
						<p>{!! $g_about['where'] !!}</p>
					</div>
					<div data-gsap-element="item" class="text-white">
						<b class="secondary">Kiedy?</b>
						<p>{!! $g_about['when'] !!}</p>
					</div>
				</div>

				@if (!empty($g_about['button']))
				<a data-gsap-element="btn" class="second-btn m-btn" href="{{ $g_about['button']['url'] }}">{{ $g_about['button']['title'] }}</a>
				@endif
			</div>
		</div>

	</div>

</section>