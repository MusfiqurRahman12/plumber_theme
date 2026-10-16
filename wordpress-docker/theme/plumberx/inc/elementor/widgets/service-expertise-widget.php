<?php
/**
 * Elementor Widget: PlumberX Service Expertise
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Service_Expertise_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_service_expertise';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Service Expertise', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Expertise Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '25 Years of Expertise in Plumbing', 'plumberx' ),
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore veritatis et quasi architecto.\n\nLorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor in-cidiamet consectetur adipiscing elit sed do eiusmod tempor.", 'plumberx' ),
            )
        );

        $this->add_control(
            'phone_1_text',
            array(
                'label'   => esc_html__( 'Button 1 Text (Phone)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '01865 524 8503',
            )
        );

        $this->add_control(
            'phone_1_url',
            array(
                'label'   => esc_html__( 'Button 1 URL', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => 'tel:018655248503',
                ),
            )
        );

        $this->add_control(
            'phone_2_text',
            array(
                'label'   => esc_html__( 'Button 2 Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '01865 524 8503',
            )
        );

        $this->add_control(
            'phone_2_url',
            array(
                'label'   => esc_html__( 'Button 2 URL', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => 'mailto:info@plumberx.com',
                ),
            )
        );

        $this->add_control(
            'expertise_image',
            array(
                'label'   => esc_html__( 'Expertise Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/service1_expertise.jpg',
                ),
            )
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            array(
                'label' => esc_html__( 'Style', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'bg_color',
            array(
                'label'     => esc_html__( 'Background Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .service1-expertise-section' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $title     = ! empty( $settings['section_title'] ) ? $settings['section_title'] : '25 Years of Expertise in Plumbing';
        $desc      = ! empty( $settings['description'] ) ? $settings['description'] : '';
        $btn1_text = ! empty( $settings['phone_1_text'] ) ? $settings['phone_1_text'] : '01865 524 8503';
        $btn1_url  = ! empty( $settings['phone_1_url']['url'] ) ? $settings['phone_1_url']['url'] : 'tel:018655248503';
        $btn2_text = ! empty( $settings['phone_2_text'] ) ? $settings['phone_2_text'] : '01865 524 8503';
        $btn2_url  = ! empty( $settings['phone_2_url']['url'] ) ? $settings['phone_2_url']['url'] : 'mailto:info@plumberx.com';
        $img_url   = ! empty( $settings['expertise_image']['url'] ) ? $settings['expertise_image']['url'] : PLUMBERX_URI . '/assets/images/service1_expertise.jpg';
        ?>
        <section class="service1-expertise-section">
          <div class="container service1-expertise-grid">
            <div class="expertise-text-col">
              <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
              <div class="tab-desc-text">
                <?php echo wp_kses_post( wpautop( $desc ) ); ?>
              </div>

              <div class="expertise-contact-buttons">
                <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-expertise-contact">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24 11.72 11.72 0 003.68.59 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.72 11.72 0 00.59 3.68 1 1 0 01-.24 1.02l-2.23 2.09z"/>
                  </svg>
                  <?php echo esc_html( $btn1_text ); ?>
                </a>
                <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-expertise-contact">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                  </svg>
                  <?php echo esc_html( $btn2_text ); ?>
                </a>
              </div>
            </div>

            <div class="expertise-img-col">
              <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" style="width:100%; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);">
            </div>
          </div>
        </section>
        <?php
    }
}
