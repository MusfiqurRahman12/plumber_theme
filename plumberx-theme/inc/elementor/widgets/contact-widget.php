<?php
/**
 * Elementor Widget: PlumberX Contact Section
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Contact_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_contact';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Contact Form & Info', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        // Intro Text Section
        $this->start_controls_section(
            'intro_section',
            array(
                'label' => esc_html__( 'Intro Header', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'intro_text',
            array(
                'label'       => esc_html__( 'Intro Text', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'You can talk to our online representative at any time. Please use our Live Chat System on our website or Fill up below instant messaging programs. Please be patient, We will get back to you.',
                'label_block' => true,
            )
        );

        $this->add_control(
            'highlight_text',
            array(
                'label'       => esc_html__( 'Highlight Phone / Note', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Our 24/7 Support, General Inquireies Phone: + 1800 654 321',
                'label_block' => true,
            )
        );

        $this->end_controls_section();

        // Contact Info Section
        $this->start_controls_section(
            'info_section',
            array(
                'label' => esc_html__( 'Contact Information', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'info_title',
            array(
                'label'   => esc_html__( 'Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Contact info', 'plumberx' ),
            )
        );

        $this->add_control(
            'info_subtitle',
            array(
                'label'       => esc_html__( 'Subtitle', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Have any Queries? Let us know. We will clear it for you at the best.',
                'label_block' => true,
            )
        );

        // Office
        $this->add_control(
            'office_label',
            array(
                'label'   => esc_html__( 'Office Label', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Office',
            )
        );
        $this->add_control(
            'office_value',
            array(
                'label'   => esc_html__( 'Office Address', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "Plumberx Company, 215, Mallin Street\nNew Youk, NY 100 254",
            )
        );

        // Email
        $this->add_control(
            'email_label',
            array(
                'label'   => esc_html__( 'Email Label', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Email :',
            )
        );
        $this->add_control(
            'email_value',
            array(
                'label'   => esc_html__( 'Email Addresses', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "contact@plumberx.com\ninfo@plumberx.com",
            )
        );

        // Phone
        $this->add_control(
            'phone_label',
            array(
                'label'   => esc_html__( 'Phone Label', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Phone :',
            )
        );
        $this->add_control(
            'phone_value',
            array(
                'label'   => esc_html__( 'Phone Numbers', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "+0120 123 4 56 789\n+0120 987 65419",
            )
        );

        $this->end_controls_section();

        // Form Settings
        $this->start_controls_section(
            'form_section',
            array(
                'label' => esc_html__( 'Form Settings', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'button_text',
            array(
                'label'   => esc_html__( 'Submit Button Text', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SUBMIT NOW',
            )
        );

        $this->add_control(
            'shortcode',
            array(
                'label'       => esc_html__( 'Custom Form Shortcode (CF7 / WPForms)', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '[contact-form-7 id="..."]',
                'description' => esc_html__( 'Leave empty to use the built-in responsive styled form.', 'plumberx' ),
            )
        );

        $this->end_controls_section();

        // Map Section
        $this->start_controls_section(
            'map_section',
            array(
                'label' => esc_html__( 'Map Display', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_map',
            array(
                'label'        => esc_html__( 'Show Map', 'plumberx' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'map_image',
            array(
                'label'     => esc_html__( 'Map Graphic / Image', 'plumberx' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => array(
                    'url' => PLUMBERX_URI . '/assets/images/contact_map.jpg',
                ),
                'condition' => array( 'show_map' => 'yes' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $map_url = '';
        if ( ! empty( $settings['map_image']['url'] ) ) {
            $map_url = $settings['map_image']['url'];
        } elseif ( ! empty( $settings['map_image']['id'] ) ) {
            $map_url = wp_get_attachment_image_url( $settings['map_image']['id'], 'full' );
        }
        if ( empty( $map_url ) ) {
            $map_url = PLUMBERX_URI . '/assets/images/contact_map.jpg';
        }
        ?>
        <section class="contact-section">
            <div class="container">
                
                <?php if ( ! empty( $settings['intro_text'] ) || ! empty( $settings['highlight_text'] ) ) : ?>
                    <p class="contact-intro-text">
                        <?php echo esc_html( $settings['intro_text'] ); ?>
                        <?php if ( ! empty( $settings['highlight_text'] ) ) : ?>
                            <span class="contact-intro-highlight"><?php echo esc_html( $settings['highlight_text'] ); ?></span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>

                <div class="contact-grid">
                    
                    <!-- Left: Form -->
                    <div class="contact-form-col">
                        <?php if ( ! empty( $settings['shortcode'] ) ) : ?>
                            <?php echo do_shortcode( $settings['shortcode'] ); ?>
                        <?php else : ?>
                            <form onsubmit="event.preventDefault(); if (typeof showToast === 'function') { showToast('Thank you! Your message has been sent successfully.'); } else { alert('Thank you! Your message has been sent successfully.'); } this.reset();">
                                <div class="form-group">
                                    <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'Name', 'plumberx' ); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-input" placeholder="<?php esc_attr_e( 'Email', 'plumberx' ); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-input" placeholder="<?php esc_attr_e( 'Phone Number', 'plumberx' ); ?>" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-input" rows="6" placeholder="<?php esc_attr_e( 'Message', 'plumberx' ); ?>" required></textarea>
                                </div>
                                <button type="submit" class="btn-quote-submit" style="width: auto; padding: 14px 40px; font-weight: 700; letter-spacing: 0.5px;">
                                    <?php echo esc_html( $settings['button_text'] ); ?>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <!-- Right: Contact Info -->
                    <div class="contact-info-col">
                        <?php if ( ! empty( $settings['info_title'] ) ) : ?>
                            <h3><?php echo esc_html( $settings['info_title'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $settings['info_subtitle'] ) ) : ?>
                            <p><?php echo esc_html( $settings['info_subtitle'] ); ?></p>
                        <?php endif; ?>

                        <div class="contact-detail-list">
                            <!-- Office -->
                            <?php if ( ! empty( $settings['office_value'] ) ) : ?>
                                <div class="contact-detail-item">
                                    <div class="contact-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                    </div>
                                    <div class="contact-detail-text">
                                        <h4><?php echo esc_html( $settings['office_label'] ); ?></h4>
                                        <p><?php echo nl2br( esc_html( $settings['office_value'] ) ); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Email -->
                            <?php if ( ! empty( $settings['email_value'] ) ) : ?>
                                <div class="contact-detail-item">
                                    <div class="contact-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                    </div>
                                    <div class="contact-detail-text">
                                        <h4><?php echo esc_html( $settings['email_label'] ); ?></h4>
                                        <p><?php echo nl2br( esc_html( $settings['email_value'] ) ); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Phone -->
                            <?php if ( ! empty( $settings['phone_value'] ) ) : ?>
                                <div class="contact-detail-item">
                                    <div class="contact-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </div>
                                    <div class="contact-detail-text">
                                        <h4><?php echo esc_html( $settings['phone_label'] ); ?></h4>
                                        <p><?php echo nl2br( esc_html( $settings['phone_value'] ) ); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <!-- Map Display -->
                <?php if ( 'yes' === ( $settings['show_map'] ?? 'yes' ) ) : ?>
                    <div class="contact-map-wrap">
                        <img src="<?php echo esc_url( $map_url ); ?>" alt="<?php esc_attr_e( 'PlumberX Service Coverage Map New York', 'plumberx' ); ?>">
                    </div>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}
