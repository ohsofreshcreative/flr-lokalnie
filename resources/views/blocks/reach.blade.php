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

<!--- reach -->

<section data-gsap-anim="section" id="form" class="b-reach relative section-py -smt {{ $sectionClass }}" style="background-image: linear-gradient(to right, rgba(41, 3, 8, 0.5) 0%, rgba(41, 3, 8, 1.0) 40%, rgba(41, 3, 8, 1.0) 100%), url('{{ $g_reach_1['image']['url'] }}'); background-size: cover; background-position: center;">

	<div class="__wrapper c-main relative z-2">

		<div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
				<div class="__data text-white">
					@if (!empty($g_reach_1['title']))
					<p data-gsap-element="subtitle" class="subtitle-p">{{ $g_reach_1['title'] }}</p>
					@endif
					<h2 data-gsap-element="header" class="m-header text-white">{!! $g_reach_1['header'] !!}</h2>

					<div data-gsap-element="txt" class="__txt mb-10">{!! $g_reach_1['txt'] !!}</div>
					<b data-gsap-element="subtitle" class="subtitle-p">Opiekun firmowy</b>
					<p data-gsap-element="person" class="__person text-white text-2xl w-max">{{ $g_reach_1['person'] }}</p>
					<a data-gsap-element="phone" class="__phone flex items-center text-white text-xl w-max mt-2" href="tel:{{ $g_reach_1['phone'] }}">{{ $g_reach_1['phone'] }}</a>
					<a data-gsap-element="mail" class="__mail flex items-center text-white text-xl w-max mt-1" href="mailto:{{ $g_reach_1['mail'] }}">{{ $g_reach_1['mail'] }}</a>


				</div>
			</div>
			<div data-gsap-element="form" class="__form">
				<h3 class="text-white">{{ $g_reach_2['title'] }}</h3>
				<div class="reach-form-container mt-4">
					{!! do_shortcode($g_reach_2['shortcode']) !!}
				</div>
			</div>
		</div>
	</div>
</section>