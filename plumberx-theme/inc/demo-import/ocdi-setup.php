<?php
/**
 * One Click Demo Import (OCDI) Integration
 *
 * Hooks into the pt-ocdi plugin if installed to provide full demo content import.
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define OCDI demo files
 */
function plumberx_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'PlumberX Complete Demo', 'plumberx' ),
            'categories'                   => array( 'Handyman', 'Plumbing', 'Full Site' ),
            'local_import_file'            => PLUMBERX_DIR . '/inc/demo-import/demo-data/content.xml',
            'import_preview_image_url'     => PLUMBERX_URI . '/screenshot.png',
            'preview_url'                  => home_url( '/' ),
            'import_notice'                => esc_html__( 'Importing this demo will create 12 complete pages, blog posts, WooCommerce products, menus, and drag-and-drop Elementor layouts. Please ensure Elementor is installed and active before importing.', 'plumberx' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'plumberx_ocdi_import_files' );

/**
 * Setup navigation menus, front page, and reading settings after OCDI import
 */
function plumberx_ocdi_after_import_setup( $selected_import ) {
    // 1. Assign Menus
    $primary_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
    if ( ! $primary_menu ) {
        $primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    }

    if ( $primary_menu ) {
        set_theme_mod( 'nav_menu_locations', array(
            'primary' => $primary_menu->term_id,
            'footer'  => $primary_menu->term_id,
        ) );
    }

    // 2. Set Front Page and Blog Page
    $front_page = get_page_by_path( 'home' );
    $blog_page  = get_page_by_path( 'blog' );

    if ( $front_page ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
    }

    if ( $blog_page ) {
        update_option( 'page_for_posts', $blog_page->ID );
    }

    // 3. Set WooCommerce Shop Page
    $shop_page = get_page_by_path( 'shop' );
    if ( $shop_page && class_exists( 'WooCommerce' ) ) {
        update_option( 'woocommerce_shop_page_id', $shop_page->ID );
        update_option( 'woocommerce_coming_soon', 'no' );
    }

    // 4. Regenerate Elementor CSS cache
    if ( class_exists( '\Elementor\Plugin' ) ) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }
}
add_action( 'pt-ocdi/after_import', 'plumberx_ocdi_after_import_setup' );

/**
 * Custom intro message on OCDI page
 */
add_filter( 'pt-ocdi/plugin_intro_text', function( $default_text ) {
    $intro  = '<div class="ocdi__intro-text" style="background:#fff;padding:20px;border-left:4px solid #00a4e4;border-radius:6px;margin-bottom:24px;box-shadow:0 2px 8px rgba(0,0,0,0.05);">';
    $intro .= '<h2 style="margin-top:0;color:#0b1b3d;">' . esc_html__( 'Welcome to PlumberX Demo Import', 'plumberx' ) . '</h2>';
    $intro .= '<p>' . esc_html__( 'Click the import button below to install all 12 pre-built pages, services, projects, pricing tables, shop items, blog posts, and interactive Elementor layouts with 100% fidelity.', 'plumberx' ) . '</p>';
    $intro .= '<p style="color:#64748b;font-size:13px;">' . esc_html__( 'Note: You can also use the built-in native importer under Appearance > PlumberX Demo Import at any time without needing this plugin.', 'plumberx' ) . '</p>';
    $intro .= '</div>';
    return $intro;
} );
