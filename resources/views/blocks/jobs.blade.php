@php $sectionClass = '';$sectionClass .= $flip ? ' order-flip' : '';$sectionClass .= $darkbg ? ' section-dark' : '';$sectionId = $block->data['id'] ?? null;$customClass = $block->data['className'] ?? '';@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="accordion faq relative overflow-hidden -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main relative z-2">
		<h2 data-gsap-element="header" class="w-full lg:w-1/2">{{ $g_jobs['title'] }}</h2>
		<div class="grid grid-cols-1 lg:grid-cols-[2.5fr_1fr] gap-20 mt-10">
			<div class="__content order2">
				@if (!empty($g_jobs['button']))
				<a class="main-btn m-btn" href="{{ $g_jobs['button']['url'] }}">{{ $g_jobs['button']['title'] }}</a>
				@endif
				<div data-gsap-element="accordion" class="accordion-wrapper grid">
					@foreach ($repeater as $item)
					<div class="accordion px-8">
						<input
							class="acc-check"
							type="radio"
							name="radio-a"
							id="check{{ $loop->index }}">
						<label class="accordion-label text-h6 font-semibold" for="check{{ $loop->index }}">{{ $item['title'] }}</label>
						<div class="accordion-content">
							<p>{!! $item['txt'] !!}</p>
							<a href="#" class="stroke-btn js-open-modal m-btn" data-job-title="{{ $item['title'] }}">Aplikuj</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="b-border p-10 h-max">
				<h5 data-gsap-element="header" class="">{{ $g_jobs['subtitle'] }}</h5>
				<h5 data-gsap-element="header" class="primary">{{ $g_jobs['header'] }}</h5>
				<div data-gsap-element="txt" class="">{!! $g_jobs['content'] !!}</div>
				<a href="#" class="stroke-btn js-open-modal m-btn" data-job-title="Ogólne zapytanie CV">Wyślij CV</a>
			</div>
		</div>
	</div>

</section>