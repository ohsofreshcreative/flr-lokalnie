@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="reviews -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
			<div class="__content">
				<div class="__wrapper c-main block">
					@if (!empty($g_reviews['subtitle']))
					<p data-gsap-element="subheader" class="subtitle-s">{{ strip_tags($g_reviews['subtitle']) }}</p>
					@endif
					<h2 class="">{{ $g_reviews['title']}}</h2>
					<div data-gsap-element="txt" class="text-gray mt-2">{{ strip_tags($g_reviews['txt']) }}</div>
					<div class="flex items-center justify-between my-8">
						<img src="/wp-content/uploads/2025/08/quote.svg" />
						<img src="/wp-content/uploads/2025/08/stars.svg" />
					</div>
				</div>
				<div class="swiper reviews-swiper c-main !overflow-hidden">
					<div class="swiper-wrapper">
						@foreach($r_reviews as $card)
						<div class="swiper-slide">
							<div class="__card">
								<div class="__rectangle absolute"></div>
								@if(!empty($card['txt']))
								<div class="__txt">{{ $card['txt'] }}</div>
								@endif
								<div class="flex items-center gap-4 mt-6">
									@if(!empty($card['img']))
									<div class="__img">
										{!! wp_get_attachment_image($card['img']['ID'], 'medium', false, ['class' => 'img-fluid']) !!}
									</div>
									@endif
									@if(!empty($card['name']))
									<b class="block">{{ $card['name'] }}</b>
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="__arrows flex gap-4 mt-10">
						<div class="swiper-button-prev">
							<svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none">
								<path d="M8.91341 8.91778C9.23744 8.59356 9.23744 8.0681 8.91341 7.74388L2.26133 1.08768C1.93702 0.76317 1.41101 0.76317 1.08671 1.08768C0.762684 1.4119 0.762684 1.93735 1.08671 2.26157L7.73879 8.91778C8.0631 9.24229 8.58911 9.24229 8.91341 8.91778Z" fill="#DC9D38" />
								<path d="M1.08659 15.9123C0.762565 15.5881 0.762565 15.0626 1.08659 14.7384L7.73867 8.08222C8.06298 7.75771 8.58899 7.75771 8.9133 8.08222C9.23732 8.40644 9.23732 8.9319 8.9133 9.25612L2.26121 15.9123C1.9369 16.2368 1.41089 16.2368 1.08659 15.9123Z" fill="#DC9D38" />
							</svg>
						</div>
						<div class="swiper-button-next">
							<svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none">
								<path d="M8.91341 8.91778C9.23744 8.59356 9.23744 8.0681 8.91341 7.74388L2.26133 1.08768C1.93702 0.76317 1.41101 0.76317 1.08671 1.08768C0.762684 1.4119 0.762684 1.93735 1.08671 2.26157L7.73879 8.91778C8.0631 9.24229 8.58911 9.24229 8.91341 8.91778Z" fill="#DC9D38" />
								<path d="M1.08659 15.9123C0.762565 15.5881 0.762565 15.0626 1.08659 14.7384L7.73867 8.08222C8.06298 7.75771 8.58899 7.75771 8.9133 8.08222C9.23732 8.40644 9.23732 8.9319 8.9133 9.25612L2.26121 15.9123C1.9369 16.2368 1.41089 16.2368 1.08659 15.9123Z" fill="#DC9D38" />
							</svg>
						</div>
					</div>
				</div>
			</div>
			@if (!empty($g_reviews['image']))
			<div data-gsap-element="img" class="__img order1">
				<img class="object-cover h-full radius-img" src="{{ $g_reviews['image']['url'] }}" alt="{{ $g_reviews['image']['alt'] ?? '' }}">
			</div>
			@endif
		</div>
	</div>

</section>


<!-- 	<div class="swiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide">Slide 1</div>
    <div class="swiper-slide">Slide 2</div>
    <div class="swiper-slide">Slide 3</div>
  </div>

  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div> -->