<?php
/**
 * Setup Services 2 Page (Post ID 161) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 161;
$site_url = home_url();
$media_map = get_option( 'plumberx_media_map', array() );

function get_img_url( $filename, $media_map, $site_url ) {
    if ( isset( $media_map[$filename]['url'] ) ) {
        return $media_map[$filename]['url'];
    }
    return $site_url . '/wp-content/uploads/2026/10/' . $filename;
}

$elementor_data = array(
    // 1. Subpage Banner
    array(
        'id'       => 'sec_banner',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_banner',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_banner',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_subpage_banner',
                        'settings'   => array(
                            'title'                  => 'Services 2',
                            'show_breadcrumb'        => 'yes',
                            'breadcrumb_parent_text' => 'Home',
                            'breadcrumb_parent_url'  => array( 'url' => '/' ),
                            'breadcrumb_current_text'=> 'Services 2',
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Services Grid (8 Cards)
    array(
        'id'       => 'sec_services_grid',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_services_grid',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_services_grid',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_services_grid',
                        'settings'   => array(
                            'section_title'    => 'We offer Different Services',
                            'section_subtitle' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Consect petur adipiscing elit.',
                            'show_splash'      => 'yes',
                            'splash_image'     => array(
                                'url' => get_img_url( 'water_splash.png', $media_map, $site_url ),
                            ),
                            'splash_width'     => 320,
                            'services_list'    => array(
                                array(
                                    'card_title' => 'Plumbing Repairs',
                                    'card_image' => array( 'url' => get_img_url( 'service2_1.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Sewer Cleaning & Repairs',
                                    'card_image' => array( 'url' => get_img_url( 'service2_2.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Drain Repairs & Cleaning',
                                    'card_image' => array( 'url' => get_img_url( 'service2_3.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Faucet & Leak Repairs',
                                    'card_image' => array( 'url' => get_img_url( 'service2_4.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Gas Line Service',
                                    'card_image' => array( 'url' => get_img_url( 'service2_5.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Remodeling Service',
                                    'card_image' => array( 'url' => get_img_url( 'service2_6.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Water Treatment Service',
                                    'card_image' => array( 'url' => get_img_url( 'service2_7.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                                array(
                                    'card_title' => 'Cooling & Heating Service',
                                    'card_image' => array( 'url' => get_img_url( 'service2_8.jpg', $media_map, $site_url ) ),
                                    'card_desc'  => 'Bring to the table win-win survival strategies to ensure proactive domination.',
                                    'link_text'  => 'Know More',
                                    'card_link'  => array( 'url' => '/service-repair/' ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 3. Emergency Banner
    array(
        'id'       => 'sec_emergency',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
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
                            'btn_text'        => 'CONTACT US',
                            'btn_link'        => array( 'url' => '/contact/' ),
                            'plumber_img'     => array( 'url' => get_img_url( 'emergency_plumber.png', $media_map, $site_url ) ),
                            'wrench_img'      => array( 'url' => get_img_url( 'emergency_wrench.png', $media_map, $site_url ) ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

// Clear raw post_content to avoid duplicate rendering
wp_update_post( array(
    'ID'           => $post_id,
    'post_content' => '',
) );

// Update Elementor metadata
update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
update_post_meta( $post_id, '_elementor_version', '4.3.5' );
update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $elementor_data ) ) );

echo "Successfully configured Services 2 (Post ID: " . $post_id . ") with native Elementor widgets!\n";
