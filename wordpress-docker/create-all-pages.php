<?php
/**
 * Create All Pages with Full Elementor Support & Dynamic Media Links
 */

require_once '/var/www/html/wp-load.php';
require_once '/var/www/html/wp-admin/includes/post.php';

$media_map = get_option( 'plumberx_media_map', array() );
$site_url  = home_url();

function plumberx_clean_page_html( $html, $media_map, $site_url ) {
    // 1. Replace static image paths with WordPress uploaded media URLs
    foreach ( $media_map as $filename => $data ) {
        // Match assets/images/filename with optional query strings
        $pattern = '/assets\/images\/' . preg_quote( $filename, '/' ) . '(\?v=[0-9]+)?/';
        $html = preg_replace( $pattern, $data['url'], $html );
    }

    // 2. Fallback for any missed assets/images/
    $html = preg_replace( '/assets\/images\//', $site_url . '/wp-content/themes/plumberx/assets/images/', $html );

    // 3. Replace internal HTML links with WordPress permalinks
    $link_replacements = array(
        'index.html'          => $site_url . '/',
        'about.html'          => $site_url . '/about/',
        'services-1.html'     => $site_url . '/services/',
        'services-2.html'     => $site_url . '/services-2/',
        'services-3.html'     => $site_url . '/services-3/',
        'service-repair.html' => $site_url . '/service-repair/',
        'projects.html'       => $site_url . '/projects/',
        'case-study.html'     => $site_url . '/case-study/',
        'price.html'          => $site_url . '/pricing/',
        'blog.html'           => $site_url . '/blog/',
        'blog-single.html'    => $site_url . '/single-post/',
        'contact.html'        => $site_url . '/contact/',
        'shop.html'           => $site_url . '/shop/',
    );

    foreach ( $link_replacements as $src_link => $dst_link ) {
        $html = str_replace( '"' . $src_link . '"', '"' . $dst_link . '"', $html );
        $html = str_replace( "'" . $src_link . "'", "'" . $dst_link . "'", $html );
    }

    return $html;
}

function plumberx_extract_page_body( $file_path, $media_map, $site_url ) {
    if ( ! file_exists( $file_path ) ) {
        return '';
    }
    $raw_html = file_get_contents( $file_path );

    // Extract between </header> and <footer class="site-footer">
    if ( preg_match( '/<\/header>\s*(.*?)\s*(?:<!-- Footer -->|<footer class="site-footer">)/s', $raw_html, $matches ) ) {
        $content = $matches[1];
    } else {
        // Fallback: take body content
        preg_match( '/<body[^>]*>(.*?)<\/body>/s', $raw_html, $matches );
        $content = $matches[1] ?? $raw_html;
    }

    // Clean up free quote modal or toast notice duplicates if present
    $content = preg_replace( '/<div id="toastNotice"[^>]*>.*?<\/div>/s', '', $content );

    return plumberx_clean_page_html( trim( $content ), $media_map, $site_url );
}

