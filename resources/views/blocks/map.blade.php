@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $whitebg ? ' section-white' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="map {{ $sectionId }}" @endif class="map -smt mb-32 {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main">
		<h2 data-gsap-element="header" class="mb-10">{{ $g_map['title'] }}</h2>

		@if (!empty($g_map['code']))
		<div class="grayscale">{!! $g_map['code'] !!}</div>
		@endif

	</div>

</section>