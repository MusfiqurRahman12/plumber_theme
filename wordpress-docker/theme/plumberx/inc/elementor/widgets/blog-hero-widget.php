<?php
/**
 * Elementor Widget: PlumberX Blog Hero Banner
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Blog_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_blog_hero';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Blog Hero Banner', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Banner Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Blog', 'plumberx' ),
                'label_block' => true,
            )
        );

        $this->add_control(
            'van_image',
            array(
                'label'   => esc_html__( 'Service Van Cutout Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/blog_banner_van.png',
                ),
            )
        );

        $this->add_control(
            'bg_image',
            array(
                'label'   => esc_html__( 'Background Pattern / Texture', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/blog_top_crop.jpg',
                ),
            )
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            array(
                'label' => esc_html__( 'Banner Styling', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__( 'Title Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .blog-hero-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__( 'Title Typography', 'plumberx' ),
                'selector' => '{{WRAPPER}} .blog-hero-title',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $van_url = '';
        if ( ! empty( $settings['van_image']['url'] ) ) {
            $van_url = $settings['van_image']['url'];
        } elseif ( ! empty( $settings['van_image']['id'] ) ) {
            $van_url = wp_get_attachment_image_url( $settings['van_image']['id'], 'full' );
        }
        if ( empty( $van_url ) ) {
            $van_url = PLUMBERX_URI . '/assets/images/blog_banner_van.png';
        }

        $bg_url = '';
        if ( ! empty( $settings['bg_image']['url'] ) ) {
            $bg_url = $settings['bg_image']['url'];
        } elseif ( ! empty( $settings['bg_image']['id'] ) ) {
            $bg_url = wp_get_attachment_image_url( $settings['bg_image']['id'], 'full' );
        }
        if ( empty( $bg_url ) ) {
            $bg_url = PLUMBERX_URI . '/assets/images/blog_top_crop.jpg';
        }
        ?>
        <section class="blog-hero-banner">
            <?php if ( ! empty( $bg_url ) ) : ?>
                <style>
                    .elementor-element-<?php echo esc_attr( $this->get_id() ); ?> .blog-hero-banner::before {
                        background-image: url('<?php echo esc_url( $bg_url ); ?>') !important;
                    }
                </style>
            <?php endif; ?>
            <div class="container blog-hero-grid">
                <div class="blog-hero-text">
                    <h1 class="blog-hero-title"><?php echo esc_html( $settings['title'] ); ?></h1>
                </div>
                <div class="blog-hero-van-col">
                    <img src="<?php echo esc_url( $van_url ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>" class="blog-hero-van-img">
                </div>
            </div>
        </section>
        <?php
    }
}
