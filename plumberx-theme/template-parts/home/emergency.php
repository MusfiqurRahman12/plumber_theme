<?php
/**
 * Emergency Banner Template Part
 * @package PlumberX
 */
$emergency_title = get_theme_mod( 'plumberx_emergency_title', 'Emergency Leaks & Pipe Bursts' );
$emergency_text  = get_theme_mod( 'plumberx_emergency_text', 'If you have an emergency plumbing need, simply call our 24 hour emergency plumbing' );
$emergency_phone = get_theme_mod( 'plumberx_emergency_phone', '01865 524 8503' );
$plumber_img     = get_theme_mod( 'plumberx_emergency_plumber_img', PLUMBERX_URI . '/assets/images/emergency_plumber.png' );
$wrench_img      = get_theme_mod( 'plumberx_emergency_wrench_img', PLUMBERX_URI . '/assets/images/emergency_wrench.png' );
?>
<section class="emergency-banner-section">
  <div class="container emergency-layout">
    <?php if ( $plumber_img ) : ?>
      <img src="<?php echo esc_url( $plumber_img ); ?>" alt="<?php esc_attr_e( 'Emergency Plumber', 'plumberx' ); ?>" class="emergency-plumber-cutout">
    <?php endif; ?>
    
    <div class="emergency-center">
      <h3 class="emergency-title"><?php echo esc_html( $emergency_title ); ?></h3>
      <p class="emergency-sub"><?php echo esc_html( $emergency_text ); ?></p>
      <div class="emergency-action-row">
        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $emergency_phone ) ); ?>" class="emergency-phone"><?php echo esc_html( $emergency_phone ); ?></a>
        <span class="emergency-or"><?php esc_html_e( 'OR', 'plumberx' ); ?></span>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-emergency-contact"><?php esc_html_e( 'CONTACT US', 'plumberx' ); ?></a>
      </div>
    </div>

    <?php if ( $wrench_img ) : ?>
      <img src="<?php echo esc_url( $wrench_img ); ?>" alt="<?php esc_attr_e( 'Pipe Wrench', 'plumberx' ); ?>" class="emergency-wrench-cutout">
    <?php endif; ?>
  </div>
</section>
