<?php
/**
 * Main Template File (Blog Index & Archive Fallback)
 *
 * @package PlumberX
 */

get_header();
?>

<!-- Blog Hero Banner with Service Van -->
<section class="blog-hero-banner">
  <div class="container blog-hero-grid">
    <div class="blog-hero-text">
      <h1 class="blog-hero-title">
        <?php
        if ( is_search() ) {
            /* translators: %s: search query. */
            printf( esc_html__( 'Search: %s', 'plumberx' ), '<span>' . get_search_query() . '</span>' );
        } elseif ( is_archive() ) {
            the_archive_title();
        } else {
            esc_html_e( 'Blog', 'plumberx' );
        }
        ?>
      </h1>
    </div>
    <div class="blog-hero-van-col">
      <img src="<?php echo esc_url( PLUMBERX_URI . '/assets/images/blog_banner_van.png' ); ?>" alt="<?php esc_attr_e( 'PlumberX Service Van', 'plumberx' ); ?>" class="blog-hero-van-img">
    </div>
  </div>
</section>

<!-- Blog Layout Section -->
<section class="blog-layout-section">
  <div class="container blog-grid-layout">
    
    <!-- Main Blog Posts List -->
    <div class="blog-posts-main">
      <?php
      if ( have_posts() ) :
          $post_index = 0;
          while ( have_posts() ) : the_post();
              $post_index++;
              $fallback_img = PLUMBERX_URI . '/assets/images/blog_main_' . ( ( ( $post_index - 1 ) % 4 ) + 1 ) . '.jpg';
      ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-card' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'full', array( 'class' => 'blog-post-featured-img' ) ); ?>
            <?php else : ?>
              <img src="<?php echo esc_url( $fallback_img ); ?>" alt="<?php the_title_attribute(); ?>" class="blog-post-featured-img">
            <?php endif; ?>
            <div class="blog-post-content">
              <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="blog-post-meta">
                <span class="blog-date">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:4px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                  </svg>
                  <?php echo get_the_date( 'M d, Y' ); ?>
                </span>
                <span class="blog-author"><?php esc_html_e( 'by', 'plumberx' ); ?> <?php the_author(); ?></span>
              </div>
              <p class="blog-post-excerpt">
                <?php echo wp_trim_words( get_the_excerpt(), 45 ); ?>
              </p>
              <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'plumberx' ); ?></a>
            </div>
          </article>
      <?php
          endwhile;

          the_posts_pagination( array(
              'prev_text' => __( '&laquo; Previous', 'plumberx' ),
              'next_text' => __( 'Next &raquo;', 'plumberx' ),
          ) );
      else :
          echo '<p>' . esc_html__( 'No posts found.', 'plumberx' ) . '</p>';
      endif;
      ?>
    </div>

    <!-- Blog Sidebar -->
    <aside class="blog-sidebar">
      
      <!-- Search Widget -->
      <div class="sidebar-widget">
        <h4 class="widget-title"><?php esc_html_e( 'Search', 'plumberx' ); ?></h4>
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex; gap: 8px;">
          <input type="search" name="s" class="form-input" placeholder="<?php esc_attr_e( 'Search keywords...', 'plumberx' ); ?>" required style="padding: 10px 14px;" value="<?php echo get_search_query(); ?>">
          <button type="submit" class="btn-quote-submit" style="width: auto; padding: 10px 20px; white-space:nowrap;"><?php esc_html_e( 'Search', 'plumberx' ); ?></button>
        </form>
      </div>

      <!-- Categories Widget -->
      <div class="sidebar-widget widget-categories">
        <h4 class="widget-title"><?php esc_html_e( 'Categories', 'plumberx' ); ?></h4>
        <ul style="list-style: none; padding: 0; margin: 0;">
          <?php
          $categories = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 6 ) );
          if ( ! empty( $categories ) ) :
              foreach ( $categories as $cat ) :
              ?>
                <li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">&gt; <?php echo esc_html( $cat->name ); ?></a></li>
              <?php
              endforeach;
          else :
          ?>
            <li><a href="#">&gt; Installation of Roof</a></li>
            <li><a href="#">&gt; Damage Roof</a></li>
            <li><a href="#">&gt; Roof Renovation</a></li>
            <li><a href="#">&gt; Company Profile</a></li>
            <li><a href="#">&gt; Roof Projects</a></li>
            <li><a href="#">&gt; Roof Gutter</a></li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Recent News Widget -->
      <div class="sidebar-widget">
        <h4 class="widget-title"><?php esc_html_e( 'Recent News', 'plumberx' ); ?></h4>
        <div class="recent-news-list">
          <?php
          $recent_posts = wp_get_recent_posts( array(
              'numberposts' => 4,
              'post_status' => 'publish',
          ) );
          if ( ! empty( $recent_posts ) ) :
              foreach ( $recent_posts as $r_idx => $recent ) :
                  $thumb = get_the_post_thumbnail_url( $recent['ID'], 'thumbnail' );
                  if ( empty( $thumb ) ) {
                      $thumb = PLUMBERX_URI . '/assets/images/blog_thumb_' . ( ( $r_idx % 4 ) + 1 ) . '.jpg';
                  }
              ?>
                <div class="recent-news-item">
                  <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $recent['post_title'] ); ?>" class="recent-news-thumb">
                  <div class="recent-news-info">
                    <h5><a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>"><?php echo esc_html( $recent['post_title'] ); ?></a></h5>
                    <span><?php echo get_the_date( 'd M. Y', $recent['ID'] ); ?></span>
                  </div>
                </div>
              <?php
              endforeach;
              wp_reset_query();
          endif;
          ?>
        </div>
      </div>

      <!-- Tags Widget -->
      <div class="sidebar-widget">
        <h4 class="widget-title"><?php esc_html_e( 'Tags', 'plumberx' ); ?></h4>
        <div class="widget-tags">
          <?php
          $tags = get_tags( array( 'number' => 6 ) );
          if ( ! empty( $tags ) ) :
              foreach ( $tags as $t_idx => $tag ) :
                  $active_class = ( 0 === $t_idx ) ? ' active' : '';
              ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-btn<?php echo esc_attr( $active_class ); ?>"><?php echo esc_html( $tag->name ); ?></a>
              <?php
              endforeach;
          else :
          ?>
            <a href="#" class="tag-btn active">Roofing</a>
            <a href="#" class="tag-btn">Clean</a>
            <a href="#" class="tag-btn">Water</a>
            <a href="#" class="tag-btn">Plumber</a>
            <a href="#" class="tag-btn">Pipe</a>
            <a href="#" class="tag-btn">Repair</a>
          <?php endif; ?>
        </div>
      </div>

    </aside>

  </div>
</section>

<?php
get_footer();
