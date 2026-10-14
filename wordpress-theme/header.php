<?php
/**
 * The header template for ApexFlow Plumbing Theme
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <?php wp_head(); ?>

  <!-- Fallback Schema.org JSON-LD Structured Data for LocalBusiness / Plumber -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Plumber",
    "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
    "image": "<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-master-plumber.jpg'); ?>",
    "telephone": "+1-800-555-3569",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "priceRange": "$$",
    "currenciesAccepted": "USD",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "US"
    },
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        "opens": "00:00",
        "closes": "23:59"
      }
    ],
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.9",
      "reviewCount": "842"
    }
  }
  </script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- Top Utility Bar -->
  <div class="site-topbar">
    <div class="container topbar-content">
      <div class="topbar-left">
        <span class="topbar-item">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
          Licensed & Insured: <strong class="topbar-highlight"><?php echo esc_html(get_theme_mod('apexflow_license_id', '#PL-98214')); ?></strong>
        </span>
        <span class="topbar-item">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          24/7/365 Emergency Dispatch
        </span>
      </div>
      <div class="topbar-right">
        <span class="topbar-item">
          <span class="pulse-dot"></span>
          Avg. Arrival: <strong class="topbar-highlight">38 Minutes</strong>
        </span>
        <span class="topbar-item">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          BBB Accredited A+
        </span>
      </div>
    </div>
  </div>

  <!-- Main Navigation Header -->
  <header class="site-header" role="banner">
    <div class="container header-inner">
      
      <!-- Brand Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-branding" aria-label="<?php bloginfo('name'); ?> Homepage">
        <div class="brand-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
          </svg>
        </div>
        <div class="brand-text">
          <span class="brand-name">Apex<span>Flow</span></span>
          <span class="brand-tagline">24/7 USA Emergency Plumber</span>
        </div>
      </a>

      <!-- Primary Navigation Menu -->
      <nav class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'apexflow-plumbing'); ?>">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => false,
            ]);
        } else {
        ?>
          <ul class="nav-menu">
            <li class="nav-item"><a href="#services">Services</a></li>
            <li class="nav-item"><a href="#estimator">Cost Guide</a></li>
            <li class="nav-item"><a href="#why-us">Why Us</a></li>
            <li class="nav-item"><a href="#reviews">Reviews</a></li>
            <li class="nav-item"><a href="#faq">FAQ</a></li>
            <li class="nav-item"><a href="#areas">Service Areas</a></li>
          </ul>
        <?php } ?>
      </nav>

      <!-- Header CTAs -->
      <div class="header-actions">
        <div class="header-phone-box">
          <span class="phone-label">24/7 Emergency Line</span>
          <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="phone-number">
            <?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?>
          </a>
        </div>

        <button class="btn btn-primary" data-open-modal="bookingModal" aria-label="Schedule Service Appointment">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span>Book Service</span>
        </button>

        <button class="nav-toggle-btn" id="mobileNavToggle" aria-label="Toggle navigation menu" aria-expanded="false">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>

    </div>
  </header>

  <!-- Mobile Drawer -->
  <div class="mobile-nav-drawer" id="mobileNavDrawer" aria-label="Mobile Navigation">
    <ul class="mobile-menu-list">
      <li class="mobile-menu-item"><a href="#services">Our Plumbing Services</a></li>
      <li class="mobile-menu-item"><a href="#estimator">Upfront Cost Estimator</a></li>
      <li class="mobile-menu-item"><a href="#why-us">Why Homeowners Trust Us</a></li>
      <li class="mobile-menu-item"><a href="#reviews">Verified Customer Reviews</a></li>
      <li class="mobile-menu-item"><a href="#faq">Frequently Asked Questions</a></li>
      <li class="mobile-menu-item"><a href="#areas">USA Metro Coverage</a></li>
    </ul>
    <div style="margin-top: 1rem;">
      <a href="tel:<?php echo esc_attr(get_theme_mod('apexflow_phone_link', '18005553569')); ?>" class="btn btn-emergency" style="width: 100%;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
        Call 24/7: <?php echo esc_html(get_theme_mod('apexflow_phone', '(800) 555-FLOW')); ?>
      </a>
    </div>
  </div>
