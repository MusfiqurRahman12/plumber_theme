<?php
/**
 * Elementor Widget: Shop Products Grid
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Shop_Products_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_shop_products';
    }

    public function get_title() {
        return esc_html__( 'Shop Products Grid', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Section: Header
        $this->start_controls_section(
            'section_header',
            array(
                'label' => esc_html__( 'Section Header', 'plumberx' ),
            )
        );

        $this->add_control(
            'title_primary',
            array(
                'label'   => esc_html__( 'Primary Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Products',
            )
        );

        $this->add_control(
            'title_secondary',
            array(
                'label'   => esc_html__( 'Secondary Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'from our Store',
            )
        );

        $this->end_controls_section();

        // Section: Products Source
        $this->start_controls_section(
            'section_products',
            array(
                'label' => esc_html__( 'Products Content', 'plumberx' ),
            )
        );

        $this->add_control(
            'source_mode',
            array(
                'label'   => esc_html__( 'Source Mode', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'repeater',
                'options' => array(
                    'repeater'    => esc_html__( 'Custom Products (Static / Repeater)', 'plumberx' ),
                    'woocommerce' => esc_html__( 'WooCommerce Catalog Products', 'plumberx' ),
                ),
            )
        );

        // Repeater for Custom Products
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Product Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Screw Driver 1',
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'price',
            array(
                'label'   => esc_html__( 'Formatted Price (e.g. $33.00)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '$33.00',
            )
        );

        $repeater->add_control(
            'price_number',
            array(
                'label'       => esc_html__( 'Numeric Price (for Cart Drawer)', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'default'     => 33.00,
                'step'        => 0.01,
                'description' => esc_html__( 'Used by interactive cart drawer calculation.', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Product Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/images/shop_item_1.jpg',
                ),
            )
        );

        $repeater->add_control(
            'button_text',
            array(
                'label'   => esc_html__( 'Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'ADD TO CART',
            )
        );

        $repeater->add_control(
            'link',
            array(
                'label'       => esc_html__( 'Product Detail Link (Optional)', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => '#',
                'default'     => array(
                    'url' => '#',
                ),
            )
        );

        $this->add_control(
            'custom_products',
            array(
                'label'       => esc_html__( 'Custom Products List', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}} - {{{ price }}}',
                'condition'   => array(
                    'source_mode' => 'repeater',
                ),
                'default'     => array(
                    array(
                        'title'        => 'Screw Driver 1',
                        'price'        => '$33.00',
                        'price_number' => 33.00,
                        'image'        => array(
                            'url' => get_template_directory_uri() . '/assets/images/shop_item_1.jpg',
                        ),
                        'button_text'  => 'ADD TO CART',
                    ),
                    array(
                        'title'        => 'Plumbing Tools',
                        'price'        => '$15.00',
                        'price_number' => 15.00,
                        'image'        => array(
                            'url' => get_template_directory_uri() . '/assets/images/shop_item_2.jpg',
                        ),
                        'button_text'  => 'ADD TO CART',
                    ),
                    array(
                        'title'        => 'Safety Items',
                        'price'        => '$35.00',
                        'price_number' => 35.00,
                        'image'        => array(
                            'url' => get_template_directory_uri() . '/assets/images/shop_item_3.jpg',
                        ),
                        'button_text'  => 'ADD TO CART',
                    ),
                    array(
                        'title'        => 'Plumber Cap',
                        'price'        => '$35.00',
                        'price_number' => 35.00,
                        'image'        => array(
                            'url' => get_template_directory_uri() . '/assets/images/shop_item_4.jpg',
                        ),
                        'button_text'  => 'ADD TO CART',
                    ),
                    array(
                        'title'        => 'Screws Box',
                        'price'        => '$35.00',
                        'price_number' => 35.00,
                        'image'        => array(
                            'url' => get_template_directory_uri() . '/assets/images/shop_item_5.jpg',
                        ),
                        'button_text'  => 'ADD TO CART',
                    ),
                    array(
                        'title'        => 'Bolts And Nuts',
                        'price'        => '$55.00',
                        'price_number' => 55.00,
                        'image'        => array(
                            'url' => get_template_directory_uri() . '/assets/images/shop_item_6.jpg',
                        ),
                        'button_text'  => 'ADD TO CART',
                    ),
                ),
            )
        );

        // WooCommerce query controls
        $this->add_control(
            'wc_posts_per_page',
            array(
                'label'     => esc_html__( 'Products Count', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 6,
                'condition' => array(
                    'source_mode' => 'woocommerce',
                ),
            )
        );

        $this->add_control(
            'wc_orderby',
            array(
                'label'     => esc_html__( 'Order By', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'date',
                'options'   => array(
                    'date'  => esc_html__( 'Date', 'plumberx' ),
                    'title' => esc_html__( 'Title', 'plumberx' ),
                    'price' => esc_html__( 'Price', 'plumberx' ),
                    'rand'  => esc_html__( 'Random', 'plumberx' ),
                ),
                'condition' => array(
                    'source_mode' => 'woocommerce',
                ),
            )
        );

        $this->add_control(
            'wc_order',
            array(
                'label'     => esc_html__( 'Order', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => array(
                    'ASC'  => esc_html__( 'Ascending (ASC)', 'plumberx' ),
                    'DESC' => esc_html__( 'Descending (DESC)', 'plumberx' ),
                ),
                'condition' => array(
                    'source_mode' => 'woocommerce',
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
            'primary_title_color',
            array(
                'label'     => esc_html__( 'Primary Title Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => array(
                    '{{WRAPPER}} .section-title.decorated' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'btn_bg_color',
            array(
                'label'     => esc_html__( 'Add to Cart Button Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ef4444',
                'selectors' => array(
                    '{{WRAPPER}} .btn-add-cart' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title_primary   = ! empty( $settings['title_primary'] ) ? $settings['title_primary'] : 'Products';
        $title_secondary = ! empty( $settings['title_secondary'] ) ? $settings['title_secondary'] : 'from our Store';
        $source_mode     = ! empty( $settings['source_mode'] ) ? $settings['source_mode'] : 'repeater';
        ?>
        <section class="shop-products-section" id="shopProducts">
            <div class="container">
                
                <div class="section-header" style="text-align: left; margin-bottom: 35px;">
                    <h2 class="section-title decorated" style="text-align: left; display: inline-block;">
                        <?php echo esc_html( $title_primary ); ?> 
                        <?php if ( ! empty( $title_secondary ) ) : ?>
                            <span style="font-weight: 400; color: #64748b;"><?php echo esc_html( $title_secondary ); ?></span>
                        <?php endif; ?>
                    </h2>
                </div>

                <div class="products-grid-shop">
                    <?php
                    if ( 'woocommerce' === $source_mode && class_exists( 'WooCommerce' ) ) :
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => ! empty( $settings['wc_posts_per_page'] ) ? intval( $settings['wc_posts_per_page'] ) : 6,
                            'orderby'        => ! empty( $settings['wc_orderby'] ) ? $settings['wc_orderby'] : 'date',
                            'order'          => ! empty( $settings['wc_order'] ) ? $settings['wc_order'] : 'DESC',
                        );
                        $query = new \WP_Query( $args );

                        if ( $query->have_posts() ) :
                            while ( $query->have_posts() ) :
                                $query->the_post();
                                global $product;
                                if ( ! is_a( $product, 'WC_Product' ) ) {
                                    $product = wc_get_product( get_the_ID() );
                                }
                                $price_html = $product ? $product->get_price_html() : '';
                                $raw_price  = $product ? $product->get_price() : '0.00';
                                $img_url    = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : get_template_directory_uri() . '/assets/images/shop_item_1.jpg';
                                ?>
                                <div class="product-card">
                                    <div class="product-img-wrap">
                                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                    </div>
                                    <div class="product-info">
                                        <h4 class="product-title"><?php the_title(); ?></h4>
                                        <div class="product-price"><?php echo wp_kses_post( $price_html ); ?></div>
                                        <button class="btn-add-cart" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-price="<?php echo esc_attr( $raw_price ); ?>" data-img="<?php echo esc_url( $img_url ); ?>">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                            </svg>
                                            <?php esc_html_e( 'ADD TO CART', 'plumberx' ); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    else :
                        // Custom repeater products
                        if ( ! empty( $settings['custom_products'] ) ) :
                            foreach ( $settings['custom_products'] as $item ) :
                                $title       = ! empty( $item['title'] ) ? $item['title'] : 'Plumbing Product';
                                $price       = ! empty( $item['price'] ) ? $item['price'] : '$35.00';
                                $price_num   = isset( $item['price_number'] ) ? floatval( $item['price_number'] ) : 35.00;
                                $img_url     = ! empty( $item['image']['url'] ) ? $item['image']['url'] : get_template_directory_uri() . '/assets/images/shop_item_1.jpg';
                                $btn_text    = ! empty( $item['button_text'] ) ? $item['button_text'] : 'ADD TO CART';
                                ?>
                                <div class="product-card">
                                    <div class="product-img-wrap">
                                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                                    </div>
                                    <div class="product-info">
                                        <h4 class="product-title"><?php echo esc_html( $title ); ?></h4>
                                        <div class="product-price"><?php echo esc_html( $price ); ?></div>
                                        <button class="btn-add-cart" data-title="<?php echo esc_attr( $title ); ?>" data-price="<?php echo esc_attr( $price_num ); ?>" data-img="<?php echo esc_url( $img_url ); ?>">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                            </svg>
                                            <?php echo esc_html( $btn_text ); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                    endif;
                    ?>
                </div>

            </div>
        </section>
        <?php
    }
}
