@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
$backgroundImage = !empty($g_herobg['image']['url']) ? "linear-gradient(90deg, rgba(41, 3, 8, 0.8) 40%, rgba(41, 3, 8, 0.3) 100%), url({$g_herobg['image']['url']})" : '';
@endphp

<!--- hero-bg -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-hero-bg relative {{ $sectionClass }} {{ $section_class ?? '' }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main relative py-36">
		<h1 data-gsap-element="header" class="text-white text-center">{{ $g_herobg['title'] }}</h1>

		@if (has_post_thumbnail())
		<img data-gsap-element="image" class="mt-20" src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
		@endif

	</div>

</section>