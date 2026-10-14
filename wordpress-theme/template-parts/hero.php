<?php
/**
 * Template part for displaying the Hero Section
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?>
<section class="hero-section" id="hero">
  <div class="container">
    <div class="hero-grid">
      
      <!-- Hero Left Column: Core Value Proposition & ZIP Checker -->
      <div class="hero-content">
        
        <div class="hero-dispatch-status">
          <span class="pulse-dot"></span>
          <span><strong>Live Dispatch:</strong> 4 Master Plumbers On Duty in Your Radius</span>
        </div>

        <h1 class="hero-title">
          USA's Trusted 24/7 <span class="highlight-blue">Emergency Plumbers</span> & Drain Specialists
        </h1>

        <p class="hero-subtitle">
          Don't let a burst pipe or clogged sewer ruin your home. Our licensed, background-checked master plumbers arrive in <strong>under 60 minutes</strong> with upfront flat-rate pricing and zero overtime fees.
        </p>

        <!-- Interactive ZIP Code Dispatch Tool -->
        <div class="zip-checker-container" id="zipChecker">
          <form class="zip-checker-form" id="zipCheckerForm" aria-label="Check Plumber Standby in Your ZIP Code">
            <div class="zip-input-wrapper">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <input type="text" class="zip-input" id="zipInput" placeholder="Enter your 5-digit US ZIP Code..." maxlength="10" required>
            </div>
            <button type="submit" class="btn btn-secondary">
              <span>Check Availability</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </button>
          </form>
          <div class="zip-status-output" id="zipOutput" role="status" aria-live="polite"></div>
        </div>

        <!-- Hero Primary CTAs -->
        <div class="hero-actions">
          <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="btn btn-emergency">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span>Call <?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?></span>
          </a>

          <button class="btn btn-outline" data-open-modal="bookingModal">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg>
            <span>Book Online ($25 Off)</span>
          </button>
        </div>

        <!-- Trust Metrics Strip -->
        <div class="hero-trust-metrics">
          <div class="trust-avatar-group">
            <div class="trust-avatars">
              <div class="trust-avatar">JD</div>
              <div class="trust-avatar">SK</div>
              <div class="trust-avatar">MR</div>
              <div class="trust-avatar">+</div>
            </div>
            <div class="trust-text">
              <strong>12,400+ Homes Saved</strong>
              <span>Across Major US Metro Areas</span>
            </div>
          </div>

          <div class="trust-rating">
            <span class="stars">★★★★★</span>
            <span><strong>4.9/5</strong> (840+ Google Reviews)</span>
          </div>
        </div>

      </div>

      <!-- Hero Right Column: Diagnostic & Cost Estimator Card -->
      <div class="hero-visual-card" id="estimator">
        
        <div class="hero-image-wrap">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-master-plumber.jpg'); ?>" alt="Licensed Master Plumber inspecting copper piping" width="600" height="400" loading="eager">
          <div class="hero-image-overlay">
            <div class="image-badge-content">
              <h3 class="image-badge-title">Mike H. • Master Plumber</h3>
              <p class="image-badge-desc">18 Years Experience • Badge #PL-49102</p>
            </div>
          </div>
        </div>

        <div class="floating-badge badge-top-right">
          <div class="floating-badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
          </div>
          <div class="floating-badge-text">
            <strong>$2M Insured</strong>
            <span>Bonded & Certified</span>
          </div>
        </div>

        <div class="hero-calc-body">
          <div class="calc-header-row">
            <span class="calc-heading">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
              </svg>
              Select Your Issue For Instant Estimate:
            </span>
            <span class="calc-badge" id="calcIssueBadge">Popular</span>
          </div>

          <div class="issue-pill-selector" role="radiogroup" aria-label="Select your plumbing issue">
            <button type="button" class="issue-pill active" data-issue="drain" aria-checked="true">
              <span>🚿</span> Clogged Drain
            </button>
            <button type="button" class="issue-pill" data-issue="leak" aria-checked="false">
              <span>💥</span> Burst / Leaking Pipe
            </button>
            <button type="button" class="issue-pill" data-issue="heater" aria-checked="false">
              <span>🔥</span> Water Heater Issue
            </button>
            <button type="button" class="issue-pill" data-issue="toilet" aria-checked="false">
              <span>🚽</span> Toilet Backup
            </button>
          </div>

          <div class="calc-result-box">
            <div class="result-info">
              <span>Estimated Flat Rate:</span>
              <strong id="calcEstimatedPrice">$99 - $185</strong>
            </div>
            <div class="result-eta">
              <span>Estimated Dispatch ETA:</span>
              <strong id="calcEstimatedEta">30-45 Mins</strong>
            </div>
          </div>

          <div style="margin-top: 1rem; text-align: center;">
            <button class="btn btn-primary" style="width: 100%;" data-open-modal="bookingModal">
              <span>Lock In This Flat Rate & Dispatch</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>
</section>
