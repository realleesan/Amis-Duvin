<section id="register" class="py-24 bg-[#0f0d0e] relative overflow-hidden bg-wine-radial">
  <div class="max-w-6xl mx-auto px-6 relative z-10">
    <div class="text-center mb-16">
      <p class="text-[#D4AF37] text-xs uppercase tracking-[0.35em] mb-3">Đặt tiệc riêng tư</p>
      <h2 class="font-heading text-3xl sm:text-5xl text-[#f4ede4] mb-4">Đăng Ký Đặt Tiệc</h2>
      <p class="text-xs text-[#a69c96]">Để lại thông tin, Amis du Vin sẽ liên hệ xác nhận trong vòng 2 giờ làm việc.</p>
    </div>

    <div class="grid lg:grid-cols-5 gap-10">
      <!-- Form Container -->
      <form id="bookingForm" class="lg:col-span-3 bg-[#191517] border border-[#332a2e] p-8 rounded-sm space-y-5">
        <div>
          <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Họ và tên *</label>
          <input type="text" name="name" required placeholder="Nguyễn Văn An" class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm" />
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Số điện thoại *</label>
            <input type="tel" name="phone" required placeholder="0912345678" maxLength="10" class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm" />
          </div>
          <div>
            <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Email *</label>
            <input type="email" name="email" required placeholder="an@email.com" class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm" />
          </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Số lượng khách *</label>
            <input type="number" name="participants" value="2" min="1" required class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm" />
          </div>
          <div>
            <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Ngày đặt tiệc *</label>
            <input type="date" id="bookingDate" name="date" required class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm" />
          </div>
        </div>

        <!-- Dynamic Slots Picker -->
        <div>
          <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Khung giờ (Lịch Sommelier) *</label>
          <input type="hidden" id="selectedSlot" name="slot" value="" />
          <div id="slotsContainer">
            <p class="text-xs text-[#a69c96] italic py-3">Vui lòng chọn ngày để hiển thị các khung giờ trống.</p>
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-2">Ghi chú thêm</label>
          <textarea name="notes" rows="3" placeholder="Ghi chú về dị ứng thực phẩm, dịp kỷ niệm..." class="input-elegant w-full px-4 py-3.5 rounded-sm text-sm"></textarea>
        </div>

        <button type="submit" id="btnBookingSubmit" class="btn-gold w-full text-xs uppercase tracking-widest py-4 mt-2">
          Xác Nhận Đặt Tiệc
        </button>
      </form>

      <!-- Trust Info Box -->
      <div class="lg:col-span-2 space-y-6">
        <div class="bg-[#191517] p-6 border border-[#332a2e] rounded-sm">
          <h4 class="font-heading text-xl text-[#D4AF37] mb-2">Chi phí dự kiến</h4>
          <p class="text-xs text-[#a69c96] leading-relaxed">Từ 1.500.000đ/khách — tùy thuộc vào gói Wine Pairing và thực đơn lựa chọn.</p>
        </div>

        <div class="bg-[#191517] p-6 border border-[#332a2e] rounded-sm">
          <h4 class="font-heading text-xl text-[#D4AF37] mb-2">Phương thức thanh toán</h4>
          <p class="text-xs text-[#a69c96] leading-relaxed">Chuyển khoản ngân hàng hoặc QR VNPay. Đặt cọc 30% để giữ suất và chuẩn bị nguyên liệu.</p>
        </div>

        <div class="bg-[#191517] p-6 border border-[#332a2e] rounded-sm">
          <h4 class="font-heading text-xl text-[#D4AF37] mb-2">Chính sách hoàn / hủy</h4>
          <p class="text-xs text-[#a69c96] leading-relaxed">Hoàn 100% tiền cọc nếu báo hủy trước 72 giờ.</p>
        </div>
      </div>
    </div>
  </div>
</section>
