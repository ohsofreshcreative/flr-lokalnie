

@php
  defined('ABSPATH') || exit;
  global $product;
@endphp

{{--
  Hook: woocommerce_before_single_product.
  @hooked woocommerce_output_all_notices - 10
--}}
@php
  do_action('woocommerce_before_single_product');
@endphp

@if (post_password_required())
  {!! get_the_password_form() !!}
  @php
    return;
  @endphp
@endif

<div id="product-{{ get_the_ID() }}" @php wc_product_class('grid grid-cols-1 lg:grid-cols-[1fr_2fr] gap-10 -smt', $product) @endphp>
  @php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
  @endphp

  <div class="summary entry-summary">
    @php
      /**
       * Hook: woocommerce_single_product_summary.
       *
       * @hooked woocommerce_template_single_title - 5
       * @hooked woocommerce_template_single_rating - 10
       * @hooked woocommerce_template_single_price - 10
       * @hooked woocommerce_template_single_excerpt - 20
       * @hooked woocommerce_template_single_add_to_cart - 30
       * @hooked woocommerce_template_single_meta - 40
       * @hooked woocommerce_template_single_sharing - 50
       * @hooked WC_Structured_Data::generate_product_data() - 60
       */
      do_action('woocommerce_single_product_summary');
    @endphp
  </div>

  @php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
  @endphp
</div>

@php
  do_action('woocommerce_after_single_product');
@endphp