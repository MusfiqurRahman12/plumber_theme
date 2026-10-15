<?php
/**
 * Archive Template for Projects
 *
 * @package PlumberX
 */

get_header();
?>

<!-- Subpage Banner -->
<section class="subpage-banner">
  <div class="container banner-content">
    <h1 class="banner-title"><?php esc_html_e( 'Our Projects', 'plumberx' ); ?></h1>
    <div class="breadcrumb-list">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'plumberx' ); ?></a>
      <span class="breadcrumb-separator">&gt;</span>
      <span><?php esc_html_e( 'Projects', 'plumberx' ); ?></span>
    </div>
  </div>
</section>

<!-- Projects Gallery Section -->
<section class="projects-gallery-section">
  <div class="container">
    
    <!-- Filter Navigation -->
    <div class="gallery-filter-nav">
      <button class="gallery-filter-btn active" data-filter="all"><?php esc_html_e( 'All', 'plumberx' ); ?></button>
      <button class="gallery-filter-btn" data-filter="kitchen"><?php esc_html_e( 'Kitchen', 'plumberx' ); ?></button>
      <button class="gallery-filter-btn" data-filter="bathroom"><?php esc_html_e( 'Bathroom', 'plumberx' ); ?></button>
      <button class="gallery-filter-btn" data-filter="drain"><?php esc_html_e( 'Drain Cleaning', 'plumberx' ); ?></button>
      <button class="gallery-filter-btn" data-filter="outside"><?php esc_html_e( 'Outside Plumbing', 'plumberx' ); ?></button>
      <button class="gallery-filter-btn" data-filter="server"><?php esc_html_e( 'Server Lines Cleaning', 'plumberx' ); ?></button>
      <button class="gallery-filter-btn" data-filter="tank"><?php esc_html_e( 'Tank Leak Inspections', 'plumberx' ); ?></button>
    </div>

    <!-- 9 Item Project Grid -->
    <div class="gallery-grid-9">
      <?php
      $projects = new WP_Query( array(
          'post_type'      => 'plumberx_project',
          'posts_per_page' => 12,
          'post_status'    => 'publish',
      ) );

      if ( $projects->have_posts() ) :
          $idx = 0;
          $categories_cycle = array( 'kitchen', 'bathroom', 'outside', 'drain', 'server', 'tank', 'kitchen', 'bathroom', 'drain' );
          while ( $projects->have_posts() ) : $projects->the_post();
              $idx++;
              $cat = $categories_cycle[ ( $idx - 1 ) % count( $categories_cycle ) ];
              $terms = get_the_terms( get_the_ID(), 'project_category' );
              if ( $terms && ! is_wp_error( $terms ) ) {
                  $cat = $terms[0]->slug;
              }
              $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?: PLUMBERX_URI . '/assets/images/project_' . ( ( ( $idx - 1 ) % 8 ) + 1 ) . '.jpg';
      ?>
        <div class="gallery-card" data-category="<?php echo esc_attr( $cat ); ?>">
          <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
          <div class="gallery-card-overlay">
            <div class="gallery-action-btns">
              <button class="gallery-action-btn project-zoom-btn" data-img="<?php echo esc_url( $img_url ); ?>" title="Zoom In" aria-label="Zoom In">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  <line x1="11" y1="8" x2="11" y2="14"></line>
                  <line x1="8" y1="11" x2="14" y2="11"></line>
                </svg>
              </button>
              <a href="<?php echo esc_url( home_url( '/case-study/' ) ); ?>" class="gallery-action-btn" title="View Case Study" aria-label="View Case Study">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                  <polyline points="15 3 21 3 21 9"></polyline>
                  <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
              </a>
            </div>
          </div>
        </div>
      <?php
          endwhile;
          wp_reset_postdata();
      else :
          for ( $i = 1; $i <= 9; $i++ ) :
              $sample_cats = array( 'kitchen', 'bathroom', 'outside', 'drain', 'server', 'tank', 'kitchen', 'bathroom', 'drain' );
              $sample_cat = $sample_cats[ $i - 1 ];
              $img_url = PLUMBERX_URI . '/assets/images/project_' . ( ( ( $i - 1 ) % 8 ) + 1 ) . '.jpg';
      ?>
        <div class="gallery-card" data-category="<?php echo esc_attr( $sample_cat ); ?>">
          <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( 'Project ' . $i ); ?>">
          <div class="gallery-card-overlay">
            <div class="gallery-action-btns">
              <button class="gallery-action-btn project-zoom-btn" data-img="<?php echo esc_url( $img_url ); ?>" title="Zoom In" aria-label="Zoom In">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  <line x1="11" y1="8" x2="11" y2="14"></line>
                  <line x1="8" y1="11" x2="14" y2="11"></line>
                </svg>
              </button>
              <a href="<?php echo esc_url( home_url( '/case-study/' ) ); ?>" class="gallery-action-btn" title="View Case Study" aria-label="View Case Study">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                  <polyline points="15 3 21 3 21 9"></polyline>
                  <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
              </a>
            </div>
          </div>
        </div>
      <?php
          endfor;
      endif;
      ?>
    </div>

  </div>
</section>

<?php
get_footer();
