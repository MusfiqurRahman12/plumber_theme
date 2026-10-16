<?php
/**
 * Certified Section Template Part
 * @package PlumberX
 */
?>
<section class="certified-section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title"><strong><?php esc_html_e( 'We are certified', 'plumberx' ); ?></strong> <?php esc_html_e( 'plumber in Los Angle', 'plumberx' ); ?></h2>
      <p class="section-subtitle"><?php esc_html_e( 'We have the wherewithal to handle a number of plumbing situations in any of these locations. Don\'t hesitate to enlist our services!', 'plumberx' ); ?></p>
    </div>

    <?php
    $services = plumberx_get_services( 3 );
    if ( $services->have_posts() ) :
    ?>
    <div class="certified-grid">
      <?php $i = 0; while ( $services->have_posts() ) : $services->the_post(); $i++; ?>
        <div class="<?php echo $i === 1 ? 'certified-card-blue' : 'certified-card-standard'; ?>">
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="card-img-wrap">
            <?php the_post_thumbnail( 'plumberx-blog' ); ?>
          </div>
          <?php endif; ?>
          <div class="card-body">
            <h3 class="card-title"><?php the_title(); ?></h3>
            <p class="card-desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php else : ?>
    <!-- Fallback static content -->
    <div class="certified-grid">
      <div class="certified-card-blue">
        <div class="card-img-wrap"><img src="<?php echo PLUMBERX_URI; ?>/assets/images/home_certified_1.jpg" alt="We Are Plumber"></div>
        <div class="card-body">
          <h3 class="card-title">We Are Plumber</h3>
          <p class="card-desc">Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odios Suspendisse cursus mal suada facilisis.</p>
        </div>
      </div>
      <div class="certified-card-standard">
        <div class="card-img-wrap"><img src="<?php echo PLUMBERX_URI; ?>/assets/images/home_certified_2.jpg" alt="Commercial Plumbing"></div>
        <div class="card-body">
          <h3 class="card-title">Commercial Plumbing</h3>
          <p class="card-desc">Plumbing problems can be disastrous for commercial locations. Something as simple as a leak or a clogged pipe.</p>
        </div>
      </div>
      <div class="certified-card-standard">
        <div class="card-img-wrap"><img src="<?php echo PLUMBERX_URI; ?>/assets/images/home_certified_3.jpg" alt="Commercial Plumbing"></div>
        <div class="card-body">
          <h3 class="card-title">Commercial Plumbing</h3>
          <p class="card-desc">Plumbing problems can be disastrous for commercial locations. Something as simple as a leak or a clogged pipe.</p>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
