{{--
  Szablon dla niestandardowego tytułu produktu z dodatkowymi danymi.
  Zmienne przekazywane z app/woocommerce.php:
  - $custom_text
  - $certificate_link
  - $certificate_img
--}}
<div class="grid-2-1 grid-1-xl">
  <div>
    <h2 class="product_title entry-title">
      {{ get_the_title() }}

      @if ($custom_text)
        <h3>{{ esc_html($custom_text) }}</h3>
      @endif
    </h2>
  </div>

  @if ($certificate_link && $certificate_img)
    <div class="flex certificate__iconBox">
      <a href="{{ esc_url($certificate_link) }}" target="_blank" rel="noopener">
        <img class="certificate__icon alignnone wp-image-830 size-full" src="{{ esc_url($certificate_img) }}" alt="Certyfikat" width="250" height="83" />
      </a>
    </div>
  @endif
</div>