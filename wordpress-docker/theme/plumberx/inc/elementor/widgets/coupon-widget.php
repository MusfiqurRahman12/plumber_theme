<?php
/**
 * Elementor Widget: PlumberX Coupon / Contractor Section
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Coupon_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_coupon';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Contractor & Coupon', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'contractor_section',
            array(
                'label' => esc_html__( 'Contractor Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title_strong',
            array(
                'label'   => esc_html__( 'Title (Bold Part)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Choosing the Right', 'plumberx' ),
            )
        );

        $this->add_control(
            'title_rest',
            array(
                'label'   => esc_html__( 'Title (Remaining Part)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Plumbing Contractor', 'plumberx' ),
            )
        );

        $this->add_control(
            'contractor_text',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 5,
                'default' => "Factory Trained Technicians: We only employ factory trained technicians, they're the best in the industry. Your assurance that the work will be done right the first time.\n\nExtensive Contractor Services: At Sammi's, we expect to continue our relationship long after your new equipment is installed. Our ongoing services are designed to keep your unit operating at peak efficiency without disruptive breakdowns.",
            )
        );

        $this->add_control(
            'checklist_items',
            array(
                'label'   => esc_html__( 'Checklist Items (1 per line)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 8,
                'default' => "Plumbing Clogs\nToilets install or replace\nWater heater replacement\nNew piping and repairs\nRepair and install gas lines\nResidential and commercial\nRemodel your plumbing\nPlumbing\nFlood repair\nAnd a ton more\nDisposal repair and install",
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'coupon_section',
            array(
                'label' => esc_html__( 'Coupon Details', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'coupon_title',
            array(
                'label'   => esc_html__( 'Coupon Discount Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '$35 Off Service Call', 'plumberx' ),
            )
        );

        $this->add_control(
            'coupon_subtitle',
            array(
                'label'   => esc_html__( 'Coupon Subtitle', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Cannot be combined with any other offer', 'plumberx' ),
            )
        );

        $this->add_control(
            'coupon_note',
            array(
                'label'   => esc_html__( 'Fine Print / Note', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Must present coupon at time of service.', 'plumberx' ),
            )
        );

        $this->add_control(
            'coupon_tag',
            array(
                'label'   => esc_html__( 'Coupon Tag Badge', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'For new clients only', 'plumberx' ),
            )
        );

        $this->add_control(
            'coupon_expire',
            array(
                'label'   => esc_html__( 'Expiration Date', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '01.05.2026',
            )
        );

        $this->add_control(
            'specials_link',
            array(
                'label'   => esc_html__( 'More Specials Link', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '/pricing/',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $title_strong = ! empty( $settings['title_strong'] ) ? $settings['title_strong'] : 'Choosing the Right';
        $title_rest   = ! empty( $settings['title_rest'] ) ? $settings['title_rest'] : 'Plumbing Contractor';
        $specials_url = ! empty( $settings['specials_link']['url'] ) ? $settings['specials_link']['url'] : home_url( '/pricing' );

        $checks_raw = ! empty( $settings['checklist_items'] ) ? $settings['checklist_items'] : '';
        $checks     = array_filter( array_map( 'trim', explode( "\n", $checks_raw ) ) );
        if ( empty( $checks ) ) {
            $checks = array( 'Plumbing Clogs', 'Toilets install or replace', 'Water heater replacement', 'New piping and repairs', 'Repair and install gas lines', 'Residential and commercial', 'Remodel your plumbing', 'Plumbing', 'Flood repair', 'And a ton more', 'Disposal repair and install' );
        }
        ?>
        <section class="contractor-section">
          <div class="container contractor-grid">
            <div class="contractor-info-col">
              <h2 class="section-title"><strong><?php echo esc_html( $title_strong ); ?></strong> <?php echo esc_html( $title_rest ); ?></h2>
              <p class="contractor-text"><?php echo wp_kses_post( nl2br( $settings['contractor_text'] ) ); ?></p>

              <div class="contractor-checklist-grid">
                <?php foreach ( $checks as $check ) : ?>
                  <div class="check-item"><span class="check-icon">✓</span> <?php echo esc_html( $check ); ?></div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="contractor-coupon-col">
              <div class="coupon-box">
                <div class="coupon-header">
                  <h3><?php echo esc_html( $settings['coupon_title'] ); ?></h3>
                </div>
                <div class="coupon-body">
                  <h4><?php echo esc_html( $settings['coupon_subtitle'] ); ?></h4>
                  <p><?php echo esc_html( $settings['coupon_note'] ); ?></p>
                  <div class="coupon-tag"><?php echo esc_html( $settings['coupon_tag'] ); ?></div>
                  <div class="coupon-expire">Expire on : <?php echo esc_html( $settings['coupon_expire'] ); ?></div>
                </div>
                <div class="coupon-footer">
                  <a href="javascript:void(0)" class="coupon-print-link"><?php esc_html_e( 'Click open in Print View', 'plumberx' ); ?></a>
                  <a href="<?php echo esc_url( $specials_url ); ?>" class="coupon-more-specials"><?php esc_html_e( 'Click here for more specials', 'plumberx' ); ?></a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
