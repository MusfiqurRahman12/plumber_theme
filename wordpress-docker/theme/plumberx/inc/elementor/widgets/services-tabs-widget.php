<?php
/**
 * Elementor Widget: PlumberX Services Tabs
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Services_Tabs_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_services_tabs';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Services Tabs', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-tabs';
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
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Services That We Offers', 'plumberx' ),
            )
        );

        $this->add_control(
            'plumber_image',
            array(
                'label'   => esc_html__( 'Standing Plumber Illustration', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/service_tab_plumber.png',
                ),
            )
        );

        $this->add_control(
            'source',
            array(
                'label'   => esc_html__( 'Data Source', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'cpt',
                'options' => array(
                    'cpt'    => esc_html__( 'Dynamic: Services Post Type', 'plumberx' ),
                    'manual' => esc_html__( 'Manual: Custom Repeater Tabs', 'plumberx' ),
                ),
            )
        );

        $this->end_controls_section();

        // Repeater Section for manual tabs
        $this->start_controls_section(
            'tabs_section',
            array(
                'label'     => esc_html__( 'Custom Tabs', 'plumberx' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => array( 'source' => 'manual' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            array(
                'label'   => esc_html__( 'Tab Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'PLUMBING LEAKS', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'tab_desc',
            array(
                'label'   => esc_html__( 'Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'We have the wherewithal to handle a number of plumbing situations in any of these locations. Don\'t hesitate to enlist our services! From start to finish, you can count on Plumberx Plumbing for superior assistance, maintenance, repairs, and more.', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'tab_checklist',
            array(
                'label'   => esc_html__( 'Checklist Items (1 per line)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "Diagnosis and Check-ups\nInstallations and Upgrades\nSystem Maintenance and Cleaning\nEmergency Plumbing Repairs\nClog Removal",
            )
        );

        $repeater->add_control(
            'tab_image',
            array(
                'label'   => esc_html__( 'Tab Inner Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/service_tab_kitchen.jpg',
                ),
            )
        );

        $this->add_control(
            'custom_tabs',
            array(
                'label'       => esc_html__( 'Tabs List', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
                'default'     => array(
                    array( 'tab_title' => 'PLUMBING LEAKS' ),
                    array( 'tab_title' => 'BATHROOM PLUMBING' ),
                    array( 'tab_title' => 'KITCHEN PLUMBING' ),
                    array( 'tab_title' => 'OUTSIDE PLUMBING' ),
                    array( 'tab_title' => 'BROKEN FIXTURES' ),
                    array( 'tab_title' => 'DRAIN CLOGS' ),
                    array( 'tab_title' => 'BROKEN TOILETS' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings    = $this->get_settings_for_display();
        $source      = $settings['source'];
        $plumber_img = ! empty( $settings['plumber_image']['url'] ) ? $settings['plumber_image']['url'] : PLUMBERX_URI . '/assets/images/service_tab_plumber.png';
        $tabs        = array();

        if ( 'cpt' === $source ) {
            $services = plumberx_get_services( -1 );
            if ( $services->have_posts() ) {
                while ( $services->have_posts() ) {
                    $services->the_post();
                    $checklist_raw = get_post_meta( get_the_ID(), '_service_checklist', true );
                    $checklist = array();
                    if ( $checklist_raw ) {
                        $checklist = array_filter( array_map( 'trim', explode( "\n", $checklist_raw ) ) );
                    }
                    $tabs[] = array(
                        'id'        => 'tabSvc' . get_the_ID(),
                        'title'     => strtoupper( get_the_title() ),
                        'desc'      => get_the_excerpt() ?: get_the_content(),
                        'checklist' => $checklist,
                        'image'     => get_the_post_thumbnail_url( get_the_ID(), 'plumberx-blog' ) ?: PLUMBERX_URI . '/assets/images/service_tab_kitchen.jpg',
                    );
                }
                wp_reset_postdata();
            }
        } else {
            foreach ( $settings['custom_tabs'] as $index => $tab ) {
                $checklist = array_filter( array_map( 'trim', explode( "\n", $tab['tab_checklist'] ) ) );
                $tabs[] = array(
                    'id'        => 'customTab' . $index,
                    'title'     => strtoupper( $tab['tab_title'] ),
                    'desc'      => $tab['tab_desc'],
                    'checklist' => $checklist,
                    'image'     => ! empty( $tab['tab_image']['url'] ) ? $tab['tab_image']['url'] : PLUMBERX_URI . '/assets/images/service_tab_kitchen.jpg',
                );
            }
        }

        if ( empty( $tabs ) ) {
            // Static fallback matching static index.html
            $tabs = array(
                array(
                    'id'        => 'tabLeaks',
                    'title'     => 'PLUMBING LEAKS',
                    'desc'      => 'We have the wherewithal to handle a number of plumbing situations in any of these loca-tions. Don\'t hesitate to enlist our services! From start to finish, you can count on Plumberx Plumbing for superior assistance, maintenance, repairs, and more.',
                    'checklist' => array( 'Diagnosis and Check-ups', 'Installations and Upgrades', 'System Maintenance and Cleaning', 'Emergency Plumbing Repairs', 'Clog Removal' ),
                    'image'     => PLUMBERX_URI . '/assets/images/service_tab_kitchen.jpg',
                ),
                array(
                    'id'        => 'tabBathroom',
                    'title'     => 'BATHROOM PLUMBING',
                    'desc'      => 'Complete bathroom plumbing solutions from faulty shower valves to vanity basin leak detection and faucet rebuilds. We keep your bathroom sparkling and functional.',
                    'checklist' => array( 'Shower & Bathtub Repairs', 'Vanity Drain Alignment', 'Pressure Regulator Tuning', 'Odor & Trap Inspections' ),
                    'image'     => PLUMBERX_URI . '/assets/images/case_study_1.jpg',
                ),
                array(
                    'id'        => 'tabKitchen',
                    'title'     => 'KITCHEN PLUMBING',
                    'desc'      => 'From garbage disposal units to refrigerator ice-maker water lines and dishwasher connections, our licensed plumbers make kitchen prep worry-free.',
                    'checklist' => array( 'Sink Faucet Installation', 'Garbage Disposal Maintenance', 'Under-counter Pipe Resealing' ),
                    'image'     => PLUMBERX_URI . '/assets/images/service_tab_kitchen.jpg',
                ),
                array(
                    'id'        => 'tabOutside',
                    'title'     => 'OUTSIDE PLUMBING',
                    'desc'      => 'Protect your exterior from winter freezes and high water bills with hose bibb repairs, main line backflow checks, and irrigation shutoff services.',
                    'checklist' => array( 'Hose Bibb & Spigot Replacement', 'Yard Main Pipe Excavation', 'Anti-Siphon Valve Testing' ),
                    'image'     => PLUMBERX_URI . '/assets/images/project_3.jpg',
                ),
                array(
                    'id'        => 'tabFixtures',
                    'title'     => 'BROKEN FIXTURES',
                    'desc'      => 'Restore luxury and water savings with custom fixture retrofits, chrome mixer replacements, and high-efficiency aerators.',
                    'checklist' => array( 'Brass & Chrome Replacements', 'Cartridge & Stem Swaps' ),
                    'image'     => PLUMBERX_URI . '/assets/images/project_6.jpg',
                ),
                array(
                    'id'        => 'tabDrain',
                    'title'     => 'DRAIN CLOGS',
                    'desc'      => 'Stubborn clogs cleared safely without damaging your pipes using motorized drain augers and hydro-jetting technology.',
                    'checklist' => array( 'Hydro Jetting Cleanouts', 'Fiber-optic Camera Scans' ),
                    'image'     => PLUMBERX_URI . '/assets/images/price_1.jpg',
                ),
                array(
                    'id'        => 'tabToilets',
                    'title'     => 'BROKEN TOILETS',
                    'desc'      => 'Stop constantly running water and weak flush mechanisms with flapper, fill valve, and seal flange replacement by certified plumbers.',
                    'checklist' => array( 'Flange & Wax Ring Replacement', 'Dual Flush Upgrades' ),
                    'image'     => PLUMBERX_URI . '/assets/images/shop_hero_toilet.png',
                ),
            );
        }
        ?>
        <section class="services-tab-section">
          <div class="container">
            <?php if ( ! empty( $settings['section_title'] ) ) : ?>
              <div class="section-header">
                <h2 class="section-title decorated"><?php echo esc_html( $settings['section_title'] ); ?></h2>
              </div>
            <?php endif; ?>

            <div class="services-tab-layout">
              <!-- Tab Navigation -->
              <div class="tab-nav-vertical">
                <?php foreach ( $tabs as $index => $tab ) : ?>
                  <button class="tab-btn-vertical <?php echo 0 === $index ? 'active' : ''; ?>" 
                          data-target="<?php echo esc_attr( $tab['id'] ); ?>" 
                          type="button">
                    <?php echo esc_html( $tab['title'] ); ?>
                  </button>
                <?php endforeach; ?>
              </div>

              <!-- Tab Content -->
              <div class="tab-content-area">
                <?php foreach ( $tabs as $index => $tab ) : ?>
                  <div class="tab-content-panel <?php echo 0 === $index ? 'active' : ''; ?>" id="<?php echo esc_attr( $tab['id'] ); ?>">
                    <p class="tab-desc-text"><?php echo esc_html( $tab['desc'] ); ?></p>
                    <div class="tab-body-row">
                      <?php if ( ! empty( $tab['image'] ) ) : ?>
                        <img src="<?php echo esc_url( $tab['image'] ); ?>" alt="<?php echo esc_attr( $tab['title'] ); ?>" class="tab-kitchen-img">
                      <?php endif; ?>
                      <?php if ( ! empty( $tab['checklist'] ) ) : ?>
                        <div class="checklist">
                          <?php foreach ( $tab['checklist'] as $item ) : ?>
                            <div class="check-item"><span class="check-icon">✓</span> <?php echo esc_html( $item ); ?></div>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Standing Plumber Illustration -->
              <div class="tab-plumber-col">
                <img src="<?php echo esc_url( $plumber_img ); ?>" alt="<?php esc_attr_e( 'Certified Plumber', 'plumberx' ); ?>" class="tab-standing-plumber">
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
