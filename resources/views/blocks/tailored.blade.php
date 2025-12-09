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


<!--- tailored --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-tailored -smt section-py {{ $sectionClass }}" style="background-image:linear-gradient(rgba(41, 3, 8, 0.7), rgba(41, 3, 8, 1)), url('{{ $g_tailored['image']['url'] }}'); background-size:cover; background-position:center;">

	<div class="__wrapper c-main">
		<div class="">
			@if (!empty($g_tailored['header']))
			<h1 class="text-white w-full md:w-1/2">{{ strip_tags($g_tailored['header']) }}</h1>
			@endif

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
				@foreach ($g_tailored['r_tailored'] as $item)
				<div class="__card relative text-white mt-10">
					@if (!empty($item['img']))
					<img src="{{ $item['img']['url'] }}" alt="{{ $item['img']['alt'] ?? '' }}" />
					@endif
					<p class="font-bold text-h2">{!! $item['number'] !!}</p>
					<p class="font-bold text-h5 min-h-16">{{ $item['header'] }}</p>
					<p class="text-lg mt-2">{!! $item['txt'] !!}</p>
				</div>
				@endforeach
			</div>

		</div>
	</div>

</section>