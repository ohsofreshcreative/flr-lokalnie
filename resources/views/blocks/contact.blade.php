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

<!--- contact -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-contact relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-2">

		<div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
				<div class="__data text-white">
					<h2 data-gsap-element="header" class="m-header text-white">{!! $g_contact_1['title'] !!}</h2>

					<div data-gsap-element="txt" class="__txt mb-10">{!! $g_contact_1['txt'] !!}</div>
					<a data-gsap-element="phone" class="__phone flex items-center text-white text-xl w-max" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
					<a data-gsap-element="mail" class="__mail flex items-center text-white text-xl w-max mt-2" href="mailto:{{ $g_contact_1['mail'] }}">{{ $g_contact_1['mail'] }}</a>


				</div>
			</div>
			<div data-gsap-element="form" class="__form">
				<h3 class="text-white">{{ $g_contact_2['title'] }}</h3>
				<div class="contact-form-container mt-4">
					{!! do_shortcode($g_contact_2['shortcode']) !!}
				</div>
			</div>
		</div>
	</div>
</section>