document.addEventListener('DOMContentLoaded', () => {
  const bookingForm = document.getElementById('bookingForm');
  const dateInput = document.getElementById('bookingDate');
  const btnBookingSubmit = document.getElementById('btnBookingSubmit');

  window.selectBookingSlot = function(slotValue, btnEl) {
    const hiddenInput = document.getElementById('selectedTimeSlot');
    if (hiddenInput) hiddenInput.value = slotValue;

    const container = document.getElementById('slotPickerContainer');
    if (container) {
      container.querySelectorAll('.slot-pill-btn').forEach(btn => {
        btn.classList.remove('border-[var(--wine)]', 'bg-[var(--wine)]/20', 'ring-1', 'ring-[var(--wine)]');
        btn.classList.add('border-border', 'bg-card');
      });
    }

    if (btnEl) {
      btnEl.classList.remove('border-border', 'bg-card');
      btnEl.classList.add('border-[var(--wine)]', 'bg-[var(--wine)]/20', 'ring-1', 'ring-[var(--wine)]');
    }
  };

  if (dateInput) {
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 5);
    const maxDateStr = maxDate.toISOString().split('T')[0];

    dateInput.min = todayStr;
    dateInput.max = maxDateStr;

    if (!dateInput.value || dateInput.value < todayStr || dateInput.value > maxDateStr) {
      dateInput.value = todayStr;
    }
  }

  if (bookingForm) {
    bookingForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(bookingForm);
      const payload = Object.fromEntries(formData.entries());

      // Validate 5-day booking window (today to today + 5 days)
      if (dateInput && dateInput.value) {
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const maxDate = new Date();
        maxDate.setDate(today.getDate() + 5);
        maxDate.setHours(23, 59, 59, 999);

        const selectedDate = new Date(dateInput.value);
        selectedDate.setHours(12, 0, 0, 0);

        if (selectedDate < today || selectedDate > maxDate) {
          alert('Theo quy định, Quý khách chỉ có thể đặt tiệc trong vòng 5 ngày tới!');
          return;
        }
      }

      if (!payload.time_slot && !payload.slot) {
        alert('Vui lòng chọn ca phục vụ (Ca 1 hoặc Ca 2)!');
        return;
      }

      btnBookingSubmit.disabled = true;
      btnBookingSubmit.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Đang gửi thông tin...
      `;

      try {
        const res = await fetch('/api/booking', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.success) {
          bookingForm.reset();
          const hiddenInput = document.getElementById('selectedTimeSlot');
          if (hiddenInput) hiddenInput.value = '';
          const container = document.getElementById('slotPickerContainer');
          if (container) {
            container.querySelectorAll('.slot-pill-btn').forEach(btn => {
              btn.classList.remove('border-[var(--wine)]', 'bg-[var(--wine)]/20', 'ring-1', 'ring-[var(--wine)]');
              btn.classList.add('border-border', 'bg-card');
            });
          }

          const successModal = document.getElementById('successModal');
          if (successModal) successModal.classList.add('active');
        } else {
          let errorMsg = data.message || 'Vui lòng kiểm tra lại thông tin nhập!';
          if (data.errors && typeof data.errors === 'object') {
            errorMsg = Object.values(data.errors).join('\n');
          }
          alert(errorMsg);
        }
      } catch (err) {
        console.error('Booking submission error:', err);
        alert('Đã xảy ra lỗi kết nối. Vui lòng thử lại!');
      } finally {
        btnBookingSubmit.disabled = false;
        btnBookingSubmit.textContent = 'Đặt tiệc ngay';
      }
    });
  }
});
