<?php
/**
 * Setup Case Study Page (Post ID 165) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 165;
$site_url = home_url();

function get_case_img( $att_id, $filename ) {
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
                            'title'                   => 'Case Study',
                            'show_breadcrumb'         => 'yes',
                            'breadcrumb_parent_text'  => 'Home',
                            'breadcrumb_parent_url'   => array( 'url' => '/' ),
                            'breadcrumb_middle_text'  => 'Pages',
                            'breadcrumb_middle_url'   => array( 'url' => '#' ),
                            'breadcrumb_current_text' => 'Case Study',
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Case Study Details Section
    array(
        'id'       => 'sec_case_study',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_case_study',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_case_study',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_case_study',
                        'settings'   => array(
                            'desc_title'        => 'Project Description',
                            'desc_text_1'       => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore veritatis et quasi architecto. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
                            'desc_text_2'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                            'challenge_title'   => 'The Challenge in Installation',
                            'challenge_text_1'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                            'challenge_text_2'  => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco proident, sunt in culpa qui officia deserunt mollit anim id est laborum. aliqua. Ut enim ad minim veniam, quis nostrud exercitation.',
                            'quote_text'        => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non dolore magna aliqua. Ut enim ad minim veniam, quis in',
                            'quote_author'      => 'Micale John, Client',
                            'final_title'       => 'The Final View of Project',
                            'final_text'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco proident, sunt in culpa qui officia deserunt mollit.',
                            'img_top'           => array( 'url' => get_case_img( 70, 'case_study_1.jpg' ), 'id' => 70 ),
                            'alt_top'           => 'Minimalist Bathroom Installation',
                            'img_mid_1'         => array( 'url' => get_case_img( 71, 'case_study_2.jpg' ), 'id' => 71 ),
                            'alt_mid_1'         => 'Luxury Vanity Cabinet Work',
                            'img_mid_2'         => array( 'url' => get_case_img( 72, 'case_study_3.jpg' ), 'id' => 72 ),
                            'alt_mid_2'         => 'Natural Stone Bathroom Bathtub',
                            'img_bottom'        => array( 'url' => get_case_img( 73, 'case_study_4.jpg' ), 'id' => 73 ),
                            'alt_bottom'        => 'Finished Modern Blue Bathroom Project',
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
                            'title'        => 'Emergency Leaks & Pipe Bursts',
                            'subtitle'     => 'If you have an emergency plumbing need, simply call our 24 hour emergecny plumbing',
                            'phone'        => '01865 524 8503',
                            'btn_text'     => 'CONTACT US',
                            'btn_url'      => array( 'url' => '/contact/' ),
                            'plumber_img'  => array( 'url' => get_case_img( 141, 'emergency_plumber.png' ) ),
                            'wrench_img'   => array( 'url' => get_case_img( 142, 'emergency_wrench.png' ) ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

// Update Page Metadata and Content
$json_data = wp_json_encode( $elementor_data );

update_post_meta( $post_id, '_elementor_data', wp_slash( $json_data ) );
update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
update_post_meta( $post_id, '_elementor_version', '3.24.4' );

// Clear raw HTML post_content
wp_update_post( array(
    'ID'           => $post_id,
    'post_content' => '',
    'post_status'  => 'publish',
) );

echo "Successfully configured Case Study page (ID: {$post_id}) with Elementor data!\n";
