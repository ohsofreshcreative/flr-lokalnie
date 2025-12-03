@php
$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section @if($sectionId) id="{{ $sectionId }}" @endif class="events-list-block bg-white -pt-11 -pb-11 {{ $customClass }}">
  
  {{-- Sekcja Newslettera --}}
  @if($show_newsletter && !empty($newsletter['shortcode']))
    <div class="con-main newsletter grid-2 a-items-c -gap-5 grid-1-s -mb-10 -gap-2-s">
      <div>
        @if($newsletter['image'])
          {!! wp_get_attachment_image($newsletter['image']['ID'], 'large', false, ['class' => 'blurIn']) !!}
        @endif
      </div>
      <div class="blurIn delay-1" style="margin:0 auto; margin-bottom:30px;">
        @if($newsletter['title'])
          <h3 class="second -mb-1 blurIn">{{ $newsletter['title'] }}</h3>
        @endif
        @if($newsletter['subtitle'])
          <h6 class="dark -mb-3 blurIn">{{ $newsletter['subtitle'] }}</h6>
        @endif
        {!! do_shortcode($newsletter['shortcode']) !!}
      </div>
    </div>
  @endif

  {{-- Nagłówek listy wydarzeń --}}
  <div id="oferta" class="calendar con-main">
    @if($events['subheader'] || $events['header'])
      <div class="w-40 w-100-l">
        @if($events['subheader'])
          <h6 class="sub blurIn">{{ $events['subheader'] }}</h6>
        @endif
        @if($events['header'])
          <h3 class="dark blurIn -pt-2">{{ $events['header'] }}</h3>
        @endif
      </div>
    @endif
  </div>

 {{-- Lista wydarzeń --}}
<div class="con-main related__news -pt-5">
  <div class="grid-2-l -gap-2-l grid-1-m">
    @if($events_query->have_posts())
      @while($events_query->have_posts()) @php $events_query->the_post() @endphp
        @php
          global $product;
          // POPRAWKA: Pobieramy pole o prawidłowej nazwie 'event_date'
          $event_date = get_field('event_date', get_the_ID()); 
          $program_url = get_field('programis', get_the_ID());
          $is_registration_open = get_field('is_registration_open', get_the_ID());
          $register_url = $is_registration_open ? get_the_permalink() : null;
          $no_data_text = get_field('registration_closed_text', get_the_ID());
        @endphp

        <div class="blog__card flex a-items-c -gap-5 blurIn -px-4 -py-2 no-flex-l ta-center-l">
          <div class="news__image">
            <img src="{{ get_theme_file_uri('/resources/images/Callendar.svg') }}" alt="Kalendarz"/>
          </div>
          <h5 class="font-bold -fs-20 flex-3 dark">{{ the_title() }}</h5>
          
          {{-- Poprawione wyświetlanie daty --}}
          @if($event_date)
            <div class="dark -fs-20 flex-3">{{ $event_date }}</div>
          @endif

          {{-- Przycisk "Program wydarzenia" --}}
          @if($program_url)
            <div class="main text-underline flex-last text-center w-20 w-100-l -mt-2-l">
              <a class="main font-bold" target="_blank" href="{{ $program_url }}">Program wydarzenia</a>
            </div>
          @else
            <div class="dark flex-last text-center w-20 w-100-l -mt-2-l"></div>
          @endif

          {{-- Przycisk "Zarejestruj się" lub tekst alternatywny --}}
          @if($register_url)
            <div class="second-btn flex-last text-center w-20 w-100-l -mt-2-l">
              <a href="{{ $register_url }}">Zarejestruj się</a>
            </div>
          @elseif($no_data_text)
            <div class="dark flex-last text-center w-20 w-100-l -mt-2-l">{{ $no_data_text }}</div>
          @else
            <div class="dark flex-last text-center w-20 w-100-l -mt-2-l"></div>
          @endif
        </div>
      @endwhile
      @php wp_reset_postdata() @endphp
    @else
      <p>Brak nadchodzących wydarzeń.</p>
    @endif
  </div>
</div>
</section>