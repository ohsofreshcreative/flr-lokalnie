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

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="steps -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">
		<div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			<div class="">
				@if (!empty($g_steps['subtitle']))
				<p data-gsap-element="subheader" class="subtitle-s">{{ strip_tags($g_steps['subtitle']) }}</p>
				@endif
				@if (!empty($g_steps['title']))
				<h2 data-gsap-element="header" class="m-title">{{ strip_tags($g_steps['title']) }}</h2>
				@endif
				<div data-gsap-element="txt" class="">{{ strip_tags($g_steps['txt']) }}</div>
				@if (!empty($g_steps['image']))
				<div data-gsap-element="img" class="__img order1 mt-10">
					<img class="object-cover w-full __img img-m radius-img" src="{{ $g_steps['image']['url'] }}" alt="{{ $g_steps['image']['alt'] ?? '' }}">
				</div>
				@endif
			</div>

			@if (!empty($r_steps))
			<div class="__repeater flex flex-col justify-between gap-6 h-full">

				@foreach ($r_steps as $item)
				<div data-gsap-element="stagger" class="flex gap-6 bg-s-lighter rounded-3xl border-s-light px-8 py-8">
					<img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					<div class="__content">
						<h5 class="">{{ $item['title'] }}</h5>
						<p class="">{{ $item['txt'] }}</p>
					</div>
				</div>
				@endforeach
			</div>
			<div class="__line absolute bg-primary z-0 origin-left scale-x-0"></div>
			@endif

		</div>
	</div>

</section>