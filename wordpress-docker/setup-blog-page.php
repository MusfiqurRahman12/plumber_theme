<?php
/**
 * Setup Blog Page (Post ID 167) with Native Elementor Widgets
 */

require_once '/var/www/html/wp-load.php';

$post_id = 167;
$site_url = home_url();

function get_blog_media_url( $att_id, $filename ) {
    $url = wp_get_attachment_url( $att_id );
    if ( $url ) {
        return $url;
    }
    return get_template_directory_uri() . '/assets/images/' . $filename;
}

$elementor_data = array(
    // 1. Blog Hero Banner with Service Van
    array(
        'id'       => 'sec_blog_hero',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_blog_hero',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_blog_hero',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_blog_hero',
                        'settings'   => array(
                            'title'     => 'Blog',
                            'van_image' => array( 'url' => get_blog_media_url( 140, 'blog_banner_van.png' ), 'id' => 140 ),
                            'bg_image'  => array( 'url' => get_blog_media_url( 69, 'blog_top_crop.jpg' ), 'id' => 69 ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 2. Blog Posts & Sidebar Layout
    array(
        'id'       => 'sec_blog_list',
        'elType'   => 'section',
        'isInner'  => false,
        'settings' => array(
            'layout' => 'full_width',
            'gap'    => 'no',
        ),
        'elements' => array(
            array(
                'id'       => 'col_blog_list',
                'elType'   => 'column',
                'isInner'  => false,
                'settings' => array( '_column_size' => 100 ),
                'elements' => array(
                    array(
                        'id'         => 'wgt_blog_list',
                        'elType'     => 'widget',
                        'widgetType' => 'plumberx_blog_list',
                        'settings'   => array(
                            'posts_per_page'    => 4,
                            'show_pagination'   => 'yes',
                            'show_sidebar'      => 'yes',
                            'show_search'       => 'yes',
                            'search_title'      => 'Search',
                            'show_categories'   => 'yes',
                            'categories_title'  => 'Categories',
                            'show_recent_news'  => 'yes',
                            'recent_news_title' => 'Recent News',
                            'show_tags'         => 'yes',
                            'tags_title'        => 'Tags',
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

echo "Successfully set up Blog page (Post ID $post_id) with Elementor widgets!\n";
