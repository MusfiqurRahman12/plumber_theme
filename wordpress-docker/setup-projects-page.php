<?php
/**
 * Setup Projects Gallery Page (Post ID 164) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 164;
$site_url = home_url();

function get_project_img( $att_id, $filename ) {
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
                            'title'                   => 'Projects',
                            'show_breadcrumb'         => 'yes',
                            'breadcrumb_parent_text'  => 'Home',
                            'breadcrumb_parent_url'   => array( 'url' => '/' ),
                            'breadcrumb_current_text' => 'Projects',
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Projects Gallery Grid Section
    array(
        'id'       => 'sec_projects_gallery',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_projects_gallery',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_projects_gallery',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_projects_gallery',
                        'settings'   => array(
                            'filters' => array(
                                array( 'filter_label' => 'All', 'filter_slug' => 'all' ),
                                array( 'filter_label' => 'Kitchen', 'filter_slug' => 'kitchen' ),
                                array( 'filter_label' => 'Bathroom', 'filter_slug' => 'bathroom' ),
                                array( 'filter_label' => 'Drain Cleaning', 'filter_slug' => 'drain' ),
                                array( 'filter_label' => 'Outside Plumbing', 'filter_slug' => 'outside' ),
                                array( 'filter_label' => 'Server Lines Cleaning', 'filter_slug' => 'server' ),
                                array( 'filter_label' => 'Tank Leak Inspections', 'filter_slug' => 'tank' ),
                            ),
                            'projects' => array(
                                array(
                                    'title'    => 'Commercial Plumbing Inspection',
                                    'image'    => array( 'url' => get_project_img( 94, 'project_1.jpg' ), 'id' => 94 ),
                                    'category' => 'kitchen',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Bathroom Sink Plumbing',
                                    'image'    => array( 'url' => get_project_img( 95, 'project_2.jpg' ), 'id' => 95 ),
                                    'category' => 'bathroom',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Outside Excavation & Pipeline',
                                    'image'    => array( 'url' => get_project_img( 96, 'project_3.jpg' ), 'id' => 96 ),
                                    'category' => 'outside',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Kitchen Drain Line Fix',
                                    'image'    => array( 'url' => get_project_img( 97, 'project_4.jpg' ), 'id' => 97 ),
                                    'category' => 'kitchen',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'High Pressure Drain Clearing',
                                    'image'    => array( 'url' => get_project_img( 98, 'project_5.jpg' ), 'id' => 98 ),
                                    'category' => 'drain',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Water Tank Valve Seal',
                                    'image'    => array( 'url' => get_project_img( 99, 'project_6.jpg' ), 'id' => 99 ),
                                    'category' => 'tank',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Underground Sewer Pipe Connection',
                                    'image'    => array( 'url' => get_project_img( 100, 'project_7.jpg' ), 'id' => 100 ),
                                    'category' => 'server',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Bathtub Faucet Replacement',
                                    'image'    => array( 'url' => get_project_img( 101, 'project_8.jpg' ), 'id' => 101 ),
                                    'category' => 'bathroom',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                                array(
                                    'title'    => 'Kitchen P-Trap Assembly',
                                    'image'    => array( 'url' => get_project_img( 102, 'project_9.jpg' ), 'id' => 102 ),
                                    'category' => 'drain',
                                    'link'     => array( 'url' => '/case-study/' ),
                                ),
                            ),
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

// Clear raw HTML post_content so Elementor renders cleanly and footer doesn't duplicate quote strip
wp_update_post( array(
    'ID'           => $post_id,
    'post_content' => '',
    'post_status'  => 'publish',
) );

echo "Successfully configured Projects page (ID: {$post_id}) with Elementor data!\n";
