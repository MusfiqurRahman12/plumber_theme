<?php
/**
 * Main Template File (Blog Index & Archive Fallback)
 *
 * @package PlumberX
 */

get_header();
?>

<div class="subpage-header-banner">
  <div class="container">
    <h1 class="subpage-title"><?php esc_html_e( 'Our Latest Articles & Updates', 'plumberx' ); ?></h1>
    <p class="subpage-subtitle"><?php esc_html_e( 'News, plumbing tips, and guides from certified professionals', 'plumberx' ); ?></p>
  </div>
</div>

<main class="site-main blog-archive-main">
  <div class="container">
    <div class="blog-archive-grid">
      <div class="blog-posts-column">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card-item' ); ?>>
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="card-img-wrap">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'plumberx-blog' ); ?>
                  </a>
                </div>
              <?php endif; ?>
              <div class="card-body">
                <div class="card-meta">
                  <span class="meta-date"><?php echo get_the_date(); ?></span>
                  <span class="meta-author"><?php the_author(); ?></span>
                </div>
                <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="card-excerpt">
                  <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn-read-more"><?php esc_html_e( 'Read More', 'plumberx' ); ?> &rarr;</a>
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

      <aside class="blog-sidebar-column">
        <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
          <?php dynamic_sidebar( 'blog-sidebar' ); ?>
        <?php else : ?>
          <div class="widget widget-recent-posts">
            <h4 class="widget-title"><?php esc_html_e( 'Recent Posts', 'plumberx' ); ?></h4>
            <ul>
              <?php
              $recent = new WP_Query( array( 'posts_per_page' => 5 ) );
              while ( $recent->have_posts() ) : $recent->the_post();
              ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile; wp_reset_postdata(); ?>
            </ul>
          </div>
        <?php endif; ?>
      </aside>
    </div>
  </div>
</main>

<?php
get_footer();
