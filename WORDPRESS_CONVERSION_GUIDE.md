# ApexFlow Plumber - WordPress Conversion & Deployment Guide

This project is built from the ground up to be **100% WordPress-Ready**, minimal, SEO-optimized, and conversion-focused for **USA Plumber & Rooter Services**.

---

## 📁 Project Architecture

```
d:/our company/theme for handyman creaft/Plumber design/
├── index.html                 # Standalone static version (instant preview & static deployment)
├── style.css                  # Core CSS design system with WordPress theme headers
├── script.js                  # Vanilla JS engine (ZIP checker, diagnostic calculator, modal, accordion)
├── assets/
│   └── images/
│       ├── hero-master-plumber.jpg   # High-resolution licensed master plumber photograph
│       └── plumbing-van-fleet.jpg    # Branded mobile service van fleet photograph
│
├── wordpress-theme/           # Complete, ready-to-deploy WordPress Theme!
│   ├── style.css              # WordPress theme header + complete stylesheet
│   ├── functions.php          # Enqueue scripts, menus, customizer settings
│   ├── header.php             # Semantic header with Schema.org & topbar
│   ├── footer.php             # Semantic footer & mobile sticky action bar
│   ├── front-page.php         # Modular homepage template
│   ├── index.php              # Fallback blog/page template
│   ├── assets/
│   │   ├── css/
│   │   ├── js/theme.js        # Enqueued theme script
│   │   └── images/            # Theme media assets
│   └── template-parts/        # Modular components (ACF & Gutenberg friendly)
│       ├── hero.php           # Unique Hero with live dispatch & cost estimator
│       ├── trust-bar.php      # BBB, licensed & insured badges
│       ├── services.php       # 6 core plumbing service cards with starting prices
│       ├── why-us.php         # Vehicle fleet & 100% satisfaction guarantee
│       ├── emergency-banner.php # Urgent 24/7 callout ribbon
│       ├── process.php        # 3-step stress-free repair process
│       ├── reviews.php        # Verified homeowner reviews
│       ├── faq.php            # SEO accordion with matching schema
│       ├── service-areas.php  # USA metro regional keyword pills
│       └── booking-modal.php  # Interactive dispatch & $25 coupon modal
│
└── WORDPRESS_CONVERSION_GUIDE.md # This guide
```

---

## 🚀 Option 1: Direct WordPress Theme Installation (Easiest & Fastest)

1. Open your WordPress root directory (e.g. `C:\xampp\htdocs\myplumbing\` or your live hosting via cPanel / FTP).
2. Navigate to `wp-content/themes/`.
3. Copy or upload the `wordpress-theme` folder and rename it to `apexflow-plumbing`:
   ```
   wp-content/themes/apexflow-plumbing/
   ```
4. Log in to your WordPress Admin dashboard (`/wp-admin`).
5. Go to **Appearance > Themes**.
6. You will see **ApexFlow - USA Emergency Plumbing & Rooter Services**.
7. Click **Activate**.
8. Go to **Settings > Reading** and set:
   - "Your homepage displays" -> **A static page**.
   - Select a page named "Home" as the homepage.
9. Visit your website: your full responsive plumbing site is live!

---

## ⚙️ Customizing Phone Number, License & Rates in WordPress

In **Appearance > Customize > Emergency & Contact Information**, you can update without touching code:
- **Emergency Phone Display**: e.g., `(800) 555-FLOW`
- **Emergency Tel Link**: e.g., `18005553569`
- **Master Plumber License ID**: e.g., `#PL-98214`

---

## 🧩 Option 2: Using with ACF Pro (Advanced Custom Fields)

To make every headline, starting price, and review fully editable in the WP admin:

1. Install and activate **Advanced Custom Fields Pro** (or free ACF).
2. Create a Field Group named **"Homepage Plumbing Data"** assigned to `front-page.php`.
3. Recommended ACF fields:
   - `hero_headline` (Text)
   - `hero_subheadline` (Textarea)
   - `technicians_on_duty_count` (Number, default: `4`)
   - `emergency_phone_number` (Text)
   - `services_repeater` (Repeater: title, icon, description, starting_price, badge)
   - `reviews_repeater` (Repeater: name, location, stars, review_text)
4. In `template-parts/hero.php`, replace static strings with:
   ```php
   <?php the_field('hero_headline'); ?>
   ```

---

## 📨 Lead Generation & Form Integration (Contact Form 7 / WPForms)

In `template-parts/booking-modal.php`:
1. If you use **Contact Form 7**, create a form with fields `[text* your-name]`, `[tel* your-phone]`, `[text* your-zip]`, `[select* your-service]`.
2. Replace `<form class="booking-form" ...>` with:
   ```php
   <?php echo do_shortcode('[contact-form-7 id="123" title="Emergency Dispatch Booking"]'); ?>
   ```
3. The styling will automatically inherit the `.form-control` and `.btn-primary` styles from `style.css`.

---

## 🔍 SEO & Local Schema Best Practices

The theme includes valid **Schema.org LocalBusiness (`Plumber`)** and **`FAQPage`** JSON-LD microdata in `header.php`.

### To target your specific USA City / State:
Edit the address in `header.php` or hook via your SEO plugin (Rank Math SEO / Yoast SEO):
```json
"address": {
  "@type": "PostalAddress",
  "streetAddress": "123 Plumbing Way",
  "addressLocality": "Dallas",
  "addressRegion": "TX",
  "postalCode": "75001",
  "addressCountry": "US"
}
```

### Why this design ranks high on Google:
1. **Single Semantic `<h1>`**: Clear topical relevance for local emergency plumbing.
2. **Zero Bloat & Fast Core Web Vitals**: Pure vanilla CSS (under 18 KB) and lightweight vanilla JS. No jQuery or heavy CSS frameworks.
3. **High Dwell Time**: Interactive ZIP code checker and cost calculator engage users immediately, lowering bounce rate.
4. **Mobile-First Urgency UX**: Floating sticky click-to-dial bar drives immediate conversions on smartphones during emergencies.
