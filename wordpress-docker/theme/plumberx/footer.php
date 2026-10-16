<?php
/**
 * Footer Template
 *
 * @package PlumberX
 */
?>

  <!-- Request Free Quote Strip Button -->
  <?php if ( ! is_page( array( 'contact', 'contact-us' ) ) ) : ?>
  <div class="quote-strip-button-wrap">
    <button class="btn-request-free-quote" type="button">REQUEST FOR A FREE QUOTE</button>
  </div>
  <?php endif; ?>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container footer-grid">
      <!-- Col 1: Contact Us -->
      <div class="footer-col footer-contact-info">
        <h4 class="footer-col-title"><?php esc_html_e( 'Contact Us', 'plumberx' ); ?></h4>
        <p><?php echo wp_kses_post( nl2br( get_theme_mod( 'plumberx_address', 'Plumberx Company Inc. 3648, Rorance Road,<br>New York, SC 29170' ) ) ); ?></p>
        <p>Phone : <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', get_theme_mod( 'plumberx_phone', '18004567890' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'plumberx_phone', '1800 456 7890' ) ); ?></a></p>
        <p><?php echo esc_html( get_theme_mod( 'plumberx_license', 'license #M-201874' ) ); ?></p>
      </div>

      <!-- Col 2: Quick Links -->
      <div class="footer-col">
        <h4 class="footer-col-title"><?php esc_html_e( 'Quick Links', 'plumberx' ); ?></h4>
        <?php
        if ( has_nav_menu( 'footer' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'container'      => 'div',
                'container_class' => 'footer-links-grid',
                'depth'          => 1,
            ) );
        } else {
        ?>
        <div class="footer-links-grid">
          <div>
            <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></p>
            <p><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a></p>
            <p><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Testimonial</a></p>
            <p><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></p>
          </div>
          <div>
            <p><a href="<?php echo esc_url( home_url( '/pricing' ) ); ?>">Financing</a></p>
            <p><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">Career</a></p>
            <p><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact us</a></p>
          </div>
        </div>
        <?php } ?>
      </div>

      <!-- Col 3: Trust & Payment -->
      <div class="footer-col footer-trust-col">
        <?php
        $badge_img = get_theme_mod( 'plumberx_footer_badge_img', PLUMBERX_URI . '/assets/images/footer_badge.png' );
        if ( $badge_img ) :
        ?>
          <img src="<?php echo esc_url( $badge_img ); ?>" alt="<?php esc_attr_e( '24 Hours Service Guarantee', 'plumberx' ); ?>" class="footer-badge-img">
        <?php endif; ?>
        <div>
          <p style="margin-bottom:8px; color:#ffffff; font-weight:600;"><?php esc_html_e( 'We Accept:', 'plumberx' ); ?></p>
          <?php
          $cards_img = get_theme_mod( 'plumberx_footer_cards_img', PLUMBERX_URI . '/assets/images/footer_cards.png' );
          if ( $cards_img ) :
          ?>
            <img src="<?php echo esc_url( $cards_img ); ?>" alt="<?php esc_attr_e( 'Visa, Mastercard, Discover, Amex', 'plumberx' ); ?>" class="footer-cards-img">
          <?php endif; ?>
        </div>
      </div>

      <!-- Col 4: Plumber Graphic -->
      <div class="footer-col footer-plumber-col">
        <?php
        $plumber_img = get_theme_mod( 'plumberx_footer_plumber_img', PLUMBERX_URI . '/assets/images/footer_plumber.png' );
        if ( $plumber_img ) :
        ?>
          <img src="<?php echo esc_url( $plumber_img ); ?>" alt="<?php esc_attr_e( 'Professional Plumber', 'plumberx' ); ?>" class="footer-plumber-img">
        <?php endif; ?>
      </div>
    </div>

    <div class="container footer-bottom-bar">
      <div><?php echo esc_html( get_theme_mod( 'plumberx_footer_copyright', '© 2026 PlumberX. All Rights Reserved.' ) ); ?></div>
      <div>Site Development: <a href="https://www.ztechbd.com" target="_blank" rel="noopener" class="developer-credit">Ztech Communication</a></div>
    </div>
  </footer>

  <!-- Modals -->
  <!-- Appointment Modal -->
  <div class="modal-overlay" id="appointmentModal">
    <div class="modal-card">
      <div class="modal-header">
        <h3><?php esc_html_e( 'Book an Appointment', 'plumberx' ); ?></h3>
        <button class="modal-close-btn">&times;</button>
      </div>
      <div class="modal-body">
        <form id="appointmentForm">
          <div class="form-group">
            <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'Full Name', 'plumberx' ); ?>" required>
          </div>
          <div class="form-group">
            <input type="tel" class="form-input" placeholder="<?php esc_attr_e( 'Phone Number', 'plumberx' ); ?>" required>
          </div>
          <div class="form-group">
            <select class="form-select" required>
              <option value=""><?php esc_html_e( 'Select Service Needed', 'plumberx' ); ?></option>
              <option value="leaks"><?php esc_html_e( 'Plumbing Leaks & Pipe Bursts', 'plumberx' ); ?></option>
              <option value="drain"><?php esc_html_e( 'Drain Cleaning & Clog Removal', 'plumberx' ); ?></option>
              <option value="water-heater"><?php esc_html_e( 'Water Heater Repair / Replace', 'plumberx' ); ?></option>
              <option value="commercial"><?php esc_html_e( 'Commercial Plumbing Service', 'plumberx' ); ?></option>
            </select>
          </div>
          <div class="form-group">
            <input type="date" class="form-input" required>
          </div>
          <div class="form-group">
            <textarea class="form-textarea" rows="3" placeholder="<?php esc_attr_e( 'Additional details...', 'plumberx' ); ?>"></textarea>
          </div>
          <button type="submit" class="btn-quote-submit"><?php esc_html_e( 'Confirm Appointment', 'plumberx' ); ?></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Free Quote Modal -->
  <div class="modal-overlay" id="quoteModal">
    <div class="modal-card">
      <div class="modal-header">
        <h3><?php esc_html_e( 'Request Free Quote', 'plumberx' ); ?></h3>
        <button class="modal-close-btn">&times;</button>
      </div>
      <div class="modal-body">
        <form id="quoteModalForm">
          <div class="form-group">
            <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'Your Name', 'plumberx' ); ?>" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-input" placeholder="<?php esc_attr_e( 'Your Email', 'plumberx' ); ?>" required>
          </div>
          <div class="form-group">
            <input type="tel" class="form-input" placeholder="<?php esc_attr_e( 'Phone Number', 'plumberx' ); ?>" required>
          </div>
          <div class="form-group">
            <textarea class="form-textarea" rows="3" placeholder="<?php esc_attr_e( 'Describe your plumbing requirements...', 'plumberx' ); ?>"></textarea>
          </div>
          <button type="submit" class="btn-quote-submit"><?php esc_html_e( 'Submit Quote Request', 'plumberx' ); ?></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Search Modal -->
  <div class="modal-overlay" id="searchModal">
    <div class="modal-card" style="max-width: 440px;">
      <div class="modal-header">
        <h3><?php esc_html_e( 'Search', 'plumberx' ); ?> <?php bloginfo( 'name' ); ?></h3>
        <button class="modal-close-btn">&times;</button>
      </div>
      <div class="modal-body">
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <div class="form-group">
            <input type="text" id="siteSearchInput" name="s" class="form-input" placeholder="<?php esc_attr_e( 'Type keywords...', 'plumberx' ); ?>" required value="<?php echo get_search_query(); ?>">
          </div>
          <button type="submit" class="btn-quote-submit"><?php esc_html_e( 'Search', 'plumberx' ); ?></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Lightbox Modal -->
  <div class="modal-overlay" id="lightboxModal">
    <div class="modal-card" style="max-width: 780px; background: transparent; box-shadow: none;">
      <div style="text-align: right; margin-bottom: 8px;">
        <button class="modal-close-btn" style="color:#ffffff; font-size:32px;">&times;</button>
      </div>
      <img id="lightboxImg" src="" alt="<?php esc_attr_e( 'Project Preview', 'plumberx' ); ?>" style="width:100%; border-radius: var(--radius-sm); box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
    </div>
  </div>

  <?php if ( class_exists( 'WooCommerce' ) ) : ?>
  <!-- Shopping Cart Drawer -->
  <div class="cart-drawer-overlay" id="cartDrawerOverlay"></div>
  <div class="cart-drawer" id="cartDrawer">
    <div class="cart-drawer-header">
      <h3 style="font-size:16px;"><?php esc_html_e( 'Your Shopping Cart', 'plumberx' ); ?></h3>
      <button id="closeCartBtn" style="background:none; border:none; color:#ffffff; font-size:24px; cursor:pointer;">&times;</button>
    </div>
    <div class="cart-items-container" id="cartItemsContainer">
      <p style="text-align:center; color:#94a3b8; padding:30px 0;"><?php esc_html_e( 'Your cart is empty.', 'plumberx' ); ?></p>
    </div>
    <div class="cart-drawer-footer">
      <div class="cart-total-row">
        <span><?php esc_html_e( 'Subtotal:', 'plumberx' ); ?></span>
        <span id="cartTotalAmount"><?php echo WC()->cart ? WC()->cart->get_cart_subtotal() : '$0.00'; ?></span>
      </div>
      <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-quote-submit"><?php esc_html_e( 'PROCEED TO CHECKOUT', 'plumberx' ); ?></a>
    </div>
  </div>
  <?php endif; ?>

  <?php wp_footer(); ?>
</body>
</html>
