<?php
/**
 * Elementor Widget: PlumberX Projects Showcase
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Projects_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_projects';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Projects Showcase', 'plumberx' );
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
                'label' => esc_html__( 'Projects Configuration', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Projects', 'plumberx' ),
            )
        );

        $this->add_control(
            'posts_per_page',
            array(
                'label'   => esc_html__( 'Number of Projects', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 8,
                'min'     => 3,
                'max'     => 24,
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'VIEW ALL', 'plumberx' ),
            )
        );

        $this->add_control(
            'btn_link',
            array(
                'label'       => esc_html__( 'Button Link', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'plumberx' ),
                'default'     => array(
                    'url' => '/projects/',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $count    = ! empty( $settings['posts_per_page'] ) ? intval( $settings['posts_per_page'] ) : 8;
        $btn_text = ! empty( $settings['btn_text'] ) ? $settings['btn_text'] : 'VIEW ALL';
        $btn_url  = ! empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : home_url( '/projects' );

        $projects = plumberx_get_projects( $count );
        ?>
        <section class="projects-dark-section">
          <div class="container">
            <?php if ( ! empty( $settings['section_title'] ) ) : ?>
              <div class="section-header">
                <h2 class="section-title"><?php echo esc_html( $settings['section_title'] ); ?></h2>
              </div>
            <?php endif; ?>

            <div class="projects-grid">
              <?php
              if ( $projects->have_posts() ) :
                  $p_idx = 0;
                  while ( $projects->have_posts() ) : $projects->the_post();
                      $p_idx++;
                      $cats = get_the_terms( get_the_ID(), 'project_category' );
                      $cat_name = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->name : ( get_post_meta( get_the_ID(), '_project_subtitle', true ) ?: 'Commercial Plumbing' );
                      $thumb = get_the_post_thumbnail_url( get_the_ID(), 'plumberx-project' ) ?: PLUMBERX_URI . '/assets/images/project_' . ( ( ( $p_idx - 1 ) % 8 ) + 1 ) . '.jpg';
              ?>
                <div class="project-card">
                  <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>">
                  <div class="project-overlay">
                    <h4 class="project-overlay-title"><?php the_title(); ?></h4>
                    <span class="project-overlay-cat"><?php echo esc_html( $cat_name ); ?></span>
                    <button class="project-zoom-btn" data-img="<?php echo esc_url( $thumb ); ?>">+</button>
                  </div>
                </div>
              <?php
                  endwhile;
                  wp_reset_postdata();
              else :
                  // Static fallback projects matching static HTML
                  $fallback_projects = array(
                      array( 'title' => 'Pressure Gauge Tuning', 'cat' => 'Commercial Plumbing', 'img' => 'project_1.jpg' ),
                      array( 'title' => 'Basin Trap Installation', 'cat' => 'Bathroom Plumbing', 'img' => 'project_2.jpg' ),
                      array( 'title' => 'Municipal Sewer Trenching', 'cat' => 'Outdoor Plumbing', 'img' => 'project_3.jpg' ),
                      array( 'title' => 'Boiler Line Repair', 'cat' => 'Commercial Plumbing', 'img' => 'project_4.jpg' ),
                      array( 'title' => 'High Pressure Conduit', 'cat' => 'Pipe Re-routing', 'img' => 'project_5.jpg' ),
                      array( 'title' => 'Brass Fitting Repair', 'cat' => 'Kitchen & Bath', 'img' => 'project_6.jpg' ),
                      array( 'title' => 'Precision Hardware Repair', 'cat' => 'Tool Certification', 'img' => 'project_7.jpg' ),
                      array( 'title' => 'Residential Drain Inspection', 'cat' => 'Residential Repair', 'img' => 'project_8.jpg' ),
                  );
                  foreach ( $fallback_projects as $proj ) :
                      $thumb_url = PLUMBERX_URI . '/assets/images/' . $proj['img'];
              ?>
                <div class="project-card">
                  <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $proj['title'] ); ?>">
                  <div class="project-overlay">
                    <h4 class="project-overlay-title"><?php echo esc_html( $proj['title'] ); ?></h4>
                    <span class="project-overlay-cat"><?php echo esc_html( $proj['cat'] ); ?></span>
                    <button class="project-zoom-btn" data-img="<?php echo esc_url( $thumb_url ); ?>">+</button>
                  </div>
                </div>
              <?php
                  endforeach;
              endif;
              ?>
            </div>

            <div class="text-center">
              <a href="<?php echo esc_url( $btn_url ); ?>" class="view-all-projects-btn"><?php echo esc_html( $btn_text ); ?></a>
            </div>
          </div>
        </section>
        <?php
    }
}
