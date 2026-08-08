<!-- Refund & Deposit Policy Modal -->
<div id="refundPolicyModal" class="modal-overlay">
  <div class="relative w-full max-w-2xl max-h-[90vh] flex flex-col bg-card border border-border rounded-sm shadow-2xl animate-scale-in my-auto">
    <div class="shrink-0 glass px-6 sm:px-8 py-5 flex items-center justify-between border-b border-border">
      <div>
        <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-1">Chính sách Amis du Vin</p>
        <h3 class="font-heading text-lg text-foreground">Quy định Đặt tiệc &amp; Chính sách Hoàn/Hủy cọc</h3>
      </div>
      <button onclick="closeRefundPolicyModal()" class="w-10 h-10 flex items-center justify-center text-muted-foreground hover:text-foreground rounded-full hover:bg-muted transition-colors shrink-0" aria-label="Đóng">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
      </button>
    </div>
    <div class="p-6 sm:p-8 overflow-y-auto no-scrollbar space-y-4 text-sm text-muted-foreground leading-relaxed">
      <p class="text-foreground font-medium">Để đảm bảo chất lượng phục vụ biệt lập và sự chuẩn bị kỹ lưỡng nhất từ Sommelier và Bếp, Amis du Vin áp dụng quy định đặt tiệc như sau:</p>
      <div class="space-y-4">
        <div>
          <h4 class="text-foreground font-heading text-base mb-1">1. Quy định Thời gian Đặt trước</h4>
          <p>Quý khách cần đặt tiệc trước <strong class="text-foreground">tối thiểu 05 ngày</strong> so với thời điểm tổ chức để nhà hàng sắp xếp ca phục vụ và chuẩn bị nguồn nguyên liệu hảo hạng.</p>
        </div>
        
        <div>
          <h4 class="text-foreground font-heading text-base mb-1">2. Quy định Giới hạn Phục vụ</h4>
          <p>Mỗi ngày tối đa 02 ca tiệc (Ca 1: 11h00 – 14h00, Ca 2: 18h00 – 21h00). Mỗi ca phục vụ tối đa 02 đoàn khách và tổng số lượng khách không vượt quá <strong class="text-foreground">24 người/ca</strong>.</p>
        </div>

        <div>
          <h4 class="text-foreground font-heading text-base mb-1">3. Quy định Đặt cọc Giữ chỗ</h4>
          <p>Bắt buộc đặt cọc <strong class="text-foreground">30% tổng chi phí dự kiến</strong> sau khi chốt thực đơn với bộ phận CSKH để xác nhận giữ chỗ chính thức.</p>
        </div>

        <div>
          <h4 class="text-foreground font-heading text-base mb-1">4. Chính sách Hoàn / Hủy cọc</h4>
          <ul class="list-disc pl-5 space-y-2 mt-1">
            <li><strong class="text-foreground">Báo hủy trước 02 ngày (48 – 72 giờ)</strong>: Quý khách được hoàn lại <span class="text-emerald-400 font-semibold">100% tiền đặt cọc</span>.</li>
            <li><strong class="text-foreground">Báo hủy trước 01 ngày (dưới 24 – 48 giờ)</strong>: Giữ lại <span class="text-[var(--wine)] font-semibold">100% tiền cọc</span> để bù đắp chi phí chuẩn bị nguyên liệu tươi sống cho bữa tiệc.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
