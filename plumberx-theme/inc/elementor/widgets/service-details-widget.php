<?php
/**
 * Elementor Widget: PlumberX Service Details / Repair Layout
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Service_Details_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_service_details';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Service Details / Repair Layout', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-sidebar';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // --- 1. Sidebar Section ---
        $this->start_controls_section(
            'sidebar_section',
            array(
                'label' => esc_html__( 'Sidebar Settings', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $menu_repeater = new \Elementor\Repeater();

        $menu_repeater->add_control(
            'menu_title',
            array(
                'label'   => esc_html__( 'Label', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Plumbing Repairs', 'plumberx' ),
            )
        );

        $menu_repeater->add_control(
            'menu_link',
            array(
                'label'   => esc_html__( 'URL', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/service-repair/' ),
            )
        );

        $menu_repeater->add_control(
            'is_active',
            array(
                'label'        => esc_html__( 'Active Menu Item?', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'plumberx' ),
                'label_off'    => esc_html__( 'No', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'no',
            )
        );

        $this->add_control(
            'sidebar_menu',
            array(
                'label'       => esc_html__( 'Sidebar Menu Links', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $menu_repeater->get_controls(),
                'title_field' => '{{{ menu_title }}}',
                'default'     => array(
                    array( 'menu_title' => 'Plumbing Repairs', 'menu_link' => array( 'url' => '/service-repair/' ), 'is_active' => 'yes' ),
                    array( 'menu_title' => 'Sewer Cleaning & Repairs', 'menu_link' => array( 'url' => '/service-repair/' ), 'is_active' => 'no' ),
                    array( 'menu_title' => 'Drain Repairs & Cleaning', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                    array( 'menu_title' => 'Faucet & Leak Repairs', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                    array( 'menu_title' => 'Gas Line Service', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                    array( 'menu_title' => 'Remodeling Service', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                    array( 'menu_title' => 'Water Treatment Service', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                    array( 'menu_title' => 'Heating & Cooling', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                ),
            )
        );

        $this->add_control(
            'sidebar_promo_image',
            array(
                'label'   => esc_html__( 'Promo Widget Banner', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/repair_sidebar_widget.jpg',
                ),
            )
        );

        $this->add_control(
            'downloads_title',
            array(
                'label'   => esc_html__( 'Downloads Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Downloads PDFs', 'plumberx' ),
            )
        );

        $dl_repeater = new \Elementor\Repeater();

        $dl_repeater->add_control(
            'download_title',
            array(
                'label'   => esc_html__( 'Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Brochure PDF', 'plumberx' ),
            )
        );

        $dl_repeater->add_control(
            'download_link',
            array(
                'label'   => esc_html__( 'File / Link URL', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#' ),
            )
        );

        $dl_repeater->add_control(
            'icon_style',
            array(
                'label'   => esc_html__( 'Icon Style', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'doc',
                'options' => array(
                    'doc'      => esc_html__( 'Document / PDF File', 'plumberx' ),
                    'download' => esc_html__( 'Download Arrow', 'plumberx' ),
                ),
            )
        );

        $this->add_control(
            'downloads_list',
            array(
                'label'       => esc_html__( 'PDF Downloads', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $dl_repeater->get_controls(),
                'title_field' => '{{{ download_title }}}',
                'default'     => array(
                    array( 'download_title' => 'Our Brochure PDF', 'icon_style' => 'doc', 'download_link' => array( 'url' => '#' ) ),
                    array( 'download_title' => 'Our Recent Products', 'icon_style' => 'download', 'download_link' => array( 'url' => '#' ) ),
                ),
            )
        );

        $this->end_controls_section();

        // --- 2. Main Content Top Section ---
        $this->start_controls_section(
            'main_content_section',
            array(
                'label' => esc_html__( 'Main Narrative & Top Photos', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'top_photo_1',
            array(
                'label'   => esc_html__( 'Top Photo 1 (Left)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/repair_top_1.jpg',
                ),
            )
        );

        $this->add_control(
            'top_photo_2',
            array(
                'label'   => esc_html__( 'Top Photo 2 (Right)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/repair_top_2.jpg',
                ),
            )
        );

        $this->add_control(
            'main_service_title',
            array(
                'label'   => esc_html__( 'Main Service Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Plumbing Repairs', 'plumberx' ),
            )
        );

        $this->add_control(
            'paragraph_1',
            array(
                'label'   => esc_html__( 'Paragraph 1', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => esc_html__( 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.', 'plumberx' ),
            )
        );

        $this->add_control(
            'paragraph_2',
            array(
                'label'   => esc_html__( 'Paragraph 2', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => esc_html__( 'Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring. Capitalize on low hanging fruit to identify a ballpark value added activity to beta test.', 'plumberx' ),
            )
        );

        $this->end_controls_section();

        // --- 3. Benefit of Service Box ---
        $this->start_controls_section(
            'benefit_section',
            array(
                'label' => esc_html__( 'Benefit of Service Box', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'benefit_image',
            array(
                'label'   => esc_html__( 'Benefit Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/repair_benefit.jpg',
                ),
            )
        );

        $this->add_control(
            'benefit_title',
            array(
                'label'   => esc_html__( 'Benefit Box Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Benefit of Service', 'plumberx' ),
            )
        );

        $this->add_control(
            'benefit_desc',
            array(
                'label'   => esc_html__( 'Benefit Box Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( 'Expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.', 'plumberx' ),
            )
        );

        $chk_repeater = new \Elementor\Repeater();

        $chk_repeater->add_control(
            'check_text',
            array(
                'label'   => esc_html__( 'Checklist Item', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Those who do not know how to pursue', 'plumberx' ),
            )
        );

        $this->add_control(
            'benefit_checklist',
            array(
                'label'       => esc_html__( 'Checklist Items', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $chk_repeater->get_controls(),
                'title_field' => '{{{ check_text }}}',
                'default'     => array(
                    array( 'check_text' => 'Those who do not know how to pursue' ),
                    array( 'check_text' => 'Pleasure rationally encounter' ),
                    array( 'check_text' => 'Consequences that are extremely painful.' ),
                    array( 'check_text' => 'Nor again is there anyone who loves or pursues' ),
                ),
            )
        );

        $this->end_controls_section();

        // --- 4. Facts Grid Section ---
        $this->start_controls_section(
            'facts_section',
            array(
                'label' => esc_html__( 'Some Facts Works With Us', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'facts_title',
            array(
                'label'   => esc_html__( 'Facts Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Some facts works with us', 'plumberx' ),
            )
        );

        $this->add_control(
            'facts_subtitle',
            array(
                'label'   => esc_html__( 'Facts Section Subtitle', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( "Our management consulting services focus on our clients' most critical issues and opportunities: strategy, marketing, organization, operations, technology, transformation, digital.", 'plumberx' ),
            )
        );

        $facts_repeater = new \Elementor\Repeater();

        $facts_repeater->add_control(
            'fact_title',
            array(
                'label'   => esc_html__( 'Fact Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Professional Team', 'plumberx' ),
            )
        );

        $facts_repeater->add_control(
            'fact_icon_type',
            array(
                'label'   => esc_html__( 'Icon Style', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'team',
                'options' => array(
                    'team'     => esc_html__( 'Team / Users', 'plumberx' ),
                    'deadline' => esc_html__( 'Clock / Deadline', 'plumberx' ),
                    'strategy' => esc_html__( 'Layers / Strategy', 'plumberx' ),
                    'quality'  => esc_html__( 'Award / Quality', 'plumberx' ),
                ),
            )
        );

        $facts_repeater->add_control(
            'fact_desc',
            array(
                'label'   => esc_html__( 'Fact Description', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => esc_html__( 'Efficiently unleash cross-media informa-tion without cross-media value. Quickly maximize timely deliverables.', 'plumberx' ),
            )
        );

        $this->add_control(
            'facts_list',
            array(
                'label'       => esc_html__( 'Facts Items (4 Columns)', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $facts_repeater->get_controls(),
                'title_field' => '{{{ fact_title }}}',
                'default'     => array(
                    array(
                        'fact_title'     => 'Professional Team',
                        'fact_icon_type' => 'team',
                        'fact_desc'      => 'Efficiently unleash cross-media informa-tion without cross-media value. Quickly maximize timely deliverables.',
                    ),
                    array(
                        'fact_title'     => 'Deadline Completion',
                        'fact_icon_type' => 'deadline',
                        'fact_desc'      => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate.',
                    ),
                    array(
                        'fact_title'     => 'Best Strategy of Work',
                        'fact_icon_type' => 'strategy',
                        'fact_desc'      => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate.',
                    ),
                    array(
                        'fact_title'     => 'Quality Work',
                        'fact_icon_type' => 'quality',
                        'fact_desc'      => 'Efficiently unleash cross-media informa-tion without cross-media value. Quickly maximize timely deliverables.',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        // --- 5. Accordion Section ---
        $this->start_controls_section(
            'faq_section',
            array(
                'label' => esc_html__( 'More Information (Accordion)', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'faq_title',
            array(
                'label'   => esc_html__( 'Accordion Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'More information', 'plumberx' ),
            )
        );

        $this->add_control(
            'faq_subtitle',
            array(
                'label'   => esc_html__( 'Accordion Subtitle', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( "Our management consulting services focus on our clients' most critical issues and opportunities: strategy, marketing, organization, operations, technology, digital.", 'plumberx' ),
            )
        );

        $faq_repeater = new \Elementor\Repeater();

        $faq_repeater->add_control(
            'faq_question',
            array(
                'label'   => esc_html__( 'Question / Heading', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Capitalize on low hanging fruit to identify a ballpark value added activity.', 'plumberx' ),
            )
        );

        $faq_repeater->add_control(
            'faq_answer',
            array(
                'label'   => esc_html__( 'Answer Content', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => esc_html__( 'Expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids actual teachings of the great explorer of the truth, the master-builder of human actual teachings of the great explorer of the truth, the master-builder of human.', 'plumberx' ),
            )
        );

        $faq_repeater->add_control(
            'is_open',
            array(
                'label'        => esc_html__( 'Open by Default?', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'plumberx' ),
                'label_off'    => esc_html__( 'No', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'no',
            )
        );

        $this->add_control(
            'faq_list',
            array(
                'label'       => esc_html__( 'Accordion Items', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $faq_repeater->get_controls(),
                'title_field' => '{{{ faq_question }}}',
                'default'     => array(
                    array(
                        'faq_question' => 'Capitalize on low hanging fruit to identify a ballpark value added activity.',
                        'faq_answer'   => 'Expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids actual teachings of the great explorer of the truth, the master-builder of human actual teachings of the great explorer of the truth, the master-builder of human.',
                        'is_open'      => 'yes',
                    ),
                    array(
                        'faq_question' => 'Digital divide with additional clickthroughs from DevOps.',
                        'faq_answer'   => 'Podcasting operational change management inside of workflows to establish a horizontal pipeline. Taking seamless key performance indicators offline to maximise the long tail.',
                        'is_open'      => 'no',
                    ),
                    array(
                        'faq_question' => 'Nanotechnology immersion along the information highway will close the loop.',
                        'faq_answer'   => 'Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.',
                        'is_open'      => 'no',
                    ),
                    array(
                        'faq_question' => 'Organically grow the holistic world view of disruptive innovation via workplace.',
                        'faq_answer'   => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.',
                        'is_open'      => 'no',
                    ),
                ),
            )
        );

        $this->end_controls_section();
    }

    public function render_fact_svg( $type ) {
        switch ( $type ) {
            case 'team':
                return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
            case 'deadline':
                return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
            case 'strategy':
                return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>';
            case 'quality':
                return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>';
            default:
                return '';
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $menu_items    = ! empty( $settings['sidebar_menu'] ) ? $settings['sidebar_menu'] : array();
        $promo_img_url = ! empty( $settings['sidebar_promo_image']['url'] ) ? $settings['sidebar_promo_image']['url'] : PLUMBERX_URI . '/assets/images/repair_sidebar_widget.jpg';
        $dl_title      = ! empty( $settings['downloads_title'] ) ? $settings['downloads_title'] : 'Downloads PDFs';
        $downloads     = ! empty( $settings['downloads_list'] ) ? $settings['downloads_list'] : array();

        $photo1_url    = ! empty( $settings['top_photo_1']['url'] ) ? $settings['top_photo_1']['url'] : PLUMBERX_URI . '/assets/images/repair_top_1.jpg';
        $photo2_url    = ! empty( $settings['top_photo_2']['url'] ) ? $settings['top_photo_2']['url'] : PLUMBERX_URI . '/assets/images/repair_top_2.jpg';
        $main_title    = ! empty( $settings['main_service_title'] ) ? $settings['main_service_title'] : 'Plumbing Repairs';
        $para1         = ! empty( $settings['paragraph_1'] ) ? $settings['paragraph_1'] : '';
        $para2         = ! empty( $settings['paragraph_2'] ) ? $settings['paragraph_2'] : '';

        $benefit_img   = ! empty( $settings['benefit_image']['url'] ) ? $settings['benefit_image']['url'] : PLUMBERX_URI . '/assets/images/repair_benefit.jpg';
        $benefit_title = ! empty( $settings['benefit_title'] ) ? $settings['benefit_title'] : 'Benefit of Service';
        $benefit_desc  = ! empty( $settings['benefit_desc'] ) ? $settings['benefit_desc'] : '';
        $checklist     = ! empty( $settings['benefit_checklist'] ) ? $settings['benefit_checklist'] : array();

        $facts_title   = ! empty( $settings['facts_title'] ) ? $settings['facts_title'] : 'Some facts works with us';
        $facts_sub     = ! empty( $settings['facts_subtitle'] ) ? $settings['facts_subtitle'] : '';
        $facts         = ! empty( $settings['facts_list'] ) ? $settings['facts_list'] : array();

        $faq_title     = ! empty( $settings['faq_title'] ) ? $settings['faq_title'] : 'More information';
        $faq_sub       = ! empty( $settings['faq_subtitle'] ) ? $settings['faq_subtitle'] : '';
        $faqs          = ! empty( $settings['faq_list'] ) ? $settings['faq_list'] : array();
        ?>
        <section class="repair-layout-section">
          <div class="container repair-grid">
            <!-- Left Sidebar -->
            <aside class="repair-sidebar">
              <?php if ( ! empty( $menu_items ) ) : ?>
                <nav class="repair-sidebar-menu">
                  <?php foreach ( $menu_items as $item ) : 
                    $active_class = ( 'yes' === ( $item['is_active'] ?? '' ) ) ? ' active' : '';
                    $m_url        = ! empty( $item['menu_link']['url'] ) ? $item['menu_link']['url'] : '#';
                    $m_ext        = ! empty( $item['menu_link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
                  ?>
                    <a href="<?php echo esc_url( $m_url ); ?>" class="repair-menu-item<?php echo esc_attr( $active_class ); ?>"<?php echo $m_ext; ?>><?php echo esc_html( $item['menu_title'] ); ?></a>
                  <?php endforeach; ?>
                </nav>
              <?php endif; ?>

              <?php if ( ! empty( $promo_img_url ) ) : ?>
                <div class="repair-promo-widget">
                  <img src="<?php echo esc_url( $promo_img_url ); ?>" alt="<?php echo esc_attr__( 'Schedule an Appointment Today', 'plumberx' ); ?>">
                </div>
              <?php endif; ?>

              <?php if ( ! empty( $downloads ) ) : ?>
                <div class="repair-download-widget">
                  <h4><?php echo esc_html( $dl_title ); ?></h4>
                  <?php foreach ( $downloads as $dl ) : 
                    $dl_url = ! empty( $dl['download_link']['url'] ) ? $dl['download_link']['url'] : '#';
                    $style  = $dl['icon_style'] ?? 'doc';
                  ?>
                    <a href="<?php echo esc_url( $dl_url ); ?>" class="btn-download-pdf">
                      <span><?php echo esc_html( $dl['download_title'] ); ?></span>
                      <?php if ( 'download' === $style ) : ?>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                          <polyline points="7 10 12 15 17 10"></polyline>
                          <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                      <?php else : ?>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                          <polyline points="14 2 14 8 20 8"></polyline>
                          <line x1="16" y1="13" x2="8" y2="13"></line>
                          <line x1="16" y1="17" x2="8" y2="17"></line>
                          <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                      <?php endif; ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </aside>

            <!-- Right Main Content -->
            <main class="repair-main-content">
              <div class="repair-top-photos">
                <img src="<?php echo esc_url( $photo1_url ); ?>" alt="<?php echo esc_attr( $main_title ); ?>">
                <img src="<?php echo esc_url( $photo2_url ); ?>" alt="<?php echo esc_attr( $main_title ); ?>">
              </div>

              <h3><?php echo esc_html( $main_title ); ?></h3>
              <?php if ( ! empty( $para1 ) ) : ?>
                <p><?php echo esc_html( $para1 ); ?></p>
              <?php endif; ?>
              <?php if ( ! empty( $para2 ) ) : ?>
                <p><?php echo esc_html( $para2 ); ?></p>
              <?php endif; ?>

              <!-- Benefit of Service Box -->
              <div class="benefit-service-grid">
                <img src="<?php echo esc_url( $benefit_img ); ?>" alt="<?php echo esc_attr( $benefit_title ); ?>">
                <div>
                  <h4 style="font-size:18px; font-weight:700; color:var(--primary-navy); margin-bottom:10px;"><?php echo esc_html( $benefit_title ); ?></h4>
                  <?php if ( ! empty( $benefit_desc ) ) : ?>
                    <p style="font-size:13px; color:var(--text-gray); line-height:1.55; margin-bottom:14px;"><?php echo esc_html( $benefit_desc ); ?></p>
                  <?php endif; ?>
                  <?php if ( ! empty( $checklist ) ) : ?>
                    <div class="checklist">
                      <?php foreach ( $checklist as $c ) : ?>
                        <div class="check-item"><span class="check-icon">✓</span> <?php echo esc_html( $c['check_text'] ); ?></div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Some facts works with us -->
              <?php if ( ! empty( $facts_title ) || ! empty( $facts_sub ) ) : ?>
                <div class="section-header" style="margin-top: 40px; margin-bottom: 20px;">
                  <?php if ( ! empty( $facts_title ) ) : ?>
                    <h4 style="font-size: 20px; font-weight: 700; color: var(--primary-navy);"><?php echo esc_html( $facts_title ); ?></h4>
                  <?php endif; ?>
                  <?php if ( ! empty( $facts_sub ) ) : ?>
                    <p style="font-size: 13px; color: var(--text-gray);"><?php echo esc_html( $facts_sub ); ?></p>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if ( ! empty( $facts ) ) : ?>
                <div class="facts-grid">
                  <?php foreach ( $facts as $f ) : 
                    $f_icon_html = $this->render_fact_svg( $f['fact_icon_type'] ?? 'team' );
                  ?>
                    <div class="fact-item">
                      <div class="fact-icon">
                        <?php echo $f_icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                      </div>
                      <div class="fact-info">
                        <h5><?php echo esc_html( $f['fact_title'] ); ?></h5>
                        <p><?php echo esc_html( $f['fact_desc'] ); ?></p>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <!-- More Information Accordion -->
              <?php if ( ! empty( $faq_title ) || ! empty( $faq_sub ) ) : ?>
                <div class="section-header" style="margin-top: 30px; margin-bottom: 16px;">
                  <?php if ( ! empty( $faq_title ) ) : ?>
                    <h4 style="font-size: 20px; font-weight: 700; color: var(--primary-navy);"><?php echo esc_html( $faq_title ); ?></h4>
                  <?php endif; ?>
                  <?php if ( ! empty( $faq_sub ) ) : ?>
                    <p style="font-size: 13px; color: var(--text-gray);"><?php echo esc_html( $faq_sub ); ?></p>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if ( ! empty( $faqs ) ) : ?>
                <div class="accordion">
                  <?php foreach ( $faqs as $faq ) : 
                    $is_open = 'yes' === ( $faq['is_open'] ?? '' );
                    $item_cls = $is_open ? ' active' : '';
                    $sign     = $is_open ? '−' : '+';
                  ?>
                    <div class="accordion-item<?php echo esc_attr( $item_cls ); ?>">
                      <div class="accordion-header">
                        <span><?php echo esc_html( $faq['faq_question'] ); ?></span>
                        <span class="accordion-icon"><?php echo esc_html( $sign ); ?></span>
                      </div>
                      <div class="accordion-body">
                        <?php echo esc_html( $faq['faq_answer'] ); ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </main>
          </div>
        </section>
        <?php
    }
}
