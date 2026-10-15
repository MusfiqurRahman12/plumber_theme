<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Fully compatible with Elementor full-width and canvas modes.
 *
 * @package PlumberX
 */

get_header();
?>

<main id="primary" class="site-main page-main">
    <?php
    while ( have_posts() ) :
        the_post();

        // Check if Elementor built this page
        $is_elementor = false;
        if ( class_exists( '\Elementor\Plugin' ) ) {
            $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
            if ( $document && $document->is_built_with_elementor() ) {
                $is_elementor = true;
            }
        }

        if ( $is_elementor ) :
            // Elementor handles full width layout
            the_content();
        else :
        ?>
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="container page-content-container">
                <div class="page-content">
                    <?php
                    the_content();
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'plumberx' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>
            </div>
        <?php
        endif;

    endwhile;
    ?>
</main>

<?php
get_footer();
