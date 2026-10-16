<?php
/**
 * Elementor Widget: PlumberX About Mission
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_About_Mission_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_about_mission';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: About Our Mission', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Mission Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Mission', 'plumberx' ),
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore.', 'plumberx' ),
            )
        );

        $this->add_control(
            'mission_image',
            array(
                'label'   => esc_html__( 'Mission Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/about_mission.jpg',
                ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_text',
            array(
                'label'   => esc_html__( 'Checklist Item', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Natus erroroluptatem', 'plumberx' ),
            )
        );

        $this->add_control(
            'checklist_items',
            array(
                'label'       => esc_html__( 'Checklist Items', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ item_text }}}',
                'default'     => array(
                    array( 'item_text' => 'Natus erroroluptatem' ),
                    array( 'item_text' => 'Natus erroroluptatem' ),
                    array( 'item_text' => 'Accusantium doloremue' ),
                    array( 'item_text' => 'Accusantium doloremue' ),
                    array( 'item_text' => 'Laudantium unde' ),
                    array( 'item_text' => 'Laudantium unde' ),
                    array( 'item_text' => 'Natus error sit volupta' ),
                    array( 'item_text' => 'Natus error sit volupta' ),
                    array( 'item_text' => 'Accusantium dolor' ),
                    array( 'item_text' => 'Accusantium dolor' ),
                ),
            )
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            array(
                'label' => esc_html__( 'Section Style', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'bg_color',
            array(
                'label'     => esc_html__( 'Background Color', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .about-mission-section' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $title     = ! empty( $settings['section_title'] ) ? $settings['section_title'] : 'Our Mission';
        $desc      = ! empty( $settings['description'] ) ? $settings['description'] : '';
        $items     = ! empty( $settings['checklist_items'] ) ? $settings['checklist_items'] : array();
        $img_url   = ! empty( $settings['mission_image']['url'] ) ? $settings['mission_image']['url'] : PLUMBERX_URI . '/assets/images/about_mission.jpg';
        ?>
        <section class="about-mission-section">
          <div class="container">
            <div class="section-header">
              <h2 class="section-title decorated"><?php echo esc_html( $title ); ?></h2>
            </div>

            <div class="about-mission-grid">
              <div class="mission-text-col">
                <?php if ( $desc ) : ?>
                  <p class="tab-desc-text"><?php echo esc_html( $desc ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $items ) ) : ?>
                  <div class="contractor-checklist-grid" style="margin-top: 20px;">
                    <?php foreach ( $items as $item ) : ?>
                      <div class="check-item"><span class="check-icon">&#10003;</span> <?php echo esc_html( $item['item_text'] ); ?></div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class="mission-image-col">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" style="width:100%; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);">
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
