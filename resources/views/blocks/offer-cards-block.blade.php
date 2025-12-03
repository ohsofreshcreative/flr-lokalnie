@php
// Klasy sekcji (opcjonalne tła, marginesy)
$sectionClass = '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';

// Unikalny identyfikator instancji (dla JS)
$uid = 'offer-tabs-' . ($sectionId ?: wp_unique_id());

// Normalizacja wartości kolumn (2/3/4)
$colCount = in_array((string)$columns, ['2', '3', '4'], true) ? (string)$columns : '3';
@endphp

<!--- offer-cards-block --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="offer-cards -smt {{ $section_class }} {{ $sectionClass }}">

	<div class="{{ $block->classes }}">
		<div class="__wrapper c-main">

			@if(!empty($subtitle))
			<p class="subtitle-p text-center">{{ $subtitle }}</p>
			@endif
			@if(!empty($title))
			<h2 data-gsap-element="header" class="m-title text-center">{{ $title }}</h2>
			@endif

			@if(!empty($tabs))
			<div id="{{ $uid }}-root" class="offer-tabs mt-16" data-offer-tabs-root>
				<div class="offer-tabs__nav mb-8" role="tablist" aria-label="Kategorie ofert">
					<ul class="flex flex-wrap gap-2 justify-center">
						@foreach($tabs as $i => $tab)
						<li data-gsap-element="tab">
							<button
								type="button"
								class="stroke-btn offer-tab px-4 py-2 rounded border leading-none transition @if($i===0) is-active @endif"
								role="tab"
								aria-selected="{{ $i===0 ? 'true' : 'false' }}"
								aria-controls="{{ $uid }}-panel-{{ $tab['id'] }}"
								id="{{ $uid }}-tab-{{ $tab['id'] }}">
								{{ $tab['label'] }}
							</button>
						</li>
						@endforeach
					</ul>
				</div>

				<div class="offer-tabs__panels">
					@foreach($tabs as $i => $tab)
					<div
						id="{{ $uid }}-panel-{{ $tab['id'] }}"
						class="offer-tabpanel @if($i!==0) hidden @endif"
						role="tabpanel"
						aria-labelledby="{{ $uid }}-tab-{{ $tab['id'] }}">
						@if(!empty($tab['posts']))
						<div class="__grid mt-6 grid grid-cols-1 gap-6">
							@foreach($tab['posts'] as $post)
							<article class="__card bg-white b-border-light h-full flex flex-col rounded-3xl">
								@if(!empty($post['image']))
								<a class="rounded-2xl overflow-hidden" href="{{ $post['permalink'] }}" class="block">{!! $post['image'] !!}</a>
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
						<div class="no-data text-sm opacity-70">Brak ofert w tej kategorii.</div>
						@endif
					</div>
					@endforeach
				</div>
			</div>
			@else
			<div class="no-data">Brak danych oferty. Dodaj wpisy w „Oferta” i przypisz kategorie.</div>
			@endif

		</div>
	</div>
</section>