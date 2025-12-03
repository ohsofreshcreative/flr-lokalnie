@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<section data-gsap-anim="section" class="cta -smt {{ $sectionClass }}">
	<div class="__wrapper">
		<div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch rounded-2xl overflow-hidden bg-s-light">

			<div class="relative md:col-span-6 {{ $flip ? 'md:order-2' : 'md:order-1' }}">
				<img
					src="{{ $cta['image']['url'] }}"
					alt="{{ $cta['image']['alt'] ?? ($cta['title'] ?? '') }}"
					class="w-full h-full object-cover"
					loading="lazy">
			</div>

			<div class="md:col-span-6 {{ $flip ? 'md:order-1' : 'md:order-2' }} flex items-center">
				<div class="pt-0 pb-16 md:py-20 w-full text-center md:text-left">
					@if ($cta['title'])
					<p data-gsap-element="header" class="text-h3 font-semibold">{{ $cta['title'] }}</p>
					@endif

					@if (!empty($cta['button']))
					<a class="second-btn m-btn mt-6 inline-flex" href="{{ $cta['button']['url'] }}">
						{{ $cta['button']['title'] }}
					</a>
					@endif
				</div>
			</div>

		</div>
	</div>
</section>