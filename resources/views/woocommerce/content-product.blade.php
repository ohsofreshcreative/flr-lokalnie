@php
defined('ABSPATH') || exit;
global $product;

$product_about = get_field('product_about', $product->get_id());
$description = $product->get_description();

$product_name = (is_array($product_about) && !empty($product_about['name'])) ? $product_about['name'] : $product->get_name();
@endphp

<li class="product__card border-left-p bg-dark border-dashed rounded-xl !px-10 !py-14 grid grid-cols-1 lg:grid-cols-[1fr_2fr_2fr] gap-10">

	<figure class="woocommerce-product-figure relative">
		<a href="{{ get_permalink() }}">
			<img src="{{ get_the_post_thumbnail_url($product->get_id(), 'large') }}"
				alt="{{ get_the_title() }}" class="img-m img-xs" />
		</a>
	</figure>

	<div>
		<h5 class="woocommerce-loop-product__title">
        
			<a class="text-white" href="{{ get_permalink() }}">{{ $product_name }}</a>
		</h5>
		@if ($description)
		<div class="text-sm mt-4 text-white">{!! $description !!}</div>
		@endif
	</div>

	<div class="flex flex-col justify-between b-border-l pl-10">
		<div class="flex gap-6">
       
			@if (is_array($product_about) && !empty($product_about['date']))
			<div class="text-white flex items-center gap-2"><img src="/wp-content/uploads/2025/11/callendar.svg"/> {{ $product_about['date'] }}</div>
			@endif
        
			@if (is_array($product_about) && !empty($product_about['place']))
			<div class="text-white flex items-center gap-2"><img src="/wp-content/uploads/2025/11/place.svg"/> {{ $product_about['place'] }}</div>
			@endif
		</div>

		<div class="">
			<div class="price text-2xl text-white">
				Bilety od:<br> {!! $product->get_price_html() !!}
			</div>
			<a href="{{ get_permalink() }}" class="second-btn mt-4">Zarejestruj się</a>
		</div>
	</div>
</li>