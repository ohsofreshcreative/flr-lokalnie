@extends('layouts.app')

@section('content')
<div class="c-main -spt">
	
	@php
	do_action('woocommerce_archive_description');
	@endphp
	
	@php $term = get_queried_object() @endphp
	@if ($term instanceof WP_Term && $term->taxonomy === 'product_cat')
	<section class="shop-term-intro mt-8">
		@if (!empty(get_field('header', $term)))
		<h4 class="shop-term-heading">{{ get_field('header', $term) }}</h4>
		@endif
		@if (!empty(term_description($term->term_id, 'product_cat')))
		<div class="shop-term-description">{!! term_description($term->term_id, 'product_cat') !!}</div>
		@endif
	</section>
	@endif
</div>

@php
do_action('woocommerce_after_main_content');
do_action('get_footer', 'shop');
@endphp
@endsection