<?php
/**
 * ApexFlow Plumbing Theme Functions & Definitions
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Setup Theme Defaults and Register Support for Various WordPress Features.
 */
function apexflow_plumbing_setup() {
    // Add default title tag support managed by WordPress
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus([
        'primary' => __('Primary Navigation', 'apexflow-plumbing'),
        'footer_services' => __('Footer Services Menu', 'apexflow-plumbing'),
        'footer_company' => __('Footer Company Menu', 'apexflow-plumbing'),
    ]);

    // HTML5 markup support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Custom Logo support
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action('after_setup_theme', 'apexflow_plumbing_setup');

/**
 * Enqueue Styles and Scripts.
 */
function apexflow_plumbing_scripts() {
    // Google Fonts (Outfit & Plus Jakarta Sans)
    wp_enqueue_style(
        'apexflow-google-fonts',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Main Theme Stylesheet
    wp_enqueue_style(
        'apexflow-main-style',
        get_stylesheet_uri(),
        [],
        '1.0.0'
    );

    // Theme Interactive JavaScript
    wp_enqueue_script(
        'apexflow-main-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        [],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'apexflow_plumbing_scripts');

/**
 * Customizer Settings for Emergency Contact & License Info.
 */
function apexflow_customize_register($wp_customize) {
    $wp_customize->add_section('apexflow_emergency_section', [
        'title'    => __('Emergency & Contact Information', 'apexflow-plumbing'),
        'priority' => 30,
    ]);

    // Phone Number
    $wp_customize->add_setting('apexflow_phone', [
        'default'           => '(800) 555-FLOW',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('apexflow_phone', [
        'label'    => __('Emergency Phone Display', 'apexflow-plumbing'),
        'section'  => 'apexflow_emergency_section',
        'type'     => 'text',
    ]);

    // Phone Link (tel: format)
    $wp_customize->add_setting('apexflow_phone_link', [
        'default'           => '18005553569',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('apexflow_phone_link', [
        'label'    => __('Emergency Tel Link (numbers only)', 'apexflow-plumbing'),
        'section'  => 'apexflow_emergency_section',
        'type'     => 'text',
    ]);

    // License ID
    $wp_customize->add_setting('apexflow_license_id', [
        'default'           => '#PL-98214',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('apexflow_license_id', [
        'label'    => __('Master Plumber License ID', 'apexflow-plumbing'),
        'section'  => 'apexflow_emergency_section',
        'type'     => 'text',
    ]);
}
add_action('customize_register', 'apexflow_customize_register');
