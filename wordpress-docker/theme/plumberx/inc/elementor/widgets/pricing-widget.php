<?php
/**
 * Elementor Widget: PlumberX Pricing Plans
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Pricing_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_pricing';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Pricing Plans', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Section: Header
        $this->start_controls_section(
            'header_section',
            array(
                'label' => esc_html__( 'Section Header', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Section Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'We always offer value for money with totally transparent charges', 'plumberx' ),
                'label_block' => true,
            )
        );

        $this->add_control(
            'description',
            array(
                'label'       => esc_html__( 'Section Description', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => "Don't hesitate to ask any plumbing or repairing questions via telephone, or reach through our contact structure underneath. Your message will be dispatched straightforwardly to our staff who will reply when they can.",
                'rows'        => 3,
                'label_block' => true,
            )
        );

        $this->end_controls_section();

        // Section: Price Cards
        $this->start_controls_section(
            'pricing_section',
            array(
                'label' => esc_html__( 'Price Cards', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Card Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ),
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Service Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Repair a Sewer Main', 'plumberx' ),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'price',
            array(
                'label'   => esc_html__( 'Price Amount', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '$199',
            )
        );

        $repeater->add_control(
            'avg_label',
            array(
                'label'   => esc_html__( 'Average Label', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Average', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'card_link',
            array(
                'label'         => esc_html__( 'Optional Card Link', 'plumberx' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'plumberx' ),
                'show_external' => true,
                'default'       => array(
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ),
            )
        );

        // Pre-fill 11 default cards matching price.html
        $default_cards = array();
        for ( $i = 1; $i <= 11; $i++ ) {
            $default_cards[] = array(
                'title'     => 'Repair a Sewer Main',
                'price'     => '$199',
                'avg_label' => 'Average',
            );
        }

        $this->add_control(
            'pricing_list',
            array(
                'label'       => esc_html__( 'Pricing Items', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $default_cards,
                'title_field' => '{{{ title }}} ({{{ price }}})',
            )
        );

        $this->end_controls_section();

        // Section: Query Card
        $this->start_controls_section(
            'query_card_section',
            array(
                'label' => esc_html__( 'Query / Contact Card', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_query_card',
            array(
                'label'        => esc_html__( 'Show Query Card', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'plumberx' ),
                'label_off'    => esc_html__( 'Hide', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'query_title',
            array(
                'label'       => esc_html__( 'Query Heading', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Contact us for any other Querry', 'plumberx' ),
                'label_block' => true,
                'condition'   => array(
                    'show_query_card' => 'yes',
                ),
            )
        );

        $this->add_control(
            'query_link_text',
            array(
                'label'     => esc_html__( 'Link Text', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Click here', 'plumberx' ),
                'condition' => array(
                    'show_query_card' => 'yes',
                ),
            )
        );

        $this->add_control(
            'query_link_url',
            array(
                'label'       => esc_html__( 'Link URL', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'plumberx' ),
                'default'     => array(
                    'url'         => home_url( '/contact/' ),
                    'is_external' => false,
                    'nofollow'    => false,
                ),
                'condition'   => array(
                    'show_query_card' => 'yes',
                ),
            )
        );

        $this->end_controls_section();

        // Style Section: General & Cards
        $this->start_controls_section(
            'style_section',
            array(
                'label' => esc_html__( 'Typography & Styling', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__( 'Header Title Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price-section h2' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__( 'Header Title Typography', 'plumberx' ),
                'selector' => '{{WRAPPER}} .price-section h2',
            )
        );

        $this->add_control(
            'card_title_color',
            array(
                'label'     => esc_html__( 'Card Title Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price-card-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'price_amount_color',
            array(
                'label'     => esc_html__( 'Price Amount Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price-amount' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $pricing_list = ! empty( $settings['pricing_list'] ) ? $settings['pricing_list'] : array();
        ?>
        <section class="price-section">
            <div class="container">
                
                <?php if ( ! empty( $settings['title'] ) || ! empty( $settings['description'] ) ) : ?>
                    <div style="margin-bottom: 40px;">
                        <?php if ( ! empty( $settings['title'] ) ) : ?>
                            <h2 style="font-size: 26px; font-weight: 700; color: var(--primary-navy); margin-bottom: 12px; line-height: 1.3;">
                                <?php echo esc_html( $settings['title'] ); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $settings['description'] ) ) : ?>
                            <p style="font-size: 13.5px; color: var(--text-gray); line-height: 1.6; max-width: 950px;">
                                <?php echo esc_html( $settings['description'] ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="price-cards-grid">
                    <?php
                    foreach ( $pricing_list as $index => $item ) :
                        $img_url = '';
                        if ( ! empty( $item['image']['url'] ) ) {
                            $img_url = $item['image']['url'];
                        } elseif ( ! empty( $item['image']['id'] ) ) {
                            $img_url = wp_get_attachment_image_url( $item['image']['id'], 'full' );
                        }

                        // Fallback to theme asset
                        if ( empty( $img_url ) ) {
                            $card_num = ( $index % 11 ) + 1;
                            $img_url  = PLUMBERX_URI . '/assets/images/price_' . $card_num . '.jpg';
                        }

                        $card_title = ! empty( $item['title'] ) ? $item['title'] : 'Repair a Sewer Main';
                        $card_price = ! empty( $item['price'] ) ? $item['price'] : '$199';
                        $card_avg   = ! empty( $item['avg_label'] ) ? $item['avg_label'] : 'Average';
                        $card_link  = ! empty( $item['card_link']['url'] ) ? $item['card_link']['url'] : '';
                        $link_target = ! empty( $item['card_link']['is_external'] ) ? ' target="_blank"' : '';
                        $link_rel   = ! empty( $item['card_link']['nofollow'] ) ? ' rel="nofollow"' : '';
                    ?>
                        <div class="price-card elementor-repeater-item-<?php echo esc_attr( $item['_id'] ?? $index ); ?>">
                            <div class="price-card-thumb">
                                <?php if ( ! empty( $card_link ) ) : ?>
                                    <a href="<?php echo esc_url( $card_link ); ?>"<?php echo $link_target . $link_rel; ?>>
                                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $card_title ); ?>">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $card_title ); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="price-card-body">
                                <h4 class="price-card-title">
                                    <?php if ( ! empty( $card_link ) ) : ?>
                                        <a href="<?php echo esc_url( $card_link ); ?>"<?php echo $link_target . $link_rel; ?> style="color: inherit; text-decoration: none;">
                                            <?php echo esc_html( $card_title ); ?>
                                        </a>
                                    <?php else : ?>
                                        <?php echo esc_html( $card_title ); ?>
                                    <?php endif; ?>
                                </h4>
                                <div>
                                    <span class="price-amount"><?php echo esc_html( $card_price ); ?></span>
                                    <?php if ( ! empty( $card_avg ) ) : ?>
                                        <span class="price-avg"><?php echo esc_html( $card_avg ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if ( 'yes' === ( $settings['show_query_card'] ?? 'yes' ) ) :
                        $query_title     = ! empty( $settings['query_title'] ) ? $settings['query_title'] : 'Contact us for any other Querry';
                        $query_link_text = ! empty( $settings['query_link_text'] ) ? $settings['query_link_text'] : 'Click here';
                        $query_link_url  = ! empty( $settings['query_link_url']['url'] ) ? $settings['query_link_url']['url'] : home_url( '/contact/' );
                        $query_target    = ! empty( $settings['query_link_url']['is_external'] ) ? ' target="_blank"' : '';
                        $query_rel       = ! empty( $settings['query_link_url']['nofollow'] ) ? ' rel="nofollow"' : '';
                    ?>
                        <div class="price-card-query">
                            <h4 style="font-size: 16px; font-weight: 700; color: var(--primary-navy); margin-bottom: 6px;">
                                <?php echo esc_html( $query_title ); ?>
                            </h4>
                            <a href="<?php echo esc_url( $query_link_url ); ?>"<?php echo $query_target . $query_rel; ?> style="font-size: 13.5px; color: #64748b; text-decoration: underline;">
                                <?php echo esc_html( $query_link_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </section>
        <?php
    }
}
