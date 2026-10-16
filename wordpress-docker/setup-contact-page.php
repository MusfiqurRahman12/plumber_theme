<?php
/**
 * Setup Contact Us Page (Post ID 168) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 168;
$site_url = home_url();

function get_contact_img( $att_id, $filename ) {
    $url = wp_get_attachment_url( $att_id );
    if ( $url ) {
        return $url;
    }
    return get_template_directory_uri() . '/assets/images/' . $filename;
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
                            'title'                   => 'Contact Us',
                            'show_breadcrumb'         => 'yes',
                            'breadcrumb_parent_text'  => 'Home',
                            'breadcrumb_parent_url'   => array( 'url' => '/' ),
                            'breadcrumb_current_text' => 'Contact Us',
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Contact Details & Form Section
    array(
        'id'       => 'sec_contact',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_contact',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_contact',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_contact',
                        'settings'   => array(
                            'intro_text'     => 'You can talk to our online representative at any time. Please use our Live Chat System on our website or Fill up below instant messaging programs. Please be patient, We will get back to you.',
                            'highlight_text' => 'Our 24/7 Support, General Inquireies Phone: + 1800 654 321',
                            'info_title'     => 'Contact info',
                            'info_subtitle'  => 'Have any Queries? Let us know. We will clear it for you at the best.',
                            'office_label'   => 'Office',
                            'office_value'   => "Plumberx Company, 215, Mallin Street\nNew Youk, NY 100 254",
                            'email_label'    => 'Email :',
                            'email_value'    => "contact@plumberx.com\ninfo@plumberx.com",
                            'phone_label'    => 'Phone :',
                            'phone_value'    => "+0120 123 4 56 789\n+0120 987 65419",
                            'button_text'    => 'SUBMIT NOW',
                            'show_map'       => 'yes',
                            'map_image'      => array( 'url' => get_contact_img( 74, 'contact_map.jpg' ), 'id' => 74 ),
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
                            'title'    => 'Emergency Leaks & Pipe Bursts',
                            'subtitle' => 'If you have an emergency plumbing need, simply call our 24 hour emergecny plumbing',
                            'phone'    => '01865 524 8503',
                            'btn_text' => 'CONTACT US',
                            'btn_link' => array( 'url' => '/contact/' ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

// Update post meta
update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
update_post_meta( $post_id, '_elementor_version', '3.18.3' );
update_post_meta( $post_id, '_elementor_data', wp_slash( json_encode( $elementor_data ) ) );

// Clear raw post_content
wp_update_post( array(
    'ID'           => $post_id,
    'post_content' => '',
) );

echo "Successfully set up Contact Us page (Post ID $post_id) with Elementor widgets!\n";
