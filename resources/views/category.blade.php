@extends('layouts.app')

@section('content')
@php
$term = get_queried_object();
$title = $term ? get_field('title', 'category_' . $term->term_id) : null;
$txt = $term ? get_field('txt', 'category_' . $term->term_id) : null;
$image = $term ? get_field('image', 'category_' . $term->term_id) : null;

// Fetch all categories
$categories = get_categories();

// Get the current category URL
$current_category_url = $term ? get_category_link($term->term_id) : home_url(); // Fallback to home URL if not a category archive

@endphp

<section data-gsap-anim="section" class="bg-gradient relative overflow-hidden">
	<div class="__wrapper c-main py-60">

		<div class="w-full sm:w-3/4 relative z-10">
			<p data-gsap-element="subheader" class="subtitle-p">Baza wiedzy</p>
			<h1 data-gsap-element="header" class="trajan text-white">{!! category_description() !!}</h1>
		</div>
	</div>
	<img class="absolute mix-blend-overlay -top-20 -right-80" src="/wp-content/uploads/2025/08/logo-stroke.svg" />
</section>

@if($featured_post)
<div class="featured-post c-main relative z-10">
	<a href="{{ get_permalink($featured_post) }}">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center  bg-white rounded-2xl p-10 -mt-40">

			<div class="">
				<div class="relative rounded-2xl overflow-hidden aspect-[16/16] md:aspect-[21/12]">
					{!! get_the_post_thumbnail($featured_post->ID, 'large', [
					'class' => 'absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105',
					'alt' => esc_attr(get_the_title($featured_post)),
					]) !!}
				</div>
			</div>

			<div class="flex flex-col justify-center">
				<h2 class="!text-2xl md:!text-3xl mr-4 md:mr-10">
					{{ get_the_title($featured_post) }}
				</h2>

				<div class="mt-6">
					<div class="blog-btn bg-p-light rounded-full w-max">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 20" fill="none">
							<path d="M22.7454 9.26177L14.0655 0.581915C13.6572 0.173617 12.9932 0.173556 12.585 0.581781C12.1768 0.990005 12.1768 1.65399 12.5851 2.06229L19.4744 8.95162L1.99787 8.95242C1.41912 8.95267 0.95049 9.4213 0.950243 10C0.950595 10.5788 1.41932 11.0475 1.99806 11.0479L19.4752 11.0471L12.5869 17.9354C12.1786 18.3437 12.1787 19.0076 12.587 19.4159C12.9953 19.8242 13.6593 19.8243 14.0675 19.4161L22.7434 10.7402C23.1537 10.3341 23.1536 9.67007 22.7454 9.26177Z" fill="#2B176A" />
						</svg>
					</div>
				</div>
			</div>

		</div>
	</a>
</div>
@endif

<div class="-smt">
	<div class="__wrapper c-main flex gap-4 overflow-x-scroll">
		<a class="stroke-small-btn" href="/kategorie/wszystkie-wpisy/">Wszystkie wpisy</a>
		@foreach($categories as $category)
		@if($category->name !== 'Wszystkie wpisy')
		<a class="stroke-small-btn" href="{{ get_category_link($category->term_id) }}" class="button {{ $term && $term->term_id === $category->term_id ? 'active' : '' }}">{{ $category->name }}</a>
		@endif
		@endforeach
	</div>
</div>

@if (have_posts())
 <div class="c-main pb-25 !mt-10 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @while (have_posts()) @php(the_post())
      @continue($featured_post && (int) get_the_ID() === (int) $featured_post->ID)
      @includeFirst(['partials.content', 'partials.content'])
    @endwhile
  </div>
{!! get_the_posts_navigation() !!}
@else
<div class="mt-20 mb-20">
	<div class="c-main">
		<h3 class="trajan">Brak wpisów w tej kategorii.</h3>
		<a class="main-btn m-btn" href="/kategorie/wszystkie-wpisy/">Sprawdź wszystkie wpisy</a>
	</div>
</div>
@endif
@endsection