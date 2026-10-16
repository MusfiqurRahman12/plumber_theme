<?php
/**
 * Elementor Widget: PlumberX Blog Posts & Sidebar Layout
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Blog_List_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_blog_list';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Blog Posts & Sidebar', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Posts Query Section
        $this->start_controls_section(
            'query_section',
            array(
                'label' => esc_html__( 'Blog Posts Query', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'posts_per_page',
            array(
                'label'   => esc_html__( 'Posts Per Page', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 20,
                'default' => 4,
            )
        );

        $this->add_control(
            'show_pagination',
            array(
                'label'        => esc_html__( 'Show Pagination', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'plumberx' ),
                'label_off'    => esc_html__( 'Hide', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->end_controls_section();

        // Sidebar Section
        $this->start_controls_section(
            'sidebar_section',
            array(
                'label' => esc_html__( 'Sidebar Settings', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_sidebar',
            array(
                'label'        => esc_html__( 'Show Sidebar', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'plumberx' ),
                'label_off'    => esc_html__( 'Hide', 'plumberx' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'show_search',
            array(
                'label'        => esc_html__( 'Show Search Widget', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'condition'    => array( 'show_sidebar' => 'yes' ),
            )
        );

        $this->add_control(
            'search_title',
            array(
                'label'     => esc_html__( 'Search Heading', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Search', 'plumberx' ),
                'condition' => array( 'show_sidebar' => 'yes', 'show_search' => 'yes' ),
            )
        );

        $this->add_control(
            'show_categories',
            array(
                'label'        => esc_html__( 'Show Categories Widget', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'condition'    => array( 'show_sidebar' => 'yes' ),
            )
        );

        $this->add_control(
            'categories_title',
            array(
                'label'     => esc_html__( 'Categories Heading', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Categories', 'plumberx' ),
                'condition' => array( 'show_sidebar' => 'yes', 'show_categories' => 'yes' ),
            )
        );

        $this->add_control(
            'show_recent_news',
            array(
                'label'        => esc_html__( 'Show Recent News Widget', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'condition'    => array( 'show_sidebar' => 'yes' ),
            )
        );

        $this->add_control(
            'recent_news_title',
            array(
                'label'     => esc_html__( 'Recent News Heading', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Recent News', 'plumberx' ),
                'condition' => array( 'show_sidebar' => 'yes', 'show_recent_news' => 'yes' ),
            )
        );

        $this->add_control(
            'show_tags',
            array(
                'label'        => esc_html__( 'Show Tags Widget', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'condition'    => array( 'show_sidebar' => 'yes' ),
            )
        );

        $this->add_control(
            'tags_title',
            array(
                'label'     => esc_html__( 'Tags Heading', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__( 'Tags', 'plumberx' ),
                'condition' => array( 'show_sidebar' => 'yes', 'show_tags' => 'yes' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $posts_per_page = ! empty( $settings['posts_per_page'] ) ? intval( $settings['posts_per_page'] ) : 4;

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged,
            'post_status'    => 'publish',
        );

        $query = new \WP_Query( $args );
        $show_sidebar = ( 'yes' === ( $settings['show_sidebar'] ?? 'yes' ) );
        ?>
        <section class="blog-layout-section">
            <div class="container blog-grid-layout"<?php echo ! $show_sidebar ? ' style="grid-template-columns: 1fr;"' : ''; ?>>
                
                <!-- Main Blog Posts List -->
                <div class="blog-posts-main">
                    <?php
                    if ( $query->have_posts() ) :
                        $idx = 0;
                        while ( $query->have_posts() ) : $query->the_post();
                            $idx++;
                            $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                            if ( empty( $thumb_url ) ) {
                                $thumb_num = ( ( $idx - 1 ) % 4 ) + 1;
                                $thumb_url = PLUMBERX_URI . '/assets/images/blog_main_' . $thumb_num . '.jpg';
                            }
                        ?>
                            <article class="blog-post-card">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="blog-post-featured-img">
                                </a>
                                <div class="blog-post-content">
                                    <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="blog-post-meta">
                                        <span class="blog-date">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:4px;">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <?php echo get_the_date( 'M d, Y' ); ?>
                                        </span>
                                        <span class="blog-author"><?php esc_html_e( 'by', 'plumberx' ); ?> <?php the_author(); ?></span>
                                    </div>
                                    <p class="blog-post-excerpt">
                                        <?php echo wp_trim_words( get_the_excerpt(), 45 ); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'plumberx' ); ?></a>
                                </div>
                            </article>
                        <?php
                        endwhile;

                        if ( 'yes' === ( $settings['show_pagination'] ?? 'yes' ) && $query->max_num_pages > 1 ) :
                            echo '<div class="pagination-wrap" style="margin-top: 20px;">';
                            echo paginate_links( array(
                                'total'     => $query->max_num_pages,
                                'current'   => $paged,
                                'prev_text' => '&laquo; ' . esc_html__( 'Previous', 'plumberx' ),
                                'next_text' => esc_html__( 'Next', 'plumberx' ) . ' &raquo;',
                            ) );
                            echo '</div>';
                        endif;

                        wp_reset_postdata();
                    else :
                    ?>
                        <p><?php esc_html_e( 'No blog posts found.', 'plumberx' ); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Blog Sidebar -->
                <?php if ( $show_sidebar ) : ?>
                    <aside class="blog-sidebar">
                        
                        <!-- Search Widget -->
                        <?php if ( 'yes' === ( $settings['show_search'] ?? 'yes' ) ) : ?>
                            <div class="sidebar-widget">
                                <h4 class="widget-title"><?php echo esc_html( $settings['search_title'] ); ?></h4>
                                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex; gap: 8px;">
                                    <input type="search" name="s" class="form-input" placeholder="<?php esc_attr_e( 'Search keywords...', 'plumberx' ); ?>" required style="padding: 10px 14px;">
                                    <button type="submit" class="btn-quote-submit" style="width: auto; padding: 10px 20px; white-space:nowrap;"><?php esc_html_e( 'Search', 'plumberx' ); ?></button>
                                </form>
                            </div>
                        <?php endif; ?>

                        <!-- Categories Widget -->
                        <?php if ( 'yes' === ( $settings['show_categories'] ?? 'yes' ) ) : ?>
                            <div class="sidebar-widget widget-categories">
                                <h4 class="widget-title"><?php echo esc_html( $settings['categories_title'] ); ?></h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <?php
                                    $categories = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 6 ) );
                                    if ( ! empty( $categories ) ) :
                                        foreach ( $categories as $cat ) :
                                        ?>
                                            <li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">&gt; <?php echo esc_html( $cat->name ); ?></a></li>
                                        <?php
                                        endforeach;
                                    else :
                                    ?>
                                        <li><a href="#">&gt; Installation of Roof</a></li>
                                        <li><a href="#">&gt; Damage Roof</a></li>
                                        <li><a href="#">&gt; Roof Renovation</a></li>
                                        <li><a href="#">&gt; Company Profile</a></li>
                                        <li><a href="#">&gt; Roof Projects</a></li>
                                        <li><a href="#">&gt; Roof Gutter</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Recent News Widget -->
                        <?php if ( 'yes' === ( $settings['show_recent_news'] ?? 'yes' ) ) : ?>
                            <div class="sidebar-widget">
                                <h4 class="widget-title"><?php echo esc_html( $settings['recent_news_title'] ); ?></h4>
                                <div class="recent-news-list">
                                    <?php
                                    $recent_posts = wp_get_recent_posts( array(
                                        'numberposts' => 4,
                                        'post_status' => 'publish',
                                    ) );
                                    if ( ! empty( $recent_posts ) ) :
                                        foreach ( $recent_posts as $r_idx => $recent ) :
                                            $thumb = get_the_post_thumbnail_url( $recent['ID'], 'thumbnail' );
                                            if ( empty( $thumb ) ) {
                                                $thumb = PLUMBERX_URI . '/assets/images/blog_thumb_' . ( ( $r_idx % 4 ) + 1 ) . '.jpg';
                                            }
                                        ?>
                                            <div class="recent-news-item">
                                                <a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>">
                                                    <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $recent['post_title'] ); ?>" class="recent-news-thumb">
                                                </a>
                                                <div class="recent-news-info">
                                                    <h5><a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>"><?php echo esc_html( $recent['post_title'] ); ?></a></h5>
                                                    <span><?php echo get_the_date( 'd M. Y', $recent['ID'] ); ?></span>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                        wp_reset_query();
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Tags Widget -->
                        <?php if ( 'yes' === ( $settings['show_tags'] ?? 'yes' ) ) : ?>
                            <div class="sidebar-widget">
                                <h4 class="widget-title"><?php echo esc_html( $settings['tags_title'] ); ?></h4>
                                <div class="widget-tags">
                                    <?php
                                    $tags = get_tags( array( 'number' => 6 ) );
                                    if ( ! empty( $tags ) ) :
                                        foreach ( $tags as $t_idx => $tag ) :
                                            $active_class = ( 0 === $t_idx ) ? ' active' : '';
                                        ?>
                                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-btn<?php echo esc_attr( $active_class ); ?>"><?php echo esc_html( $tag->name ); ?></a>
                                        <?php
                                        endforeach;
                                    else :
                                    ?>
                                        <a href="#" class="tag-btn active">Roofing</a>
                                        <a href="#" class="tag-btn">Clean</a>
                                        <a href="#" class="tag-btn">Water</a>
                                        <a href="#" class="tag-btn">Plumber</a>
                                        <a href="#" class="tag-btn">Pipe</a>
                                        <a href="#" class="tag-btn">Repair</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </aside>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}
