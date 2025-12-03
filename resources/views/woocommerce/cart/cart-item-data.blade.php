@php defined('ABSPATH') || exit; @endphp

<dl class="variation">
  @foreach ($item_data as $data)
    @php
      // Usuwamy fragment z ceną (np. "(+10,00 zł)") z wartości wariantu
      $display_value = preg_replace('/\s?\(.*\)/', '', $data['display']);
    @endphp
    <dt class="{{ sanitize_html_class('variation-' . $data['key']) }} text-sm pt-2 pl-4">
      {{-- Usunięto dwukropek z końca --}}
      {!! wp_kses_post($data['key']) !!}
    </dt>
 <!--    <dd class="{{ sanitize_html_class('variation-' . $data['key']) }}">
      {!! wp_kses_post(wpautop($display_value)) !!}
    </dd> -->
  @endforeach
</dl>