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

@php
$backgroundImage = !empty($bottom['image']['url']) ? "linear-gradient(90deg, rgba(41, 3, 8, 1) 40%, rgba(41, 3, 8, 0.3) 100%), url({$bottom['image']['url']})" : '';
@endphp

<!-- bottom-block -->

<section data-gsap-anim="section" class="cta-bottom relative overflow-hidden -smt bg-dark {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: 50%;">
	<div class="c-main py-40">
		<div class="w-full md:w-1/2">
			<p data-gsap-element="subtitle" class="subtitle-p">{{ strip_tags($bottom['subtitle']) }}</p>
			<h2 data-gsap-element="header" class="text-white mt-2">{{ $bottom['title'] }}</h2>
			<h2 data-gsap-element="txt" class=primary mt-2">
				{!! $bottom['txt'] !!}
			</h2>
			@if (!empty($bottom['button']))
			<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $bottom['button']['url'] }}">{{ $bottom['button']['title'] }}</a>
			@endif
		</div>

		<!-- 	<div class="flex flex-col mt-10 gap-4">
			<a data-gsap-element="phone" class="__phone flex items-center text-2xl text-white" href="tel:{{ $bottom['phone'] }}">{{ $bottom['phone'] }}</a>
			<a data-gsap-element="mail" class="__mail flex items-center text-2xl text-white" href="mailto:{{ $bottom['mail'] }}">{{ $bottom['mail'] }}</a>
		</div> -->

	</div>
</section>