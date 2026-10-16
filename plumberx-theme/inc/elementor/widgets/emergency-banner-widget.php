<?php
/**
 * Elementor Widget: PlumberX Emergency Banner
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Emergency_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_emergency_banner';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Emergency Banner', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-alert';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Emergency Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'emergency_title',
            array(
                'label'   => esc_html__( 'Emergency Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Emergency Leaks & Pipe Bursts', 'plumberx' ),
            )
        );

        $this->add_control(
            'emergency_text',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'If you have an emergency plumbing need, simply call our 24 hour emergency plumbing', 'plumberx' ),
            )
        );

        $this->add_control(
            'phone_number',
            array(
                'label'   => esc_html__( 'Emergency Phone Number', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '01865 524 8503',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Contact Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'CONTACT US', 'plumberx' ),
            )
        );

        $this->add_control(
            'btn_link',
            array(
                'label'   => esc_html__( 'Contact Button Link', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '/contact/',
                ),
            )
        );

        $this->add_control(
            'plumber_img',
            array(
                'label'   => esc_html__( 'Plumber Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/emergency_plumber.png',
                ),
            )
        );

        $this->add_control(
            'wrench_img',
            array(
                'label'   => esc_html__( 'Pipe Wrench Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/emergency_wrench.png',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings    = $this->get_settings_for_display();
        $title       = ! empty( $settings['emergency_title'] ) ? $settings['emergency_title'] : 'Emergency Leaks & Pipe Bursts';
        $subtext     = ! empty( $settings['emergency_text'] ) ? $settings['emergency_text'] : 'If you have an emergency plumbing need, simply call our 24 hour emergency plumbing';
        $phone       = ! empty( $settings['phone_number'] ) ? $settings['phone_number'] : '01865 524 8503';
        $phone_clean = preg_replace( '/[^0-9+]/', '', $phone );
        $btn_text    = ! empty( $settings['btn_text'] ) ? $settings['btn_text'] : 'CONTACT US';
        $btn_url     = ! empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : home_url( '/contact' );
        $plumber_url = ! empty( $settings['plumber_img']['url'] ) ? $settings['plumber_img']['url'] : PLUMBERX_URI . '/assets/images/emergency_plumber.png';
        $wrench_url  = ! empty( $settings['wrench_img']['url'] ) ? $settings['wrench_img']['url'] : PLUMBERX_URI . '/assets/images/emergency_wrench.png';
        ?>
        <section class="emergency-banner-section">
          <div class="container emergency-layout">
            <?php if ( $plumber_url ) : ?>
              <img src="<?php echo esc_url( $plumber_url ); ?>" alt="<?php esc_attr_e( 'Emergency Plumber', 'plumberx' ); ?>" class="emergency-plumber-cutout">
            <?php endif; ?>
            
            <div class="emergency-center">
              <h3 class="emergency-title"><?php echo esc_html( $title ); ?></h3>
              <p class="emergency-sub"><?php echo esc_html( $subtext ); ?></p>
              <div class="emergency-action-row">
                <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="emergency-phone"><?php echo esc_html( $phone ); ?></a>
                <span class="emergency-or"><?php esc_html_e( 'OR', 'plumberx' ); ?></span>
                <a href="<?php echo esc_url( $btn_url ); ?>" class="btn-emergency-contact"><?php echo esc_html( $btn_text ); ?></a>
              </div>
            </div>

            <?php if ( $wrench_url ) : ?>
              <img src="<?php echo esc_url( $wrench_url ); ?>" alt="<?php esc_attr_e( 'Pipe Wrench', 'plumberx' ); ?>" class="emergency-wrench-cutout">
            <?php endif; ?>
          </div>
        </section>
        <?php
    }
}
