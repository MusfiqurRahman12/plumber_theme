<?php
require_once '/var/www/html/wp-load.php';

$pages = get_posts( array( 'post_type' => 'page', 'numberposts' => -1 ) );
foreach ( $pages as $p ) {
    $cleaned = preg_replace( '/<div class="quote-strip-button-wrap">.*?<\/div>/s', '', $p->post_content );
    if ( $cleaned !== $p->post_content ) {
        wp_update_post( array( 'ID' => $p->ID, 'post_content' => $cleaned ) );
        echo "Cleaned quote button from: " . $p->post_title . "\n";
    }
}
echo "Quote button cleanup complete.\n";
