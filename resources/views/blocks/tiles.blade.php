@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $greybg ? ' section-grey' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<section data-gsap-anim="section" class="cards -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">
		<div class="">

			<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-end">
				<div class="__content">
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
			</div>

			<div class="grid mt-10">

				@foreach ($r_tiles as $index => $item)
				<div data-gsap-element="card" class="__card grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center gap-6 mb-10">

					<img class="" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					<div>
						<p class="text-h2 font-bold secondary">{{ sprintf('%02d', $index + 1) }}</p>
						<h6 class="text-white mt-4">{{ $item['card_title'] }}</h6>
						<p class="text-white mt-2">{{ $item['card_txt'] }}</p>
					</div>
				</div>
				@endforeach
			</div>

		</div>
	</div>

</section>