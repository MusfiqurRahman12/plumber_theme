<?php
/**
 * Setup Shop Page (Post ID 6) with Native Elementor Widgets & WooCommerce Sync
 */

require_once '/var/www/html/wp-load.php';

$post_id = 6;
$site_url = home_url();

function get_shop_img( $att_id, $filename ) {
    $url = wp_get_attachment_url( $att_id );
    if ( $url ) {
        return $url;
    }
    return get_template_directory_uri() . '/assets/images/' . $filename;
}

// 1. Sync the 6 WooCommerce products to match shop.html exactly
$wc_items = array(
    17 => array( 'title' => 'Screw Driver 1', 'price' => '33.00', 'thumb_id' => 119 ),
    15 => array( 'title' => 'Plumbing Tools', 'price' => '15.00', 'thumb_id' => 120 ),
    16 => array( 'title' => 'Safety Items',   'price' => '35.00', 'thumb_id' => 121 ),
    12 => array( 'title' => 'Plumber Cap',    'price' => '35.00', 'thumb_id' => 122 ),
    13 => array( 'title' => 'Screws Box',     'price' => '35.00', 'thumb_id' => 123 ),
    14 => array( 'title' => 'Bolts And Nuts', 'price' => '55.00', 'thumb_id' => 124 ),
);

foreach ( $wc_items as $prod_id => $data ) {
    if ( get_post( $prod_id ) ) {
        wp_update_post( array(
            'ID'         => $prod_id,
            'post_title' => $data['title'],
        ) );
        update_post_meta( $prod_id, '_regular_price', $data['price'] );
        update_post_meta( $prod_id, '_price', $data['price'] );
        set_post_thumbnail( $prod_id, $data['thumb_id'] );
    }
}

// 2. Build Elementor layout for Shop Page (ID 6)
$elementor_data = array(
    // 1. Shop Hero Section
    array(
        'id'       => 'sec_shop_hero',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_shop_hero',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_shop_hero',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_shop_hero',
                        'settings'   => array(
                            'title_red'   => 'Our Featured',
                            'title_cyan'  => 'Products',
                            'description' => 'Our plumbing professionals are thoroughly trained to assess the situation and effectively respond in a way that treats the source of the problems.',
                            'button_text' => 'Shop Now',
                            'button_link' => array( 'url' => '#shopProducts' ),
                            'hero_image'  => array(
                                'id'  => 153,
                                'url' => get_shop_img( 153, 'shop_hero_toilet_clean.png' ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Highlights Strip
    array(
        'id'       => 'sec_shop_highlights',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_shop_highlights',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_shop_highlights',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_shop_highlights',
                        'settings'   => array(
                            'highlights' => array(
                                array(
                                    'title'       => 'FREE SHIPPING',
                                    'description' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
                                    'icon_preset' => 'truck',
                                ),
                                array(
                                    'title'       => 'SALE 15% OFF',
                                    'description' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
                                    'icon_preset' => 'tag',
                                ),
                                array(
                                    'title'       => 'NEW ARRIVAL',
                                    'description' => 'Duis aute irure dolor in reprehend erit in voluptate velit esse cillum dolore eu fugiat nulla.',
                                    'icon_preset' => 'star',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 3. Products Section
    array(
        'id'       => 'sec_shop_products',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_shop_products',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_shop_products',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_shop_products',
                        'settings'   => array(
                            'title_primary'   => 'Products',
                            'title_secondary' => 'from our Store',
                            'source_mode'     => 'repeater',
                            'custom_products' => array(
                                array(
                                    'title'        => 'Screw Driver 1',
                                    'price'        => '$33.00',
                                    'price_number' => 33.00,
                                    'image'        => array(
                                        'id'  => 119,
                                        'url' => get_shop_img( 119, 'shop_item_1.jpg' ),
                                    ),
                                    'button_text'  => 'ADD TO CART',
                                ),
                                array(
                                    'title'        => 'Plumbing Tools',
                                    'price'        => '$15.00',
                                    'price_number' => 15.00,
                                    'image'        => array(
                                        'id'  => 120,
                                        'url' => get_shop_img( 120, 'shop_item_2.jpg' ),
                                    ),
                                    'button_text'  => 'ADD TO CART',
                                ),
                                array(
                                    'title'        => 'Safety Items',
                                    'price'        => '$35.00',
                                    'price_number' => 35.00,
                                    'image'        => array(
                                        'id'  => 121,
                                        'url' => get_shop_img( 121, 'shop_item_3.jpg' ),
                                    ),
                                    'button_text'  => 'ADD TO CART',
                                ),
                                array(
                                    'title'        => 'Plumber Cap',
                                    'price'        => '$35.00',
                                    'price_number' => 35.00,
                                    'image'        => array(
                                        'id'  => 122,
                                        'url' => get_shop_img( 122, 'shop_item_4.jpg' ),
                                    ),
                                    'button_text'  => 'ADD TO CART',
                                ),
                                array(
                                    'title'        => 'Screws Box',
                                    'price'        => '$35.00',
                                    'price_number' => 35.00,
                                    'image'        => array(
                                        'id'  => 123,
                                        'url' => get_shop_img( 123, 'shop_item_5.jpg' ),
                                    ),
                                    'button_text'  => 'ADD TO CART',
                                ),
                                array(
                                    'title'        => 'Bolts And Nuts',
                                    'price'        => '$55.00',
                                    'price_number' => 55.00,
                                    'image'        => array(
                                        'id'  => 124,
                                        'url' => get_shop_img( 124, 'shop_item_6.jpg' ),
                                    ),
                                    'button_text'  => 'ADD TO CART',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 4. Emergency Banner
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

// Update post meta for Shop Page ID 6
update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
update_post_meta( $post_id, '_elementor_version', '3.18.3' );
update_post_meta( $post_id, '_elementor_data', wp_slash( json_encode( $elementor_data ) ) );

// Clear raw post_content
wp_update_post( array(
    'ID'           => $post_id,
    'post_content' => '',
) );

echo "Successfully set up Shop page (Post ID $post_id) with Elementor widgets!\n";
