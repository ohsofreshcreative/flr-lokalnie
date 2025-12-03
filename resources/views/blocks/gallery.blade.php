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

<!--- gallery -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-gallery relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper">

		@if (!empty($g_gallery['gallery']))
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($g_gallery['gallery'] as $image)
            <img class="w-full h-full object-cover" src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}">
            @endforeach
        </div>
        @endif

	</div>

</section>