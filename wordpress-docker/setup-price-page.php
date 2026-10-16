<?php
/**
 * Setup Price Plans Page (Post ID 166) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 166;
$site_url = home_url();

function get_price_img( $att_id, $filename ) {
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
                            'title'                   => 'Price',
                            'show_breadcrumb'         => 'yes',
                            'breadcrumb_parent_text'  => 'Home',
                            'breadcrumb_parent_url'   => array( 'url' => '/' ),
                            'breadcrumb_middle_text'  => 'Pages',
                            'breadcrumb_middle_url'   => array( 'url' => '#' ),
                            'breadcrumb_current_text' => 'Price',
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Pricing Plans Section
    array(
        'id'       => 'sec_pricing',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_pricing',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_pricing',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_pricing',
                        'settings'   => array(
                            'title'           => 'We always offer value for money with totally transparent charges',
                            'description'     => "Don't hesitate to ask any plumbing or repairing questions via telephone, or reach through our contact structure underneath. Your message will be dispatched straightforwardly to our staff who will reply when they can.",
                            'pricing_list'    => array(
                                array(
                                    '_id'       => 'card_1',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 83, 'price_1.jpg' ), 'id' => 83 ),
                                ),
                                array(
                                    '_id'       => 'card_2',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 86, 'price_2.jpg' ), 'id' => 86 ),
                                ),
                                array(
                                    '_id'       => 'card_3',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 87, 'price_3.jpg' ), 'id' => 87 ),
                                ),
                                array(
                                    '_id'       => 'card_4',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 88, 'price_4.jpg' ), 'id' => 88 ),
                                ),
                                array(
                                    '_id'       => 'card_5',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 89, 'price_5.jpg' ), 'id' => 89 ),
                                ),
                                array(
                                    '_id'       => 'card_6',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 90, 'price_6.jpg' ), 'id' => 90 ),
                                ),
                                array(
                                    '_id'       => 'card_7',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 91, 'price_7.jpg' ), 'id' => 91 ),
                                ),
                                array(
                                    '_id'       => 'card_8',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 92, 'price_8.jpg' ), 'id' => 92 ),
                                ),
                                array(
                                    '_id'       => 'card_9',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 93, 'price_9.jpg' ), 'id' => 93 ),
                                ),
                                array(
                                    '_id'       => 'card_10',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 84, 'price_10.jpg' ), 'id' => 84 ),
                                ),
                                array(
                                    '_id'       => 'card_11',
                                    'title'     => 'Repair a Sewer Main',
                                    'price'     => '$199',
                                    'avg_label' => 'Average',
                                    'image'     => array( 'url' => get_price_img( 85, 'price_11.jpg' ), 'id' => 85 ),
                                ),
                            ),
                            'show_query_card' => 'yes',
                            'query_title'     => 'Contact us for any other Querry',
                            'query_link_text' => 'Click here',
                            'query_link_url'  => array( 'url' => '/contact/' ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

// Update post
update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
update_post_meta( $post_id, '_elementor_version', '3.18.3' );
update_post_meta( $post_id, '_elementor_data', wp_slash( json_encode( $elementor_data ) ) );

// Clear raw post_content to prevent duplicate content
wp_update_post( array(
    'ID'           => $post_id,
    'post_content' => '',
) );

echo "Successfully set up Price Plans page (Post ID $post_id) with Elementor widgets!\n";
