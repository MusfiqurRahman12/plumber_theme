<?php
/**
 * Template part for Emergency Callout Banner
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?>
<section class="emergency-callout-section" id="emergency">
  <div class="container">
    <div class="emergency-callout-inner">
      
      <div class="emergency-left">
        <span class="emergency-pill">
          <span class="pulse-dot"></span>
          24/7/365 Emergency Dispatch Active
        </span>
        <h2 class="emergency-title">Active Leak or Flooding Right Now?</h2>
        <p class="emergency-desc">
          Every minute counts when water is running through your floors and drywall. Call our emergency response team right now for immediate dispatch and live phone guidance on how to shut off your main water valve safely.
        </p>
      </div>

      <div class="emergency-actions-box">
        <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="btn btn-emergency">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
          <span>Call <?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?></span>
        </a>

        <button class="btn btn-outline-white" data-open-modal="bookingModal">
          <span>Request Priority Callback</span>
        </button>
      </div>

    </div>
  </div>
</section>
