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