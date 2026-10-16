<?php
/**
 * Services Tabs Template Part
 * @package PlumberX
 */
$services = plumberx_get_services( -1 );
$service_posts = array();
if ( $services->have_posts() ) {
    while ( $services->have_posts() ) {
        $services->the_post();
        $service_posts[] = array(
            'id'        => get_the_ID(),
            'title'     => get_the_title(),
            'content'   => get_the_excerpt(),
            'image'     => get_the_post_thumbnail_url( get_the_ID(), 'plumberx-blog' ),
            'checklist' => get_post_meta( get_the_ID(), '_service_checklist', true ),
        );
    }
    wp_reset_postdata();
}

// Fallback data if no services added yet
if ( empty( $service_posts ) ) {
    $service_posts = array(
        array( 'id' => 'tabLeaks', 'title' => 'PLUMBING LEAKS', 'content' => 'We handle all plumbing leak situations.', 'image' => PLUMBERX_URI . '/assets/images/service_tab_kitchen.jpg', 'checklist' => "Diagnosis and Check-ups\nInstallations and Upgrades\nSystem Maintenance and Cleaning\nEmergency Plumbing Repairs\nClog Removal" ),
        array( 'id' => 'tabBathroom', 'title' => 'BATHROOM PLUMBING', 'content' => 'Complete bathroom plumbing solutions.', 'image' => '', 'checklist' => "Shower & Bathtub Repairs\nVanity Drain Alignment\nPressure Regulator Tuning\nOdor & Trap Inspections" ),
        array( 'id' => 'tabKitchen', 'title' => 'KITCHEN PLUMBING', 'content' => 'Kitchen plumbing made worry-free.', 'image' => '', 'checklist' => "Sink Faucet Installation\nGarbage Disposal Maintenance\nUnder-counter Pipe Resealing" ),
        array( 'id' => 'tabDrain', 'title' => 'DRAIN CLOGS', 'content' => 'Stubborn clogs cleared safely.', 'image' => '', 'checklist' => "Hydro Jetting Cleanouts\nFiber-optic Camera Scans" ),
    );
}
?>
<section class="services-tab-section">
  <div class="container">
    <?php plumberx_section_header( 'Services That We Offers', '', true ); ?>

    <div class="services-tab-layout">
      <!-- Tab Navigation -->
      <div class="tab-nav-vertical">
        <?php foreach ( $service_posts as $i => $svc ) : ?>
          <button class="tab-btn-vertical<?php echo $i === 0 ? ' active' : ''; ?>" data-target="tab<?php echo esc_attr( $svc['id'] ); ?>"><?php echo esc_html( strtoupper( $svc['title'] ) ); ?></button>
        <?php endforeach; ?>
      </div>

      <!-- Tab Content -->
      <div class="tab-content-area">
        <?php foreach ( $service_posts as $i => $svc ) : ?>
          <div class="tab-content-panel<?php echo $i === 0 ? ' active' : ''; ?>" id="tab<?php echo esc_attr( $svc['id'] ); ?>">
            <p class="tab-desc-text"><?php echo esc_html( $svc['content'] ); ?></p>
            <div class="tab-body-row">
              <?php if ( ! empty( $svc['image'] ) ) : ?>
                <img src="<?php echo esc_url( $svc['image'] ); ?>" alt="<?php echo esc_attr( $svc['title'] ); ?>" class="tab-kitchen-img">
              <?php endif; ?>
              <?php if ( ! empty( $svc['checklist'] ) ) : ?>
                <div class="checklist">
                  <?php foreach ( explode( "\n", $svc['checklist'] ) as $item ) : $item = trim( $item ); if ( $item ) : ?>
                    <div class="check-item"><span class="check-icon">✓</span> <?php echo esc_html( $item ); ?></div>
                  <?php endif; endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Standing Plumber Illustration -->
      <div class="tab-plumber-col">
        <img src="<?php echo esc_url( PLUMBERX_URI . '/assets/images/service_tab_plumber.png' ); ?>" alt="<?php esc_attr_e( 'Certified Plumber', 'plumberx' ); ?>" class="tab-standing-plumber">
      </div>
    </div>
  </div>
</section>
