@php
$featured_image = get_the_post_thumbnail_url(null, 'full');
$sectionClass = 'single-hero'; // Możesz dodać więcej klas według uznania
$backgroundImage = $featured_image
? "linear-gradient(180deg, rgba(255,255,255,0.2), rgba(255,255,255,1)), url('{$featured_image}')"
: '';
@endphp

<div class="__content">

	<div id="tresc" class="__entry">
		@php(the_content())
	</div>

</div>