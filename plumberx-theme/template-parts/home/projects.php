<?php
/**
 * Projects Section Template Part
 * @package PlumberX
 */
$projects = plumberx_get_projects( 8 );
?>
<section class="projects-dark-section">
  <div class="container">
    <?php plumberx_section_header( 'Our Projects' ); ?>

    <div class="projects-grid">
      <?php if ( $projects->have_posts() ) : while ( $projects->have_posts() ) : $projects->the_post();
        $subtitle = get_post_meta( get_the_ID(), '_project_subtitle', true );
        $img_url  = get_the_post_thumbnail_url( get_the_ID(), 'plumberx-project' );
        $cats     = get_the_terms( get_the_ID(), 'project_category' );
        $cat_name = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->name : $subtitle;
      ?>
        <div class="project-card" <?php if ( $cats && ! is_wp_error( $cats ) ) echo 'data-category="' . esc_attr( $cats[0]->slug ) . '"'; ?>>
          <?php if ( $img_url ) : ?>
            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
          <?php endif; ?>
          <div class="project-overlay">
            <h4 class="project-overlay-title"><?php the_title(); ?></h4>
            <span class="project-overlay-cat"><?php echo esc_html( $cat_name ); ?></span>
            <button class="project-zoom-btn" data-img="<?php echo esc_url( $img_url ); ?>">+</button>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <!-- Fallback static projects -->
        <?php for ( $i = 1; $i <= 8; $i++ ) : ?>
        <div class="project-card">
          <img src="<?php echo PLUMBERX_URI; ?>/assets/images/project_<?php echo $i; ?>.jpg" alt="Project <?php echo $i; ?>">
          <div class="project-overlay">
            <h4 class="project-overlay-title">Project <?php echo $i; ?></h4>
            <span class="project-overlay-cat">Plumbing</span>
            <button class="project-zoom-btn" data-img="<?php echo PLUMBERX_URI; ?>/assets/images/project_<?php echo $i; ?>.jpg">+</button>
          </div>
        </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>

    <div class="text-center">
      <a href="<?php echo esc_url( get_post_type_archive_link( 'plumberx_project' ) ); ?>" class="view-all-projects-btn"><?php esc_html_e( 'VIEW ALL', 'plumberx' ); ?></a>
    </div>
  </div>
</section>
