<?php
/**
 * Contractor / Coupon Section Template Part
 * @package PlumberX
 */
$coupon_title    = get_theme_mod( 'plumberx_coupon_title', '$35 Off Service Call' );
$coupon_subtitle = get_theme_mod( 'plumberx_coupon_subtitle', 'Cannot be combined with any other offer' );
$coupon_note     = get_theme_mod( 'plumberx_coupon_note', 'Must present coupon at time of service.' );
$coupon_tag      = get_theme_mod( 'plumberx_coupon_tag', 'For new clients only' );
$coupon_expire   = get_theme_mod( 'plumberx_coupon_expire', '01.05.2026' );
?>
<section class="contractor-section">
  <div class="container contractor-grid">
    <div class="contractor-info-col">
      <h2 class="section-title"><strong><?php esc_html_e( 'Choosing the Right', 'plumberx' ); ?></strong> <?php esc_html_e( 'Plumbing Contractor', 'plumberx' ); ?></h2>
      <p class="contractor-text"><?php esc_html_e( 'Factory Trained Technicians: We only employ factory trained technicians, they\'re the best in the industry. Your assurance that the work will be done right the first time.', 'plumberx' ); ?><br><br>
      <?php esc_html_e( 'Extensive Contractor Services: At Sammi\'s, we expect to continue our relationship long after your new equipment is installed.', 'plumberx' ); ?></p>

      <div class="contractor-checklist-grid">
        <?php
        $checks = array( 'Plumbing Clogs', 'Toilets install or replace', 'Water heater replacement', 'New piping and repairs', 'Repair and install gas lines', 'Residential and commercial', 'Remodel your plumbing', 'Plumbing', 'Flood repair', 'And a ton more', 'Disposal repair and install' );
        foreach ( $checks as $check ) :
        ?>
          <div class="check-item"><span class="check-icon">✓</span> <?php echo esc_html( $check ); ?></div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="contractor-coupon-col">
      <div class="coupon-box">
        <div class="coupon-header">
          <h3><?php echo esc_html( $coupon_title ); ?></h3>
        </div>
        <div class="coupon-body">
          <h4><?php echo esc_html( $coupon_subtitle ); ?></h4>
          <p><?php echo esc_html( $coupon_note ); ?></p>
          <div class="coupon-tag"><?php echo esc_html( $coupon_tag ); ?></div>
          <div class="coupon-expire"><?php esc_html_e( 'Expire on :', 'plumberx' ); ?> <?php echo esc_html( $coupon_expire ); ?></div>
        </div>
        <div class="coupon-footer">
          <a href="javascript:void(0)" class="coupon-print-link"><?php esc_html_e( 'Click open in Print View', 'plumberx' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/pricing' ) ); ?>" class="coupon-more-specials"><?php esc_html_e( 'Click here for more specials', 'plumberx' ); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>
