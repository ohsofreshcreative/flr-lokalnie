@php
// Pobieranie danych ze strony opcji
$r_partners = get_field('r_partners', 'option');

// Pobieranie ustawień bloku (jeśli są potrzebne)
$section_id = get_field('section_id');
$section_class = get_field('section_class');
$nomt = get_field('nomt');
$wide = get_field('wide');
$lightbg = get_field('lightbg');
$graybg = get_field('graybg');
$whitebg = get_field('whitebg');
$brandbg = get_field('brandbg');

$sectionClass = '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<section @if(!empty($section_id)) id="{{ $section_id }}" @endif class="partners -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main">
		@if ($r_partners)
		@foreach ($r_partners as $group)
		<div class="__group mb-12">
			@if (!empty($group['header']))
			<h3 class="text-center mb-8">{{ $group['header'] }}</h3>
			@endif

			@if (!empty($group['logos']))
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 items-center">
				@foreach ($group['logos'] as $logo)
				@if (!empty($logo['img']))
				@if (!empty($logo['link']))
				<a href="{{ $logo['link'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center bg-white h-[120px]">
					<img src="{{ $logo['img']['url'] }}" alt="{{ $logo['img']['alt'] ?? 'Logo partnera' }}" class="max-h-16 w-auto">
				</a>
				@else
				<div class="flex items-center justify-center bg-white h-[120px]">
					<img src="{{ $logo['img']['url'] }}" alt="{{ $logo['img']['alt'] ?? 'Logo partnera' }}" class="max-h-16 w-auto">
				</div>
				@endif
				@endif
				@endforeach
			</div>
			@endif
		</div>
		@endforeach
		@endif
	</div>
</section>