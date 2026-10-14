<?php
/**
 * The main template file
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
  <div class="container" style="padding: 4rem 1.25rem;">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_title('<h1 class="section-title">', '</h1>');
            the_content();
        endwhile;
    else :
        echo '<p>' . esc_html__('No content found.', 'apexflow-plumbing') . '</p>';
    endif;
    ?>
  </div>
</main>

<?php
get_footer();
