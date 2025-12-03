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


<!--- table --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-table -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main">
		<div class="">
			@if (!empty($g_table['header']))
			<h3 class="">{{ strip_tags($g_table['header']) }}</h3>
			@endif

			<div class="__table w-max m-auto">
				@foreach ($g_table['r_table'] as $item)
				<div class="__row grid grid-cols-[2fr_1fr] gap-30 p-2 b-border-b">
					<p class="text-white">{{ $item['col1'] }}</p>
					<p class="text-white">{{ $item['col2'] }}</p>
			<!-- 		<p class="text-white">{{ $item['col3'] }}</p> -->
				</div>
				@endforeach
			</div>
		</div>

	</div>
	</div>

</section>