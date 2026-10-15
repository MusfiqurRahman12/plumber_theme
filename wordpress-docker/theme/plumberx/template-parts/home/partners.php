<?php
/**
 * Partner Logos Strip Template Part
 * 
 * Smooth infinite loop marquee of brand logos, pulled from plumberx_partner CPT with static fallback.
 *
 * @package PlumberX
 */

$partners_query = new WP_Query( array(
    'post_type'      => 'plumberx_partner',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
) );

$partner_items = array();

if ( $partners_query->have_posts() ) {
    while ( $partners_query->have_posts() ) {
        $partners_query->the_post();
        $tagline = get_post_meta( get_the_ID(), '_partner_tagline', true );
        $partner_items[] = array(
            'name'    => get_the_title(),
            'tagline' => $tagline,
            'image'   => get_the_post_thumbnail_url( get_the_ID(), 'full' ),
        );
    }
    wp_reset_postdata();
}

// Fallback brands if no CPT entries yet
if ( empty( $partner_items ) ) {
    $partner_items = array(
        array( 'name' => 'KOHLER', 'tagline' => 'THE BOLD LOOK', 'image' => '' ),
        array( 'name' => 'MOEN', 'tagline' => 'BUY IT FOR LOOKS', 'image' => '' ),
        array( 'name' => 'DELTA', 'tagline' => 'FAUCET COMPANY', 'image' => '' ),
        array( 'name' => 'GROHE', 'tagline' => 'PURE FREUDE AN WASSER', 'image' => '' ),
        array( 'name' => 'TOTO', 'tagline' => 'PERFECTION BY DESIGN', 'image' => '' ),
        array( 'name' => 'AMERICAN STANDARD', 'tagline' => 'LIFE TESTED', 'image' => '' ),
        array( 'name' => 'RHEEM', 'tagline' => 'DEGREE OF COMFORT', 'image' => '' ),
        array( 'name' => 'BRADFORD WHITE', 'tagline' => 'BUILT TO BE THE BEST', 'image' => '' ),
    );
}
?>
<section class="partner-logos-section">
  <div class="partner-logos-marquee">
    <div class="partner-logos-track">
      <!-- Group 1 -->
      <div class="partner-logos-group">
        <?php foreach ( $partner_items as $item ) : ?>
          <div class="partner-brand-item">
            <?php if ( ! empty( $item['image'] ) ) : ?>
              <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" class="partner-brand-logo">
            <?php else : ?>
              <span class="partner-brand-name"><?php echo esc_html( $item['name'] ); ?></span>
              <?php if ( ! empty( $item['tagline'] ) ) : ?>
                <span class="partner-brand-tag"><?php echo esc_html( $item['tagline'] ); ?></span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Group 2 (Duplicate for Seamless Infinite Loop) -->
      <div class="partner-logos-group" aria-hidden="true">
        <?php foreach ( $partner_items as $item ) : ?>
          <div class="partner-brand-item">
            <?php if ( ! empty( $item['image'] ) ) : ?>
              <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" class="partner-brand-logo">
            <?php else : ?>
              <span class="partner-brand-name"><?php echo esc_html( $item['name'] ); ?></span>
              <?php if ( ! empty( $item['tagline'] ) ) : ?>
                <span class="partner-brand-tag"><?php echo esc_html( $item['tagline'] ); ?></span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
