<?php
/**
 * Header Template
 *
 * @package PlumberX
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="<?php echo esc_url( plumberx_get_clean_logo_url() ); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container">
      <div class="top-bar-left">
        <?php plumberx_phone_icon(); ?>
        <span>Call to our experts : <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', get_theme_mod( 'plumberx_phone', '18004567890' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'plumberx_phone', '(1800) 456 7890' ) ); ?></a></span>
      </div>
      <div class="top-bar-right">
        <button class="btn-book-top" type="button">Book a Appointment</button>
      </div>
    </div>
  </div>

  <!-- Header & Navigation -->
  <header class="site-header">
    <div class="container nav-wrapper">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
        <img src="<?php echo esc_url( plumberx_get_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-img">
      </a>
      
      <nav class="main-nav">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'walker'         => new PlumberX_Walker_Nav(),
            'fallback_cb'    => function() {
                echo '<ul class="nav-menu">';
                echo '<li class="nav-item active"><a href="' . esc_url( home_url( '/' ) ) . '" class="nav-link">Home</a></li>';
                echo '<li class="nav-item"><a href="' . esc_url( home_url( '/about' ) ) . '" class="nav-link">About Us</a></li>';
                echo '<li class="nav-item"><a href="' . esc_url( home_url( '/services' ) ) . '" class="nav-link">Services</a></li>';
                echo '<li class="nav-item"><a href="' . esc_url( home_url( '/projects' ) ) . '" class="nav-link">Projects</a></li>';
                echo '<li class="nav-item"><a href="' . esc_url( home_url( '/blog' ) ) . '" class="nav-link">Blog</a></li>';
                if ( class_exists( 'WooCommerce' ) ) {
                    echo '<li class="nav-item"><a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '" class="nav-link">Shop</a></li>';
                }
                echo '<li class="nav-item"><a href="' . esc_url( home_url( '/contact' ) ) . '" class="nav-link">Contact Us</a></li>';
                echo '</ul>';
            },
        ) );
        ?>

        <div class="header-actions">
          <button class="search-toggle-btn" aria-label="Search">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>
          <?php if ( class_exists( 'WooCommerce' ) ) : ?>
          <button class="cart-toggle-btn" aria-label="Cart">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="cart-badge" id="cartBadgeCount"><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span>
          </button>
          <?php endif; ?>
          <button class="mobile-menu-btn" aria-label="Toggle navigation">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="3" y1="12" x2="21" y2="12"></line>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
          </button>
        </div>
      </nav>
    </div>
  </header>
