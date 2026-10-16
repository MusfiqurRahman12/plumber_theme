<?php
/**
 * Export Complete PlumberX Demo Content to Structured JSON
 */

require_once '/var/www/html/wp-load.php';

$export = array(
    'theme'       => 'plumberx',
    'version'     => '1.0.1',
    'exported_at' => gmdate( 'Y-m-d H:i:s' ),
    'pages'       => array(),
    'posts'       => array(),
    'products'    => array(),
    'menu'        => array(),
    'options'     => array(),
    'attachments' => array(),
);

// 1. Export 12 Pages
$page_ids = array( 11, 159, 160, 161, 162, 163, 164, 165, 166, 167, 168, 6 );
foreach ( $page_ids as $id ) {
    $p = get_post( $id );
    if ( $p ) {
        $raw_el_data = get_post_meta( $id, '_elementor_data', true );
        $export['pages'][ $p->post_name ] = array(
            'title'          => $p->post_title,
            'slug'           => $p->post_name,
            'content'        => $p->post_content,
            'template'       => get_post_meta( $id, '_wp_page_template', true ),
            'edit_mode'      => get_post_meta( $id, '_elementor_edit_mode', true ),
            'template_type'  => get_post_meta( $id, '_elementor_template_type', true ),
            'elementor_data' => $raw_el_data ? json_decode( $raw_el_data, true ) : array(),
        );
    }
}

// 2. Export 4 Blog Posts
$post_ids = array( 169, 204, 205, 206 );
foreach ( $post_ids as $id ) {
    $p = get_post( $id );
    if ( $p ) {
        $cats = wp_get_post_categories( $id, array( 'fields' => 'names' ) );
        $thumb_id = get_post_thumbnail_id( $id );
        $thumb_meta = $thumb_id ? get_post_meta( $thumb_id, '_wp_attached_file', true ) : '';
        $export['posts'][] = array(
            'title'          => $p->post_title,
            'slug'           => $p->post_name,
            'content'        => $p->post_content,
            'excerpt'        => $p->post_excerpt,
            'categories'     => $cats,
            'thumb_file'     => $thumb_meta ? basename( $thumb_meta ) : '',
        );
    }
}

// 3. Export 6 Products
$prod_ids = array( 17, 15, 16, 12, 13, 14 );
foreach ( $prod_ids as $id ) {
    $p = get_post( $id );
    if ( $p ) {
        $thumb_id = get_post_thumbnail_id( $id );
        $thumb_meta = $thumb_id ? get_post_meta( $thumb_id, '_wp_attached_file', true ) : '';
        $export['products'][] = array(
            'title'      => $p->post_title,
            'slug'       => $p->post_name,
            'price'      => get_post_meta( $id, '_regular_price', true ) ?: '35.00',
            'thumb_file' => $thumb_meta ? basename( $thumb_meta ) : '',
        );
    }
}

// 4. Export Menu items
$menu_items = wp_get_nav_menu_items( 21 );
if ( $menu_items ) {
    foreach ( $menu_items as $item ) {
        $export['menu'][] = array(
            'title'    => $item->title,
            'url'      => $item->url,
            'parent'   => $item->menu_item_parent,
            'db_id'    => $item->ID,
            'order'    => $item->menu_order,
        );
    }
}

// 5. Export Attachments
$attachments = get_posts( array(
    'post_type'      => 'attachment',
    'posts_per_page' => -1,
    'post_status'    => 'inherit',
) );
foreach ( $attachments as $att ) {
    $file = get_post_meta( $att->ID, '_wp_attached_file', true );
    if ( $file ) {
        $export['attachments'][] = array(
            'id'       => $att->ID,
            'title'    => $att->post_title,
            'filename' => basename( $file ),
        );
    }
}

// 6. Options
$export['options'] = array(
    'show_on_front'            => 'page',
    'page_on_front_slug'       => 'home',
    'page_for_posts_slug'      => 'blog',
    'woocommerce_shop_page'    => 'shop',
    'woocommerce_coming_soon'  => 'no',
);

$json = json_encode( $export, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
file_put_contents( '/tmp/plumberx-demo-content.json', $json );

echo "Successfully exported PlumberX demo content (" . strlen( $json ) . " bytes)!\n";
echo "Pages exported: " . count( $export['pages'] ) . "\n";
echo "Posts exported: " . count( $export['posts'] ) . "\n";
echo "Products exported: " . count( $export['products'] ) . "\n";
echo "Menu items exported: " . count( $export['menu'] ) . "\n";
