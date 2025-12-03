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

<!--- info -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-info relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 gap-10">
			<div class="__first">
				@if (!empty($g_info['subtitle']))
				<p data-gsap-element="subtitle" class="subtitle-s">{{ $g_info['subtitle'] }}</p>
				@endif
				<h2 data-gsap-element="header" class="text-white m-header">{{ $g_info['title'] }}</h2>
				@if (!empty($g_info['image']))
				<div data-gsap-element="{{ $flip ? 'img-right' : 'img-left' }}" class="image-reveal-wrapper __img mt-8">
					<img class="object-cover w-full __img img-m radius-img" src="{{ $g_info['image']['url'] }}" alt="{{ $g_info['image']['alt'] ?? '' }}">
				</div>
				@endif
			</div>

			<div class="__second">

				<div data-gsap-element="txt" class="__txt text-white">
					{!! $g_info['txt'] !!}
				</div>

				 @if (!empty($g_info['r_info']))
                    @foreach ($g_info['r_info'] as $item)
                    <div data-gsap-element="card" class="__card flex items-start gap-6 mt-8">
                        <img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
                        <div>
                            <h6 class="text-white">{{ $item['header'] }}</h6>
                            <p class="text-white mt-4">{{ $item['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif


				@if (!empty($g_info['button']))
				<a data-gsap-element="btn" class="second-btn m-btn" href="{{ $g_info['button']['url'] }}" target="{{ $g_info['button']['target'] }}">{{ $g_info['button']['title'] }}</a>
				@endif

			</div>

		</div>
	</div>

</section>