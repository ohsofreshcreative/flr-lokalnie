@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="three-columns -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
	<div class="__wrapper c-main">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

			@if (!empty($threecols['image1']))
			<img class="object-cover img-xl h-full w-full __img pt-20" src="{{ $threecols['image1']['url'] }}" alt="{{ $threecols['image1']['alt'] ?? '' }}">
			@endif

			@if (!empty($threecols['image2']))
			<img class="object-cover img-xl h-full w-full __img" src="{{ $threecols['image2']['url'] }}" alt="{{ $threecols['image2']['alt'] ?? '' }}">
			@endif

			<div class="mb-20">
				<div class="relative bg-primary flex flex-col justify-between h-full px-14 py-14">
					<div class="__rectangle absolute"></div>
					@if (!empty($threecols['title']))
					<p class="font-bold uppercase font-header">{{ strip_tags($threecols['title']) }}</p>
					@endif

					@if (!empty($threecols['content']))
					<h5 class="mt-5 font-medium __txt">{{ strip_tags($threecols['content']) }}</h5>
					@endif

					<a href="#more" class="block mt-10 mb-10">
						<img src="/wp-content/uploads/2025/05/arrow-down.svg" />
					</a>
				</div>
			</div>

		</div>
	</div>
</section>