<?php
/**
 * Elementor Widget: PlumberX Latest From Blogs
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Blog_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_blog';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Latest Blogs', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Blog Section Settings', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Latest From Blogs', 'plumberx' ),
            )
        );

        $this->add_control(
            'section_subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'News & Press Release', 'plumberx' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $latest_posts = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'post_status'    => 'publish',
        ) );

        $all_items = array();

        if ( $latest_posts->have_posts() ) {
            $p_idx = 0;
            while ( $latest_posts->have_posts() ) {
                $latest_posts->the_post();
                $p_idx++;
                $all_items[] = array(
                    'title'     => get_the_title(),
                    'link'      => get_permalink(),
                    'excerpt'   => wp_trim_words( get_the_excerpt(), 18, '...' ),
                    'date'      => get_the_date( 'F j, Y' ),
                    'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'plumberx-blog' ) ?: PLUMBERX_URI . '/assets/images/blog_main_' . ( ( ( $p_idx - 1 ) % 2 ) + 1 ) . '.jpg',
                );
            }
            wp_reset_postdata();
        }

        // Static fallback items to ensure the 2-cards + 3-sidebar layout is always 100% full
        $fallbacks = array(
            array(
                'title'     => 'These cases are simple Standard',
                'link'      => home_url( '/blog' ),
                'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod tempor incididunt ut labore et dolore magna aliqua...',
                'date'      => 'June 3, 2026',
                'thumbnail' => PLUMBERX_URI . '/assets/images/blog_main_1.jpg',
            ),
            array(
                'title'     => 'Incapable of drawing an Image',
                'link'      => home_url( '/blog' ),
                'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod tempor incididunt ut labore et dolore magna aliqua...',
                'date'      => 'May 14, 2026',
                'thumbnail' => PLUMBERX_URI . '/assets/images/blog_main_2.jpg',
            ),
            array(
                'title'     => 'It is an almost life for us Gallery',
                'link'      => home_url( '/blog' ),
                'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod...',
                'date'      => 'May 12, 2026',
                'thumbnail' => '',
            ),
            array(
                'title'     => 'Many desktop publishing Audio',
                'link'      => home_url( '/blog' ),
                'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod...',
                'date'      => 'May 11, 2026',
                'thumbnail' => '',
            ),
            array(
                'title'     => 'This mistaken idea of Video',
                'link'      => home_url( '/blog' ),
                'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod...',
                'date'      => 'May 9, 2026',
                'thumbnail' => '',
            ),
        );

        // Pad with fallbacks if needed
        $count = count( $all_items );
        for ( $i = $count; $i < 5; $i++ ) {
            $all_items[] = $fallbacks[ $i ];
        }

        $cards_posts   = array_slice( $all_items, 0, 2 );
        $sidebar_posts = array_slice( $all_items, 2, 3 );
        ?>
        <section class="home-blog-section">
          <div class="container">
            <div class="section-header">
              <h2 class="section-title decorated"><?php echo esc_html( $settings['section_title'] ); ?></h2>
              <?php if ( ! empty( $settings['section_subtitle'] ) ) : ?>
                <p class="section-subtitle"><?php echo esc_html( $settings['section_subtitle'] ); ?></p>
              <?php endif; ?>
            </div>

            <div class="home-blog-grid">
              <?php foreach ( $cards_posts as $card ) : ?>
                <article class="blog-card-home">
                  <div class="card-img-wrap">
                    <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>">
                  </div>
                  <div class="card-body">
                    <h3 class="card-title"><a href="<?php echo esc_url( $card['link'] ); ?>"><?php echo esc_html( $card['title'] ); ?></a></h3>
                    <p class="card-desc"><?php echo esc_html( $card['excerpt'] ); ?></p>
                    <div class="card-footer">
                      <a href="<?php echo esc_url( $card['link'] ); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'plumberx' ); ?></a>
                      <span class="blog-date"><?php echo esc_html( $card['date'] ); ?></span>
                    </div>
                  </div>
                </article>
              <?php endforeach; ?>

              <?php if ( ! empty( $sidebar_posts ) ) : ?>
                <div class="blog-list-sidebar-home">
                  <?php foreach ( $sidebar_posts as $side ) : ?>
                    <div class="blog-list-item-home">
                      <h4 class="card-title"><a href="<?php echo esc_url( $side['link'] ); ?>"><?php echo esc_html( $side['title'] ); ?></a></h4>
                      <p class="card-desc"><?php echo esc_html( $side['excerpt'] ); ?></p>
                      <span class="blog-date"><?php echo esc_html( $side['date'] ); ?></span>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
        <?php
    }
}
