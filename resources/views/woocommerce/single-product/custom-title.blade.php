<div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-8 mb-4">
	<div>
		@if ($custom_text)
		@php
		$event_date = date_i18n('j F Y', strtotime($custom_text));
		$event_city = get_field('city', get_the_ID());
		@endphp
		<h2 class="product_title entry-title text-white">{{ $event_city }}</h2>
		<h3 class="primary">{{ $event_date }}</h3>
		@endif
	</div>

	@if ($certificate_link && $certificate_img)
	<div class="justify-self-start md:justify-self-end">
		<a href="{{ esc_url($certificate_link) }}" target="_blank" rel="noopener">
			<img class="" src="{{ esc_url($certificate_img) }}" alt="Certyfikat" />
		</a>
	</div>
	@endif
</div>