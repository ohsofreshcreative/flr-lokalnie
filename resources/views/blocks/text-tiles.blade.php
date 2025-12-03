@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $greybg ? ' section-grey' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!--- text-tiles --->

<section data-gsap-anim="section" class="b-text-tiles -smt {{ $sectionClass }}">
	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-2 gap-10">

		<div class="">
			@if (!empty($g_tiles['title']))
			<p class="subtitle-s">{{ strip_tags($g_tiles['title']) }}</p>
			@endif
			@if (!empty($g_tiles['header']))
			<h2 data-gsap-element="header" class="text-white">{{ strip_tags($g_tiles['header']) }}</h2>
			@endif

			@if (!empty($g_tiles['text']))
			<p data-gsap-element="txt" class="__txt text-white mt-6">{{ strip_tags($g_tiles['text']) }}</p>
			@endif
		</div>

		<div class="order2">

			@foreach ($repeater as $item)
			<div data-gsap-element="card" class="__card flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-10 border-s radius p-6 md:p-10 mb-6">
				<p class="text-h2 font-bold secondary">{{ $item['header'] }}</p>
				<p class="text-white text-2xl">{{ $item['txt'] }}</p>
			</div>
			@endforeach
			@if (!empty($g_tiles['button']))
			<a data-gsap-element="button" class="second-btn m-btn" href="{{ $g_tiles['button']['url'] }}">{{ $g_tiles['button']['title'] }}</a>
			@endif
		</div>
	</div>

</section>