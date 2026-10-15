<?php
/**
 * Single Post Template
 *
 * @package PlumberX
 */

get_header();
?>

<div class="subpage-header-banner">
  <div class="container">
    <h1 class="subpage-title"><?php the_title(); ?></h1>
    <div class="post-meta-header">
      <span><?php echo get_the_date(); ?></span> &bull; 
      <span><?php the_author(); ?></span>
    </div>
  </div>
</div>

<main class="site-main single-post-main">
  <div class="container">
    <div class="single-post-layout">
      <article class="single-post-content">
        <?php
        while ( have_posts() ) : the_post();
            if ( has_post_thumbnail() ) :
            ?>
              <div class="single-featured-image">
                <?php the_post_thumbnail( 'full' ); ?>
              </div>
            <?php
            endif;
        ?>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>

          <?php
          if ( comments_open() || get_comments_number() ) :
              comments_template();
          endif;
        endwhile;
        ?>
      </article>

      <aside class="blog-sidebar-column">
        <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
          <?php dynamic_sidebar( 'blog-sidebar' ); ?>
        <?php endif; ?>
      </aside>
    </div>
  </div>
</main>

<?php
get_footer();
