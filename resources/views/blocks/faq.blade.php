@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="faq -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-10">

		<div>
			@if (!empty($faq['image']))
			<img class="c-main-wide object-cover w-full __img img-xl order1" src="{{ $faq['image']['url'] }}" alt="{{ $faq['image']['alt'] ?? '' }}">
			@endif
			<div class="__content order2">
				<h3 data-gsap-element="header" class="">{{ $faq['title'] }}</h3>
				<div data-gsap-element="header" class="mt-2">
					{!! $faq['content'] !!}
				</div>
				@if (!empty($faq['button']))
				<a class="main-btn m-btn" href="{{ $faq['button']['url'] }}">{{ $faq['button']['title'] }}</a>
				@endif
			</div>
		</div>

		<div class="accordion-wrapper grid">
			@foreach ($repeater as $item)
			<div class="accordion">
				<input
					class="acc-check"
					type="radio"
					name="radio-a"
					id="check{{ $loop->index }}"
					{{ $loop->first ? 'checked' : '' }}>
				<label class="accordion-label" for="check{{ $loop->index }}">{{ $item['title'] }}</label>
				<div class="accordion-content">
					<p>{{ $item['txt'] }}</p>
				</div>
			</div>
			@endforeach
		</div>

	</div>

</section>