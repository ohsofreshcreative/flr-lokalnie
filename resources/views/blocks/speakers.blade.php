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


<!--- speakers --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-speakers -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main">
		<div class="">
			<p class="subtitle-p">{{ strip_tags($g_speakers['header']) }}</p>
			@if (!empty($g_speakers['header']))
			<h3 class="text-white">{{ strip_tags($g_speakers['header']) }}</h3>
			@endif

			@php
			$speakers = !empty($g_speakers['r_speakers']) ? $g_speakers['r_speakers'] : [];
			$speakersCount = count($speakers);

			$gridClass = '';
			if ($speakersCount === 2) {
			$gridClass = 'md:grid-cols-2';
			} elseif ($speakersCount >= 3) {
			$gridClass = 'md:grid-cols-2 lg:grid-cols-3';
			}
			@endphp

			<div class="grid grid-cols-1 {{ $gridClass }} gap-8 mt-10">
				@if ($speakersCount === 1)
				@foreach ($speakers as $item)
				<div class="__card-single grid grid-cols-1 md:grid-cols-2 gap-8 items-center border-p radius p-10">
					<div class="img-wrapper">
						<img src="{{ $item['img']['url'] }}" alt="{{ $item['img']['alt'] ?? '' }}" class="w-full img-2xl object-cover object-top radius" />
					</div>
					<div class="content-wrapper">
						<p class="font-bold text-h5 text-white !mb-0">{{ $item['title'] }}</p>
						<p class="text-lg mt-4 text-white">{{ $item['txt'] }}</p>
					</div>
				</div>
				@endforeach
				@else
				@foreach ($speakers as $item)
				<div class="__card relative border-p radius p-10">
					<img src="{{ $item['img']['url'] }}" alt="{{ $item['img']['alt'] ?? '' }}" class="w-full img-s object-cover object-top radius" />
					<p class="font-bold text-h5 text-white mt-6 mb-4">{{ $item['title'] }}</p>
					<p class="text-white">{!! $item['txt'] !!}</p>
				</div>
				@endforeach
				@endif
			</div>

		</div>
	</div>

</section>