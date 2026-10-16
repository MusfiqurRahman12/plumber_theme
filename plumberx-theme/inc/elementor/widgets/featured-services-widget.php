<?php
/**
 * Elementor Widget: PlumberX Featured Services
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Featured_Services_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_featured_services';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Featured Services (4 Cards)', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
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
                'default' => esc_html__( 'Featured Services', 'plumberx' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_title',
            array(
                'label'   => esc_html__( 'Card Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Residential Services', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'card_image',
            array(
                'label'   => esc_html__( 'Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/project_6.jpg',
                ),
            )
        );

        $repeater->add_control(
            'bg_light',
            array(
                'label'        => esc_html__( 'Light Background (for PNGs)', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'plumberx' ),
                'label_off'    => esc_html__( 'No', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'no',
            )
        );

        $this->add_control(
            'cards_list',
            array(
                'label'       => esc_html__( 'Featured Cards', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ card_title }}}',
                'default'     => array(
                    array(
                        'card_title' => 'Residential Services',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/project_6.jpg' ),
                        'bg_light'   => 'no',
                    ),
                    array(
                        'card_title' => 'Residential Services',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/home_hero_plumber.png' ),
                        'bg_light'   => 'yes',
                    ),
                    array(
                        'card_title' => 'Residential Services',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/project_5.jpg' ),
                        'bg_light'   => 'no',
                    ),
                    array(
                        'card_title' => 'Residential Services',
                        'card_image' => array( 'url' => PLUMBERX_URI . '/assets/images/team_tim_cock.png' ),
                        'bg_light'   => 'yes',
                    ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title    = ! empty( $settings['section_title'] ) ? $settings['section_title'] : 'Featured Services';
        $cards    = ! empty( $settings['cards_list'] ) ? $settings['cards_list'] : array();
        ?>
        <section class="projects-dark-section">
          <div class="container">
            <div class="section-header">
              <h2 class="section-title decorated"><?php echo esc_html( $title ); ?></h2>
            </div>

            <div class="featured-services-row">
              <?php foreach ( $cards as $card ) : 
                $img_style = '';
                if ( 'yes' === $card['bg_light'] ) {
                    $img_style = ' style="background:#f1f5f9; object-fit:contain; padding:10px;"';
                }
                $img_url = ! empty( $card['card_image']['url'] ) ? $card['card_image']['url'] : PLUMBERX_URI . '/assets/images/project_6.jpg';
              ?>
                <div class="featured-service-card">
                  <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $card['card_title'] ); ?>"<?php echo $img_style; ?>>
                  <h4><?php echo esc_html( $card['card_title'] ); ?></h4>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php
    }
}
