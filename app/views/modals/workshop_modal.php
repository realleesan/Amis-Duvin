<div id="workshopRegisterModal" class="modal-overlay">
  <div class="modal-content max-w-md relative">
    <button data-modal-close class="absolute top-4 right-4 text-[#a69c96] hover:text-[#f4ede4] text-xl">&times;</button>
    <div class="text-center mb-6">
      <span class="text-[#D4AF37] text-xs uppercase tracking-widest block mb-2">Đăng ký tham gia</span>
      <h3 id="modalWorkshopTitle" class="font-heading text-2xl text-[#f4ede4]">Workshop</h3>
    </div>

    <form id="workshopRegisterForm" class="space-y-4">
      <input type="hidden" id="inputWorkshopId" name="workshop_id" value="" />
      <div>
        <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-1">Họ và tên</label>
        <input type="text" name="name" required placeholder="Nguyễn Văn An" class="input-elegant w-full px-4 py-3 rounded-sm text-sm" />
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-1">Số điện thoại</label>
          <input type="tel" name="phone" required placeholder="0912345678" maxLength="10" class="input-elegant w-full px-4 py-3 rounded-sm text-sm" />
        </div>
        <div>
          <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-1">Số người</label>
          <input type="number" name="participants" value="1" min="1" max="10" required class="input-elegant w-full px-4 py-3 rounded-sm text-sm" />
        </div>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-1">Email</label>
        <input type="email" name="email" required placeholder="an@example.com" class="input-elegant w-full px-4 py-3 rounded-sm text-sm" />
      </div>

      <div>
        <label class="block text-xs uppercase tracking-wider text-[#a69c96] mb-1">Ghi chú</label>
        <textarea name="notes" rows="2" placeholder="Yêu cầu chế độ ăn uống hoặc lưu ý..." class="input-elegant w-full px-4 py-3 rounded-sm text-sm"></textarea>
      </div>

      <button type="submit" class="btn-gold w-full text-xs uppercase tracking-widest py-3 mt-4">
        Xác Nhận Đăng Ký Workshop
      </button>
    </form>
  </div>
</div>
