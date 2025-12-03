@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!-- hero --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="hero bg-secondary relative -menu-pt min-h-[85svh] {{ $sectionClass }} {{ $section_class }}">

	@if (!empty($g_hero['use_video']) && !empty($g_hero['video']))
	<video
		class="absolute inset-0 w-full h-full object-cover z-0"
		autoplay
		muted
		loop
		playsinline
		preload="metadata"
		@if(!empty($g_hero['video_poster']['url'])) poster="{{ $g_hero['video_poster']['url'] }}" @endif
		aria-hidden="true">
		<source src="{{ is_array($g_hero['video']) ? ($g_hero['video']['url'] ?? '') : $g_hero['video'] }}"
			type="{{ is_array($g_hero['video']) ? ($g_hero['video']['mime_type'] ?? 'video/mp4') : 'video/mp4' }}">
	</video>
	<div class="absolute inset-0 bg-black/40 z-10 pointer-events-none"></div>
	@endif

	<div class="__wrapper c-wide grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative z-20">
		<div class="__content pt-20 pb-10 md:py-30">
			<h2 data-gsap-element="header" class=" text-white">
				{{ $g_hero['title'] }}
			</h2>
			<h5 data-gsap-element="txt" class="text-white mt-2">
				{!! $g_hero['subtitle'] !!}
			</h5>
			<div data-gsap-element="txt" class="__txt text-white mt-2">
				{!! $g_hero['txt'] !!}
			</div>

			<div data-gsap-element="info" class="__info flex gap-6 mt-6">
				<div class="flex items-center gap-2">
					<div>
						<img src="/wp-content/uploads/2025/11/calendar.svg" />
					</div>
					<div class="text-white">
						{!! $g_hero['date'] !!}
					</div>
				</div>
				<div class="flex items-center gap-2">
					<div>
						<img src="/wp-content/uploads/2025/11/place.svg" />
					</div>
					<div class=" text-center">
						<a class="text-white !underline" target="_blank" href="{!! $g_hero['link'] !!}">{!! $g_hero['place'] !!}</a>
					</div>
				</div>
			</div>

			@if (!empty($g_hero['button1']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="second-btn left-btn"
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

		@if (!empty($g_hero['image']))
		<div data-gsap-element="image" class="">
			<img src="{{ $g_hero['image']['url'] }}" alt="{{ $g_hero['image']['alt'] ?? '' }}">
		</div>
		@endif
	</div>

</section>