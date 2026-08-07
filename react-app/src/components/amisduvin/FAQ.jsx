import { useState } from "react";
import { Plus, Minus } from "lucide-react";
import Reveal from "./Reveal";

const FAQS = [
  { q: "Amis du Vin có phục vụ tiệc riêng tư theo yêu cầu không?", a: "Có. Chúng tôi thiết kế thực đơn và lựa chọn rượu vang riêng cho từng bữa tiệc, phù hợp sở thích, ngân sách và dịp lễ của Quý khách." },
  { q: "Mỗi buổi tiệc phục vụ tối đa bao nhiêu khách?", a: "Không gian ấm cúng tối ưu cho nhóm từ 8 đến 30 khách. Với quy mô lớn hơn, vui lòng liên hệ để chúng tôi bố trí riêng." },
  { q: "Tôi cần đặt trước bao lâu?", a: "Khuyến nghị đặt trước 3–5 ngày để Sommelier và Bếp chuẩn bị thực đơn tốt nhất. Các gói Premium nên đặt trước 1–2 tuần." },
  { q: "Chưa hiểu về rượu vang, có tham gia được không?", a: "Tuyệt đối được. Trải nghiệm dành cho mọi trình độ — Sommelier hướng dẫn từ cơ bản, giúp Quý khách tự tin thưởng thức." },
  { q: "Chi phí bao gồm những gì?", a: "Đã bao gồm thực đơn ẩm thực, rượu vang pairing, không gian riêng và sự hướng dẫn trực tiếp của Sommelier trong suốt bữa tiệc." },
  { q: "Có hỗ trợ khách ăn chay hoặc dị ứng không?", a: "Có. Vui lòng ghi chú yêu cầu đặc biệt khi đặt tiệc, bếp sẽ chuẩn bị thực đơn thay thế phù hợp." },
  { q: "Chính sách hoàn/hủy đặt tiệc thế nào?", a: "Hoàn 100% nếu hủy trước 72 giờ. Trong vòng 72 giờ, giữ 50% chi phí. Chi tiết xem tại mục chính sách cạnh Form đặt tiệc." },
];

/**
 * FAQ — Accordion: bấm mở 1 câu, bấm câu khác tự đóng câu cũ.
 */
export default function FAQ() {
  const [open, setOpen] = useState(0);
  const toggle = (i) => setOpen(open === i ? -1 : i);

  return (
    <section id="faq" className="scroll-anchor relative py-24 sm:py-32 bg-background">
      <div className="max-w-3xl mx-auto px-5 sm:px-8">
        <Reveal>
          <div className="text-center mb-12">
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Câu hỏi thường gặp</p>
            <h2 className="font-heading text-3xl sm:text-5xl text-foreground">FAQ</h2>
          </div>
        </Reveal>

        <div className="space-y-3">
          {FAQS.map((f, i) => {
            const isOpen = open === i;
            return (
              <Reveal key={i} delay={i * 50}>
                <div className={`rounded-sm border bg-card transition-colors duration-300 ${isOpen ? "border-[var(--wine)]/40" : "border-border"}`}>
                  <button
                    onClick={() => toggle(i)}
                    className="w-full flex items-center justify-between gap-4 text-left px-5 sm:px-6 py-5 min-h-[64px]"
                    aria-expanded={isOpen}
                  >
                    <span className="font-heading text-base sm:text-lg text-foreground">{f.q}</span>
                    <span className={`shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors ${isOpen ? "bg-[var(--wine)] text-white" : "bg-foreground/5 text-foreground/60"}`}>
                      {isOpen ? <Minus className="w-4 h-4" /> : <Plus className="w-4 h-4" />}
                    </span>
                  </button>
                  <div className={`grid transition-all duration-300 ease-out ${isOpen ? "grid-rows-[1fr] opacity-100" : "grid-rows-[0fr] opacity-0"}`}>
                    <div className="overflow-hidden">
                      <p className="px-5 sm:px-6 pb-5 text-sm text-muted-foreground leading-relaxed">{f.a}</p>
                    </div>
                  </div>
                </div>
              </Reveal>
            );
          })}
        </div>
      </div>
    </section>
  );
}