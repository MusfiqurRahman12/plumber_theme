<?php
/**
 * Bulk Import All Assets into WordPress Media Library
 */

require_once '/var/www/html/wp-load.php';
require_once '/var/www/html/wp-admin/includes/image.php';
require_once '/var/www/html/wp-admin/includes/file.php';
require_once '/var/www/html/wp-admin/includes/media.php';

$assets_dir = get_template_directory() . '/assets/images';
if ( ! is_dir( $assets_dir ) ) {
    die( "Assets directory not found: $assets_dir\n" );
}

$files = glob( $assets_dir . '/*.{jpg,jpeg,png,webp,svg}', GLOB_BRACE );
$media_map = get_option( 'plumberx_media_map', array() );

$imported = 0;
$skipped  = 0;

foreach ( $files as $file_path ) {
    $filename = basename( $file_path );

    // Check if already imported
    if ( isset( $media_map[ $filename ] ) && wp_get_attachment_url( $media_map[ $filename ]['id'] ) ) {
        $skipped++;
        continue;
    }

    $file_content = file_get_contents( $file_path );
    $upload = wp_upload_bits( $filename, null, $file_content );

    if ( ! empty( $upload['error'] ) ) {
        echo "Error uploading $filename: " . $upload['error'] . "\n";
        continue;
    }

    $wp_filetype = wp_check_filetype( $filename, null );
    $title = preg_replace( '/\.[^.]+$/', '', $filename );

    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_text_field( str_replace( array( '-', '_' ), ' ', $title ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $upload['file'] );

    if ( ! is_wp_error( $attach_id ) ) {
        $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        $url = wp_get_attachment_url( $attach_id );
        $media_map[ $filename ] = array(
            'id'  => $attach_id,
            'url' => $url,
        );
        $imported++;
        echo "Imported: $filename (ID: $attach_id)\n";
    }
}

update_option( 'plumberx_media_map', $media_map );
echo "\nTotal assets in map: " . count( $media_map ) . "\n";
echo "New imported: $imported, Skipped existing: $skipped\n";
