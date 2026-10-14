<?php
/**
 * The template for displaying the home page
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

  <?php
  // Modular Template Parts (Easily customize or replace with ACF / Gutenberg blocks)
  get_template_part('template-parts/hero');
  get_template_part('template-parts/trust-bar');
  get_template_part('template-parts/services');
  get_template_part('template-parts/why-us');
  get_template_part('template-parts/emergency-banner');
  get_template_part('template-parts/process');
  get_template_part('template-parts/reviews');
  get_template_part('template-parts/faq');
  get_template_part('template-parts/service-areas');
  ?>

</main>

<?php
get_footer();
