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

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-experts -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="flex">
		@if (!empty($gallery))
		<div class="swiper usage-swiper !overflow-hidden w-1/2">

			<div class="swiper-wrapper">
				@foreach($gallery as $image)
				 <div class="swiper-slide">
                    {!! wp_get_attachment_image($image['ID'], 'full', false, ['class' => 'w-full h-full object-cover']) !!}
                </div>
				@endforeach
			</div>
		</div>
		@endif

		<div class="__content order2 w-1/2">
			<div class="w-3/4 m-auto">
				<p data-gsap-element="subtitle" class="__subtitle subtitle-p">{{ $g_experts['subtitle'] }}</p>
				<h2 data-gsap-element="header" class="text-white">{{ $g_experts['header'] }}</h2>
				<div data-gsap-element="txt" class="text-white mt-2">
					{!! $g_experts['txt'] !!}
				</div>
				@if (!empty($g_experts['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_experts['button']['url'] }}">{{ $g_experts['button']['title'] }}</a>
				@endif
			</div>

		</div>
	</div>

</section>


<!-- 	<div class="swiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide">Slide 1</div>
    <div class="swiper-slide">Slide 2</div>
    <div class="swiper-slide">Slide 3</div>
  </div>

  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div> -->