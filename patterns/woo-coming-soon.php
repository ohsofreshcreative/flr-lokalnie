<?php
/**
 * Title: Woo Coming Soon (custom)
 * Slug: woocommerce/coming-soon
 * Categories: hidden
 * Inserter: no
 */
?>

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group bg-background" style="min-height:100vh;display:grid;place-items:center;padding:48px;">
  <!-- wp:group {"layout":{"type":"constrained"}} -->
  <div class="wp-block-group" style="text-align:center;max-width:800px">
    <!-- wp:site-logo {"width":120} /-->
    <?php
    $logo = get_field('logo_white', 'option');
    if ($logo) :
        $url = $logo['url'];
        $alt = $logo['alt'] ?: 'Logo';
    ?>
        <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>" class="w-auto h-12">
    <?php endif; ?>
    <!-- wp:heading {"level":1, "style":{"color":{"text":"#ffffff"}}} -->
    <h1 class="wp-block-heading" style="color:#FFF">Wracamy wkrótce!</h1>
    <!-- /wp:heading -->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->