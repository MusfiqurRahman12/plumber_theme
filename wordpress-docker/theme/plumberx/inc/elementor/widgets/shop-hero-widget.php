<?php
/**
 * Elementor Widget: Shop Hero
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Shop_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_shop_hero';
    }

    public function get_title() {
        return esc_html__( 'Shop Hero', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Hero Content', 'plumberx' ),
            )
        );

        $this->add_control(
            'title_red',
            array(
                'label'       => esc_html__( 'Title Part 1 (Red Accent)', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Our Featured',
                'placeholder' => 'Our Featured',
            )
        );

        $this->add_control(
            'title_cyan',
            array(
                'label'       => esc_html__( 'Title Part 2 (Cyan Accent)', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Products',
                'placeholder' => 'Products',
            )
        );

        $this->add_control(
            'description',
            array(
                'label'       => esc_html__( 'Description', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Our plumbing professionals are thoroughly trained to assess the situation and effectively respond in a way that treats the source of the problems.',
            )
        );

        $this->add_control(
            'button_text',
            array(
                'label'       => esc_html__( 'Button Text', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Shop Now',
            )
        );

        $this->add_control(
            'button_link',
            array(
                'label'       => esc_html__( 'Button Link', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => '#shopProducts',
                'default'     => array(
                    'url' => '#shopProducts',
                ),
            )
        );

        $default_img = get_template_directory_uri() . '/assets/images/shop_hero_toilet_clean.png';
        $this->add_control(
            'hero_image',
            array(
                'label'   => esc_html__( 'Hero Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => $default_img,
                ),
            )
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            array(
                'label' => esc_html__( 'Style Options', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'title_red_color',
            array(
                'label'     => esc_html__( 'Title Part 1 Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ef4444',
                'selectors' => array(
                    '{{WRAPPER}} .shop-hero-text h1 .shop-title-red' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'title_cyan_color',
            array(
                'label'     => esc_html__( 'Title Part 2 Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#38bdf8',
                'selectors' => array(
                    '{{WRAPPER}} .shop-hero-text h1 .shop-title-cyan' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-hero-divider' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'desc_color',
            array(
                'label'     => esc_html__( 'Description Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .shop-hero-desc' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $button_url = ! empty( $settings['button_link']['url'] ) ? $settings['button_link']['url'] : '#shopProducts';
        $target     = ! empty( $settings['button_link']['is_external'] ) ? ' target="_blank"' : '';
        $nofollow   = ! empty( $settings['button_link']['nofollow'] ) ? ' rel="nofollow"' : '';

        $img_url = ! empty( $settings['hero_image']['url'] ) ? $settings['hero_image']['url'] : get_template_directory_uri() . '/assets/images/shop_hero_toilet_clean.png';
        ?>
        <section class="shop-hero-section">
            <div class="container shop-hero-grid">
                <div class="shop-hero-text">
                    <h1 style="font-size: 44px; font-weight: 800; line-height: 1.15; margin-bottom: 20px;">
                        <?php if ( ! empty( $settings['title_red'] ) ) : ?>
                            <span class="shop-title-red" style="color: #ef4444;"><?php echo esc_html( $settings['title_red'] ); ?></span><br>
                        <?php endif; ?>
                        <?php if ( ! empty( $settings['title_cyan'] ) ) : ?>
                            <span class="shop-title-cyan" style="color: #38bdf8;"><?php echo esc_html( $settings['title_cyan'] ); ?></span>
                        <?php endif; ?>
                    </h1>
                    <div class="shop-hero-divider" style="width: 120px; height: 2px; background-color: #38bdf8; margin-bottom: 22px;"></div>
                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <p class="shop-hero-desc" style="font-size: 14.5px; opacity: 0.92; line-height: 1.6; max-width: 480px; margin-bottom: 10px;">
                            <?php echo esc_html( $settings['description'] ); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['button_text'] ) ) : ?>
                        <a href="<?php echo esc_url( $button_url ); ?>" class="btn-shop-hero"<?php echo $target . $nofollow; ?>>
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="shop-hero-img-col">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $settings['title_red'] . ' ' . $settings['title_cyan'] ); ?>" class="shop-hero-toilet-img">
                </div>
            </div>
        </section>
        <?php
    }
}
