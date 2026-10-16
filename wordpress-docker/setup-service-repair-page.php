<?php
/**
 * Setup Plumbing Repairs / Service Details Page (Post ID 163) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 163;
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
                            'title'                  => 'Repair',
                            'show_breadcrumb'        => 'yes',
                            'breadcrumb_parent_text' => 'Home',
                            'breadcrumb_parent_url'  => array( 'url' => '/' ),
                            'breadcrumb_current_text'=> 'Repair',
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Service Details & Repair Section
    array(
        'id'       => 'sec_service_details',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_service_details',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_service_details',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_service_details',
                        'settings'   => array(
                            // Sidebar
                            'sidebar_menu' => array(
                                array( 'menu_title' => 'Plumbing Repairs', 'menu_link' => array( 'url' => '/service-repair/' ), 'is_active' => 'yes' ),
                                array( 'menu_title' => 'Sewer Cleaning & Repairs', 'menu_link' => array( 'url' => '/service-repair/' ), 'is_active' => 'no' ),
                                array( 'menu_title' => 'Drain Repairs & Cleaning', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                                array( 'menu_title' => 'Faucet & Leak Repairs', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                                array( 'menu_title' => 'Gas Line Service', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                                array( 'menu_title' => 'Remodeling Service', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                                array( 'menu_title' => 'Water Treatment Service', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                                array( 'menu_title' => 'Heating & Cooling', 'menu_link' => array( 'url' => '/services-2/' ), 'is_active' => 'no' ),
                            ),
                            'sidebar_promo_image' => array(
                                'url' => get_img_url( 'repair_sidebar_widget.jpg', $media_map, $site_url ),
                            ),
                            'downloads_title' => 'Downloads PDFs',
                            'downloads_list'  => array(
                                array( 'download_title' => 'Our Brochure PDF', 'icon_style' => 'doc', 'download_link' => array( 'url' => '#' ) ),
                                array( 'download_title' => 'Our Recent Products', 'icon_style' => 'download', 'download_link' => array( 'url' => '#' ) ),
                            ),

                            // Main Top
                            'top_photo_1'        => array( 'url' => get_img_url( 'repair_top_1.jpg', $media_map, $site_url ) ),
                            'top_photo_2'        => array( 'url' => get_img_url( 'repair_top_2.jpg', $media_map, $site_url ) ),
                            'main_service_title' => 'Plumbing Repairs',
                            'paragraph_1'        => 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.',
                            'paragraph_2'        => 'Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring. Capitalize on low hanging fruit to identify a ballpark value added activity to beta test.',

                            // Benefit of Service
                            'benefit_image'     => array( 'url' => get_img_url( 'repair_benefit.jpg', $media_map, $site_url ) ),
                            'benefit_title'     => 'Benefit of Service',
                            'benefit_desc'      => 'Expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.',
                            'benefit_checklist' => array(
                                array( 'check_text' => 'Those who do not know how to pursue' ),
                                array( 'check_text' => 'Pleasure rationally encounter' ),
                                array( 'check_text' => 'Consequences that are extremely painful.' ),
                                array( 'check_text' => 'Nor again is there anyone who loves or pursues' ),
                            ),

                            // Some Facts
                            'facts_title'    => 'Some facts works with us',
                            'facts_subtitle' => "Our management consulting services focus on our clients' most critical issues and opportunities: strategy, marketing, organization, operations, technology, transformation, digital.",
                            'facts_list'     => array(
                                array(
                                    'fact_title'     => 'Professional Team',
                                    'fact_icon_type' => 'team',
                                    'fact_desc'      => 'Efficiently unleash cross-media informa-tion without cross-media value. Quickly maximize timely deliverables.',
                                ),
                                array(
                                    'fact_title'     => 'Deadline Completion',
                                    'fact_icon_type' => 'deadline',
                                    'fact_desc'      => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate.',
                                ),
                                array(
                                    'fact_title'     => 'Best Strategy of Work',
                                    'fact_icon_type' => 'strategy',
                                    'fact_desc'      => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate.',
                                ),
                                array(
                                    'fact_title'     => 'Quality Work',
                                    'fact_icon_type' => 'quality',
                                    'fact_desc'      => 'Efficiently unleash cross-media informa-tion without cross-media value. Quickly maximize timely deliverables.',
                                ),
                            ),

                            // More Information Accordion
                            'faq_title'    => 'More information',
                            'faq_subtitle' => "Our management consulting services focus on our clients' most critical issues and opportunities: strategy, marketing, organization, operations, technology, digital.",
                            'faq_list'     => array(
                                array(
                                    'faq_question' => 'Capitalize on low hanging fruit to identify a ballpark value added activity.',
                                    'faq_answer'   => 'Expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids actual teachings of the great explorer of the truth, the master-builder of human actual teachings of the great explorer of the truth, the master-builder of human.',
                                    'is_open'      => 'yes',
                                ),
                                array(
                                    'faq_question' => 'Digital divide with additional clickthroughs from DevOps.',
                                    'faq_answer'   => 'Podcasting operational change management inside of workflows to establish a horizontal pipeline. Taking seamless key performance indicators offline to maximise the long tail.',
                                    'is_open'      => 'no',
                                ),
                                array(
                                    'faq_question' => 'Nanotechnology immersion along the information highway will close the loop.',
                                    'faq_answer'   => 'Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.',
                                    'is_open'      => 'no',
                                ),
                                array(
                                    'faq_question' => 'Organically grow the holistic world view of disruptive innovation via workplace.',
                                    'faq_answer'   => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.',
                                    'is_open'      => 'no',
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

echo "Successfully configured Plumbing Repairs (Post ID: " . $post_id . ") with native Elementor widgets!\n";
