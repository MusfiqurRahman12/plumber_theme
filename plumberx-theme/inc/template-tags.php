<?php
/**
 * Template Tags Helper Functions
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Output star rating HTML
 */
function plumberx_star_rating( $rating = 5 ) {
    $output = '<div class="testimonial-stars" aria-label="' . esc_attr( $rating ) . ' out of 5 stars">';
    for ( $i = 0; $i < (int) $rating; $i++ ) {
        $output .= '<span>★</span>';
    }
    $output .= '</div>';
    echo $output;
}

/**
 * Output verified badge SVG
 */
function plumberx_verified_badge() {
    echo '<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
}

/**
 * Output phone SVG icon
 */
function plumberx_phone_icon() {
    echo '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24 11.72 11.72 0 003.68.59 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.72 11.72 0 00.59 3.68 1 1 0 01-.24 1.02l-2.23 2.09z"/></svg>';
}

/**
 * Get section heading HTML
 */
function plumberx_section_header( $title, $subtitle = '', $decorated = false ) {
    $class = 'section-header';
    $title_class = 'section-title' . ( $decorated ? ' decorated' : '' );
    echo '<div class="' . esc_attr( $class ) . '">';
    echo '<h2 class="' . esc_attr( $title_class ) . '">' . wp_kses_post( $title ) . '</h2>';
    if ( $subtitle ) {
        echo '<p class="section-subtitle">' . esc_html( $subtitle ) . '</p>';
    }
    echo '</div>';
}

/**
 * Get testimonials query
 */
function plumberx_get_testimonials( $limit = -1 ) {
    return new WP_Query( array(
        'post_type'      => 'plumberx_testimonial',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
}

/**
 * Get team members query
 */
function plumberx_get_team_members( $limit = -1 ) {
    return new WP_Query( array(
        'post_type'      => 'plumberx_team',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
}

/**
 * Get projects query
 */
function plumberx_get_projects( $limit = 8 ) {
    return new WP_Query( array(
        'post_type'      => 'plumberx_project',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
}

/**
 * Get services query
 */
function plumberx_get_services( $limit = -1 ) {
    return new WP_Query( array(
        'post_type'      => 'plumberx_service',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
}

/**
 * Get partners query
 */
function plumberx_get_partners( $limit = -1 ) {
    return new WP_Query( array(
        'post_type'      => 'plumberx_partner',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );
}
