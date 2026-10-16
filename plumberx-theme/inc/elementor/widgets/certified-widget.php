<?php
/**
 * Elementor Widget: PlumberX Certified Plumber Section
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Certified_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_certified';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Certified Plumber', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-certificate';
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
            'title_strong',
            array(
                'label'   => esc_html__( 'Title (Bold Part)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'We are certified', 'plumberx' ),
            )
        );

        $this->add_control(
            'title_rest',
            array(
                'label'   => esc_html__( 'Title (Remaining Part)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'plumber in Los Angle', 'plumberx' ),
            )
        );

        $this->add_control(
            'section_subtitle',
            array(
                'label'   => esc_html__( 'Section Subtitle / Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( 'We have the wherewithal to handle a number of plumbing situations in any of these locations. Don\'t hesitate to enlist our services! From start to finish, you can count on Plumberx Plumbing for superior assistance, maintenance, repairs, and more.', 'plumberx' ),
            )
        );

        $this->end_controls_section();

        // Cards Section
        $this->start_controls_section(
            'cards_section',
            array(
                'label' => esc_html__( 'Certified Cards', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        // Card 1
        $this->add_control(
            'card1_title',
            array(
                'label'   => esc_html__( 'Card 1 Title (Blue Card)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'We Are Plumber', 'plumberx' ),
            )
        );
        $this->add_control(
            'card1_desc',
            array(
                'label'   => esc_html__( 'Card 1 Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, cons ectetur elit. Vestibulum nec odios Suspe ndisse cursus mal suada faci lisis, Lorem ipsum dolor sit ametion consectetur elit. Vesti bulum nec odio.', 'plumberx' ),
            )
        );
        $this->add_control(
            'card1_img',
            array(
                'label'   => esc_html__( 'Card 1 Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/home_certified_1.jpg',
                ),
            )
        );

        // Card 2
        $this->add_control(
            'card2_title',
            array(
                'label'   => esc_html__( 'Card 2 Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Commercial Plumbing', 'plumberx' ),
                'separator' => 'before',
            )
        );
        $this->add_control(
            'card2_desc',
            array(
                'label'   => esc_html__( 'Card 2 Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Plumbing problems can be disastrous for commercial locations. Something as simple as a leak or a clogged pipe.', 'plumberx' ),
            )
        );
        $this->add_control(
            'card2_img',
            array(
                'label'   => esc_html__( 'Card 2 Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/home_certified_2.jpg',
                ),
            )
        );

        // Card 3
        $this->add_control(
            'card3_title',
            array(
                'label'   => esc_html__( 'Card 3 Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Commercial Plumbing', 'plumberx' ),
                'separator' => 'before',
            )
        );
        $this->add_control(
            'card3_desc',
            array(
                'label'   => esc_html__( 'Card 3 Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Plumbing problems can be disastrous for commercial locations. Something as simple as a leak or a clogged pipe.', 'plumberx' ),
            )
        );
        $this->add_control(
            'card3_img',
            array(
                'label'   => esc_html__( 'Card 3 Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/home_certified_3.jpg',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $title_strong = ! empty( $settings['title_strong'] ) ? $settings['title_strong'] : 'We are certified';
        $title_rest   = ! empty( $settings['title_rest'] ) ? $settings['title_rest'] : 'plumber in Los Angle';
        $subtitle     = ! empty( $settings['section_subtitle'] ) ? $settings['section_subtitle'] : '';

        $card1_img = ! empty( $settings['card1_img']['url'] ) ? $settings['card1_img']['url'] : PLUMBERX_URI . '/assets/images/home_certified_1.jpg';
        $card2_img = ! empty( $settings['card2_img']['url'] ) ? $settings['card2_img']['url'] : PLUMBERX_URI . '/assets/images/home_certified_2.jpg';
        $card3_img = ! empty( $settings['card3_img']['url'] ) ? $settings['card3_img']['url'] : PLUMBERX_URI . '/assets/images/home_certified_3.jpg';
        ?>
        <section class="certified-section">
          <div class="container">
            <div class="section-header">
              <h2 class="section-title"><strong><?php echo esc_html( $title_strong ); ?></strong> <?php echo esc_html( $title_rest ); ?></h2>
              <?php if ( $subtitle ) : ?>
                <p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p>
              <?php endif; ?>
            </div>

            <div class="certified-grid">
              <div class="certified-card-blue">
                <div class="card-img-wrap">
                  <img src="<?php echo esc_url( $card1_img ); ?>" alt="<?php echo esc_attr( $settings['card1_title'] ); ?>">
                </div>
                <div class="card-body">
                  <h3 class="card-title"><?php echo esc_html( $settings['card1_title'] ); ?></h3>
                  <p class="card-desc"><?php echo esc_html( $settings['card1_desc'] ); ?></p>
                </div>
              </div>

              <div class="certified-card-standard">
                <div class="card-img-wrap">
                  <img src="<?php echo esc_url( $card2_img ); ?>" alt="<?php echo esc_attr( $settings['card2_title'] ); ?>">
                </div>
                <div class="card-body">
                  <h3 class="card-title"><?php echo esc_html( $settings['card2_title'] ); ?></h3>
                  <p class="card-desc"><?php echo esc_html( $settings['card2_desc'] ); ?></p>
                </div>
              </div>

              <div class="certified-card-standard">
                <div class="card-img-wrap">
                  <img src="<?php echo esc_url( $card3_img ); ?>" alt="<?php echo esc_attr( $settings['card3_title'] ); ?>">
                </div>
                <div class="card-body">
                  <h3 class="card-title"><?php echo esc_html( $settings['card3_title'] ); ?></h3>
                  <p class="card-desc"><?php echo esc_html( $settings['card3_desc'] ); ?></p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
