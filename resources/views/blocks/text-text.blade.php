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

<!--- text-text -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-text-text relative -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8">
		@if (!empty($g1_text_text['header']))
		<div class="__first bg-brand border-p radius p-10">
			@if (!empty($g1_text_text['image']))
			<img class="m-img" src="{{ $g1_text_text['image']['url'] }}" alt="{{ $g1_text_text['image']['alt'] ?? '' }}">
			@endif
			@if (!empty($g1_text_text['title']))
			<p class="subtitle-s m-subtitle">{{ $g1_text_text['title'] }}</p>
			@endif
			<h5 class="text-white m-header">{{ $g1_text_text['header'] }}</h5>
			<div class="__txt text-white">{!! $g1_text_text['content'] !!}</div>
		</div>
		@endif
		@if (!empty($g2_text_text['header']))
		<div class="__second bg-brand border-p radius p-10">
			@if (!empty($g2_text_text['image']))
			<img class="m-img" src="{{ $g2_text_text['image']['url'] }}" alt="{{ $g2_text_text['image']['alt'] ?? '' }}">
			@endif
			@if (!empty($g2_text_text['title']))
			<p class="subtitle-s m-subtitle">{{ $g2_text_text['title'] }}</p>
			@endif
			<h5 class="text-white m-header">{{ $g2_text_text['header'] }}</h5>
			<div class="__txt text-white">{!! $g2_text_text['content'] !!}</div>
		</div>
		@endif
	</div>

</section>