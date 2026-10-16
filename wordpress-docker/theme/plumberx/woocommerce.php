<?php
/**
 * WooCommerce Template Fallback
 *
 * Fully supports Elementor-built Shop Page while maintaining
 * standard WooCommerce catalog and product templates.
 *
 * @package PlumberX
 */

get_header();

$shop_page_id = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'shop' ) : 0;
$is_elementor = false;

if ( is_shop() && $shop_page_id && class_exists( '\Elementor\Plugin' ) ) {
    $document = \Elementor\Plugin::$instance->documents->get( $shop_page_id );
    if ( $document && $document->is_built_with_elementor() ) {
        $is_elementor = true;
    }
}

if ( $is_elementor ) :
    // Elementor handles full width layout
    ?>
    <main id="primary" class="site-main page-main">
        <?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $shop_page_id ); ?>
    </main>
    <?php
else :
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
endif;

get_footer();
