@php
$nomt = get_field('nomt');
$flip = get_field('flip');
$wide = get_field('wide');
$gap = get_field('gap');
$lightbg = get_field('lightbg');
$graybg = get_field('graybg');
$whitebg = get_field('whitebg');
$brandbg = get_field('brandbg');
$section_id = get_field('section_id');
$section_class = get_field('section_class');
$g_counter = get_field('g_counter');
$block_title = get_field('block-title');
@endphp

<section id="{{ $section_id }}" class="counter relative -mt-20 z-10 {{ $nomt ? 'mt-0' : '' }} {{ $section_class }}">
	<div class="c-main">
		 <div class="bg-s-light px-20 py-10">
            @if ($g_counter && $g_counter['date'])
            <div class="__counter flex justify-evenly" data-date="{{ $g_counter['date'] }}">
                <div class="__item text-center">
                    <span class="text-h1 secondary" id="days">00</span>
                    <div class="">Dni</div>
                </div>
                <div class="__item text-center">
                    <span class="text-h1 secondary" id="hours">00</span>
                    <div class="">Godzin</div>
                </div>
                <div class="__item text-center">
                    <span class="text-h1 secondary" id="minutes">00</span>
                    <div class="">Minut</div>
                </div>
                <div class="__item text-center">
                    <span class="text-h1 secondary" id="seconds">00</span>
                    <div class="">Sekund</div>
                </div>
            </div>
            @endif
        </div>
	</div>
</section>