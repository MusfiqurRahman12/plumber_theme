<?php
/**
 * Single Post Template
 *
 * @package PlumberX
 */

get_header();
?>

<!-- Subpage Banner -->
<section class="subpage-banner">
  <div class="container banner-content">
    <h1 class="banner-title" style="font-size: 28px;"><?php the_title(); ?></h1>
    <div class="breadcrumb-list">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'plumberx' ); ?></a>
      <span class="breadcrumb-separator">&gt;</span>
      <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'plumberx' ); ?></a>
      <span class="breadcrumb-separator">&gt;</span>
      <span><?php the_title(); ?></span>
    </div>
  </div>
</section>

<!-- Single Blog Content Layout -->
<section class="blog-layout-section">
  <div class="container blog-grid-layout">
    
    <!-- Article Left Column -->
    <article class="blog-single-body">
      <?php
      while ( have_posts() ) : the_post();
      ?>
        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
          <div style="margin-bottom: 25px; border-radius: var(--radius-sm); overflow:hidden; box-shadow: var(--shadow-sm);">
            <?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: auto; display:block;' ) ); ?>
          </div>
        <?php else : ?>
          <div style="margin-bottom: 25px; border-radius: var(--radius-sm); overflow:hidden; box-shadow: var(--shadow-sm);">
            <img src="<?php echo esc_url( PLUMBERX_URI . '/assets/images/blog_single_featured.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: auto; display:block;">
          </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="entry-content">
          <?php the_content(); ?>
        </div>

        <!-- Meta Line -->
        <div style="font-size: 12.5px; color: #64748b; margin-top: 30px; padding-top: 14px; border-top: 1px solid var(--border-light);">
          <?php esc_html_e( 'Posted in', 'plumberx' ); ?> <?php the_category( ', ' ); ?> &bull; <?php comments_number( esc_html__( 'No Comments', 'plumberx' ), esc_html__( '1 Comment', 'plumberx' ), esc_html__( '% Comments', 'plumberx' ) ); ?>
        </div>

        <!-- Author Bio Box -->
        <div class="author-bio-box">
          <?php
          $avatar_img = get_avatar_url( get_the_author_meta( 'ID' ) );
          // If local environment or Gravatar fails, use theme author_avatar.png
          $avatar_url = PLUMBERX_URI . '/assets/images/author_avatar.png';
          ?>
          <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>" class="author-avatar-img">
          <div class="author-info">
            <h4><?php the_author(); ?></h4>
            <p>
              <?php
              $bio = get_the_author_meta( 'description' );
              echo esc_html( ! empty( $bio ) ? $bio : 'This is a sample bio, you can change it from the admin panel easily. Share a little biographical information to fill out your profile. This may be shown publicly.' );
              ?>
            </p>
          </div>
        </div>

        <!-- Navigation Links -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
          <div>
            <?php previous_post_link( '%link', '&laquo; %title' ); ?>
          </div>
          <div>
            <?php next_post_link( '%link', '%title &raquo;' ); ?>
          </div>
        </div>

        <!-- Comment Section -->
        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
      endwhile;
      ?>
    </article>

    <!-- Sidebar Right Column -->
    <aside class="blog-sidebar">
      
      <!-- Search Widget -->
      <div class="sidebar-widget">
        <label style="font-size: 13px; font-weight: 600; color: #475569; display:block; margin-bottom: 8px;"><?php esc_html_e( 'Search', 'plumberx' ); ?></label>
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex; gap: 8px;">
          <input type="search" name="s" class="form-input" placeholder="<?php esc_attr_e( 'Search keywords...', 'plumberx' ); ?>" required style="padding: 10px 14px;" value="<?php echo get_search_query(); ?>">
          <button type="submit" class="btn-quote-submit" style="width: auto; padding: 10px 22px; white-space:nowrap;"><?php esc_html_e( 'Search', 'plumberx' ); ?></button>
        </form>
      </div>

      <!-- Recent Posts Widget -->
      <div class="sidebar-widget">
        <h4 class="widget-title"><?php esc_html_e( 'Recent Posts', 'plumberx' ); ?></h4>
        <?php
        $recent_posts = wp_get_recent_posts( array(
            'numberposts' => 5,
            'post_status' => 'publish',
        ) );
        if ( ! empty( $recent_posts ) ) :
            foreach ( $recent_posts as $recent ) :
            ?>
              <a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>" class="sidebar-recent-post-link"><?php echo esc_html( $recent['post_title'] ); ?></a>
            <?php
            endforeach;
            wp_reset_query();
        else :
        ?>
          <a href="#" class="sidebar-recent-post-link">These cases are simple Standard</a>
          <a href="#" class="sidebar-recent-post-link">Incapable of drawing an Image</a>
          <a href="#" class="sidebar-recent-post-link">It is an almost life for us Gallery</a>
          <a href="#" class="sidebar-recent-post-link">Many desktop publishing Audio</a>
          <a href="#" class="sidebar-recent-post-link">This mistaken idea of Video</a>
        <?php endif; ?>
      </div>

      <!-- Archives Widget -->
      <div class="sidebar-widget">
        <h4 class="widget-title"><?php esc_html_e( 'Archives', 'plumberx' ); ?></h4>
        <ul class="sidebar-bullet-list">
          <?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 5 ) ); ?>
        </ul>
      </div>

      <!-- Categories Widget -->
      <div class="sidebar-widget">
        <h4 class="widget-title"><?php esc_html_e( 'Categories', 'plumberx' ); ?></h4>
        <ul class="sidebar-bullet-list">
          <?php
          wp_list_categories( array(
              'title_li' => '',
              'depth'    => 1,
          ) );
          ?>
        </ul>
      </div>

    </aside>

  </div>
</section>

<?php
get_footer();
