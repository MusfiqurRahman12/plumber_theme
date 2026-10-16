<?php
/**
 * Elementor Widget: PlumberX Services Grid (8 Cards)
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Services_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_services_grid';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Services Grid (8 Cards)', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Section Header
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
                'default' => esc_html__( 'We offer Different Services', 'plumberx' ),
            )
        );

        $this->add_control(
            'section_subtitle',
            array(
                'label'   => esc_html__( 'Section Subtitle', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Consect petur adipiscing elit.', 'plumberx' ),
            )
        );

        $this->end_controls_section();

        // Services Repeater
        $this->start_controls_section(
            'services_section',
            array(
                'label' => esc_html__( 'Service Cards', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_title',
            array(
                'label'   => esc_html__( 'Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Plumbing Repairs', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'card_image',
            array(
                'label'   => esc_html__( 'Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/service2_1.jpg',
                ),
            )
        );

        $repeater->add_control(
            'card_desc',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( 'Bring to the table win-win survival strategies to ensure proactive domination.', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'link_text',
            array(
                'label'   => esc_html__( 'Link Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Know More', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'card_link',
            array(
                'label'       => esc_html__( 'Link URL', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com or /service-repair/', 'plumberx' ),
                'default'     => array(
                    'url'         => '/service-repair/',
                    'is_external' => false,
                    'nofollow'    => false,
                ),
            )
        );

        $this->add_control(
            'services_list',
            array(
                'label'       => esc_html__( 'Cards', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ card_title }}}',
                'default'     => array(
                    array(
                        'card_title' => 'Plumbing Repairs',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_1.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Sewer Cleaning & Repairs',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_2.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Drain Repairs & Cleaning',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_3.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Faucet & Leak Repairs',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_4.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Gas Line Service',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_5.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Remodeling Service',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_6.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Water Treatment Service',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_7.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title' => 'Cooling & Heating Service',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/service2_8.jpg' ),
                        'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                        'link_text'  => 'Know More',
                        'card_link'  => array( 'url' => '/service-repair/' ),
                    ),
                ),
            )
        );

        $this->end_controls_section();

        // Decorative Elements
        $this->start_controls_section(
            'decorative_section',
            array(
                'label' => esc_html__( 'Decorative Elements', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_splash',
            array(
                'label'        => esc_html__( 'Show Water Splash Image', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'plumberx' ),
                'label_off'    => esc_html__( 'Hide', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'splash_image',
            array(
                'label'     => esc_html__( 'Splash Image', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => array(
                    'url' => PLUMBERX_URI . '/assets/images/water_splash.png',
                ),
                'condition' => array(
                    'show_splash' => 'yes',
                ),
            )
        );

        $this->add_control(
            'splash_width',
            array(
                'label'     => esc_html__( 'Splash Max Width (px)', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 320,
                'min'       => 100,
                'max'       => 600,
                'condition' => array(
                    'show_splash' => 'yes',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $title        = ! empty( $settings['section_title'] ) ? $settings['section_title'] : '';
        $subtitle     = ! empty( $settings['section_subtitle'] ) ? $settings['section_subtitle'] : '';
        $services     = ! empty( $settings['services_list'] ) ? $settings['services_list'] : array();
        $show_splash  = ! empty( $settings['show_splash'] ) ? $settings['show_splash'] : 'no';
        $splash_url   = ! empty( $settings['splash_image']['url'] ) ? $settings['splash_image']['url'] : PLUMBERX_URI . '/assets/images/water_splash.png';
        $splash_width = ! empty( $settings['splash_width'] ) ? intval( $settings['splash_width'] ) : 320;
        ?>
        <section class="service2-section" style="position: relative;">
          <div class="container">
            <?php if ( ! empty( $title ) || ! empty( $subtitle ) ) : ?>
              <div class="section-header text-center">
                <?php if ( ! empty( $title ) ) : ?>
                  <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( ! empty( $subtitle ) ) : ?>
                  <p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <?php if ( ! empty( $services ) ) : ?>
              <div class="service2-grid">
                <?php foreach ( $services as $item ) : 
                  $img_url     = ! empty( $item['card_image']['url'] ) ? $item['card_image']['url'] : PLUMBERX_URI . '/assets/images/service2_1.jpg';
                  $link_url    = ! empty( $item['card_link']['url'] ) ? $item['card_link']['url'] : home_url( '/service-repair/' );
                  $is_external = ! empty( $item['card_link']['is_external'] );
                  $link_target = $is_external ? ' target="_blank" rel="noopener noreferrer"' : '';
                ?>
                  <div class="service2-card">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['card_title'] ); ?>">
                    <div class="service2-card-body">
                      <h3 class="service2-card-title"><?php echo esc_html( $item['card_title'] ); ?></h3>
                      <p class="service2-card-desc"><?php echo esc_html( $item['card_desc'] ); ?></p>
                      <?php if ( ! empty( $item['link_text'] ) ) : ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="service2-know-more"<?php echo $link_target; ?>><?php echo esc_html( $item['link_text'] ); ?></a>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <?php if ( 'yes' === $show_splash && ! empty( $splash_url ) ) : ?>
            <img src="<?php echo esc_url( $splash_url ); ?>" alt="Splash" class="contractor-water-splash" style="max-width:<?php echo esc_attr( $splash_width ); ?>px;">
          <?php endif; ?>
        </section>
        <?php
    }
}
