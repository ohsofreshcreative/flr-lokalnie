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

<!--- text-tiles --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-text-tiles relative -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-10">

		<div class="relative md:sticky top-0 md:top-24 h-max">
			@if (!empty($g_tiles['title']))
			<p class="subtitle-p">{{ strip_tags($g_tiles['title']) }}</p>
			@endif
			@if (!empty($g_tiles['header']))
			<h2 data-gsap-element="header" class="text-white">{{ strip_tags($g_tiles['header']) }}</h2>
			@endif

			@if (!empty($g_tiles['text']))
			<p data-gsap-element="txt" class="__txt text-white mt-6">{{ strip_tags($g_tiles['text']) }}</p>
			@endif
		</div>

		<div class="order2">

			@foreach ($r_tiles as $item)
			<div data-gsap-element="card" class="__card flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-10 border-p rounded-xl p-6 md:p-10 mb-6">
				@if (!empty($item['image']))
				<div data-gsap-element="img" class="__img order1">
					<img class="__img w-[100px] max-w-[48px]" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}">
				</div>
				@endif
				<div class="text-white">
					<p class="text-2xl font-bold">{{ $item['header'] }}</p>
					<p class="">{{ $item['txt'] }}</p>
				</div>
			</div>
			@endforeach
			@if (!empty($g_tiles['button']))
			<a data-gsap-element="button" class="second-btn m-btn" href="{{ $g_tiles['button']['url'] }}">{{ $g_tiles['button']['title'] }}</a>
			@endif
		</div>
	</div>

</section>