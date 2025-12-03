@php
defined('ABSPATH') || exit;
global $product;
@endphp


@php
  /**
   * Hook: woocommerce_before_single_product.
   * @hooked wc_print_notices - 10
   */
  do_action('woocommerce_before_single_product');
@endphp

@if (post_password_required())
  {!! get_the_password_form() !!}
  @php return; @endphp
@endif

<div id="product-{{ $product->get_id() }}" {!! wc_product_class('b-single-product c-main', $product) !!}>

  <div>

    <div class="">
      @php
        /**
         * Hook: woocommerce_single_product_summary.
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
  </div>

</div>

@php do_action('woocommerce_after_single_product'); @endphp