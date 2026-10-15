<?php
/**
 * Attach media to products and projects
 */
require_once '/var/www/html/wp-load.php';
require_once '/var/www/html/wp-admin/includes/image.php';
require_once '/var/www/html/wp-admin/includes/file.php';
require_once '/var/www/html/wp-admin/includes/media.php';

function plumberx_attach_local_image( $post_id, $file_path ) {
    if ( ! file_exists( $file_path ) ) {
        return false;
    }
    $filename = basename( $file_path );
    $upload_file = wp_upload_bits( $filename, null, file_get_contents( $file_path ) );
    if ( ! $upload_file['error'] ) {
        $wp_filetype = wp_check_filetype( $filename, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
        if ( ! is_wp_error( $attachment_id ) ) {
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
            set_post_thumbnail( $post_id, $attachment_id );
            return $attachment_id;
        }
    }
    return false;
}

$theme_dir = get_template_directory();

// 1. Attach Shop Product Images
$products = wc_get_products( array( 'limit' => 10 ) );
$shop_idx = 1;
foreach ( $products as $prod ) {
    $img_path = $theme_dir . '/assets/images/shop_item_' . ( ( ( $shop_idx - 1 ) % 6 ) + 1 ) . '.jpg';
    if ( ! has_post_thumbnail( $prod->get_id() ) ) {
        plumberx_attach_local_image( $prod->get_id(), $img_path );
        echo "Attached image to product: " . $prod->get_name() . "\n";
    }
    $shop_idx++;
}

// 2. Attach Project Images
$projects = get_posts( array( 'post_type' => 'plumberx_project', 'numberposts' => 10 ) );
$proj_idx = 1;
foreach ( $projects as $proj ) {
    $img_path = $theme_dir . '/assets/images/project_' . ( ( ( $proj_idx - 1 ) % 8 ) + 1 ) . '.jpg';
    if ( ! has_post_thumbnail( $proj->ID ) ) {
        plumberx_attach_local_image( $proj->ID, $img_path );
        echo "Attached image to project: " . $proj->post_title . "\n";
    }
    $proj_idx++;
}

echo "Image attachment complete!\n";
