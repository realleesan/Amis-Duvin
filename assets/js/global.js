document.addEventListener('DOMContentLoaded', () => {
  // Age verification check
  const ageModal = document.getElementById('ageVerificationModal');
  const isVerified = sessionStorage.getItem('adv_verified') === '1';

  if (!isVerified && ageModal) {
    ageModal.classList.add('active');
  }

  const btnVerifyAge = document.getElementById('btnVerifyAge');
  if (btnVerifyAge) {
    btnVerifyAge.addEventListener('click', () => {
      sessionStorage.setItem('adv_verified', '1');
      if (ageModal) ageModal.classList.remove('active');
    });
  }

  // Smooth scroll links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetEl = document.getElementById(targetId);
      if (targetEl) {
        targetEl.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // Modal Triggers
  document.querySelectorAll('[data-modal-target]').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-modal-target');
      const modal = document.getElementById(targetId);
      if (modal) modal.classList.add('active');
    });
  });

  document.querySelectorAll('[data-modal-close]').forEach(btn => {
    btn.addEventListener('click', () => {
      const modal = btn.closest('.modal-overlay');
      if (modal) modal.classList.remove('active');
    });
  });

  // FAQ Accordion
  document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
      const parent = item.closest('.faq-item');
      if (parent) {
        parent.classList.toggle('active');
        const answer = parent.querySelector('.faq-answer');
        if (answer) {
          answer.classList.toggle('hidden');
        }
      }
    });
  });
});

function scrollToId(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
