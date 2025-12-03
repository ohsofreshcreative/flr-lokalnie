@php
$sectionClass = '';
$sectionClass .= !empty($flip) ? ' order-flip' : '';
$sectionClass .= !empty($section_class) ? ' ' . $section_class : '';

$imageUrl = !empty($g_herooffer['image']['url']) ? $g_herooffer['image']['url'] : '';
$backgroundImage = $imageUrl
    ? "linear-gradient(270deg, rgba(43, 23, 106, 0.9) 0%, rgba(43, 23, 106, 0.9) 0%), url('{$imageUrl}')"
    : '';
@endphp

<section
    data-gsap-anim="section"
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    class="hero-offer relative {{ $sectionClass }}"
    @if($backgroundImage) style="background-image: {!! $backgroundImage !!}; background-size: cover; background-position: center;" @endif
>
    <div class="__wrapper c-main {{ $imageUrl ? 'py-50' : '' }}">
        <div class="__content relative z-10">

            @if (!empty($g_herooffer['title']))
                <h1 data-gsap-element="header" class="trajan text-white text-center">{{ $g_herooffer['title'] }}</h1>
            @endif

            @if (!empty($g_herooffer['content']))
                <div class="mt-4 text-white prose prose-invert max-w-none">
                    {!! $g_herooffer['content'] !!}
                </div>
            @endif

            @if(!empty($nav))
                <nav class="hero-sub__nav mt-6" aria-label="Nawigacja po sekcjach oferty">
                    <ul class="flex flex-wrap justify-center gap-2">
                        @foreach($nav as $item)
                            <li>
                                <a class="clean-btn px-4 py-2 rounded border leading-none transition"
                                   href="{{ $item['href'] }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endif
        </div>
    </div>

    {{-- Dekoracyjny kształt – podmień ścieżkę na własną/prod --}}
    <img class="absolute top-0 left-0" src="/wp-content/uploads/2025/08/hero-shape.svg" alt="" />
</section>
