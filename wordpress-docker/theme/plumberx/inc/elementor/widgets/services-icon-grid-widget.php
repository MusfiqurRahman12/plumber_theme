<?php
/**
 * Elementor Widget: PlumberX Services 3 Grid (8 Icon Cards)
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Services_Icon_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_services_icon_grid';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Services 3 Grid (8 Icon Cards)', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    public function get_preset_svg( $preset ) {
        switch ( $preset ) {
            case 'repairs':
                return '<svg viewBox="0 0 64 64"><circle cx="32" cy="24" r="12"/><path d="M22 22h20v-4a10 10 0 0 0-20 0v4z"/><path d="M16 52c0-8.84 7.16-16 16-16s16 7.16 16 16v4H16v-4z"/><path d="M48 28l8 8-4 4-8-8"/><path d="M16 28l-8 8 4 4 8-8"/></svg>';
            case 'sewer':
                return '<svg viewBox="0 0 64 64"><rect x="18" y="14" width="28" height="18" rx="3"/><line x1="24" y1="20" x2="40" y2="20"/><line x1="24" y1="26" x2="40" y2="26"/><path d="M26 32v18a6 6 0 0 0 12 0V32"/><circle cx="28" cy="46" r="2" fill="currentColor"/><circle cx="36" cy="46" r="2" fill="currentColor"/><circle cx="32" cy="52" r="2" fill="currentColor"/></svg>';
            case 'faucet':
                return '<svg viewBox="0 0 64 64"><path d="M14 26h24v12H26v10h-4V38H14V26z"/><path d="M24 16v10h4V16h-4z"/><path d="M18 16h16"/><path d="M24 54c0 3 2 5 2 5s2-2 2-5c0-1.1-.9-2-2-2s-2 .9-2 2z" fill="currentColor"/></svg>';
            case 'gas':
                return '<svg viewBox="0 0 64 64"><rect x="12" y="30" width="40" height="14" rx="2"/><circle cx="32" cy="20" r="10"/><line x1="32" y1="20" x2="37" y2="16"/><line x1="32" y1="30" x2="32" y2="34"/></svg>';
            case 'remodel':
                return '<svg viewBox="0 0 64 64"><circle cx="32" cy="32" r="8"/><path d="M32 16v4m0 24v4m16-16h-4M20 32h-4m22.6-11.3l-2.8 2.8m-17 17l-2.8 2.8m22.6 0l-2.8-2.8m-17-17l-2.8-2.8"/></svg>';
            case 'water':
                return '<svg viewBox="0 0 64 64"><rect x="18" y="16" width="28" height="34" rx="4"/><line x1="26" y1="16" x2="26" y2="50"/><circle cx="38" cy="28" r="4"/><circle cx="38" cy="38" r="4"/></svg>';
            case 'heating':
                return '<svg viewBox="0 0 64 64"><rect x="16" y="16" width="32" height="32" rx="4"/><circle cx="32" cy="32" r="10"/><path d="M32 22v20m-10-10h20"/></svg>';
            case 'drain':
                return '<svg viewBox="0 0 64 64"><path d="M16 24h32v8H16z"/><circle cx="32" cy="28" r="4" fill="currentColor"/><path d="M28 32v18h8V32"/></svg>';
            default:
                return '';
        }
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
            'icon_preset',
            array(
                'label'   => esc_html__( 'Icon Style / Preset', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'repairs',
                'options' => array(
                    'repairs'  => esc_html__( 'Plumbing Repairs (Wrench / Plumber)', 'plumberx' ),
                    'sewer'    => esc_html__( 'Sewer Cleaning & Repairs', 'plumberx' ),
                    'faucet'   => esc_html__( 'Faucet & Leak Repairs', 'plumberx' ),
                    'gas'      => esc_html__( 'Gas Line Service', 'plumberx' ),
                    'remodel'  => esc_html__( 'Remodeling Service', 'plumberx' ),
                    'water'    => esc_html__( 'Water Treatment Services', 'plumberx' ),
                    'heating'  => esc_html__( 'Heating & Cooling', 'plumberx' ),
                    'drain'    => esc_html__( 'Drain Cleaning & Repairs', 'plumberx' ),
                    'custom'   => esc_html__( 'Custom SVG Code', 'plumberx' ),
                ),
            )
        );

        $repeater->add_control(
            'custom_svg',
            array(
                'label'       => esc_html__( 'Custom SVG Code', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'placeholder' => '<svg viewBox="0 0 64 64">...</svg>',
                'condition'   => array(
                    'icon_preset' => 'custom',
                ),
            )
        );

        $repeater->add_control(
            'card_desc',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( "For the greater part of us, our house isn't only a place, it's the place .", 'plumberx' ),
            )
        );

        $repeater->add_control(
            'link_text',
            array(
                'label'   => esc_html__( 'Link Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'plumberx' ),
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
                        'card_title'  => 'Plumbing Repairs',
                        'icon_preset' => 'repairs',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Sever Cleaning & Repairs',
                        'icon_preset' => 'sewer',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Faucet & Leak Repairs',
                        'icon_preset' => 'faucet',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Gas Line Service',
                        'icon_preset' => 'gas',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Remodeling Service',
                        'icon_preset' => 'remodel',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Water Treatment Services',
                        'icon_preset' => 'water',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Heating & Cooling',
                        'icon_preset' => 'heating',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
                    ),
                    array(
                        'card_title'  => 'Drain Cleaning & Repairs',
                        'icon_preset' => 'drain',
                        'card_desc'   => "For the greater part of us, our house isn't only a place, it's the place .",
                        'link_text'   => 'Read More',
                        'card_link'   => array( 'url' => '/service-repair/' ),
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
        <section class="service3-section" style="position: relative;">
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
              <div class="service3-grid">
                <?php foreach ( $services as $item ) : 
                  $preset = ! empty( $item['icon_preset'] ) ? $item['icon_preset'] : 'repairs';
                  if ( 'custom' === $preset && ! empty( $item['custom_svg'] ) ) {
                      $icon_html = $item['custom_svg'];
                  } else {
                      $icon_html = $this->get_preset_svg( $preset );
                  }
                  $link_url    = ! empty( $item['card_link']['url'] ) ? $item['card_link']['url'] : home_url( '/service-repair/' );
                  $is_external = ! empty( $item['card_link']['is_external'] );
                  $link_target = $is_external ? ' target="_blank" rel="noopener noreferrer"' : '';
                ?>
                  <div class="service3-card">
                    <div class="service3-icon-wrap">
                      <?php echo $icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                    <h3 class="service3-title"><?php echo esc_html( $item['card_title'] ); ?></h3>
                    <p class="service3-desc"><?php echo esc_html( $item['card_desc'] ); ?></p>
                    <?php if ( ! empty( $item['link_text'] ) ) : ?>
                      <a href="<?php echo esc_url( $link_url ); ?>" class="btn-service3-read"<?php echo $link_target; ?>><?php echo esc_html( $item['link_text'] ); ?></a>
                    <?php endif; ?>
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
