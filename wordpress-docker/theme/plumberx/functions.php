<?php
/**
 * PlumberX Theme Functions
 *
 * @package PlumberX
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'PLUMBERX_VERSION', '1.0.1' );
define( 'PLUMBERX_DIR', get_template_directory() );
define( 'PLUMBERX_URI', get_template_directory_uri() );

/*---------------------------------------------
 * 1. THEME SETUP
 *---------------------------------------------*/
function plumberx_setup() {
    // Title tag support
    add_theme_support( 'title-tag' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'plumberx-project', 600, 450, true );
    add_image_size( 'plumberx-blog', 720, 480, true );
    add_image_size( 'plumberx-team', 400, 500, true );
    add_image_size( 'plumberx-testimonial', 80, 80, true );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ) );

    // WooCommerce support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'plumberx' ),
        'footer'  => __( 'Footer Menu', 'plumberx' ),
    ) );

    // Elementor Pro header/footer support
    add_theme_support( 'elementor' );

    // Wide/full alignment for Gutenberg
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'plumberx_setup' );

/*---------------------------------------------
 * 2. ENQUEUE STYLES & SCRIPTS
 *---------------------------------------------*/
function plumberx_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style( 'plumberx-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap', array(), null );

    // Main theme CSS (from static design)
    wp_enqueue_style( 'plumberx-main', PLUMBERX_URI . '/assets/css/style.css', array(), PLUMBERX_VERSION );

    // Theme stylesheet (WP required)
    wp_enqueue_style( 'plumberx-style', get_stylesheet_uri(), array( 'plumberx-main' ), PLUMBERX_VERSION );

    // Main JS
    wp_enqueue_script( 'plumberx-main-js', PLUMBERX_URI . '/assets/js/main.js', array(), PLUMBERX_VERSION, true );

    // Localize script for AJAX
    wp_localize_script( 'plumberx-main-js', 'plumberxAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'plumberx_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'plumberx_enqueue_assets' );

/*---------------------------------------------
 * 3. REGISTER WIDGET AREAS
 *---------------------------------------------*/
function plumberx_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'plumberx' ),
        'id'            => 'blog-sidebar',
        'description'   => __( 'Sidebar for blog pages.', 'plumberx' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 1', 'plumberx' ),
        'id'            => 'footer-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-col-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 2', 'plumberx' ),
        'id'            => 'footer-2',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-col-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'plumberx_widgets_init' );

/*---------------------------------------------
 * 4. CUSTOM POST TYPES
 *---------------------------------------------*/
