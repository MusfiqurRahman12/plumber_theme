/**
 * ApexFlow Plumbing - Interactive JavaScript Engine
 * WordPress Ready & Clean Modular Vanilla JS
 */

document.addEventListener('DOMContentLoaded', () => {
  initStickyHeader();
  initMobileNavigation();
  initZipCodeChecker();
  initHeroDiagnosticCalculator();
  initFaqAccordion();
  initBookingModal();
  initSmoothScroll();
});

/* ==========================================================================
   1. STICKY HEADER SCROLL SHADOW
   ========================================================================== */
function initStickyHeader() {
  const header = document.querySelector('.site-header');
  if (!header) return;

  const handleScroll = () => {
    if (window.scrollY > 20) {
      header.classList.add('header-scrolled');
    } else {
      header.classList.remove('header-scrolled');
    }
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();
}

/* ==========================================================================
   2. MOBILE NAVIGATION DRAWER
   ========================================================================== */
function initMobileNavigation() {
  const toggleBtn = document.getElementById('mobileNavToggle');
  const drawer = document.getElementById('mobileNavDrawer');
  const menuLinks = drawer ? drawer.querySelectorAll('a') : [];

  if (!toggleBtn || !drawer) return;

  toggleBtn.addEventListener('click', () => {
    const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
    toggleBtn.setAttribute('aria-expanded', !isExpanded);
    drawer.classList.toggle('active');
  });

  menuLinks.forEach(link => {
    link.addEventListener('click', () => {
      drawer.classList.remove('active');
      toggleBtn.setAttribute('aria-expanded', 'false');
    });
  });

  document.addEventListener('click', (e) => {
    if (!drawer.contains(e.target) && !toggleBtn.contains(e.target) && drawer.classList.contains('active')) {
      drawer.classList.remove('active');
      toggleBtn.setAttribute('aria-expanded', 'false');
    }
  });
}

/* ==========================================================================
   3. HERO ZIP CODE SERVICE CHECKER
   ========================================================================== */
function initZipCodeChecker() {
  const form = document.getElementById('zipCheckerForm');
  const input = document.getElementById('zipInput');
  const output = document.getElementById('zipOutput');

  if (!form || !input || !output) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const zip = input.value.trim();

    // Check basic 5-digit US ZIP format
    const isValidZip = /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip);

    if (isValidZip) {
      output.className = 'zip-status-output success';
      output.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span><strong>Dispatch Active in ZIP ${zip}:</strong> 3 Master Plumbers in your radius. Estimated arrival: <strong>25-45 minutes</strong>.</span>
      `;
    } else {
      output.className = 'zip-status-output error';
      output.style.backgroundColor = '#fef2f2';
      output.style.color = '#991b1b';
      output.style.border = '1px solid #fecaca';
      output.style.display = 'flex';
      output.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <span>Please enter a valid 5-digit US ZIP Code to verify technician standby.</span>
      `;
    }
  });
}

/* ==========================================================================
   4. HERO INTERACTIVE DIAGNOSTIC / COST ESTIMATOR
   ========================================================================== */
const PLUMBING_ISSUES = {
  drain: {
    name: 'Clogged Drain / Sewer',
    price: '$99 - $185',
    eta: '30-45 Mins',
    badge: 'Popular',
    desc: 'High-speed camera snake & heavy hydro-jetting available.'
  },
  leak: {
    name: 'Pipe Leak / Burst Pipe',
    price: '$120 - $240',
    eta: 'Immediate (25-35 Mins)',
    badge: 'High Priority',
    desc: 'Emergency water shutoff & acoustic leak detection.'
  },
  heater: {
    name: 'Water Heater Breakdown',
    price: '$150 - $350',
    eta: '45-60 Mins',
    badge: 'Same-Day Install',
    desc: 'Gas, electric & tankless troubleshooting.'
  },
  toilet: {
    name: 'Toilet Overflow / Backup',
    price: '$89 - $160',
    eta: '30 Mins',
    badge: 'Emergency Rooter',
    desc: 'Wax ring seal, flapper overhaul, and deep main clearing.'
  }
};

function initHeroDiagnosticCalculator() {
  const pills = document.querySelectorAll('.issue-pill');
  const priceDisplay = document.getElementById('calcEstimatedPrice');
  const etaDisplay = document.getElementById('calcEstimatedEta');
  const badgeDisplay = document.getElementById('calcIssueBadge');

  if (!pills.length || !priceDisplay) return;

  pills.forEach(pill => {
    pill.addEventListener('click', () => {
      pills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');

      const issueKey = pill.getAttribute('data-issue');
      const data = PLUMBING_ISSUES[issueKey];

      if (data) {
        priceDisplay.textContent = data.price;
        if (etaDisplay) etaDisplay.textContent = data.eta;
        if (badgeDisplay) badgeDisplay.textContent = data.badge;
      }
    });
  });
}

/* ==========================================================================
   5. SEO-FRIENDLY FAQ ACCORDION
   ========================================================================== */
function initFaqAccordion() {
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(item => {
    const questionBtn = item.querySelector('.faq-question');
    if (!questionBtn) return;

    questionBtn.addEventListener('click', () => {
      const isActive = item.classList.contains('active');

      // Close other open items
      faqItems.forEach(otherItem => {
        if (otherItem !== item) {
          otherItem.classList.remove('active');
          const btn = otherItem.querySelector('.faq-question');
          if (btn) btn.setAttribute('aria-expanded', 'false');
        }
      });

      // Toggle current
      item.classList.toggle('active', !isActive);
      questionBtn.setAttribute('aria-expanded', !isActive);
    });
  });
}

/* ==========================================================================
   6. BOOKING MODAL POPUP
   ========================================================================== */
function initBookingModal() {
  const openButtons = document.querySelectorAll('[data-open-modal="bookingModal"]');
  const modal = document.getElementById('bookingModal');
  const closeBtn = document.getElementById('closeModalBtn');
  const form = document.getElementById('quickBookingForm');

  if (!modal) return;

  openButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

  const closeModal = () => {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  };

  if (closeBtn) closeBtn.addEventListener('click', closeModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin">
          <circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-linecap="round"></circle>
        </svg> Dispatching Request...
      `;

      setTimeout(() => {
        form.innerHTML = `
          <div style="text-align: center; padding: 2rem 1rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </div>
            <h3 style="font-size: 1.35rem; font-weight: 800; color: #0a192f; margin-bottom: 0.5rem;">Request Confirmed!</h3>
            <p style="color: #64748b; font-size: 0.9375rem; margin-bottom: 1.5rem;">
              Our dispatch coordinator is assigning the closest on-duty licensed plumber. You will receive an SMS confirmation within <strong>5 minutes</strong>.
            </p>
            <p style="font-weight: 700; color: #0284c7; font-size: 1rem;">
              Immediate Emergency? Call (800) 555-FLOW
            </p>
          </div>
        `;
      }, 1200);
    });
  }
}

/* ==========================================================================
   7. SMOOTH SCROLLING FOR ANCHOR LINKS
   ========================================================================== */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || targetId === '') return;

      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        const headerOffset = 90;
        const elementPosition = targetEl.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });
}