function plumberx_make_elementor_data( $html_content ) {
    $sec_id = 'sec_' . substr( md5( uniqid() ), 0, 7 );
    $col_id = 'col_' . substr( md5( uniqid() ), 0, 7 );
    $wgt_id = 'wgt_' . substr( md5( uniqid() ), 0, 7 );

    $elementor_data = array(
        array(
            'id'       => $sec_id,
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => $col_id,
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array(
                        '_column_size' => 100,
                    ),
                    'elements' => array(
                        array(
                            'id'         => $wgt_id,
                            'elType'     => 'widget',
                            'widgetType' => 'html',
                            'settings'   => array(
                                'html' => $html_content,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );

    return wp_json_encode( $elementor_data );
}

$source_dir = '/var/www/html/wp-content/themes/plumberx/assets/../../../../plumber -third theme';
// If mounted or accessible, or read from theme directory
if ( ! is_dir( $source_dir ) ) {
    $source_dir = '/var/www/html/source-theme';
}

echo "Using source theme directory: $source_dir\n";

$pages_to_build = array(
    array(
        'title'    => 'About Us',
        'slug'     => 'about',
        'file'     => 'about.html',
    ),
    array(
        'title'    => 'Services',
        'slug'     => 'services',
        'file'     => 'services-1.html',
    ),
    array(
        'title'    => 'Services 2',
        'slug'     => 'services-2',
        'file'     => 'services-2.html',
    ),
    array(
        'title'    => 'Services 3',
        'slug'     => 'services-3',
        'file'     => 'services-3.html',
    ),
    array(
        'title'    => 'Plumbing Repairs',
        'slug'     => 'service-repair',
        'file'     => 'service-repair.html',
    ),
    array(
        'title'    => 'Projects',
        'slug'     => 'projects',
        'file'     => 'projects.html',
    ),
    array(
        'title'    => 'Case Study',
        'slug'     => 'case-study',
        'file'     => 'case-study.html',
    ),
    array(
        'title'    => 'Price Plans',
        'slug'     => 'pricing',
        'file'     => 'price.html',
    ),
    array(
        'title'    => 'Blog',
        'slug'     => 'blog',
        'file'     => 'blog.html',
    ),
    array(
        'title'    => 'Contact Us',
        'slug'     => 'contact',
        'file'     => 'contact.html',
    ),
);

foreach ( $pages_to_build as $p ) {
    $file_path = $source_dir . '/' . $p['file'];
    $page_html = plumberx_extract_page_body( $file_path, $media_map, $site_url );

    if ( empty( $page_html ) ) {
        echo "Warning: No content extracted for " . $p['title'] . " from $file_path\n";
        continue;
    }

    $existing_page = get_page_by_path( $p['slug'] );
    if ( $existing_page ) {
        $post_id = $existing_page->ID;
        wp_update_post( array(
            'ID'           => $post_id,
            'post_title'   => $p['title'],
            'post_content' => $page_html,
            'post_status'  => 'publish',
        ) );
        echo "Updated Page: " . $p['title'] . " (ID: $post_id)\n";
    } else {
        $post_id = wp_insert_post( array(
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $page_html,
            'post_type'    => 'page',
            'post_status'  => 'publish',
        ) );
        echo "Created Page: " . $p['title'] . " (ID: $post_id)\n";
    }

    if ( $post_id ) {
        // Elementor Builder Metadata
        $elementor_json = plumberx_make_elementor_data( $page_html );
        update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
        update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
        update_post_meta( $post_id, '_elementor_version', '4.3.5' );
        update_post_meta( $post_id, '_elementor_data', wp_slash( $elementor_json ) );
        update_post_meta( $post_id, '_wp_page_template', 'default' );
    }
}

// Single Blog Post
$single_post_file = $source_dir . '/blog-single.html';
if ( file_exists( $single_post_file ) ) {
    $single_html = plumberx_extract_page_body( $single_post_file, $media_map, $site_url );
    $existing_post = get_page_by_path( 'these-cases-are-simple-standard', OBJECT, 'post' );
    if ( $existing_post ) {
        wp_update_post( array(
            'ID'           => $existing_post->ID,
            'post_title'   => 'These cases are simple Standard',
            'post_content' => $single_html,
        ) );
        $post_id = $existing_post->ID;
    } else {
        $post_id = wp_insert_post( array(
            'post_title'   => 'These cases are simple Standard',
            'post_name'    => 'these-cases-are-simple-standard',
            'post_content' => $single_html,
            'post_type'    => 'post',
            'post_status'  => 'publish',
        ) );
    }
    if ( $post_id ) {
        $elementor_json = plumberx_make_elementor_data( $single_html );
        update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
        update_post_meta( $post_id, '_elementor_template_type', 'wp-post' );
        update_post_meta( $post_id, '_elementor_version', '4.3.5' );
        update_post_meta( $post_id, '_elementor_data', wp_slash( $elementor_json ) );
        if ( isset( $media_map['blog_single_featured.jpg'] ) ) {
            set_post_thumbnail( $post_id, $media_map['blog_single_featured.jpg']['id'] );
        }
        echo "Created/Updated Single Post: These cases are simple Standard (ID: $post_id)\n";
    }
}

// Configure Homepage (ID 11) with all 10 Elementor custom PlumberX widgets!
$home_id = 11;
if ( get_post( $home_id ) ) {
    $hero_img_url      = $media_map['home_hero_plumber.png']['url'] ?? '';
    $emergency_plumber = $media_map['emergency_plumber.png']['url'] ?? '';
    $emergency_wrench  = $media_map['emergency_wrench.png']['url'] ?? '';

    $home_elementor_widgets = array(
        // 1. Hero Widget
        array(
            'id'       => 'sec_hero',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_hero',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_hero',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_hero',
                            'settings'   => array(
                                'subtitle'          => 'Expertise',
                                'title'             => 'You Can Trust',
                                'description'       => 'Our plumbing professionals are thoroughly trained to assess the situation and effectively respond in a way that treats the source of the problems.',
                                'btn1_text'         => 'REQUEST A SERVICE',
                                'btn2_text'         => 'EMERGENCY SERVICE',
                                'plumber_image'     => array( 'url' => $hero_img_url ),
                                'experience_number' => '25',
                                'experience_label'  => 'Years of Experience',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 2. Promo Strip Widget
        array(
            'id'       => 'sec_promo',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_promo',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_promo',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_promo_strip',
                            'settings'   => array(
                                'promo_title' => 'Schedule Repair Service & Save $25',
                                'promo_text'  => 'We service all plumbing leaks and clogs and we are available 24/7',
                                'btn_text'    => 'Schedule Now',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 3. Services Tabs Widget
        array(
            'id'       => 'sec_services_tabs',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_services_tabs',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_services_tabs',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_services_tabs',
                            'settings'   => array(
                                'section_title'    => 'Services That We Offers',
                                'section_subtitle' => 'Explore comprehensive plumbing solutions tailored to your needs',
                                'source'           => 'cpt',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 4. Projects Showcase Widget
        array(
            'id'       => 'sec_projects',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_projects',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_projects',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_projects',
                            'settings'   => array(
                                'section_title'  => 'Our Projects',
                                'posts_per_page' => 8,
                                'show_filters'   => 'yes',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 5. Coupon Widget
        array(
            'id'       => 'sec_coupon',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_coupon',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_coupon',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_coupon',
                            'settings'   => array(
                                'section_title'   => 'Choosing the Right Plumbing Contractor',
                                'section_desc'    => 'Factory Trained Technicians: We only employ factory trained technicians, they\'re the best in the industry. Your assurance that the work will be done right the first time.',
                                'coupon_title'    => '$35 Off Service Call',
                                'coupon_subtitle' => 'Cannot be combined with any other offer',
                                'coupon_tag'      => 'For new clients only',
                                'coupon_note'     => 'Must present coupon at time of service.',
                                'coupon_expire'   => '01.05.2026',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 6. Team Widget
        array(
            'id'       => 'sec_team',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_team',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_team',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_team',
                            'settings'   => array(
                                'section_title' => 'Meet Our Specialists',
                                'source'        => 'cpt',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 7. Testimonials Marquee Widget
        array(
            'id'       => 'sec_testimonials',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_testimonials',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_testimonials',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_testimonials',
                            'settings'   => array(
                                'section_title'    => 'What our customers says',
                                'section_subtitle' => 'Thousands of people get benefit',
                                'source'           => 'cpt',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 8. Emergency Banner Widget
        array(
            'id'       => 'sec_emergency',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_emergency',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_emergency',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_emergency_banner',
                            'settings'   => array(
                                'emergency_title' => 'Emergency Leaks & Pipe Bursts',
                                'emergency_text'  => 'If you have an emergency plumbing need, simply call our 24 hour emergency plumbing',
                                'phone_number'    => '01865 524 8503',
                                'plumber_img'     => array( 'url' => $emergency_plumber ),
                                'wrench_img'      => array( 'url' => $emergency_wrench ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 9. Blog Widget
        array(
            'id'       => 'sec_blog',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_blog',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_blog',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_blog',
                            'settings'   => array(
                                'section_title'    => 'Latest From Blogs',
                                'section_subtitle' => 'News & Press Release',
                                'posts_count'      => 5,
                            ),
                        ),
                    ),
                ),
            ),
        ),
        // 10. Partner Brands Marquee Widget
        array(
            'id'       => 'sec_partners',
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => array(),
            'elements' => array(
                array(
                    'id'       => 'col_partners',
                    'elType'   => 'column',
                    'isInner'  => false,
                    'settings' => array( '_column_size' => 100 ),
                    'elements' => array(
                        array(
                            'id'         => 'wgt_partners',
                            'elType'     => 'widget',
                            'widgetType' => 'plumberx_partners',
                            'settings'   => array(),
                        ),
                    ),
                ),
            ),
        ),
    );

    update_post_meta( $home_id, '_elementor_edit_mode', 'builder' );
    update_post_meta( $home_id, '_elementor_template_type', 'wp-page' );
    update_post_meta( $home_id, '_elementor_version', '4.3.5' );
    update_post_meta( $home_id, '_elementor_data', wp_slash( wp_json_encode( $home_elementor_widgets ) ) );
    echo "Configured Home Page with all 10 Elementor Drag-and-Drop PlumberX Widgets!\n";
}

// Build WordPress Navigation Menu with Submenus
$menu_name = 'Main Navigation';
$menu_exists = wp_get_nav_menu_object( $menu_name );

if ( ! $menu_exists ) {
    $menu_id = wp_create_nav_menu( $menu_name );

    // 1. Home
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Home',
        'menu-item-url'    => $site_url . '/',
        'menu-item-status' => 'publish',
    ) );

    // 2. About Us
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'About Us',
        'menu-item-url'    => $site_url . '/about/',
        'menu-item-status' => 'publish',
    ) );

    // 3. Services (Parent)
    $services_parent_id = wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Services',
        'menu-item-url'    => $site_url . '/services/',
        'menu-item-status' => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Services 1',
        'menu-item-url'       => $site_url . '/services/',
        'menu-item-parent-id' => $services_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Services 2',
        'menu-item-url'       => $site_url . '/services-2/',
        'menu-item-parent-id' => $services_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Services 3',
        'menu-item-url'       => $site_url . '/services-3/',
        'menu-item-parent-id' => $services_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Plumbing Repairs',
        'menu-item-url'       => $site_url . '/service-repair/',
        'menu-item-parent-id' => $services_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    // 4. Projects
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Projects',
        'menu-item-url'    => $site_url . '/projects/',
        'menu-item-status' => 'publish',
    ) );

    // 5. Pages (Parent)
    $pages_parent_id = wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Pages',
        'menu-item-url'    => $site_url . '/case-study/',
        'menu-item-status' => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Case Study',
        'menu-item-url'       => $site_url . '/case-study/',
        'menu-item-parent-id' => $pages_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Price Plans',
        'menu-item-url'       => $site_url . '/pricing/',
        'menu-item-parent-id' => $pages_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Shop Page',
        'menu-item-url'       => $site_url . '/shop/',
        'menu-item-parent-id' => $pages_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    // 6. Blog (Parent)
    $blog_parent_id = wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Blog',
        'menu-item-url'    => $site_url . '/blog/',
        'menu-item-status' => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Blog Default',
        'menu-item-url'       => $site_url . '/blog/',
        'menu-item-parent-id' => $blog_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     => 'Single Blog Post',
        'menu-item-url'       => $site_url . '/these-cases-are-simple-standard/',
        'menu-item-parent-id' => $blog_parent_id,
        'menu-item-status'    => 'publish',
    ) );

    // 7. Shop
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Shop',
        'menu-item-url'    => $site_url . '/shop/',
        'menu-item-status' => 'publish',
    ) );

    // 8. Contact Us
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Contact Us',
        'menu-item-url'    => $site_url . '/contact/',
        'menu-item-status' => 'publish',
    ) );

    // Assign to Primary Menu theme location
    $locations = get_theme_mod( 'nav_menu_locations', array() );
    $locations['primary'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
    echo "Created Main Navigation Menu with all dropdown submenus and assigned to 'primary' location.\n";
}

echo "All pages and Elementor data built successfully!\n";
