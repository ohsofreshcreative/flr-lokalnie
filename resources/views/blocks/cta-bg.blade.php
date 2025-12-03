@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<section data-gsap-anim="section" class="cta_bg py-32 -smt {{ $sectionClass }}" style="background-image:linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ $cta_bg['image']['url'] }}'); background-size:cover; background-position:center;">

	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 section-gap">
		<div></div>
		<div class="bg-white b-border p-12">

			@if ($cta_bg['title'])
			<h3 class="m-title">{{ $cta_bg['title'] }}</h3>
			<p class="">{{  strip_tags($cta_bg['content']) }}</p>
			@endif
			@if (!empty($cta_bg['button']))
			<a class="main-btn m-btn" href="{{ $cta_bg['button']['url'] }}">{{ $cta_bg['button']['title'] }}</a>
			@endif

		</div>
	</div>

</section>