@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $primarybg ? ' section-primary' : '';
$sectionClass .= $secondarybg ? ' section-secondary' : '';

$sectionId = $section_id ?? null;
$customClass = $block->data['className'] ?? '';

  $count = is_countable($items ?? null) ? count($items) : 0;
  $cols  = $count >= 4 ? 4 : max(1, $count);
  $lgGridCols = 'lg:grid-cols-' . $cols; // np. lg:grid-cols-3
@endphp

<!--- offer --->

<section data-gsap-anim="section"
	@if($sectionId) id="{{ $sectionId }}" @endif
	class="offer -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
	<div class="{{ $block->classes }}">
		<div class="__wrapper c-main">

			@if(!empty($title))
			<h2 data-gsap-element="header" class="m-title text-center">{{ $title }}</h2>
			@endif

			@if(!empty($items))
			<div class="__grid mt-10 grid grid-cols-1 md:grid-cols-1 {{ $lgGridCols }} gap-6">
				@foreach($items as $post)
				<article data-gsap-element="stagger" class="__card bg-white b-border-light h-full flex flex-col rounded-3xl">
					@if(!empty($post['image']))
					<a class="rounded-2xl overflow-hidden block" href="{{ $post['permalink'] }}">{!! $post['image'] !!}</a>
					@endif

					<div class="__content p-6 flex flex-col grow">
						<h5 class="m-title">
							<a href="{{ $post['permalink'] }}" class="hover:underline">{{ $post['title'] }}</a>
						</h5>

						@if(!empty($post['excerpt']))
						<p class="text-sm opacity-80 mb-4">{{ $post['excerpt'] }}</p>
						@endif

						<div class="mt-auto">
							<a class="underline-btn m-btn inline-flex items-center gap-2" href="{{ $post['permalink'] }}">
								Dowiedz się więcej
							</a>
						</div>
					</div>
				</article>
				@endforeach
			</div>
			@else
			<div class="no-data text-sm opacity-70 mt-6">
				Brak ofert do wyświetlenia. Dodaj wpisy „Oferta” lub wybierz inne kategorie.
			</div>
			@endif

		</div>
	</div>
</section>