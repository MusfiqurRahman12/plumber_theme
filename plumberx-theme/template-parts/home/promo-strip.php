<?php
/**
 * Promo Strip Template Part
 * @package PlumberX
 */
$promo_title = get_theme_mod( 'plumberx_promo_title', 'Schedule Repair Service & Save $25' );
$promo_text  = get_theme_mod( 'plumberx_promo_text', 'We service all plumbing leaks and clogs and we are available 24/7' );
?>
<section class="promo-strip">
  <div class="container">
    <div class="promo-left">
      <div class="promo-icon-box">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
      </div>
      <div>
        <h3 class="promo-title"><?php echo esc_html( $promo_title ); ?></h3>
        <p class="promo-subtext"><?php echo esc_html( $promo_text ); ?></p>
      </div>
    </div>
    <div>
      <button class="btn-promo-action btn-book-top"><?php esc_html_e( 'Schedule a Service', 'plumberx' ); ?></button>
    </div>
  </div>
</section>
