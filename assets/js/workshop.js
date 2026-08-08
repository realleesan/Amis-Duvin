document.addEventListener('DOMContentLoaded', () => {
  const workshopRegisterModal = document.getElementById('workshopRegisterModal');
  const workshopForm = document.getElementById('workshopRegisterForm');
  const modalWorkshopTitle = document.getElementById('modalWorkshopTitle');
  const inputWorkshopId = document.getElementById('inputWorkshopId');

  document.querySelectorAll('[data-workshop-id]').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-workshop-id');
      const title = btn.getAttribute('data-workshop-title');

      if (inputWorkshopId) inputWorkshopId.value = id;
      if (modalWorkshopTitle) modalWorkshopTitle.textContent = title || 'Workshop';
      if (workshopRegisterModal) workshopRegisterModal.classList.add('active');
    });
  });

  if (workshopForm) {
    workshopForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(workshopForm);
      const payload = Object.fromEntries(formData.entries());

      try {
        const res = await fetch('/api/workshop-register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.success) {
          workshopForm.reset();
          if (workshopRegisterModal) workshopRegisterModal.classList.remove('active');

          const workshopSuccessModal = document.getElementById('workshopSuccessModal');
          if (workshopSuccessModal) workshopSuccessModal.classList.add('active');
        } else {
          alert(data.message || 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
      } catch (err) {
        console.error('Workshop register error:', err);
        alert('Đã xảy ra lỗi kết nối. Vui lòng thử lại!');
      }
    });
  }
});
