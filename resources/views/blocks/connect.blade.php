@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<!--- conntect -->

<section data-gsap-anim="section" class="b-connect -mt-20 {{ $sectionClass }}">
	<div class="__wrapper c-main">

		@if (!empty($g_connect['header']))
		<h2 data-gsap-element="header" class="text-white mb-14">{{ strip_tags($g_connect['header']) }}</h2>
		@endif

		@if (!empty($g_connect['r_connect']))
		<div data-gsap-element="stagger" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
			@foreach ($g_connect['r_connect'] as $item)
			<div class="__card relative radius bg-darker b-shadow p-8">
				<img class="mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				<h5 class="m-title primary !font-bold mb-4">{{ $item['header'] }}</h5>
				<p class="text-white">{!! $item['text'] !!}</p>

				<div class="pt-4">
					@if (!empty($item['name']))
					<p class="text-white text-xl font-bold">{{ $item['name'] }}</p>
					@endif
					<div class="__data flex flex-col gap-2 mt-2">
						@if (!empty($item['phone']))
						<a class="__phone text-white" href="tel:{{ str_replace(' ', '', $item['phone']) }}">{{ $item['phone'] }}</a>
						@endif
						@if (!empty($item['email']))
						<a class="__mail text-white" href="mailto:{{ $item['email'] }}">{{ $item['email'] }}</a>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif

	</div>

</section>