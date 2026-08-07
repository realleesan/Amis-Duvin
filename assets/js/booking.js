document.addEventListener('DOMContentLoaded', () => {
  const bookingForm = document.getElementById('bookingForm');
  const dateInput = document.getElementById('bookingDate');
  const slotsContainer = document.getElementById('slotsContainer');
  const selectedSlotInput = document.getElementById('selectedSlot');
  const btnBookingSubmit = document.getElementById('btnBookingSubmit');

  if (dateInput) {
    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;

    dateInput.addEventListener('change', async (e) => {
      const selectedDate = e.target.value;
      if (!selectedDate) return;

      slotsContainer.innerHTML = '<p class="text-xs text-muted-foreground italic py-3">Đang tải lịch trống...</p>';

      try {
        const res = await fetch(`/api/availability?date=${selectedDate}`);
        const data = await res.json();
        const busySlots = data.busy || [];

        renderPartySlots(busySlots);
      } catch (err) {
        console.error('Error fetching availability:', err);
        renderPartySlots([]);
      }
    });
  }

  function renderPartySlots(busySlots = []) {
    const slots = [
      { id: "11-13", label: "11:00 – 13:00", meal: "Trưa" },
      { id: "13-15", label: "13:00 – 15:00", meal: "Trưa" },
      { id: "15-17", label: "15:00 – 17:00", meal: "Chiều" },
      { id: "17-19", label: "17:00 – 19:00", meal: "Tối" },
      { id: "19-21", label: "19:00 – 21:00", meal: "Tối" },
    ];

    slotsContainer.innerHTML = '';
    const grid = document.createElement('div');
    grid.className = 'grid grid-cols-2 sm:grid-cols-3 gap-2.5';

    slots.forEach(slot => {
      const isBusy = busySlots.includes(slot.id);
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.disabled = isBusy;
      btn.className = `rounded-sm border px-3 py-3 text-center transition-all min-h-[56px] ${
        isBusy
          ? 'border-border bg-muted/60 text-muted-foreground cursor-not-allowed line-through'
          : 'border-border hover:border-[#722F37] text-foreground cursor-pointer'
      }`;

      btn.innerHTML = `
        <span class="block text-xs font-medium">${slot.label}</span>
        <span class="block text-[10px] mt-0.5 text-muted-foreground">${isBusy ? 'Đã có khách' : slot.meal}</span>
      `;

      btn.addEventListener('click', () => {
        grid.querySelectorAll('button').forEach(b => b.classList.remove('border-[#722F37]', 'bg-[#722F37]', 'text-white'));
        btn.classList.add('border-[#722F37]', 'bg-[#722F37]', 'text-white');
        selectedSlotInput.value = slot.id;
      });

      grid.appendChild(btn);
    });

    slotsContainer.appendChild(grid);
  }

  if (bookingForm) {
    bookingForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(bookingForm);
      const payload = Object.fromEntries(formData.entries());

      if (!payload.slot) {
        alert('Vui lòng chọn khung giờ tiệc!');
        return;
      }

      btnBookingSubmit.disabled = true;
      btnBookingSubmit.textContent = 'Đang gửi thông tin...';

      try {
        const res = await fetch('/api/booking', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.success) {
          bookingForm.reset();
          selectedSlotInput.value = '';
          if (slotsContainer) slotsContainer.innerHTML = '';

          const successModal = document.getElementById('successModal');
          if (successModal) successModal.classList.add('active');
        } else {
          alert(data.message || 'Vui lòng kiểm tra lại thông tin!');
        }
      } catch (err) {
        console.error('Booking submission error:', err);
        alert('Đã xảy ra lỗi kết nối. Vui lòng thử lại!');
      } finally {
        btnBookingSubmit.disabled = false;
        btnBookingSubmit.textContent = 'Xác Nhận Đặt Tiệc';
      }
    });
  }
});
