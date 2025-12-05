
<div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-8 mb-4">
  <div>
    <h2 class="product_title entry-title text-white">
      {{ get_the_title() }}

      @if ($custom_text)
        <h3 class="primary">{{ esc_html($custom_text) }}</h3>
      @endif
    </h2>
  </div>

  @if ($certificate_link && $certificate_img)
    <div class="justify-self-start md:justify-self-end">
      <a href="{{ esc_url($certificate_link) }}" target="_blank" rel="noopener">
        <img class="" src="{{ esc_url($certificate_img) }}" alt="Certyfikat"/>
      </a>
    </div>
  @endif
</div>