<?php
/**
 * Elementor Widget: PlumberX Subpage Banner
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Subpage_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_subpage_banner';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Subpage Banner', 'plumberx' );
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
                'label'       => esc_html__( 'Page Title', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'About Us', 'plumberx' ),
                'placeholder' => esc_html__( 'Enter page title', 'plumberx' ),
            )
        );

        $this->add_control(
            'show_breadcrumb',
            array(
                'label'        => esc_html__( 'Show Breadcrumb', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'plumberx' ),
                'label_off'    => esc_html__( 'Hide', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'breadcrumb_parent_text',
            array(
                'label'     => esc_html__( 'Breadcrumb Home Text', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Home', 'plumberx' ),
                'condition' => array( 'show_breadcrumb' => 'yes' ),
            )
        );

        $this->add_control(
            'breadcrumb_parent_url',
            array(
                'label'       => esc_html__( 'Breadcrumb Home URL', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => array(
                    'url' => home_url( '/' ),
                ),
                'condition'   => array( 'show_breadcrumb' => 'yes' ),
            )
        );

        $this->add_control(
            'breadcrumb_current_text',
            array(
                'label'     => esc_html__( 'Breadcrumb Current Text', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'About Us', 'plumberx' ),
                'condition' => array( 'show_breadcrumb' => 'yes' ),
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
            'bg_image',
            array(
                'label'   => esc_html__( 'Background Image (Optional)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__( 'Title Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .banner-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $title        = ! empty( $settings['title'] ) ? $settings['title'] : get_the_title();
        $show_bc      = 'yes' === $settings['show_breadcrumb'];
        $parent_text  = ! empty( $settings['breadcrumb_parent_text'] ) ? $settings['breadcrumb_parent_text'] : 'Home';
        $parent_url   = ! empty( $settings['breadcrumb_parent_url']['url'] ) ? $settings['breadcrumb_parent_url']['url'] : home_url( '/' );
        $current_text = ! empty( $settings['breadcrumb_current_text'] ) ? $settings['breadcrumb_current_text'] : $title;

        $bg_style = '';
        if ( ! empty( $settings['bg_image']['url'] ) ) {
            $bg_style = ' style="background-image: url(' . esc_url( $settings['bg_image']['url'] ) . '); background-size: cover; background-position: center;"';
        }
        ?>
        <section class="subpage-banner"<?php echo $bg_style; ?>>
          <div class="container banner-content">
            <h1 class="banner-title"><?php echo esc_html( $title ); ?></h1>
            <?php if ( $show_bc ) : ?>
              <div class="breadcrumb-list">
                <a href="<?php echo esc_url( $parent_url ); ?>"><?php echo esc_html( $parent_text ); ?></a>
                <span class="breadcrumb-separator">&gt;</span>
                <span><?php echo esc_html( $current_text ); ?></span>
              </div>
            <?php endif; ?>
          </div>
        </section>
        <?php
    }
}
