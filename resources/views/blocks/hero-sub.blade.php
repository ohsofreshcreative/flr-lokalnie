@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
$backgroundImage = !empty($g_hero_sub['image']['url']) ? "linear-gradient(90deg, rgba(41, 3, 8, 1) 40%, rgba(41, 3, 8, 0.3) 100%), url({$g_hero_sub['image']['url']})" : '';
@endphp

<!-- hero-sub -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-hero-sub relative {{ $sectionClass }} {{ $section_class }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main {{ !empty($g_hero_sub['image']) ? 'py-50' : '' }}">

		<div class="__content w-full sm:w-3/4 relative z-10">
			
			<h1 data-gsap-element="header" class="text-white m-header">{{ $g_hero_sub['header'] }}</h1>

			<div data-gsap-element="text" class="text-white text-xl">{{ strip_tags($g_hero_sub['text']) }}</div>

			@if (!empty($g_hero_sub['button1']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="main-btn left-btn" href="{{ $g_hero_sub['button1']['url'] }}" target="{{ $g_hero_sub['button1']['target'] }}">{{ $g_hero_sub['button1']['title'] }}</a>

				@if (!empty($g_hero_sub['button2']))
				<a data-gsap-element="button" class="white-btn" href="{{ $g_hero_sub['button2']['url'] }}" target="{{ $g_hero_sub['button2']['target'] }}">{{ $g_hero_sub['button2']['title'] }}</a>
				@endif
			</div>
			@endif
		</div>
	</div>

</section>