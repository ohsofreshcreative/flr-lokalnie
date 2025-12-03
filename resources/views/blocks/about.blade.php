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

<!--- about -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="about relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<h1 data-gsap-element="top" class="w-full md:w-1/2">{{ $g_about['top'] }}</h1>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-10">
			@if (!empty($g_about['image']))
			<div data-gsap-element="img-left" class="__img image-reveal-wrapper radius-img order1">
				<img class="object-cover w-full __img img-xl radius-img" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2">
				<h2 data-gsap-element="header" class="m-title">{{ $g_about['title'] }}</h2>

				<div data-gsap-element="txt" class="">
					{!! $g_about['txt'] !!}
				</div>

				@if (!empty($r_about))
				<div class="flex flex-col gap-6 mt-10">
					@foreach ($r_about as $item)
					<div data-gsap-element="item" class="__item flex gap-4 items-start">
						@if (!empty($item['image']))
						<img src="{{ $item['image']['sizes']['medium'] ?? $item['image']['url'] }}"
							alt="{{ $item['image']['alt'] ?? '' }}" loading="lazy">
						@endif

						<div class="__r-content">
							@if (!empty($item['title']))
							<h5 class="">{{ $item['title'] }}</h5>
							@endif
							@if (!empty($item['txt']))
							<div class="">{!! $item['txt'] !!}</div>
							@endif
						</div>
					</div>
					@endforeach
				</div>
				@endif

				@if (!empty($g_about['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_about['button']['url'] }}">{{ $g_about['button']['title'] }}</a>
				@endif
			</div>
		</div>
	</div>
</section>