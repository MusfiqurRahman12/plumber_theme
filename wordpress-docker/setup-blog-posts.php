<?php
/**
 * Setup 4 rich blog posts matching blog.html and blog-single.html
 */

require_once '/var/www/html/wp-load.php';

$article_html = '<p class="blog-dropcap">Lorem ipsum dolor sit amet, consectetur adipisicing elit sed. Eiusmod tempor. incidiut nt ut labore et dolore magna aliqua. Ut enim. ad minim veniam, uis nostrud exerc itation ullamco. Laboris nisi. ut aliquip ex ea commodo consequat. Duis aute irure dolr. inreprehen derit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur. Eiusmod tempor. incidiut nt ut labore et dolore magna aliqua. Ut enim. ad minim veniam, uis nostrud exerc itation ullamco. Laboris nisi. ut aliquip ex ea commodo consequat. Duis aute irure dolr. inreprehen derit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur.</p>
<div style="margin: 30px 0; padding: 18px 25px; text-align: center; border-top: 2px solid #38bdf8; border-bottom: 2px solid #38bdf8; background: #f8fafc;">
  <h4 style="font-size: 13.5px; font-weight: 700; color: #475569; letter-spacing: 0.8px; text-transform: uppercase; line-height: 1.5; margin: 0;">INREPREHEN DERIT IN VOLUPTATE VELIT ESSE CILLUM DOLORE. EU FUGIAT NULLA PARIATUR QUI DOLOREM IPSUM</h4>
</div>
<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.Lorem ipsum dolor sit amet,</p>
<p>consectetur adipisicing elit sed. Eiusmod tempor. incidiut nt ut labore et dolore magna aliqua. Ut enim. ad minim veniam, uis nostrud exerc itation ullamco. Laboris nisi. ut aliquip ex ea commodo consequat. Duis aute irure dolr. inreprehen derit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur qui dolorem ipsum quia dolor sit.</p>
<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.Lorem ipsum dolor sit amet, consectetur adipisicing elit sed. Eiusmod tempor. incidiut nt ut labore et dolore magna aliqua. Ut enim. ad minim veniam, uis nostrud exerc itation ullamco. Laboris nisi. ut aliquip ex ea commodo consequat. Duis aute irure dolr. inreprehen derit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur qui dolorem ipsum quia dolor sit.</p>';

$posts_data = array(
    array(
        'id'        => 169,
        'title'     => 'These cases are simple Standard',
        'slug'      => 'these-cases-are-simple-standard',
        'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit sed. Eiusmod tempor. incidiut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur. Eiusmod tempor...',
        'thumb_id'  => 56, // blog_main_1
        'category'  => 'Adventure',
        'tags'      => array( 'Roofing', 'Plumber', 'Pipe', 'Repair' ),
        'date'      => '2020-05-11 10:00:00',
    ),
    array(
        'title'     => 'Incapable of drawing an Image',
        'slug'      => 'incapable-of-drawing-an-image',
        'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit sed. Eiusmod tempor. incidiut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur. Eiusmod tempor...',
        'thumb_id'  => 57, // blog_main_2
        'category'  => 'Explore',
        'tags'      => array( 'Clean', 'Water', 'Repair' ),
        'date'      => '2020-05-11 09:30:00',
    ),
    array(
        'title'     => 'It is an almost life for us Gallery',
        'slug'      => 'it-is-an-almost-life-for-us-gallery',
        'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit sed. Eiusmod tempor. incidiut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur. Eiusmod tempor...',
        'thumb_id'  => 58, // blog_main_3
        'category'  => 'National parks',
        'tags'      => array( 'Plumber', 'Water', 'Roofing' ),
        'date'      => '2020-05-11 09:00:00',
    ),
    array(
        'title'     => 'Many desktop publishing Audio',
        'slug'      => 'many-desktop-publishing-audio',
        'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit sed. Eiusmod tempor. incidiut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Laboris nisi. ut aliquip ex ea commodo consequat. Duis aute irure dolr. inreprehen derit in voluptate velit esse cillum dolore. Eu fugiat nulla pariatur. Eiusmod tempor...',
        'thumb_id'  => 59, // blog_main_4
        'category'  => 'Travel guide',
        'tags'      => array( 'Pipe', 'Clean', 'Repair' ),
        'date'      => '2020-05-11 08:30:00',
    ),
);

// Delete sample "Hello world!" if present
$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
if ( $hello ) {
    wp_delete_post( $hello->ID, true );
}

foreach ( $posts_data as $item ) {
    $existing = null;
    if ( ! empty( $item['id'] ) ) {
        $existing = get_post( $item['id'] );
    }
    if ( ! $existing ) {
        $existing = get_page_by_path( $item['slug'], OBJECT, 'post' );
    }

    $post_args = array(
        'post_title'    => $item['title'],
        'post_name'     => $item['slug'],
        'post_content'  => $article_html,
        'post_excerpt'  => $item['excerpt'],
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_date'     => $item['date'],
    );

    if ( $existing ) {
        $post_args['ID'] = $existing->ID;
        $pid = wp_update_post( $post_args );
    } else {
        $pid = wp_insert_post( $post_args );
    }

    if ( $pid && ! is_wp_error( $pid ) ) {
        // Set thumbnail
        if ( ! empty( $item['thumb_id'] ) ) {
            set_post_thumbnail( $pid, $item['thumb_id'] );
        }
        // Set category
        $cat_id = wp_create_category( $item['category'] );
        if ( $cat_id ) {
            wp_set_post_categories( $pid, array( $cat_id ) );
        }
        // Set tags
        if ( ! empty( $item['tags'] ) ) {
            wp_set_post_tags( $pid, $item['tags'] );
        }
        echo "Post configured: '{$item['title']}' (ID: $pid)\n";
    }
}
