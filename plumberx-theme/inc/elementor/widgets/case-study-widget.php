<?php
/**
 * Elementor Widget: PlumberX Case Study Details
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Case_Study_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_case_study';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Case Study Details', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Section: Content Details
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__( 'Case Study Content', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'desc_title',
            array(
                'label'   => esc_html__( 'Description Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Project Description', 'plumberx' ),
            )
        );

        $this->add_control(
            'desc_text_1',
            array(
                'label'   => esc_html__( 'Description Paragraph 1', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore veritatis et quasi architecto. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
            )
        );

        $this->add_control(
            'desc_text_2',
            array(
                'label'   => esc_html__( 'Description Paragraph 2', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            )
        );

        $this->add_control(
            'challenge_title',
            array(
                'label'   => esc_html__( 'Challenge Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'The Challenge in Installation', 'plumberx' ),
            )
        );

        $this->add_control(
            'challenge_text_1',
            array(
                'label'   => esc_html__( 'Challenge Paragraph 1', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            )
        );

        $this->add_control(
            'challenge_text_2',
            array(
                'label'   => esc_html__( 'Challenge Paragraph 2', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco proident, sunt in culpa qui officia deserunt mollit anim id est laborum. aliqua. Ut enim ad minim veniam, quis nostrud exercitation.',
            )
        );

        $this->add_control(
            'quote_text',
            array(
                'label'   => esc_html__( 'Testimonial Quote', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non dolore magna aliqua. Ut enim ad minim veniam, quis in',
            )
        );

        $this->add_control(
            'quote_author',
            array(
                'label'   => esc_html__( 'Quote Author', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Micale John, Client', 'plumberx' ),
            )
        );

        $this->add_control(
            'final_title',
            array(
                'label'   => esc_html__( 'Final View Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'The Final View of Project', 'plumberx' ),
            )
        );

        $this->add_control(
            'final_text',
            array(
                'label'   => esc_html__( 'Final View Paragraph', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco proident, sunt in culpa qui officia deserunt mollit.',
            )
        );

        $this->end_controls_section();

        // Section: Visual Progress Images
        $this->start_controls_section(
            'images_section',
            array(
                'label' => esc_html__( 'Case Study Images', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'img_top',
            array(
                'label'   => esc_html__( 'Top Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/case_study_1.jpg',
                ),
            )
        );

        $this->add_control(
            'alt_top',
            array(
                'label'   => esc_html__( 'Top Image Alt Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Minimalist Bathroom Installation', 'plumberx' ),
            )
        );

        $this->add_control(
            'img_mid_1',
            array(
                'label'   => esc_html__( 'Middle Image 1 (Left)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/case_study_2.jpg',
                ),
            )
        );

        $this->add_control(
            'alt_mid_1',
            array(
                'label'   => esc_html__( 'Middle Image 1 Alt Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Luxury Vanity Cabinet Work', 'plumberx' ),
            )
        );

        $this->add_control(
            'img_mid_2',
            array(
                'label'   => esc_html__( 'Middle Image 2 (Right)', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/case_study_3.jpg',
                ),
            )
        );

        $this->add_control(
            'alt_mid_2',
            array(
                'label'   => esc_html__( 'Middle Image 2 Alt Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Natural Stone Bathroom Bathtub', 'plumberx' ),
            )
        );

        $this->add_control(
            'img_bottom',
            array(
                'label'   => esc_html__( 'Bottom Image', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/case_study_4.jpg',
                ),
            )
        );

        $this->add_control(
            'alt_bottom',
            array(
                'label'   => esc_html__( 'Bottom Image Alt Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Finished Modern Blue Bathroom Project', 'plumberx' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $img_top_url = ! empty( $settings['img_top']['url'] ) ? $settings['img_top']['url'] : PLUMBERX_URI . '/assets/images/case_study_1.jpg';
        $alt_top     = ! empty( $settings['alt_top'] ) ? $settings['alt_top'] : 'Minimalist Bathroom Installation';

        $img_mid_1_url = ! empty( $settings['img_mid_1']['url'] ) ? $settings['img_mid_1']['url'] : PLUMBERX_URI . '/assets/images/case_study_2.jpg';
        $alt_mid_1     = ! empty( $settings['alt_mid_1'] ) ? $settings['alt_mid_1'] : 'Luxury Vanity Cabinet Work';

        $img_mid_2_url = ! empty( $settings['img_mid_2']['url'] ) ? $settings['img_mid_2']['url'] : PLUMBERX_URI . '/assets/images/case_study_3.jpg';
        $alt_mid_2     = ! empty( $settings['alt_mid_2'] ) ? $settings['alt_mid_2'] : 'Natural Stone Bathroom Bathtub';

        $img_bot_url = ! empty( $settings['img_bottom']['url'] ) ? $settings['img_bottom']['url'] : PLUMBERX_URI . '/assets/images/case_study_4.jpg';
        $alt_bottom  = ! empty( $settings['alt_bottom'] ) ? $settings['alt_bottom'] : 'Finished Modern Blue Bathroom Project';
        ?>
        <section class="case-study-section">
            <div class="container">
                <div class="case-study-grid">
                    
                    <!-- Left Column: Story & Details -->
                    <div class="case-study-content">
                        <?php if ( ! empty( $settings['desc_title'] ) ) : ?>
                            <h3><?php echo esc_html( $settings['desc_title'] ); ?></h3>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $settings['desc_text_1'] ) ) : ?>
                            <p><?php echo esc_html( $settings['desc_text_1'] ); ?></p>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['desc_text_2'] ) ) : ?>
                            <p><?php echo esc_html( $settings['desc_text_2'] ); ?></p>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['challenge_title'] ) ) : ?>
                            <h3 style="margin-top: 35px;"><?php echo esc_html( $settings['challenge_title'] ); ?></h3>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['challenge_text_1'] ) ) : ?>
                            <p><?php echo esc_html( $settings['challenge_text_1'] ); ?></p>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['challenge_text_2'] ) ) : ?>
                            <p><?php echo esc_html( $settings['challenge_text_2'] ); ?></p>
                        <?php endif; ?>

                        <!-- Testimonial Quote Box -->
                        <?php if ( ! empty( $settings['quote_text'] ) ) : ?>
                            <div class="case-quote-box">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#38bdf8" style="margin-bottom: 8px;">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                                <p><?php echo esc_html( $settings['quote_text'] ); ?></p>
                                <?php if ( ! empty( $settings['quote_author'] ) ) : ?>
                                    <span class="case-quote-author"><?php echo esc_html( $settings['quote_author'] ); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['final_title'] ) ) : ?>
                            <h3 style="margin-top: 35px;"><?php echo esc_html( $settings['final_title'] ); ?></h3>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['final_text'] ) ) : ?>
                            <p><?php echo esc_html( $settings['final_text'] ); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Right Column: Visual Progress Images -->
                    <div class="case-study-images-col">
                        <div class="case-img-top">
                            <img src="<?php echo esc_url( $img_top_url ); ?>" alt="<?php echo esc_attr( $alt_top ); ?>">
                        </div>
                        <div class="case-img-middle">
                            <img src="<?php echo esc_url( $img_mid_1_url ); ?>" alt="<?php echo esc_attr( $alt_mid_1 ); ?>">
                            <img src="<?php echo esc_url( $img_mid_2_url ); ?>" alt="<?php echo esc_attr( $alt_mid_2 ); ?>">
                        </div>
                        <div class="case-img-bottom">
                            <img src="<?php echo esc_url( $img_bot_url ); ?>" alt="<?php echo esc_attr( $alt_bottom ); ?>">
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php
    }
}
