<?php
/**
 * Elementor Widget: PlumberX Partner Brands Marquee
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Partners_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_partners';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Partner Brands Marquee', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Partner Brands', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'brand_name',
            array(
                'label'   => esc_html__( 'Brand Name', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'KOHLER', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'brand_tagline',
            array(
                'label'   => esc_html__( 'Brand Tagline', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'THE BOLD LOOK', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'brand_logo',
            array(
                'label'   => esc_html__( 'Brand Logo (Optional)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );

        $this->add_control(
            'brand_items',
            array(
                'label'       => esc_html__( 'Brands List', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ brand_name }}}',
                'default'     => array(
                    array( 'brand_name' => 'KOHLER', 'brand_tagline' => 'THE BOLD LOOK' ),
                    array( 'brand_name' => 'MOEN', 'brand_tagline' => 'BUY IT FOR LOOKS' ),
                    array( 'brand_name' => 'DELTA', 'brand_tagline' => 'FAUCET COMPANY' ),
                    array( 'brand_name' => 'GROHE', 'brand_tagline' => 'PURE FREUDE AN WASSER' ),
                    array( 'brand_name' => 'TOTO', 'brand_tagline' => 'PERFECTION BY DESIGN' ),
                    array( 'brand_name' => 'AMERICAN STANDARD', 'brand_tagline' => 'LIFE TESTED' ),
                    array( 'brand_name' => 'RHEEM', 'brand_tagline' => 'DEGREE OF COMFORT' ),
                    array( 'brand_name' => 'BRADFORD WHITE', 'brand_tagline' => 'BUILT TO BE THE BEST' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $brands   = ! empty( $settings['brand_items'] ) ? $settings['brand_items'] : array();

        if ( empty( $brands ) ) {
            $brands = array(
                array( 'brand_name' => 'KOHLER', 'brand_tagline' => 'THE BOLD LOOK' ),
                array( 'brand_name' => 'MOEN', 'brand_tagline' => 'BUY IT FOR LOOKS' ),
                array( 'brand_name' => 'DELTA', 'brand_tagline' => 'FAUCET COMPANY' ),
                array( 'brand_name' => 'GROHE', 'brand_tagline' => 'PURE FREUDE AN WASSER' ),
                array( 'brand_name' => 'TOTO', 'brand_tagline' => 'PERFECTION BY DESIGN' ),
                array( 'brand_name' => 'AMERICAN STANDARD', 'brand_tagline' => 'LIFE TESTED' ),
                array( 'brand_name' => 'RHEEM', 'brand_tagline' => 'DEGREE OF COMFORT' ),
                array( 'brand_name' => 'BRADFORD WHITE', 'brand_tagline' => 'BUILT TO BE THE BEST' ),
            );
        }
        ?>
        <section class="partner-logos-section">
          <div class="partner-logos-marquee">
            <div class="partner-logos-track">
              <!-- Group 1 -->
              <div class="partner-logos-group">
                <?php foreach ( $brands as $brand ) : ?>
                  <div class="partner-brand-item">
                    <?php if ( ! empty( $brand['brand_logo']['url'] ) ) : ?>
                      <img src="<?php echo esc_url( $brand['brand_logo']['url'] ); ?>" alt="<?php echo esc_attr( $brand['brand_name'] ); ?>" class="partner-brand-logo">
                    <?php else : ?>
                      <span class="partner-brand-name"><?php echo esc_html( $brand['brand_name'] ); ?></span>
                      <?php if ( ! empty( $brand['brand_tagline'] ) ) : ?>
                        <span class="partner-brand-tag"><?php echo esc_html( $brand['brand_tagline'] ); ?></span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Group 2 (Duplicate for Infinite Loop) -->
              <div class="partner-logos-group" aria-hidden="true">
                <?php foreach ( $brands as $brand ) : ?>
                  <div class="partner-brand-item">
                    <?php if ( ! empty( $brand['brand_logo']['url'] ) ) : ?>
                      <img src="<?php echo esc_url( $brand['brand_logo']['url'] ); ?>" alt="<?php echo esc_attr( $brand['brand_name'] ); ?>" class="partner-brand-logo">
                    <?php else : ?>
                      <span class="partner-brand-name"><?php echo esc_html( $brand['brand_name'] ); ?></span>
                      <?php if ( ! empty( $brand['brand_tagline'] ) ) : ?>
                        <span class="partner-brand-tag"><?php echo esc_html( $brand['brand_tagline'] ); ?></span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
