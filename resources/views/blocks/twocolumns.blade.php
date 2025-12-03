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

<!--- two-columns -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-two-cols -smt {{ $sectionClass }}">

	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8">
		<div class="__first">
			@if (!empty($col1['image']))
			<img class="m-img" src="{{ $col1['image']['url'] }}" alt="{{ $col1['image']['alt'] ?? '' }}">
			@endif
			<p class="subtitle-s m-subtitle">{{ $col1['title'] }}</p>
			<h3 class="text-white m-header">{{ $col1['header'] }}</h3>
			<div class="__txt text-white">{!! $col1['content'] !!}</div>
		</div>
		<div class="__second">

			<div class="flex gap-8 mt-10">
				<div data-gsap-element="item" class="text-white">
					<img src="/wp-content/uploads/2025/11/place.svg" />
					<b class="secondary block uppercase m-subtitle mt-4">Gdzie?</b>
					<p>{!! $col2['where'] !!}</p>
				</div>
				<div data-gsap-element="item" class="text-white">
					<img src="/wp-content/uploads/2025/11/calendar.svg" />
					<b class="secondary block uppercase m-subtitle mt-4">Kiedy?</b>
					<p>{!! $col2['when'] !!}</p>
				</div>
			</div>
			@if (!empty($col2['button1']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="second-btn left-btn" href="{{ $col2['button1']['url'] }}" target="{{ $col2['button1']['target'] }}">{{ $col2['button1']['title'] }}</a>

				@if (!empty($col2['button2']))
				<a data-gsap-element="button" class="white-btn" href="{{ $col2['button2']['url'] }}" target="{{ $col2['button2']['target'] }}">{{ $col2['button2']['title'] }}</a>
				@endif
			</div>
			@endif
		</div>
	</div>

</section>