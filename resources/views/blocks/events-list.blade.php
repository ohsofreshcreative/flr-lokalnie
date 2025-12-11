@php
// Zabezpieczamy zmienne, aby upewnić się, że istnieją
$flip = !empty($flip);
$wide = !empty($wide);
$nomt = !empty($nomt);
$gap = !empty($gap);

$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!-- events-list --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-events-list relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main">
		<div class=" grid gap-20">

			@if($show_newsletter && !empty($newsletter['shortcode']))
			<div class="__newsletter grid grid-cols-1 md:grid-cols-2 items-center gap-6 order1">
				<div class="__img">
					@if($newsletter['image'])
					{!! wp_get_attachment_image($newsletter['image']['ID'], 'large', false, ['class' => 'blurIn']) !!}
					@endif
				</div>
				<div class="__content">
					@if($newsletter['title'])
					<h3 class="primary mb-2">{{ $newsletter['title'] }}</h3>
					@endif
					@if($newsletter['subtitle'])
					<h6 class="mb-4">{{ $newsletter['subtitle'] }}</h6>
					@endif
					{!! do_shortcode($newsletter['shortcode']) !!}
				</div>
			</div>
			@endif


			<div id="oferta" class=" ">
				<div class="__top">
					@if($events['subheader'] || $events['header'])
					<div class="">
						@if($events['subheader'])
						<p class="subtitle-p">{{ $events['subheader'] }}</p>
						@endif
						@if($events['header'])
						<h2 class="w-full md:w-2/5">{{ $events['header'] }}</h2>
						@endif
					</div>
					@endif
				</div>

				<div class="__list mt-10">
					@if($events_query->have_posts())
					@while($events_query->have_posts()) @php $events_query->the_post() @endphp
					@php
					$event_date_raw = get_field('event_date', get_the_ID());
					$event_date = $event_date_raw ? date_i18n('d F Y', strtotime($event_date_raw)) : null;

					$program_url = get_field('programis', get_the_ID());
					$is_registration_open = get_field('is_registration_open', get_the_ID());
					$register_url = $is_registration_open ? get_the_permalink() : null;
					$no_data_text = get_field('registration_closed_text', get_the_ID());
					@endphp
					<div class="__card flex flex-col md:flex-row items-center justify-between w-full gap-6 p-6">
						<div class="flex flex-col md:flex-row flex-1 items-center gap-6">
							<div class="news__image">
								<img src="/wp-content/uploads/2025/12/Callendar.svg" alt="Kalendarz" />
							</div>
							<h5 class="">{{ get_the_title() }}</h5>
						</div>

						@if($event_date)

						 <div class="flex-1">{{ $event_date }}</div>
                @endif

						<div class="flex-1">
							@if(!empty($program_url) && is_array($program_url) && !empty($program_url['url']))
							<div class="text-underline">
								<a class="main font-bold" target="_blank" href="{{ $program_url['url'] }}">Program wydarzenia</a>
							</div>
							@else
							<div class="dark flex-last text-center"></div>
							@endif
						</div>

						<div class=" w-full md:w-1/5">
							@if($register_url)
							<div class="flex-last text-center">
								<a class="main-btn" href="{{ $register_url }}">Zarejestruj się</a>
							</div>
							@elseif($no_data_text)
							<div class="dark flex-last text-center">{{ is_string($no_data_text) ? $no_data_text : '' }}</div>
							@else
							<div class="dark flex-last text-center"></div>
							@endif
						</div>
					</div>
					@endwhile
					@php wp_reset_postdata() @endphp
					@else
					<p>Brak nadchodzących wydarzeń.</p>
					@endif
				</div>
			</div>

		</div>
	</div>

</section>