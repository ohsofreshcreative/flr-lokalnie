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

<!--- invitation -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-invitation relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="__content order2">
			<h2 data-gsap-element="header" class="text-white m-header">{{ $g_invitation['header'] }}</h2>

			<div data-gsap-element="txt" class="text-white mt-2">
				{!! $g_invitation['txt'] !!}
			</div>

			@if (!empty($g_invitation['button']))
			<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_invitation['button']['url'] }}">{{ $g_invitation['button']['title'] }}</a>
			@endif
		</div>
		<div class="__personas grid gap-4 mt-8">
			@if (!empty($g2_invitation['r_invitation']))
			@foreach ($g2_invitation['r_invitation'] as $persona)
			<div data-gsap-element="item" class="persona-item flex items-center gap-4">
				<div class="">
					@if (!empty($persona['img']))
					<img src="{{ $persona['img']['url'] }}" alt="{{ $persona['img']['alt'] ?? $persona['header'] }}" class="w-20 h-20 object-cover rounded-full">
					@endif
				</div>
				<div class="">
					<p class="text-xl font-semibold">{{ $persona['title'] }}</p>
					<p class="">{!! $persona['txt'] !!}</p>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>

</section>