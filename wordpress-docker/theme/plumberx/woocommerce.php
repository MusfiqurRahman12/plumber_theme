<?php
/**
 * WooCommerce Template Fallback
 *
 * @package PlumberX
 */

get_header();
?>

<div class="subpage-header-banner shop-header-banner">
  <div class="container">
    <h1 class="subpage-title"><?php woocommerce_page_title(); ?></h1>
    <p class="subpage-subtitle"><?php esc_html_e( 'Official Plumbing Fixtures, Tools & Replacement Parts', 'plumberx' ); ?></p>
  </div>
</div>

<main class="site-main woocommerce-site-main">
  <div class="container">
    <?php woocommerce_content(); ?>
  </div>
</main>

<?php
get_footer();
