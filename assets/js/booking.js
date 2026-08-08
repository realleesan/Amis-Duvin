document.addEventListener('DOMContentLoaded', () => {
  const bookingForm = document.getElementById('bookingForm');
  const dateInput = document.getElementById('bookingDate');
  const btnBookingSubmit = document.getElementById('btnBookingSubmit');

  if (dateInput) {
    // Calculate min date = today + 5 days
    const minDate = new Date();
    minDate.setDate(minDate.getDate() + 5);
    const minDateStr = minDate.toISOString().split('T')[0];
    dateInput.min = minDateStr;

    // Set default value if empty or less than min date
    if (!dateInput.value || dateInput.value < minDateStr) {
      dateInput.value = minDateStr;
    }
  }

  if (bookingForm) {
    bookingForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(bookingForm);
      const payload = Object.fromEntries(formData.entries());

      // Validate 5-day lead time on client side
      if (dateInput && dateInput.value) {
        const minDate = new Date();
        minDate.setDate(minDate.getDate() + 5);
        minDate.setHours(0, 0, 0, 0);
        const selectedDate = new Date(dateInput.value);
        selectedDate.setHours(0, 0, 0, 0);

        if (selectedDate < minDate) {
          alert('Theo quy định, ngày đặt tiệc phải cách thời điểm hiện tại tối thiểu 05 ngày!');
          return;
        }
      }

      if (!payload.time_slot && !payload.slot) {
        alert('Vui lòng chọn khung giờ (Ca 1 hoặc Ca 2)!');
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
          if (dateInput) {
            const minDate = new Date();
            minDate.setDate(minDate.getDate() + 5);
            dateInput.value = minDate.toISOString().split('T')[0];
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
