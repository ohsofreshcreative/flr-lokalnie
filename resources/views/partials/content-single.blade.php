<section data-gsap-anim="section" class="bg-gradient relative overflow-hidden">
	<div class="__wrapper c-main relative z-10 py-40">
		<div class="__content w-full sm:w-3/4 m-auto pb-10">
			<p data-gsap-element="subheader" class="subtitle-p text-center">
				{{ is_category() ? single_cat_title('', false) : (get_the_category()[0]->name ?? '') }}
			</p>
			<h2 data-gsap-element="header" class="trajan text-white text-center">{{ get_the_title() }}</h2>
			@if(has_excerpt())
			<div data-gsap-element="content" class="">
				{!! get_the_excerpt() !!}
			</div>
			@endif
		</div>
	</div>
	<img class="absolute mix-blend-soft-light -top-20 -right-80" src="/wp-content/uploads/2025/08/logo-stroke.svg" />
</section>

@if (has_post_thumbnail())
<div class="relative z-10 -mt-32">
	<div class="c-wide">
		<img class="img-2xl w-full object-cover radius-img" src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
	</div>
</div>
@endif

<div id="tresc" class="__entry mt-20">
	<div class="c-main">
		<div class="w-full md:w-2/3 m-auto">
			{!! the_content() !!}
		</div>
	</div>
</div>

@php
$current_id = get_the_ID();
$categories = wp_get_post_categories($current_id);
$related_args = [
'category__in' => $categories,
'post__not_in' => [$current_id],
'posts_per_page' => 3,
'ignore_sticky_posts' => 1,
];
$related_query = new WP_Query($related_args);
@endphp

@if($related_query->have_posts())
<section class="related-posts bg-white -smt pt-20 pb-26">
	<div class="c-main">
		<h3 class="text-2xl font-bold mb-6">Wpisy z tej kategorii</h3>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			@while($related_query->have_posts())
			@php($related_query->the_post())
			<article @php(post_class(['bg-white', 'rounded-2xl' , 'p-4' ]))>
				<header>
					@if(has_post_thumbnail())
					<div class="overflow-hidden rounded-xl">
						<a class="" href="{{ get_permalink() }}">
							{!! get_the_post_thumbnail(null, 'large', ['class' => 'featured-image img-xs rounded-xl object-cover']) !!}
						</a>
					</div>
					@endif

					<h6 class="entry-title text-h5 mt-6 rounded p-">
						<a href="{{ get_permalink() }}">
							{!! get_the_title() !!}
						</a>
					</h6>

					<!--  @include('partials.entry-meta') -->
				</header>

				<a class="m-btn block" href="{{ get_permalink() }}">
					<div class="blog-btn bg-p-light rounded-full w-max">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 24 20" fill="none">
							<path d="M22.7454 9.26177L14.0655 0.581915C13.6572 0.173617 12.9932 0.173556 12.585 0.581781C12.1768 0.990005 12.1768 1.65399 12.5851 2.06229L19.4744 8.95162L1.99787 8.95242C1.41912 8.95267 0.95049 9.4213 0.950243 10C0.950595 10.5788 1.41932 11.0475 1.99806 11.0479L19.4752 11.0471L12.5869 17.9354C12.1786 18.3437 12.1787 19.0076 12.587 19.4159C12.9953 19.8242 13.6593 19.8243 14.0675 19.4161L22.7434 10.7402C23.1537 10.3341 23.1536 9.67007 22.7454 9.26177Z" fill="#2B176A" />
						</svg>
					</div>
				</a>

				<!--   <div class="entry-summary">
    @php(the_excerpt())
  </div> -->
			</article>
			@endwhile
			@php(wp_reset_postdata())
		</div>
	</div>
</section>
@endif