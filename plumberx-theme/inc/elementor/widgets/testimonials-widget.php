<?php
/**
 * Elementor Widget: PlumberX Testimonials Marquee
 *
 * Smooth infinite loop animated customer reviews.
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_testimonials';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Testimonials Marquee', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'header_section',
            array(
                'label' => esc_html__( 'Section Header', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'What our customers says', 'plumberx' ),
            )
        );

        $this->add_control(
            'section_subtitle',
            array(
                'label'   => esc_html__( 'Section Subtitle', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Thousands of people get benefit', 'plumberx' ),
            )
        );

        $this->add_control(
            'source',
            array(
                'label'   => esc_html__( 'Data Source', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'cpt',
                'options' => array(
                    'cpt'    => esc_html__( 'Dynamic: Testimonials CPT', 'plumberx' ),
                    'manual' => esc_html__( 'Manual: Custom Repeater Reviews', 'plumberx' ),
                ),
            )
        );

        $this->end_controls_section();

        // Repeater for manual reviews
        $this->start_controls_section(
            'reviews_section',
            array(
                'label'     => esc_html__( 'Custom Reviews', 'plumberx' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => array( 'source' => 'manual' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'author_name',
            array(
                'label'   => esc_html__( 'Customer Name', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Sarah Jenkins', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'service_type',
            array(
                'label'   => esc_html__( 'Service Type / Status', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Emergency Pipe Repair', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'location',
            array(
                'label'   => esc_html__( 'Location', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Austin, TX', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'rating',
            array(
                'label'   => esc_html__( 'Star Rating (1-5)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 5,
            )
        );

        $repeater->add_control(
            'review_text',
            array(
                'label'   => esc_html__( 'Review Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( '"Outstanding emergency response! Our basement pipe burst on a Sunday night, and technician Tim arrived within 30 minutes. Repaired the leak cleanly, tested water pressure, and charged an honest price with zero hidden fees."', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Badge Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Verified Customer', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'avatar',
            array(
                'label'   => esc_html__( 'Avatar Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/testimonial_1.jpg',
                ),
            )
        );

        $this->add_control(
            'custom_reviews',
            array(
                'label'       => esc_html__( 'Reviews List', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ author_name }}} - {{{ location }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $source   = $settings['source'];
        $cards    = array();

        if ( 'cpt' === $source ) {
            $testimonials = plumberx_get_testimonials( -1 );
            if ( $testimonials->have_posts() ) {
                $idx = 0;
                while ( $testimonials->have_posts() ) {
                    $testimonials->the_post();
                    $idx++;
                    $rating   = intval( get_post_meta( get_the_ID(), '_testimonial_rating', true ) ?: 5 );
                    $loc      = get_post_meta( get_the_ID(), '_testimonial_location', true ) ?: 'Austin, TX';
                    $srv      = get_post_meta( get_the_ID(), '_testimonial_service_type', true ) ?: 'Emergency Pipe Repair';
                    $badge    = get_post_meta( get_the_ID(), '_testimonial_badge_text', true ) ?: 'Verified Customer';
                    $avatar   = get_the_post_thumbnail_url( get_the_ID(), 'plumberx-testimonial' ) ?: PLUMBERX_URI . '/assets/images/testimonial_' . ( ( ( $idx - 1 ) % 6 ) + 1 ) . '.jpg';

                    $cards[] = array(
                        'name'     => get_the_title(),
                        'location' => $loc,
                        'service'  => $srv,
                        'rating'   => $rating,
                        'text'     => get_the_content(),
                        'avatar'   => $avatar,
                        'badge'    => $badge,
                    );
                }
                wp_reset_postdata();
            }
        } else if ( ! empty( $settings['custom_reviews'] ) ) {
            foreach ( $settings['custom_reviews'] as $idx => $r ) {
                $cards[] = array(
                    'name'     => $r['author_name'],
                    'location' => $r['location'],
                    'service'  => $r['service_type'],
                    'rating'   => intval( $r['rating'] ),
                    'text'     => $r['review_text'],
                    'avatar'   => ! empty( $r['avatar']['url'] ) ? $r['avatar']['url'] : PLUMBERX_URI . '/assets/images/testimonial_' . ( ( $idx % 6 ) + 1 ) . '.jpg',
                    'badge'    => ! empty( $r['badge_text'] ) ? $r['badge_text'] : 'Verified Customer',
                );
            }
        }

        if ( empty( $cards ) ) {
            // Static fallback matching static index.html exactly
            $cards = array(
                array(
                    'name'     => 'Sarah Jenkins',
                    'service'  => 'Emergency Pipe Repair',
                    'rating'   => 5,
                    'text'     => '"Outstanding emergency response! Our basement pipe burst on a Sunday night, and technician Tim arrived within 30 minutes. Repaired the leak cleanly, tested water pressure, and charged an honest price with zero hidden fees."',
                    'badge'    => 'Verified Customer',
                    'location' => 'Austin, TX',
                    'avatar'   => PLUMBERX_URI . '/assets/images/testimonial_1.jpg',
                ),
                array(
                    'name'     => 'Michael Vance',
                    'service'  => 'Commercial Maintenance',
                    'rating'   => 5,
                    'text'     => '"We rely on PlumberX for our restaurant\'s grease trap maintenance and backflow prevention. Dependable, certified, and courteous crew. We haven\'t experienced an unexpected plumbing delay since partnering with them."',
                    'badge'    => 'Verified Business',
                    'location' => 'Dallas, TX',
                    'avatar'   => PLUMBERX_URI . '/assets/images/testimonial_2.jpg',
                ),
                array(
                    'name'     => 'David Ross',
                    'service'  => 'Bathroom Remodel & Repiping',
                    'rating'   => 5,
                    'text'     => '"Completely repiped and fitted new brass fixtures for our master bath remodel. Flawless craftsmanship, tidy work area left every afternoon, and the job was completed right on budget and schedule."',
                    'badge'    => 'Verified Customer',
                    'location' => 'Houston, TX',
                    'avatar'   => PLUMBERX_URI . '/assets/images/testimonial_3.jpg',
                ),
                array(
                    'name'     => 'Emily Watson',
                    'service'  => 'Tankless Water Heater Install',
                    'rating'   => 5,
                    'text'     => '"Replaced our 12-year-old leaking water heater with a high-efficiency tankless system. The technician walked us through every option clearly. We had continuous hot water running by dinner time!"',
                    'badge'    => 'Verified Customer',
                    'location' => 'San Antonio, TX',
                    'avatar'   => PLUMBERX_URI . '/assets/images/testimonial_4.jpg',
                ),
                array(
                    'name'     => 'Marcus Thorne',
                    'service'  => 'Main Drain & Sewer Jetting',
                    'rating'   => 5,
                    'text'     => '"Had persistent drain backup issues that two previous plumbers failed to diagnose. Their camera snake pinpointed invasive tree roots instantly and hydro-jetted them clean. Truly five-star pros!"',
                    'badge'    => 'Verified Customer',
                    'location' => 'Fort Worth, TX',
                    'avatar'   => PLUMBERX_URI . '/assets/images/testimonial_5.jpg',
                ),
                array(
                    'name'     => 'Jessica Miller',
                    'service'  => 'Boiler & Heating Inspection',
                    'rating'   => 5,
                    'text'     => '"Fast, polite, and completely transparent with costs upfront. Inspected our radiator heating before winter, fixed the boiler pressure release valve, and saved us hundreds on utility bills."',
                    'badge'    => 'Verified Customer',
                    'location' => 'Plano, TX',
                    'avatar'   => PLUMBERX_URI . '/assets/images/testimonial_6.jpg',
                ),
            );
        }
        ?>
        <section class="testimonials-section">
          <div class="container">
            <div class="section-header text-center">
              <h2 class="section-title"><?php echo esc_html( $settings['section_title'] ); ?></h2>
              <?php if ( ! empty( $settings['section_subtitle'] ) ) : ?>
                <p class="section-subtitle"><?php echo esc_html( $settings['section_subtitle'] ); ?></p>
              <?php endif; ?>
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
                      <img src="<?php echo esc_url( $card['avatar'] ); ?>" alt="<?php echo esc_attr( $card['name'] ); ?>" class="testimonial-avatar">
                      <div class="testimonial-info">
                        <h4 class="testimonial-author-name"><?php echo esc_html( $card['name'] ); ?></h4>
                        <span class="testimonial-author-status"><?php echo esc_html( $card['service'] ); ?></span>
                      </div>
                    </div>
                    <div class="testimonial-stars" aria-label="<?php echo esc_attr( $card['rating'] ); ?> out of 5 stars">
                      <?php for ( $s = 0; $s < $card['rating']; $s++ ) : ?><span>★</span><?php endfor; ?>
                    </div>
                    <p class="testimonial-text"><?php echo wp_kses_post( $card['text'] ); ?></p>
                    <div class="testimonial-footer">
                      <span class="testimonial-verified">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <?php echo esc_html( $card['badge'] ); ?>
                      </span>
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
                      <img src="<?php echo esc_url( $card['avatar'] ); ?>" alt="<?php echo esc_attr( $card['name'] ); ?>" class="testimonial-avatar">
                      <div class="testimonial-info">
                        <h4 class="testimonial-author-name"><?php echo esc_html( $card['name'] ); ?></h4>
                        <span class="testimonial-author-status"><?php echo esc_html( $card['service'] ); ?></span>
                      </div>
                    </div>
                    <div class="testimonial-stars" aria-label="<?php echo esc_attr( $card['rating'] ); ?> out of 5 stars">
                      <?php for ( $s = 0; $s < $card['rating']; $s++ ) : ?><span>★</span><?php endfor; ?>
                    </div>
                    <p class="testimonial-text"><?php echo wp_kses_post( $card['text'] ); ?></p>
                    <div class="testimonial-footer">
                      <span class="testimonial-verified">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <?php echo esc_html( $card['badge'] ); ?>
                      </span>
                      <span class="testimonial-location"><?php echo esc_html( $card['location'] ); ?></span>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
