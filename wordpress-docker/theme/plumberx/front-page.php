<?php
/**
 * Template Name: PlumberX Home
 * 
 * Front page template with all homepage sections.
 * Each section pulls from dynamic fields (Customizer + CPTs).
 * When Elementor is active and this page is built with it,
 * Elementor's content takes over via the_content().
 *
 * @package PlumberX
 */

get_header();

// Check if Elementor built this page
$is_elementor = false;
if ( class_exists( '\Elementor\Plugin' ) ) {
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    if ( $document && $document->is_built_with_elementor() ) {
        $is_elementor = true;
    }
}

if ( $is_elementor ) {
    // Elementor takes full control - drag & drop content
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
} else {
    // Default theme sections (before Elementor editing)
    get_template_part( 'template-parts/home/hero' );
    get_template_part( 'template-parts/home/promo-strip' );
    get_template_part( 'template-parts/home/certified' );
    get_template_part( 'template-parts/home/services-tabs' );
    get_template_part( 'template-parts/home/projects' );
    get_template_part( 'template-parts/home/contractor' );
    get_template_part( 'template-parts/home/team' );
    get_template_part( 'template-parts/home/testimonials' );
    get_template_part( 'template-parts/home/emergency' );
    get_template_part( 'template-parts/home/blog' );
    get_template_part( 'template-parts/home/partners' );
}

get_footer();