function plumberx_register_cpts() {
    // Services CPT
    register_post_type( 'plumberx_service', array(
        'labels' => array(
            'name'               => __( 'Services', 'plumberx' ),
            'singular_name'      => __( 'Service', 'plumberx' ),
            'add_new'            => __( 'Add New Service', 'plumberx' ),
            'add_new_item'       => __( 'Add New Service', 'plumberx' ),
            'edit_item'          => __( 'Edit Service', 'plumberx' ),
            'all_items'          => __( 'All Services', 'plumberx' ),
            'menu_name'          => __( 'Services', 'plumberx' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'service' ),
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    ) );

    // Projects CPT
    register_post_type( 'plumberx_project', array(
        'labels' => array(
            'name'               => __( 'Projects', 'plumberx' ),
            'singular_name'      => __( 'Project', 'plumberx' ),
            'add_new'            => __( 'Add New Project', 'plumberx' ),
            'add_new_item'       => __( 'Add New Project', 'plumberx' ),
            'edit_item'          => __( 'Edit Project', 'plumberx' ),
            'all_items'          => __( 'All Projects', 'plumberx' ),
            'menu_name'          => __( 'Projects', 'plumberx' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'project' ),
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    ) );

    // Testimonials CPT
    register_post_type( 'plumberx_testimonial', array(
        'labels' => array(
            'name'               => __( 'Testimonials', 'plumberx' ),
            'singular_name'      => __( 'Testimonial', 'plumberx' ),
            'add_new'            => __( 'Add New Testimonial', 'plumberx' ),
            'add_new_item'       => __( 'Add New Testimonial', 'plumberx' ),
            'edit_item'          => __( 'Edit Testimonial', 'plumberx' ),
            'all_items'          => __( 'All Testimonials', 'plumberx' ),
            'menu_name'          => __( 'Testimonials', 'plumberx' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'show_in_rest'       => true,
    ) );

    // Team Members CPT
    register_post_type( 'plumberx_team', array(
        'labels' => array(
            'name'               => __( 'Team Members', 'plumberx' ),
            'singular_name'      => __( 'Team Member', 'plumberx' ),
            'add_new'            => __( 'Add New Team Member', 'plumberx' ),
            'add_new_item'       => __( 'Add New Team Member', 'plumberx' ),
            'edit_item'          => __( 'Edit Team Member', 'plumberx' ),
            'all_items'          => __( 'All Team Members', 'plumberx' ),
            'menu_name'          => __( 'Team', 'plumberx' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'team' ),
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail', 'custom-fields' ),
        'show_in_rest'       => true,
    ) );

    // Partner Brands CPT
    register_post_type( 'plumberx_partner', array(
        'labels' => array(
            'name'               => __( 'Partners', 'plumberx' ),
            'singular_name'      => __( 'Partner', 'plumberx' ),
            'add_new'            => __( 'Add New Partner', 'plumberx' ),
            'menu_name'          => __( 'Partners', 'plumberx' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'partners' ),
        'menu_icon'          => 'dashicons-networking',
        'supports'           => array( 'title', 'thumbnail', 'custom-fields' ),
        'show_in_rest'       => true,
    ) );

    // Project Categories Taxonomy
    register_taxonomy( 'project_category', 'plumberx_project', array(
        'labels' => array(
            'name'          => __( 'Project Categories', 'plumberx' ),
            'singular_name' => __( 'Project Category', 'plumberx' ),
        ),
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'project-category' ),
        'show_in_rest' => true,
    ) );

    // Service Categories Taxonomy
    register_taxonomy( 'service_category', 'plumberx_service', array(
        'labels' => array(
            'name'          => __( 'Service Categories', 'plumberx' ),
            'singular_name' => __( 'Service Category', 'plumberx' ),
        ),
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'service-category' ),
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'plumberx_register_cpts' );

/*---------------------------------------------
 * 5. CUSTOM META BOXES (Simple, no ACF required)
 *---------------------------------------------*/
function plumberx_add_meta_boxes() {
    // Testimonial meta fields
    add_meta_box( 'plumberx_testimonial_meta', 'Testimonial Details', 'plumberx_testimonial_meta_cb', 'plumberx_testimonial', 'normal', 'high' );

    // Team member meta fields
    add_meta_box( 'plumberx_team_meta', 'Team Member Details', 'plumberx_team_meta_cb', 'plumberx_team', 'normal', 'high' );

    // Service meta fields
    add_meta_box( 'plumberx_service_meta', 'Service Details', 'plumberx_service_meta_cb', 'plumberx_service', 'normal', 'high' );

    // Partner meta fields
    add_meta_box( 'plumberx_partner_meta', 'Partner Details', 'plumberx_partner_meta_cb', 'plumberx_partner', 'normal', 'high' );

    // Project meta fields
    add_meta_box( 'plumberx_project_meta', 'Project Details', 'plumberx_project_meta_cb', 'plumberx_project', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'plumberx_add_meta_boxes' );

// Testimonial Meta Box Callback
function plumberx_testimonial_meta_cb( $post ) {
    wp_nonce_field( 'plumberx_testimonial_nonce', 'plumberx_testimonial_nonce_field' );
    $service_type = get_post_meta( $post->ID, '_testimonial_service_type', true );
    $rating       = get_post_meta( $post->ID, '_testimonial_rating', true ) ?: '5';
    $location     = get_post_meta( $post->ID, '_testimonial_location', true );
    $verified     = get_post_meta( $post->ID, '_testimonial_verified', true );
    $badge_text   = get_post_meta( $post->ID, '_testimonial_badge_text', true ) ?: 'Verified Customer';
    ?>
    <table class="form-table">
        <tr><th><label for="testimonial_service_type">Service Type</label></th>
            <td><input type="text" id="testimonial_service_type" name="testimonial_service_type" value="<?php echo esc_attr( $service_type ); ?>" class="regular-text" placeholder="e.g., Emergency Pipe Repair"></td></tr>
        <tr><th><label for="testimonial_rating">Rating (1-5)</label></th>
            <td><select id="testimonial_rating" name="testimonial_rating">
                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                    <option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?> Star<?php echo $i > 1 ? 's' : ''; ?></option>
                <?php endfor; ?>
            </select></td></tr>
        <tr><th><label for="testimonial_location">Location</label></th>
            <td><input type="text" id="testimonial_location" name="testimonial_location" value="<?php echo esc_attr( $location ); ?>" class="regular-text" placeholder="e.g., Austin, TX"></td></tr>
        <tr><th><label for="testimonial_verified">Verified</label></th>
            <td><label><input type="checkbox" id="testimonial_verified" name="testimonial_verified" value="1" <?php checked( $verified, '1' ); ?>> Mark as verified</label></td></tr>
        <tr><th><label for="testimonial_badge_text">Badge Text</label></th>
            <td><input type="text" id="testimonial_badge_text" name="testimonial_badge_text" value="<?php echo esc_attr( $badge_text ); ?>" class="regular-text" placeholder="e.g., Verified Customer"></td></tr>
    </table>
    <?php
}

// Team Meta Box Callback
function plumberx_team_meta_cb( $post ) {
    wp_nonce_field( 'plumberx_team_nonce', 'plumberx_team_nonce_field' );
    $role      = get_post_meta( $post->ID, '_team_role', true );
    $facebook  = get_post_meta( $post->ID, '_team_facebook', true );
    $twitter   = get_post_meta( $post->ID, '_team_twitter', true );
    $linkedin  = get_post_meta( $post->ID, '_team_linkedin', true );
    ?>
    <table class="form-table">
        <tr><th><label for="team_role">Job Role / Title</label></th>
            <td><input type="text" id="team_role" name="team_role" value="<?php echo esc_attr( $role ); ?>" class="regular-text" placeholder="e.g., Plumbing Mechanic"></td></tr>
        <tr><th><label for="team_facebook">Facebook URL</label></th>
            <td><input type="url" id="team_facebook" name="team_facebook" value="<?php echo esc_url( $facebook ); ?>" class="regular-text"></td></tr>
        <tr><th><label for="team_twitter">Twitter URL</label></th>
            <td><input type="url" id="team_twitter" name="team_twitter" value="<?php echo esc_url( $twitter ); ?>" class="regular-text"></td></tr>
        <tr><th><label for="team_linkedin">LinkedIn URL</label></th>
            <td><input type="url" id="team_linkedin" name="team_linkedin" value="<?php echo esc_url( $linkedin ); ?>" class="regular-text"></td></tr>
    </table>
    <?php
}

// Service Meta Box Callback
function plumberx_service_meta_cb( $post ) {
    wp_nonce_field( 'plumberx_service_nonce', 'plumberx_service_nonce_field' );
    $checklist = get_post_meta( $post->ID, '_service_checklist', true );
    $icon      = get_post_meta( $post->ID, '_service_icon', true );
    ?>
    <table class="form-table">
        <tr><th><label for="service_icon">Icon (CSS class or SVG)</label></th>
            <td><input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr( $icon ); ?>" class="regular-text" placeholder="e.g., dashicons-admin-tools"></td></tr>
        <tr><th><label for="service_checklist">Checklist Items (one per line)</label></th>
            <td><textarea id="service_checklist" name="service_checklist" rows="6" class="large-text" placeholder="Diagnosis and Check-ups&#10;Installations and Upgrades&#10;System Maintenance"><?php echo esc_textarea( $checklist ); ?></textarea></td></tr>
    </table>
    <?php
}

// Partner Meta Box Callback
function plumberx_partner_meta_cb( $post ) {
    wp_nonce_field( 'plumberx_partner_nonce', 'plumberx_partner_nonce_field' );
    $tagline = get_post_meta( $post->ID, '_partner_tagline', true );
    ?>
    <table class="form-table">
        <tr><th><label for="partner_tagline">Brand Tagline</label></th>
            <td><input type="text" id="partner_tagline" name="partner_tagline" value="<?php echo esc_attr( $tagline ); ?>" class="regular-text" placeholder="e.g., THE BOLD LOOK"></td></tr>
    </table>
    <?php
}

// Project Meta Box Callback
function plumberx_project_meta_cb( $post ) {
    wp_nonce_field( 'plumberx_project_nonce', 'plumberx_project_nonce_field' );
    $subtitle = get_post_meta( $post->ID, '_project_subtitle', true );
    ?>
    <table class="form-table">
        <tr><th><label for="project_subtitle">Subtitle / Category Label</label></th>
            <td><input type="text" id="project_subtitle" name="project_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" class="regular-text" placeholder="e.g., Commercial Plumbing"></td></tr>
    </table>
    <?php
}

/*---------------------------------------------
 * 6. SAVE META BOXES
 *---------------------------------------------*/
function plumberx_save_meta_boxes( $post_id ) {
    // Testimonial
    if ( isset( $_POST['plumberx_testimonial_nonce_field'] ) && wp_verify_nonce( $_POST['plumberx_testimonial_nonce_field'], 'plumberx_testimonial_nonce' ) ) {
        update_post_meta( $post_id, '_testimonial_service_type', sanitize_text_field( $_POST['testimonial_service_type'] ?? '' ) );
        update_post_meta( $post_id, '_testimonial_rating', sanitize_text_field( $_POST['testimonial_rating'] ?? '5' ) );
        update_post_meta( $post_id, '_testimonial_location', sanitize_text_field( $_POST['testimonial_location'] ?? '' ) );
        update_post_meta( $post_id, '_testimonial_verified', isset( $_POST['testimonial_verified'] ) ? '1' : '0' );
        update_post_meta( $post_id, '_testimonial_badge_text', sanitize_text_field( $_POST['testimonial_badge_text'] ?? 'Verified Customer' ) );
    }

    // Team
    if ( isset( $_POST['plumberx_team_nonce_field'] ) && wp_verify_nonce( $_POST['plumberx_team_nonce_field'], 'plumberx_team_nonce' ) ) {
        update_post_meta( $post_id, '_team_role', sanitize_text_field( $_POST['team_role'] ?? '' ) );
        update_post_meta( $post_id, '_team_facebook', esc_url_raw( $_POST['team_facebook'] ?? '' ) );
        update_post_meta( $post_id, '_team_twitter', esc_url_raw( $_POST['team_twitter'] ?? '' ) );
        update_post_meta( $post_id, '_team_linkedin', esc_url_raw( $_POST['team_linkedin'] ?? '' ) );
    }

    // Service
    if ( isset( $_POST['plumberx_service_nonce_field'] ) && wp_verify_nonce( $_POST['plumberx_service_nonce_field'], 'plumberx_service_nonce' ) ) {
        update_post_meta( $post_id, '_service_icon', sanitize_text_field( $_POST['service_icon'] ?? '' ) );
        update_post_meta( $post_id, '_service_checklist', sanitize_textarea_field( $_POST['service_checklist'] ?? '' ) );
    }

    // Partner
    if ( isset( $_POST['plumberx_partner_nonce_field'] ) && wp_verify_nonce( $_POST['plumberx_partner_nonce_field'], 'plumberx_partner_nonce' ) ) {
        update_post_meta( $post_id, '_partner_tagline', sanitize_text_field( $_POST['partner_tagline'] ?? '' ) );
    }

    // Project
    if ( isset( $_POST['plumberx_project_nonce_field'] ) && wp_verify_nonce( $_POST['plumberx_project_nonce_field'], 'plumberx_project_nonce' ) ) {
        update_post_meta( $post_id, '_project_subtitle', sanitize_text_field( $_POST['project_subtitle'] ?? '' ) );
    }
}
add_action( 'save_post', 'plumberx_save_meta_boxes' );

/*---------------------------------------------
 * 7. THEME CUSTOMIZER
 *---------------------------------------------*/
function plumberx_customizer( $wp_customize ) {
    // == Site Identity Section (already exists) ==

    // == Contact Info Panel ==
    $wp_customize->add_section( 'plumberx_contact', array(
        'title'    => __( 'Contact Information', 'plumberx' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'plumberx_phone', array( 'default' => '(1800) 456 7890', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_phone', array( 'label' => __( 'Phone Number', 'plumberx' ), 'section' => 'plumberx_contact', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_emergency_phone', array( 'default' => '01865 524 8503', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_emergency_phone', array( 'label' => __( 'Emergency Phone', 'plumberx' ), 'section' => 'plumberx_contact', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_address', array( 'default' => 'Plumberx Company Inc. 3648, Rorance Road, New York, SC 29170', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_address', array( 'label' => __( 'Address', 'plumberx' ), 'section' => 'plumberx_contact', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'plumberx_license', array( 'default' => 'license #M-201874', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_license', array( 'label' => __( 'License Number', 'plumberx' ), 'section' => 'plumberx_contact', 'type' => 'text' ) );

    // == Hero Section ==
    $wp_customize->add_section( 'plumberx_hero', array(
        'title'    => __( 'Hero Section', 'plumberx' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'plumberx_hero_subtitle', array( 'default' => 'Expertise', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_hero_subtitle', array( 'label' => __( 'Hero Subtitle', 'plumberx' ), 'section' => 'plumberx_hero', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_hero_title', array( 'default' => 'You Can Trust', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_hero_title', array( 'label' => __( 'Hero Title', 'plumberx' ), 'section' => 'plumberx_hero', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_hero_desc', array( 'default' => 'Our plumbing professionals are thoroughly trained to assess the situation and effectively respond in a way that treats the source of the problems.', 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'plumberx_hero_desc', array( 'label' => __( 'Hero Description', 'plumberx' ), 'section' => 'plumberx_hero', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'plumberx_hero_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumberx_hero_image', array( 'label' => __( 'Hero Plumber Image', 'plumberx' ), 'section' => 'plumberx_hero' ) ) );

    // == Promo Strip ==
    $wp_customize->add_section( 'plumberx_promo', array(
        'title'    => __( 'Promo Strip', 'plumberx' ),
        'priority' => 36,
    ) );

    $wp_customize->add_setting( 'plumberx_promo_title', array( 'default' => 'Schedule Repair Service & Save $25', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_promo_title', array( 'label' => __( 'Promo Title', 'plumberx' ), 'section' => 'plumberx_promo', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_promo_text', array( 'default' => 'We service all plumbing leaks and clogs and we are available 24/7', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_promo_text', array( 'label' => __( 'Promo Subtext', 'plumberx' ), 'section' => 'plumberx_promo', 'type' => 'text' ) );

    // == Coupon Section ==
    $wp_customize->add_section( 'plumberx_coupon', array(
        'title'    => __( 'Coupon Section', 'plumberx' ),
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'plumberx_coupon_title', array( 'default' => '$35 Off Service Call', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_coupon_title', array( 'label' => __( 'Coupon Title', 'plumberx' ), 'section' => 'plumberx_coupon', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_coupon_subtitle', array( 'default' => 'Cannot be combined with any other offer', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_coupon_subtitle', array( 'label' => __( 'Coupon Subtitle', 'plumberx' ), 'section' => 'plumberx_coupon', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_coupon_note', array( 'default' => 'Must present coupon at time of service.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_coupon_note', array( 'label' => __( 'Coupon Note', 'plumberx' ), 'section' => 'plumberx_coupon', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_coupon_tag', array( 'default' => 'For new clients only', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_coupon_tag', array( 'label' => __( 'Coupon Tag', 'plumberx' ), 'section' => 'plumberx_coupon', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_coupon_expire', array( 'default' => '01.05.2026', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_coupon_expire', array( 'label' => __( 'Coupon Expiration', 'plumberx' ), 'section' => 'plumberx_coupon', 'type' => 'text' ) );

    // == Emergency Banner ==
    $wp_customize->add_section( 'plumberx_emergency', array(
        'title'    => __( 'Emergency Banner', 'plumberx' ),
        'priority' => 45,
    ) );

    $wp_customize->add_setting( 'plumberx_emergency_title', array( 'default' => 'Emergency Leaks & Pipe Bursts', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_emergency_title', array( 'label' => __( 'Emergency Title', 'plumberx' ), 'section' => 'plumberx_emergency', 'type' => 'text' ) );

    $wp_customize->add_setting( 'plumberx_emergency_text', array( 'default' => 'If you have an emergency plumbing need, simply call our 24 hour emergency plumbing', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_emergency_text', array( 'label' => __( 'Emergency Subtext', 'plumberx' ), 'section' => 'plumberx_emergency', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'plumberx_emergency_plumber_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumberx_emergency_plumber_img', array( 'label' => __( 'Emergency Plumber Image', 'plumberx' ), 'section' => 'plumberx_emergency' ) ) );

    $wp_customize->add_setting( 'plumberx_emergency_wrench_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumberx_emergency_wrench_img', array( 'label' => __( 'Emergency Wrench Image', 'plumberx' ), 'section' => 'plumberx_emergency' ) ) );

    // == Social Links ==
    $wp_customize->add_section( 'plumberx_social', array(
        'title'    => __( 'Social Links', 'plumberx' ),
        'priority' => 50,
    ) );

    foreach ( array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' ) as $social ) {
        $wp_customize->add_setting( "plumberx_{$social}", array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "plumberx_{$social}", array( 'label' => ucfirst( $social ) . ' URL', 'section' => 'plumberx_social', 'type' => 'url' ) );
    }

    // == Footer Settings ==
    $wp_customize->add_section( 'plumberx_footer', array(
        'title'    => __( 'Footer Settings', 'plumberx' ),
        'priority' => 55,
    ) );

    $wp_customize->add_setting( 'plumberx_footer_badge_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumberx_footer_badge_img', array( 'label' => __( 'Footer Badge Image', 'plumberx' ), 'section' => 'plumberx_footer' ) ) );

    $wp_customize->add_setting( 'plumberx_footer_cards_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumberx_footer_cards_img', array( 'label' => __( 'Payment Cards Image', 'plumberx' ), 'section' => 'plumberx_footer' ) ) );

    $wp_customize->add_setting( 'plumberx_footer_plumber_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumberx_footer_plumber_img', array( 'label' => __( 'Footer Plumber Image', 'plumberx' ), 'section' => 'plumberx_footer' ) ) );

    $wp_customize->add_setting( 'plumberx_footer_copyright', array( 'default' => '© 2026 PlumberX. All Rights Reserved.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'plumberx_footer_copyright', array( 'label' => __( 'Copyright Text', 'plumberx' ), 'section' => 'plumberx_footer', 'type' => 'text' ) );
}
add_action( 'customize_register', 'plumberx_customizer' );

/*---------------------------------------------
 * 8. ELEMENTOR SUPPORT
 *---------------------------------------------*/
// Allow Elementor on CPTs
function plumberx_elementor_cpt_support() {
    $cpt_support = get_option( 'elementor_cpt_support', array( 'page', 'post' ) );
    $add_cpts = array( 'plumberx_service', 'plumberx_project' );
    foreach ( $add_cpts as $cpt ) {
        if ( ! in_array( $cpt, $cpt_support ) ) {
            $cpt_support[] = $cpt;
        }
    }
    update_option( 'elementor_cpt_support', $cpt_support );
}
add_action( 'after_switch_theme', 'plumberx_elementor_cpt_support' );

// Elementor canvas template check (full-width Elementor editing)
function plumberx_add_elementor_locations( $elementor_theme_manager ) {
    $elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'plumberx_add_elementor_locations' );

/*---------------------------------------------
 * 9. WALKER CLASS FOR NAV MENU
 *---------------------------------------------*/
class PlumberX_Walker_Nav extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown-menu">';
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-ancestor', $classes );

        $li_class = 'nav-item';
        if ( $has_children ) $li_class .= ' has-dropdown';
        if ( $is_active ) $li_class .= ' active';

        $output .= '<li class="' . esc_attr( $li_class ) . '">';

        $link_class = $depth === 0 ? 'nav-link' : 'dropdown-link';
        $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $link_class ) . '">';
        $output .= esc_html( $item->title );

        if ( $has_children && $depth === 0 ) {
            $output .= '<svg class="arrow-icon" viewBox="0 0 10 6"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>';
        }

        $output .= '</a>';
    }
}

/*---------------------------------------------
 * 10. HELPER FUNCTIONS
 *---------------------------------------------*/
function plumberx_get_logo_url() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    if ( $custom_logo_id ) {
        return wp_get_attachment_image_url( $custom_logo_id, 'full' );
    }
    return PLUMBERX_URI . '/assets/images/logo.png';
}

function plumberx_get_clean_logo_url() {
    // Favicon / clean logo
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    if ( $custom_logo_id ) {
        return wp_get_attachment_image_url( $custom_logo_id, 'thumbnail' );
    }
    return PLUMBERX_URI . '/assets/images/logo_clean.png';
}

/*---------------------------------------------
 * 11. WOOCOMMERCE HOOKS
 *---------------------------------------------*/
// Remove default WooCommerce wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function plumberx_wc_wrapper_start() {
    echo '<main class="woocommerce-main"><div class="container">';
}
function plumberx_wc_wrapper_end() {
    echo '</div></main>';
}
add_action( 'woocommerce_before_main_content', 'plumberx_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'plumberx_wc_wrapper_end', 10 );

/*---------------------------------------------
 * 12. INCLUDE TEMPLATE FILES
 *---------------------------------------------*/
require_once PLUMBERX_DIR . '/inc/template-tags.php';
require_once PLUMBERX_DIR . '/inc/elementor/elementor-init.php';
