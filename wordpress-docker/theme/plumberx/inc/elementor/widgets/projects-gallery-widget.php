<?php
/**
 * Elementor Widget: PlumberX Projects Gallery Grid
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Projects_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_projects_gallery';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Projects Gallery Grid', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Section: Filters
        $this->start_controls_section(
            'filters_section',
            array(
                'label' => esc_html__( 'Filter Categories', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $filter_repeater = new \Elementor\Repeater();

        $filter_repeater->add_control(
            'filter_label',
            array(
                'label'   => esc_html__( 'Filter Label', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'All', 'plumberx' ),
            )
        );

        $filter_repeater->add_control(
            'filter_slug',
            array(
                'label'   => esc_html__( 'Filter Slug / Key', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'all',
                'description' => esc_html__( 'Use lowercase keywords, e.g. all, kitchen, bathroom, drain, outside, server, tank', 'plumberx' ),
            )
        );

        $this->add_control(
            'filters',
            array(
                'label'       => esc_html__( 'Filter Buttons', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $filter_repeater->get_controls(),
                'title_field' => '{{{ filter_label }}} ({{{ filter_slug }}})',
                'default'     => array(
                    array( 'filter_label' => 'All', 'filter_slug' => 'all' ),
                    array( 'filter_label' => 'Kitchen', 'filter_slug' => 'kitchen' ),
                    array( 'filter_label' => 'Bathroom', 'filter_slug' => 'bathroom' ),
                    array( 'filter_label' => 'Drain Cleaning', 'filter_slug' => 'drain' ),
                    array( 'filter_label' => 'Outside Plumbing', 'filter_slug' => 'outside' ),
                    array( 'filter_label' => 'Server Lines Cleaning', 'filter_slug' => 'server' ),
                    array( 'filter_label' => 'Tank Leak Inspections', 'filter_slug' => 'tank' ),
                ),
            )
        );

        $this->end_controls_section();

        // Section: Projects
        $this->start_controls_section(
            'projects_section',
            array(
                'label' => esc_html__( 'Projects Gallery', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $project_repeater = new \Elementor\Repeater();

        $project_repeater->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Project Title / Alt Text', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Commercial Plumbing Inspection', 'plumberx' ),
                'label_block' => true,
            )
        );

        $project_repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Project Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/project_1.jpg',
                ),
            )
        );

        $project_repeater->add_control(
            'category',
            array(
                'label'       => esc_html__( 'Filter Category', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'kitchen',
                'description' => esc_html__( 'Must match a filter slug (e.g. kitchen, bathroom, drain, outside, server, tank)', 'plumberx' ),
            )
        );

        $project_repeater->add_control(
            'link',
            array(
                'label'       => esc_html__( 'Case Study / Details Link', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'plumberx' ),
                'default'     => array(
                    'url' => '/case-study/',
                ),
            )
        );

        $this->add_control(
            'projects',
            array(
                'label'       => esc_html__( 'Gallery Items', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $project_repeater->get_controls(),
                'title_field' => '{{{ title }}} ({{{ category }}})',
                'default'     => array(
                    array(
                        'title'    => 'Commercial Plumbing Inspection',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_1.jpg' ),
                        'category' => 'kitchen',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Bathroom Sink Plumbing',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_2.jpg' ),
                        'category' => 'bathroom',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Outside Excavation & Pipeline',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_3.jpg' ),
                        'category' => 'outside',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Kitchen Drain Line Fix',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_4.jpg' ),
                        'category' => 'kitchen',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'High Pressure Drain Clearing',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_5.jpg' ),
                        'category' => 'drain',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Water Tank Valve Seal',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_6.jpg' ),
                        'category' => 'tank',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Underground Sewer Pipe Connection',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_7.jpg' ),
                        'category' => 'server',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Bathtub Faucet Replacement',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_8.jpg' ),
                        'category' => 'bathroom',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                    array(
                        'title'    => 'Kitchen P-Trap Assembly',
                        'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_9.jpg' ),
                        'category' => 'drain',
                        'link'     => array( 'url' => '/case-study/' ),
                    ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $filters  = ! empty( $settings['filters'] ) ? $settings['filters'] : array();
        $projects = ! empty( $settings['projects'] ) ? $settings['projects'] : array();

        // Fallback filters if empty
        if ( empty( $filters ) ) {
            $filters = array(
                array( 'filter_label' => 'All', 'filter_slug' => 'all' ),
                array( 'filter_label' => 'Kitchen', 'filter_slug' => 'kitchen' ),
                array( 'filter_label' => 'Bathroom', 'filter_slug' => 'bathroom' ),
                array( 'filter_label' => 'Drain Cleaning', 'filter_slug' => 'drain' ),
                array( 'filter_label' => 'Outside Plumbing', 'filter_slug' => 'outside' ),
                array( 'filter_label' => 'Server Lines Cleaning', 'filter_slug' => 'server' ),
                array( 'filter_label' => 'Tank Leak Inspections', 'filter_slug' => 'tank' ),
            );
        }

        // Fallback projects if empty
        if ( empty( $projects ) ) {
            $projects = array(
                array(
                    'title'    => 'Commercial Plumbing Inspection',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_1.jpg' ),
                    'category' => 'kitchen',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Bathroom Sink Plumbing',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_2.jpg' ),
                    'category' => 'bathroom',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Outside Excavation & Pipeline',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_3.jpg' ),
                    'category' => 'outside',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Kitchen Drain Line Fix',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_4.jpg' ),
                    'category' => 'kitchen',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'High Pressure Drain Clearing',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_5.jpg' ),
                    'category' => 'drain',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Water Tank Valve Seal',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_6.jpg' ),
                    'category' => 'tank',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Underground Sewer Pipe Connection',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_7.jpg' ),
                    'category' => 'server',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Bathtub Faucet Replacement',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_8.jpg' ),
                    'category' => 'bathroom',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
                array(
                    'title'    => 'Kitchen P-Trap Assembly',
                    'image'    => array( 'url' => PLUMBERX_URI . '/assets/images/project_9.jpg' ),
                    'category' => 'drain',
                    'link'     => array( 'url' => '/case-study/' ),
                ),
            );
        }
        ?>
        <section class="projects-gallery-section">
            <div class="container">
                
                <!-- Filter Navigation -->
                <?php if ( ! empty( $filters ) ) : ?>
                    <div class="gallery-filter-nav">
                        <?php foreach ( $filters as $idx => $filt ) : 
                            $slug = ! empty( $filt['filter_slug'] ) ? sanitize_html_class( $filt['filter_slug'] ) : 'all';
                            $label = ! empty( $filt['filter_label'] ) ? $filt['filter_label'] : $slug;
                            $active_cls = ( $idx === 0 || $slug === 'all' ) ? ' active' : '';
                        ?>
                            <button class="gallery-filter-btn<?php echo esc_attr( $active_cls ); ?>" data-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- 9 Item Project Grid -->
                <div class="gallery-grid-9">
                    <?php 
                    foreach ( $projects as $proj ) :
                        $img_url = ! empty( $proj['image']['url'] ) ? $proj['image']['url'] : ( ! empty( $proj['image'] ) && is_string( $proj['image'] ) ? $proj['image'] : PLUMBERX_URI . '/assets/images/project_1.jpg' );
                        $title   = ! empty( $proj['title'] ) ? $proj['title'] : '';
                        $cat     = ! empty( $proj['category'] ) ? sanitize_html_class( $proj['category'] ) : 'kitchen';
                        $link    = ! empty( $proj['link']['url'] ) ? $proj['link']['url'] : ( ! empty( $proj['link'] ) && is_string( $proj['link'] ) ? $proj['link'] : home_url( '/case-study/' ) );
                        $target  = ! empty( $proj['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : '';
                    ?>
                        <div class="gallery-card" data-category="<?php echo esc_attr( $cat ); ?>">
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                            <div class="gallery-card-overlay">
                                <div class="gallery-action-btns">
                                    <button class="gallery-action-btn project-zoom-btn" data-img="<?php echo esc_url( $img_url ); ?>" title="<?php esc_attr_e( 'Zoom In', 'plumberx' ); ?>" aria-label="<?php esc_attr_e( 'Zoom In', 'plumberx' ); ?>">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            <line x1="11" y1="8" x2="11" y2="14"></line>
                                            <line x1="8" y1="11" x2="14" y2="11"></line>
                                        </svg>
                                    </button>
                                    <a href="<?php echo esc_url( $link ); ?>" class="gallery-action-btn" title="<?php esc_attr_e( 'View Case Study', 'plumberx' ); ?>" aria-label="<?php esc_attr_e( 'View Case Study', 'plumberx' ); ?>"<?php echo $target; ?>>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                            <polyline points="15 3 21 3 21 9"></polyline>
                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <?php
    }
}
