<?php
/**
 * Template part for displaying Services Grid
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?>
<section class="services-section" id="services">
  <div class="container">
    
    <div class="section-header">
      <span class="section-tag">Full-Scope Services</span>
      <h2 class="section-title">Commercial & Residential Plumbing Solutions</h2>
      <p class="section-subtitle">
        From minor faucet repairs to whole-house repiping and commercial sewer restoration, our master technicians arrive equipped with industry-leading diagnostic technology.
      </p>
    </div>

    <div class="services-grid">
      
      <!-- Service 1: Emergency Plumbing -->
      <article class="service-card">
        <span class="service-badge badge-urgent">24/7 Priority</span>
        <div class="service-card-top">
          <div class="service-icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
            </svg>
          </div>
          <h3 class="service-title">Emergency Plumbing & Burst Pipes</h3>
          <p class="service-desc">
            Rapid shutoff, emergency pipe clamping, and frozen pipe thawing. We prevent severe drywall and flooring water damage before it escalates.
          </p>
          <ul class="service-features-list">
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Under 60-Minute Dispatch</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Zero Night & Weekend Surcharges</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Direct Insurance Documentation</span>
            </li>
          </ul>
        </div>
        <div class="service-card-footer">
          <div class="service-price-starting">
            <span>Starts at</span>
            <strong>$129 Flat</strong>
          </div>
          <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="service-link">
            <span>Call Now</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
        </div>
      </article>

      <!-- Service 2: Drain Cleaning & Hydro Jetting -->
      <article class="service-card">
        <span class="service-badge">Rooter Tech</span>
        <div class="service-card-top">
          <div class="service-icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="M8 12s1.5-2 4-2 4 2 4 2-1.5 2-4 2-4-2-4-2z"></path>
            </svg>
          </div>
          <h3 class="service-title">Drain Cleaning & Hydro-Jetting</h3>
          <p class="service-desc">
            High-definition HD video sewer line camera inspection followed by commercial 4,000 PSI hydro-jetting that obliterates grease and tree roots.
          </p>
          <ul class="service-features-list">
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Free HD Sewer Camera Inspection</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Clears Persistent Grease & Sludge</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>1-Year Clog-Free Guarantee</span>
            </li>
          </ul>
        </div>
        <div class="service-card-footer">
          <div class="service-price-starting">
            <span>Starts at</span>
            <strong>$89 Flat</strong>
          </div>
          <a href="#estimator" class="service-link">
            <span>View Estimate</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
        </div>
      </article>

      <!-- Service 3: Water Heaters -->
      <article class="service-card">
        <span class="service-badge">Tankless & Tank</span>
        <div class="service-card-top">
          <div class="service-icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="12" y1="18" x2="12" y2="12"></line>
              <line x1="9" y1="15" x2="15" y2="15"></line>
            </svg>
          </div>
          <h3 class="service-title">Water Heater Repair & Replacement</h3>
          <p class="service-desc">
            Complete diagnostics for gas, electric, and high-efficiency tankless units. Same-day emergency replacements with 10-year parts warranty.
          </p>
          <ul class="service-features-list">
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Same-Day Replacement Units in Stock</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Rheem, Bradford White & Navien</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>$200 Eco Energy Rebates Eligible</span>
            </li>
          </ul>
        </div>
        <div class="service-card-footer">
          <div class="service-price-starting">
            <span>Starts at</span>
            <strong>$149 Repair</strong>
          </div>
          <a href="#estimator" class="service-link">
            <span>View Options</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
        </div>
      </article>

      <!-- Service 4: Leak Detection -->
      <article class="service-card">
        <span class="service-badge">Non-Invasive</span>
        <div class="service-card-top">
          <div class="service-icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
            </svg>
          </div>
          <h3 class="service-title">Slab & Hidden Leak Detection</h3>
          <p class="service-desc">
            State-of-the-art acoustic listening sensors and thermal infrared imaging to locate sub-slab leaks without tearing down your walls.
          </p>
          <ul class="service-features-list">
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Pinpoint Accuracy (Zero Guesswork)</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Protects Foundation & Flooring</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Complete Comprehensive Report</span>
            </li>
          </ul>
        </div>
        <div class="service-card-footer">
          <div class="service-price-starting">
            <span>Starts at</span>
            <strong>$199 Scan</strong>
          </div>
          <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="service-link">
            <span>Schedule Scan</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
        </div>
      </article>

      <!-- Service 5: Sewer Line & Trenchless -->
      <article class="service-card">
        <span class="service-badge">No Digging</span>
        <div class="service-card-top">
          <div class="service-icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
              <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
              <line x1="6" y1="6" x2="6.01" y2="6"></line>
              <line x1="6" y1="18" x2="6.01" y2="18"></line>
            </svg>
          </div>
          <h3 class="service-title">Trenchless Sewer Repair & Relining</h3>
          <p class="service-desc">
            Cured-In-Place Pipe (CIPP) epoxy relining creates a brand-new structural pipe inside your old cracked sewer line without tearing up your yard.
          </p>
          <ul class="service-features-list">
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>50-Year Structural Pipe Life</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Saves Your Lawn, Driveway & Trees</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Completed in Just 1 Business Day</span>
            </li>
          </ul>
        </div>
        <div class="service-card-footer">
          <div class="service-price-starting">
            <span>Custom Quote</span>
            <strong>Free Inspection</strong>
          </div>
          <button class="service-link" data-open-modal="bookingModal" style="background:none;border:none;cursor:pointer;">
            <span>Free Quote</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </button>
        </div>
      </article>

      <!-- Service 6: Whole-House Fixtures -->
      <article class="service-card">
        <span class="service-badge">Upgrades</span>
        <div class="service-card-top">
          <div class="service-icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="3"></circle>
              <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
            </svg>
          </div>
          <h3 class="service-title">Toilet, Faucet & Garbage Disposal</h3>
          <p class="service-desc">
            High-end Kohler, Moen, and Delta fixtures installed by certified craftsmen. Instant fixes for running toilets, dripping faucets, and jammed disposals.
          </p>
          <ul class="service-features-list">
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Water-Efficient Smart Fixtures</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Full Parts & Labor Guarantee</span>
            </li>
            <li class="service-feature-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Same-Day Kitchen & Bath Service</span>
            </li>
          </ul>
        </div>
        <div class="service-card-footer">
          <div class="service-price-starting">
            <span>Starts at</span>
            <strong>$95 Fix</strong>
          </div>
          <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="service-link">
            <span>Book Service</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
        </div>
      </article>

    </div>

  </div>
</section>
