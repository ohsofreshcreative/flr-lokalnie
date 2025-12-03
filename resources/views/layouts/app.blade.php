<!doctype html>
<html @php(language_attributes())>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@php(do_action('get_header'))
	@php(wp_head())

	{{-- Fonts --}}
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://use.typekit.net/lsg3eay.css">

	@vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body @php(body_class())>
	@php(wp_body_open())

<div class="so__icons flex flex-col gap-1">
	<a target="_blank" href="https://www.facebook.com/everethpublishing"><img src="/wp-content/uploads/2025/12/fb.svg"/></a>
	<a target="_blank" href="https://www.instagram.com/everethpublishing/"><img src="/wp-content/uploads/2025/12/ig.svg"/></a>
	<a target="_blank" href="https://www.linkedin.com/company/evereth/"><img src="/wp-content/uploads/2025/12/in.svg"/></a>
</div>

	<div id="app">

		@include('sections.header')

		@if (function_exists('is_woocommerce') && (is_shop() || is_product_category() || is_product_tag()))

		@yield('content')

		@elseif (function_exists('is_woocommerce') && (is_product() || is_cart() || is_checkout()))

<main id="main" class="main -spt c-main">
    @yield('content')
</main>

		@else

		<main id="main" class="main -spt">
			@yield('content')
		</main>

		@endif

		@include('sections.footer')
	</div>

	@php(do_action('get_footer'))
	@php(wp_footer())

</body>

</html>