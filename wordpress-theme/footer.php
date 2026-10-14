<?php
/**
 * The template for displaying the footer
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?>
  <!-- Site Footer -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      
      <div class="footer-top-grid">
        
        <!-- Brand Summary -->
        <div class="footer-brand-col">
          <div class="site-branding">
            <div class="brand-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
              </svg>
            </div>
            <div class="brand-text">
              <span class="brand-name" style="color:#ffffff;">Apex<span>Flow</span></span>
              <span class="brand-tagline" style="color:#94a3b8;">24/7 USA Emergency Plumber</span>
            </div>
          </div>
          <p>
            America's premier 24/7 emergency plumbing, drain cleaning, and pipe restoration contractor. Rapid dispatch, upfront flat-rate pricing, and master-certified craftsmanship.
          </p>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            <span>Emergency: <strong style="color:#ffffff;"><?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?></strong></span>
          </div>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            <span>dispatch@apexflowplumbing.com</span>
          </div>
        </div>

        <!-- Plumbing Services Links -->
        <div class="footer-col">
          <h4 class="footer-heading"><?php esc_html_e('Plumbing Services', 'apexflow-plumbing'); ?></h4>
          <?php
          if (has_nav_menu('footer_services')) {
              wp_nav_menu([
                  'theme_location' => 'footer_services',
                  'container'      => false,
                  'menu_class'     => 'footer-links-list',
              ]);
          } else {
          ?>
            <ul class="footer-links-list">
              <li class="footer-link-item"><a href="#services">Emergency Pipe Repair</a></li>
              <li class="footer-link-item"><a href="#services">Drain Snake & Hydro-Jetting</a></li>
              <li class="footer-link-item"><a href="#services">Water Heater Replacements</a></li>
              <li class="footer-link-item"><a href="#services">Slab Leak Detection</a></li>
              <li class="footer-link-item"><a href="#services">Trenchless Sewer Relining</a></li>
              <li class="footer-link-item"><a href="#services">Garbage Disposal Repair</a></li>
            </ul>
          <?php } ?>
        </div>

        <!-- Company & Trust -->
        <div class="footer-col">
          <h4 class="footer-heading"><?php esc_html_e('Company & Trust', 'apexflow-plumbing'); ?></h4>
          <ul class="footer-links-list">
            <li class="footer-link-item"><a href="#why-us">Why Choose Us</a></li>
            <li class="footer-link-item"><a href="#estimator">Upfront Cost Guide</a></li>
            <li class="footer-link-item"><a href="#reviews">Customer Testimonials</a></li>
            <li class="footer-link-item"><a href="#faq">Frequently Asked Questions</a></li>
            <li class="footer-link-item"><a href="#areas">USA Service Coverage</a></li>
            <li class="footer-link-item"><a href="#">License & Insurance Verification</a></li>
          </ul>
        </div>

        <!-- 24/7 Hours & Guarantee -->
        <div class="footer-col">
          <h4 class="footer-heading"><?php esc_html_e('Dispatch Operations', 'apexflow-plumbing'); ?></h4>
          <div class="footer-hours-box">
            <p>🕒 Open 24 Hours, 7 Days a Week</p>
            <span>Including Thanksgiving, Christmas & New Year's Day</span>
            <hr style="border:0; border-top:1px solid rgba(255,255,255,0.1); margin:0.75rem 0;">
            <p style="font-size:0.8125rem; color:#94a3b8; font-weight:400;">
              Licensed Master Contractor: <strong style="color:#ffffff;"><?php echo esc_html(get_theme_mod('apexflow_license_id', '#PL-98214')); ?></strong><br>
              Insured & Bonded to $2,000,000.
            </p>
          </div>
        </div>

      </div>

      <!-- Footer Bottom Copyright -->
      <div class="footer-bottom">
        <p>© <?php echo date('Y'); ?> ApexFlow USA Emergency Plumbing Services Inc. All Rights Reserved.</p>
        <p style="color:#64748b;">
          Powered by ApexFlow WordPress Theme. Minimal & SEO Optimized.
        </p>
      </div>

    </div>
  </footer>

  <!-- Mobile Sticky Bottom Action Bar -->
  <div class="mobile-sticky-action-bar" aria-label="Quick mobile call action">
    <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="mobile-sticky-call">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
      </svg>
      <span>Call <?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?></span>
    </a>
    <button class="mobile-sticky-quote" data-open-modal="bookingModal">
      <span>Book Online ($25 Off)</span>
    </button>
  </div>

  <!-- Booking Modal Popup -->
  <?php get_template_part('template-parts/booking-modal'); ?>

  <?php wp_footer(); ?>
</body>
</html>
