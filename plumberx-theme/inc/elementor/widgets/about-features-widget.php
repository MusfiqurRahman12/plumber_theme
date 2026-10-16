<?php
/**
 * Elementor Widget: PlumberX About Features Banner
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_About_Features_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_about_features';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: About Blue Features Banner', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Features Banner Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'plumber_image',
            array(
                'label'   => esc_html__( 'Plumber Cutout Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/about_plumber.jpg',
                ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_title',
            array(
                'label'   => esc_html__( 'Feature Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '24/7 Availality', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'feature_desc',
            array(
                'label'   => esc_html__( 'Feature Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspe ndisse cursus malesuada facilisis.', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'icon_preset',
            array(
                'label'   => esc_html__( 'Icon Style', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'clock',
                'options' => array(
                    'clock'       => esc_html__( '24/7 Clock', 'plumberx' ),
                    'mechanic'    => esc_html__( 'Certified Mechanic', 'plumberx' ),
                    'hidden_cost' => esc_html__( 'No Hidden Cost', 'plumberx' ),
                    'affordable'  => esc_html__( 'Affordable Price Tag', 'plumberx' ),
                ),
            )
        );

        $this->add_control(
            'features_list',
            array(
                'label'       => esc_html__( 'Features Boxes', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ feature_title }}}',
                'default'     => array(
                    array(
                        'feature_title' => '24/7 Availality',
                        'feature_desc'  => 'Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspe ndisse cursus malesuada facilisis.',
                        'icon_preset'   => 'clock',
                    ),
                    array(
                        'feature_title' => 'Certified Mechanics',
                        'feature_desc'  => 'Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspe ndisse cursus malesuada facilisis.',
                        'icon_preset'   => 'mechanic',
                    ),
                    array(
                        'feature_title' => 'No Hidden Cost',
                        'feature_desc'  => 'Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspe ndisse cursus malesuada facilisis.',
                        'icon_preset'   => 'hidden_cost',
                    ),
                    array(
                        'feature_title' => 'Affordable prices',
                        'feature_desc'  => 'Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspe ndisse cursus malesuada facilisis.',
                        'icon_preset'   => 'affordable',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            array(
                'label' => esc_html__( 'Banner Style', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'bg_color',
            array(
                'label'     => esc_html__( 'Background Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .about-features-banner' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    private function render_icon( $preset, $idx ) {
        // Fallback to cycling presets if not matched
        if ( empty( $preset ) ) {
            $presets = array( 'clock', 'mechanic', 'hidden_cost', 'affordable' );
            $preset = $presets[ $idx % 4 ];
        }

        switch ( $preset ) {
            case 'mechanic':
                ?>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                  <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <?php
                break;

            case 'hidden_cost':
                ?>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <?php
                break;

            case 'affordable':
                ?>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                  <line x1="7" y1="7" x2="7.01" y2="7"></line>
                </svg>
                <?php
                break;

            case 'clock':
            default:
                ?>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <?php
                break;
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $img_url  = ! empty( $settings['plumber_image']['url'] ) ? $settings['plumber_image']['url'] : PLUMBERX_URI . '/assets/images/about_plumber.jpg';
        $features = ! empty( $settings['features_list'] ) ? $settings['features_list'] : array();
        ?>
        <section class="about-features-banner">
          <div class="container about-features-layout">
            <div class="about-features-img-col">
              <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php esc_attr_e( 'Certified Plumber Repair', 'plumberx' ); ?>" class="about-plumber-cutout-img">
            </div>

            <div class="about-features-grid">
              <?php foreach ( $features as $idx => $item ) : ?>
                <div class="feature-box">
                  <div class="feature-icon-circle">
                    <?php $this->render_icon( ! empty( $item['icon_preset'] ) ? $item['icon_preset'] : '', $idx ); ?>
                  </div>
                  <div class="feature-info">
                    <h4><?php echo esc_html( $item['feature_title'] ); ?></h4>
                    <p><?php echo esc_html( $item['feature_desc'] ); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php
    }
}
