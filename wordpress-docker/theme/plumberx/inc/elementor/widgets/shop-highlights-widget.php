<?php
/**
 * Elementor Widget: Shop Highlights Strip
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Shop_Highlights_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_shop_highlights';
    }

    public function get_title() {
        return esc_html__( 'Shop Highlights Strip', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_highlights',
            array(
                'label' => esc_html__( 'Highlight Boxes', 'plumberx' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'FREE SHIPPING',
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
            )
        );

        $repeater->add_control(
            'icon_preset',
            array(
                'label'   => esc_html__( 'Icon Preset', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'truck',
                'options' => array(
                    'truck'  => esc_html__( 'Truck (Shipping)', 'plumberx' ),
                    'tag'    => esc_html__( 'Tag (Discount / Sale)', 'plumberx' ),
                    'star'   => esc_html__( 'Star (New Arrival)', 'plumberx' ),
                    'custom' => esc_html__( 'Custom SVG / Icon', 'plumberx' ),
                ),
            )
        );

        $repeater->add_control(
            'custom_svg',
            array(
                'label'     => esc_html__( 'Custom SVG', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'rows'      => 4,
                'condition' => array(
                    'icon_preset' => 'custom',
                ),
            )
        );

        $this->add_control(
            'highlights',
            array(
                'label'       => esc_html__( 'Highlight Items', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => array(
                    array(
                        'title'       => 'FREE SHIPPING',
                        'description' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
                        'icon_preset' => 'truck',
                    ),
                    array(
                        'title'       => 'SALE 15% OFF',
                        'description' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
                        'icon_preset' => 'tag',
                    ),
                    array(
                        'title'       => 'NEW ARRIVAL',
                        'description' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
                        'icon_preset' => 'star',
                    ),
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
            'bg_color',
            array(
                'label'     => esc_html__( 'Background Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#f8fafc',
                'selectors' => array(
                    '{{WRAPPER}} .shop-highlights-strip' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'icon_color',
            array(
                'label'     => esc_html__( 'Icon Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#38bdf8',
                'selectors' => array(
                    '{{WRAPPER}} .highlight-icon' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__( 'Title Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => array(
                    '{{WRAPPER}} .highlight-info h4' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'desc_color',
            array(
                'label'     => esc_html__( 'Description Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#64748b',
                'selectors' => array(
                    '{{WRAPPER}} .highlight-info p' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    private function render_icon( $preset, $custom_svg ) {
        if ( 'custom' === $preset && ! empty( $custom_svg ) ) {
            echo wp_kses(
                $custom_svg,
                array(
                    'svg'      => array( 'class' => true, 'width' => true, 'height' => true, 'viewbox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true ),
                    'path'     => array( 'd' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true ),
                    'circle'   => array( 'cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true ),
                    'line'     => array( 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true ),
                    'rect'     => array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'fill' => true, 'stroke' => true ),
                    'polygon'  => array( 'points' => true, 'fill' => true, 'stroke' => true ),
                    'polyline' => array( 'points' => true, 'fill' => true, 'stroke' => true ),
                )
            );
            return;
        }

        switch ( $preset ) {
            case 'tag':
                ?>
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                </svg>
                <?php
                break;
            case 'star':
                ?>
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <?php
                break;
            case 'truck':
            default:
                ?>
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="3" width="15" height="13"></rect>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
                <?php
                break;
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['highlights'] ) ) {
            return;
        }
        ?>
        <section class="shop-highlights-strip">
            <div class="container shop-highlights-grid">
                <?php foreach ( $settings['highlights'] as $item ) : ?>
                    <div class="highlight-box">
                        <div class="highlight-icon">
                            <?php $this->render_icon( $item['icon_preset'], ! empty( $item['custom_svg'] ) ? $item['custom_svg'] : '' ); ?>
                        </div>
                        <div class="highlight-info">
                            <?php if ( ! empty( $item['title'] ) ) : ?>
                                <h4><?php echo esc_html( $item['title'] ); ?></h4>
                            <?php endif; ?>
                            <?php if ( ! empty( $item['description'] ) ) : ?>
                                <p><?php echo esc_html( $item['description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php
    }
}
