<?php
/**
 * Template part for the Dispatch Booking Modal
 *
 * @package ApexFlow_Plumbing
 * @version 1.0.0
 */
?>
<div class="modal-overlay" id="bookingModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-box">
    <button class="modal-close-btn" id="closeModalBtn" aria-label="Close booking modal">✕</button>
    
    <h3 class="modal-title" id="modalTitle">Schedule Service & Claim $25 Off</h3>
    <p class="modal-subtitle">Fast dispatch. Upfront flat-rate quote before work begins.</p>

    <form class="booking-form" id="quickBookingForm">
      <div class="form-group">
        <label for="fullName">Your Full Name *</label>
        <input type="text" id="fullName" class="form-control" placeholder="e.g. Michael Smith" required>
      </div>

      <div class="form-group">
        <label for="phoneNumber">Cell Phone Number (For Dispatch SMS) *</label>
        <input type="tel" id="phoneNumber" class="form-control" placeholder="e.g. (555) 234-5678" required>
      </div>

      <div class="form-group">
        <label for="zipCode">Service ZIP Code *</label>
        <input type="text" id="zipCode" class="form-control" placeholder="e.g. 75001" maxlength="10" required>
      </div>

      <div class="form-group">
        <label for="serviceType">Plumbing Issue Category *</label>
        <select id="serviceType" class="form-control" required>
          <option value="">Select your issue...</option>
          <option value="emergency">Emergency Active Leak / Flooding (Immediate)</option>
          <option value="drain">Clogged Drain / Sewer Backup</option>
          <option value="water-heater">Water Heater Repair or Replacement</option>
          <option value="leak-detection">Slab / Wall Leak Detection</option>
          <option value="fixture">Toilet / Faucet / Disposal Install</option>
          <option value="other">Routine Inspection / Other</option>
        </select>
      </div>

      <div class="form-group">
        <label for="notes">Brief Description (Optional)</label>
        <textarea id="notes" class="form-control" rows="2" placeholder="e.g. Water leaking under kitchen sink pipe..."></textarea>
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>Dispatch Plumber & Apply $25 Coupon</span>
      </button>

      <p style="font-size:0.75rem; color:#94a3b8; text-align:center; margin-top:0.5rem;">
        🔒 Your privacy is safe. Zero spam. We only contact you regarding this service request.
      </p>
    </form>
  </div>
</div>
