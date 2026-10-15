<?php
/**
 * Blog Section Template Part
 * 
 * Pulls latest posts from WordPress posts query with fallback.
 *
 * @package PlumberX
 */

$blog_title    = get_theme_mod( 'plumberx_blog_title', 'Latest From Blogs' );
$blog_subtitle = get_theme_mod( 'plumberx_blog_subtitle', 'News & Press Release' );

$latest_posts = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
) );
?>
<section class="home-blog-section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title decorated"><?php echo esc_html( $blog_title ); ?></h2>
      <p class="section-subtitle"><?php echo esc_html( $blog_subtitle ); ?></p>
    </div>

    <div class="home-blog-grid">
      <?php
      if ( $latest_posts->have_posts() ) :
          $post_count = 0;
          $cards_posts = array();
          $sidebar_posts = array();

          while ( $latest_posts->have_posts() ) {
              $latest_posts->the_post();
              $post_count++;
              if ( $post_count <= 2 ) {
                  $cards_posts[] = array(
                      'title'     => get_the_title(),
                      'link'      => get_permalink(),
                      'excerpt'   => wp_trim_words( get_the_excerpt(), 18, '...' ),
                      'date'      => get_the_date( 'F j, Y' ),
                      'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'plumberx-blog' ) ?: PLUMBERX_URI . '/assets/images/blog_main_' . $post_count . '.jpg',
                  );
              } else {
                  $sidebar_posts[] = array(
                      'title'   => get_the_title(),
                      'link'    => get_permalink(),
                      'excerpt' => wp_trim_words( get_the_excerpt(), 10, '...' ),
                      'date'    => get_the_date( 'F j, Y' ),
                  );
              }
          }
          wp_reset_postdata();

          // Render 2 Main Cards
          foreach ( $cards_posts as $card ) :
          ?>
            <article class="blog-card-home">
              <div class="card-img-wrap">
                <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>">
              </div>
              <div class="card-body">
                <h3 class="card-title"><a href="<?php echo esc_url( $card['link'] ); ?>"><?php echo esc_html( $card['title'] ); ?></a></h3>
                <p class="card-desc"><?php echo esc_html( $card['excerpt'] ); ?></p>
                <div class="card-footer">
                  <a href="<?php echo esc_url( $card['link'] ); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'plumberx' ); ?></a>
                  <span class="blog-date"><?php echo esc_html( $card['date'] ); ?></span>
                </div>
              </div>
            </article>
          <?php endforeach; ?>

          <?php if ( ! empty( $sidebar_posts ) ) : ?>
            <div class="blog-list-sidebar-home">
              <?php foreach ( $sidebar_posts as $side ) : ?>
                <div class="blog-list-item-home">
                  <h4 class="card-title"><a href="<?php echo esc_url( $side['link'] ); ?>"><?php echo esc_html( $side['title'] ); ?></a></h4>
                  <p class="card-desc"><?php echo esc_html( $side['excerpt'] ); ?></p>
                  <span class="blog-date"><?php echo esc_html( $side['date'] ); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

      <?php else : ?>
        <!-- Static Fallback Demo Posts -->
        <article class="blog-card-home">
          <div class="card-img-wrap">
            <img src="<?php echo esc_url( PLUMBERX_URI . '/assets/images/blog_main_1.jpg' ); ?>" alt="<?php esc_attr_e( 'These cases are simple Standard', 'plumberx' ); ?>">
          </div>
          <div class="card-body">
            <h3 class="card-title"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">These cases are simple Standard</a></h3>
            <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
            <div class="card-footer">
              <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'plumberx' ); ?></a>
              <span class="blog-date">June 3, 2026</span>
            </div>
          </div>
        </article>

        <article class="blog-card-home">
          <div class="card-img-wrap">
            <img src="<?php echo esc_url( PLUMBERX_URI . '/assets/images/blog_main_2.jpg' ); ?>" alt="<?php esc_attr_e( 'Incapable of drawing an Image', 'plumberx' ); ?>">
          </div>
          <div class="card-body">
            <h3 class="card-title"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Incapable of drawing an Image</a></h3>
            <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
            <div class="card-footer">
              <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'plumberx' ); ?></a>
              <span class="blog-date">May 14, 2026</span>
            </div>
          </div>
        </article>

        <div class="blog-list-sidebar-home">
          <div class="blog-list-item-home">
            <h4 class="card-title"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">It is an almost life for us Gallery</a></h4>
            <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod...</p>
            <span class="blog-date">May 12, 2026</span>
          </div>

          <div class="blog-list-item-home">
            <h4 class="card-title"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Many desktop publishing Audio</a></h4>
            <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod...</p>
            <span class="blog-date">May 11, 2026</span>
          </div>

          <div class="blog-list-item-home">
            <h4 class="card-title"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">This mistaken idea of Video</a></h4>
            <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed. Eiusmod...</p>
            <span class="blog-date">May 9, 2026</span>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
