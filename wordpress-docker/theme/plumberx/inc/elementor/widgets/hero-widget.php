<?php
/**
 * Elementor Widget: PlumberX Hero Section
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_hero';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Hero Section', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    public function get_keywords() {
        return array( 'hero', 'banner', 'plumber', 'quote', 'header' );
    }

    protected function register_controls() {
        // Hero Content Section
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Hero Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'       => esc_html__( 'Subtitle', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Expertise', 'plumberx' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Main Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'You Can Trust', 'plumberx' ),
            )
        );

        $this->add_control(
            'description',
            array(
                'label'       => esc_html__( 'Description', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => esc_html__( 'Our plumbing professionals are thoroughly trained to assess the situation and effectively respond in a way that treats the source of the problems.', 'plumberx' ),
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Learn More', 'plumberx' ),
            )
        );

        $this->add_control(
            'btn_link',
            array(
                'label'       => esc_html__( 'Button Link', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'plumberx' ),
                'default'     => array(
                    'url' => '/about/',
                ),
            )
        );

        $this->add_control(
            'plumber_image',
            array(
                'label'   => esc_html__( 'Plumber Cutout Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/home_hero_plumber.png',
                ),
            )
        );

        $this->end_controls_section();

        // Quote Card Section
        $this->start_controls_section(
            'quote_card_section',
            array(
                'label' => esc_html__( 'Quote Form Card', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'tab1_text',
            array(
                'label'   => esc_html__( 'Tab 1 Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'RESIDENTIAL', 'plumberx' ),
            )
        );

        $this->add_control(
            'tab2_text',
            array(
                'label'   => esc_html__( 'Tab 2 Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'COMMERCIAL', 'plumberx' ),
            )
        );

        $this->add_control(
            'form_header',
            array(
                'label'   => esc_html__( 'Form Header', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'REQUEST A FREE QUOTE', 'plumberx' ),
            )
        );

        $this->add_control(
            'btn_submit_text',
            array(
                'label'   => esc_html__( 'Submit Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'GET A QUOTE', 'plumberx' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $btn_url  = ! empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : home_url( '/about' );
        $img_url  = ! empty( $settings['plumber_image']['url'] ) ? $settings['plumber_image']['url'] : PLUMBERX_URI . '/assets/images/home_hero_plumber.png';
        $tab1     = ! empty( $settings['tab1_text'] ) ? $settings['tab1_text'] : 'RESIDENTIAL';
        $tab2     = ! empty( $settings['tab2_text'] ) ? $settings['tab2_text'] : 'COMMERCIAL';
        $header   = ! empty( $settings['form_header'] ) ? $settings['form_header'] : 'REQUEST A FREE QUOTE';
        $submit   = ! empty( $settings['btn_submit_text'] ) ? $settings['btn_submit_text'] : 'GET A QUOTE';
        ?>
        <section class="home-hero">
          <div class="container hero-grid">
            <div class="hero-text-col">
              <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                <h2 class="hero-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></h2>
              <?php endif; ?>
              <?php if ( ! empty( $settings['title'] ) ) : ?>
                <h1 class="hero-title"><?php echo esc_html( $settings['title'] ); ?></h1>
              <?php endif; ?>
              <?php if ( ! empty( $settings['description'] ) ) : ?>
                <p class="hero-desc"><?php echo esc_html( $settings['description'] ); ?></p>
              <?php endif; ?>
              <?php if ( ! empty( $settings['btn_text'] ) ) : ?>
                <a href="<?php echo esc_url( $btn_url ); ?>" class="btn-hero-learn"><?php echo esc_html( $settings['btn_text'] ); ?></a>
              <?php endif; ?>
            </div>

            <div class="hero-plumber-col">
              <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>" class="hero-plumber-img">
            </div>

            <div class="hero-form-col">
              <div class="hero-quote-card">
                <div class="quote-tabs">
                  <button class="quote-tab-btn active" data-type="residential"><?php echo esc_html( $tab1 ); ?></button>
                  <button class="quote-tab-btn" data-type="commercial"><?php echo esc_html( $tab2 ); ?></button>
                </div>
                <div class="quote-form-body">
                  <h3 class="quote-form-header"><?php echo esc_html( $header ); ?></h3>
                  <form id="heroQuoteForm">
                    <input type="hidden" id="quoteServiceType" value="residential">
                    <div class="form-group">
                      <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'Name:', 'plumberx' ); ?>" required>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-input" placeholder="<?php esc_attr_e( 'Email:', 'plumberx' ); ?>" required>
                    </div>
                    <div class="form-group">
                      <input type="tel" class="form-input" placeholder="<?php esc_attr_e( 'Phone:', 'plumberx' ); ?>" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'City:', 'plumberx' ); ?>" required>
                    </div>
                    <button type="submit" class="btn-quote-submit"><?php echo esc_html( $submit ); ?></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
