<?php
/**
 * Elementor Widget: PlumberX Promo Strip
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Promo_Strip_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_promo_strip';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Promo Strip', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-ribbon';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Promo Details', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'promo_title',
            array(
                'label'   => esc_html__( 'Promo Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Schedule Repair Service & Save $25', 'plumberx' ),
            )
        );

        $this->add_control(
            'promo_text',
            array(
                'label'   => esc_html__( 'Subtext', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'We service all plumbing leakes and coges and we are available 24/7', 'plumberx' ),
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Schedule a Service', 'plumberx' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title    = ! empty( $settings['promo_title'] ) ? $settings['promo_title'] : 'Schedule Repair Service & Save $25';
        $subtext  = ! empty( $settings['promo_text'] ) ? $settings['promo_text'] : 'We service all plumbing leakes and coges and we are available 24/7';
        $btn_text = ! empty( $settings['btn_text'] ) ? $settings['btn_text'] : 'Schedule a Service';
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
                <h3 class="promo-title"><?php echo esc_html( $title ); ?></h3>
                <p class="promo-subtext"><?php echo esc_html( $subtext ); ?></p>
              </div>
            </div>
            <div>
              <button class="btn-promo-action btn-book-top" type="button"><?php echo esc_html( $btn_text ); ?></button>
            </div>
          </div>
        </section>
        <?php
    }
}
