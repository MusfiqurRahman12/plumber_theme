<?php
/**
 * Template part for displaying Why Choose Us Section
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?>
<section class="why-us-section" id="why-us">
  <div class="container">
    <div class="why-us-grid">
      
      <!-- Image with Service Van & House -->
      <div class="why-image-card">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/plumbing-van-fleet.jpg'); ?>" alt="ApexFlow modern commercial plumbing mobile service van parked in front of residential home" width="600" height="480" loading="lazy">
        <div class="why-guarantee-badge">
          <div class="guarantee-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
          </div>
          <div>
            <h4 class="guarantee-title">100% Satisfaction Guarantee</h4>
            <p class="guarantee-sub">If our repair fails within 12 months, we fix it completely free. No questions asked.</p>
          </div>
        </div>
      </div>

      <!-- Why Choose Us Content -->
      <div class="why-content-box">
        <span class="section-tag">The ApexFlow Advantage</span>
        <h2 class="section-title">Why 12,000+ USA Homeowners Rely on ApexFlow</h2>
        <p class="section-subtitle">
          We eliminated the headaches of traditional plumbing: no 4-hour wait windows, no mystery pricing after the job is completed, and zero inexperienced subcontractors.
        </p>

        <div class="why-points-list">
          
          <div class="why-point-item">
            <div class="why-point-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
              </svg>
            </div>
            <div class="why-point-content">
              <h4>True Flat-Rate Upfront Pricing</h4>
              <p>You see the exact bottom-line price in writing before work starts. Even if the job takes twice as long as expected, your price never increases by a dime.</p>
            </div>
          </div>

          <div class="why-point-item">
            <div class="why-point-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="why-point-content">
              <h4>60-Minute Fast Dispatch Guarantee</h4>
              <p>Our fleet of fully stocked "warehouse on wheels" service vans are staged across metro areas, allowing average response times under 45 minutes.</p>
            </div>
          </div>

          <div class="why-point-item">
            <div class="why-point-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
            </div>
            <div class="why-point-content">
              <h4>Licensed Master Plumbers Only</h4>
              <p>Every technician is background-checked, drug-screened, and state certified. We wear floor-protecting shoe covers and leave your home spotless.</p>
            </div>
          </div>

        </div>

        <div style="margin-top: 2.5rem;">
          <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span>Call <?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?> For Instant Dispatch</span>
          </a>
        </div>

      </div>

    </div>
  </div>
</section>
