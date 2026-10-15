<?php
/**
 * Testimonials Marquee Section Template Part
 * @package PlumberX
 */
$testimonials = plumberx_get_testimonials( -1 );
$cards = array();

if ( $testimonials->have_posts() ) {
    while ( $testimonials->have_posts() ) {
        $testimonials->the_post();
        $cards[] = array(
            'name'         => get_the_title(),
            'text'         => get_the_content(),
            'avatar'       => get_the_post_thumbnail_url( get_the_ID(), 'plumberx-testimonial' ),
            'service_type' => get_post_meta( get_the_ID(), '_testimonial_service_type', true ),
            'rating'       => get_post_meta( get_the_ID(), '_testimonial_rating', true ) ?: 5,
            'location'     => get_post_meta( get_the_ID(), '_testimonial_location', true ),
            'verified'     => get_post_meta( get_the_ID(), '_testimonial_verified', true ),
            'badge_text'   => get_post_meta( get_the_ID(), '_testimonial_badge_text', true ) ?: 'Verified Customer',
        );
    }
    wp_reset_postdata();
}

// Fallback if no testimonials
if ( empty( $cards ) ) {
    $cards = array(
        array( 'name' => 'Sarah Jenkins', 'text' => '"Outstanding emergency response! Our basement pipe burst on a Sunday night, and technician Tim arrived within 30 minutes."', 'avatar' => PLUMBERX_URI . '/assets/images/testimonial_1.jpg', 'service_type' => 'Emergency Pipe Repair', 'rating' => 5, 'location' => 'Austin, TX', 'verified' => '1', 'badge_text' => 'Verified Customer' ),
        array( 'name' => 'Michael Vance', 'text' => '"We rely on PlumberX for our restaurant\'s grease trap maintenance and backflow prevention. Dependable, certified crew."', 'avatar' => PLUMBERX_URI . '/assets/images/testimonial_2.jpg', 'service_type' => 'Commercial Maintenance', 'rating' => 5, 'location' => 'Dallas, TX', 'verified' => '1', 'badge_text' => 'Verified Business' ),
        array( 'name' => 'David Ross', 'text' => '"Completely repiped and fitted new brass fixtures for our master bath remodel. Flawless craftsmanship."', 'avatar' => PLUMBERX_URI . '/assets/images/testimonial_3.jpg', 'service_type' => 'Bathroom Remodel', 'rating' => 5, 'location' => 'Houston, TX', 'verified' => '1', 'badge_text' => 'Verified Customer' ),
        array( 'name' => 'Emily Watson', 'text' => '"Replaced our 12-year-old leaking water heater with a high-efficiency tankless system. Excellent service!"', 'avatar' => PLUMBERX_URI . '/assets/images/testimonial_4.jpg', 'service_type' => 'Water Heater Install', 'rating' => 5, 'location' => 'San Antonio, TX', 'verified' => '1', 'badge_text' => 'Verified Customer' ),
        array( 'name' => 'Marcus Thorne', 'text' => '"Had persistent drain backup issues that two previous plumbers failed to diagnose. Truly five-star pros!"', 'avatar' => PLUMBERX_URI . '/assets/images/testimonial_5.jpg', 'service_type' => 'Sewer Jetting', 'rating' => 5, 'location' => 'Fort Worth, TX', 'verified' => '1', 'badge_text' => 'Verified Customer' ),
        array( 'name' => 'Jessica Miller', 'text' => '"Fast, polite, and completely transparent with costs upfront. Saved us hundreds on utility bills."', 'avatar' => PLUMBERX_URI . '/assets/images/testimonial_6.jpg', 'service_type' => 'Boiler Inspection', 'rating' => 5, 'location' => 'Plano, TX', 'verified' => '1', 'badge_text' => 'Verified Customer' ),
    );
}
?>
<section class="testimonials-section">
  <div class="container">
    <div class="section-header text-center">
      <h2 class="section-title"><?php esc_html_e( 'What our customers says', 'plumberx' ); ?></h2>
      <p class="section-subtitle"><?php esc_html_e( 'Thousands of people get benefit', 'plumberx' ); ?></p>
    </div>
  </div>

  <!-- Smooth Infinite Loop Marquee -->
  <div class="testimonials-marquee">
    <div class="testimonials-track">
      <!-- Group 1 -->
      <div class="testimonials-group">
        <?php foreach ( $cards as $card ) : ?>
        <div class="testimonial-card">
          <div class="testimonial-header">
            <?php if ( $card['avatar'] ) : ?>
              <img src="<?php echo esc_url( $card['avatar'] ); ?>" alt="<?php echo esc_attr( $card['name'] ); ?>" class="testimonial-avatar">
            <?php endif; ?>
            <div class="testimonial-info">
              <h4 class="testimonial-author-name"><?php echo esc_html( $card['name'] ); ?></h4>
              <span class="testimonial-author-status"><?php echo esc_html( $card['service_type'] ); ?></span>
            </div>
          </div>
          <?php plumberx_star_rating( $card['rating'] ); ?>
          <p class="testimonial-text"><?php echo wp_kses_post( $card['text'] ); ?></p>
          <div class="testimonial-footer">
            <?php if ( $card['verified'] === '1' ) : ?>
            <span class="testimonial-verified">
              <?php plumberx_verified_badge(); ?>
              <?php echo esc_html( $card['badge_text'] ); ?>
            </span>
            <?php endif; ?>
            <span class="testimonial-location"><?php echo esc_html( $card['location'] ); ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Group 2 (Duplicate for Seamless Infinite Loop) -->
      <div class="testimonials-group" aria-hidden="true">
        <?php foreach ( $cards as $card ) : ?>
        <div class="testimonial-card">
          <div class="testimonial-header">
            <?php if ( $card['avatar'] ) : ?>
              <img src="<?php echo esc_url( $card['avatar'] ); ?>" alt="<?php echo esc_attr( $card['name'] ); ?>" class="testimonial-avatar">
            <?php endif; ?>
            <div class="testimonial-info">
              <h4 class="testimonial-author-name"><?php echo esc_html( $card['name'] ); ?></h4>
              <span class="testimonial-author-status"><?php echo esc_html( $card['service_type'] ); ?></span>
            </div>
          </div>
          <?php plumberx_star_rating( $card['rating'] ); ?>
          <p class="testimonial-text"><?php echo wp_kses_post( $card['text'] ); ?></p>
          <div class="testimonial-footer">
            <?php if ( $card['verified'] === '1' ) : ?>
            <span class="testimonial-verified">
              <?php plumberx_verified_badge(); ?>
              <?php echo esc_html( $card['badge_text'] ); ?>
            </span>
            <?php endif; ?>
            <span class="testimonial-location"><?php echo esc_html( $card['location'] ); ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
