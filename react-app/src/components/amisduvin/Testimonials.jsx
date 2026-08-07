const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { Star, Quote } from "lucide-react";
import { Image } from "@/components/ui/image";
import Reveal from "./Reveal";

const BASE = "https://media.db.com/images/public/6a623336361c483b3f15558c";

const FEEDBACK = [
  {
    name: "Anh Trần Tuấn Minh",
    role: "CEO · Công ty Đầu tư",
    service: "Gói Signature Pairing",
    img: `${BASE}/0c749a039_generated_image.png`,
    text: "Bữa tiệc hoàn hảo đến từng chi tiết. Sommelier Alex Thịnh kể chuyện vang cuốn hút, khách hàng đối tác của tôi rất ấn tượng.",
    stars: 5,
  },
  {
    name: "Chị Lê Hoàng Yến",
    role: "Giám đốc Marketing",
    service: "Gói Gourmet Selection",
    img: `${BASE}/054117747_generated_image.png`,
    text: "Không gian nhỏ, riêng tư, ấm cúng. Pairing rượu và món ăn tinh tế — một trải nghiệm văn hoá đúng nghĩa.",
    stars: 5,
  },
  {
    name: "Anh Phạm Đức Anh",
    role: "Doanh nhân",
    service: "Workshop Wine & Food Romance",
    initials: "ĐA",
    text: "Tôi không rành vang nhưng được hướng dẫn rất gần gũi. Ra về tự tin chọn vang cho bữa tiệc gia đình.",
    stars: 5,
  },
  {
    name: "Chị Vũ Thu Hà",
    role: "Chủ Spa cao cấp",
    service: "Gói Private Cellar",
    initials: "TH",
    text: "Dịch vụ chu đáo, khách hàng VIP của tôi đều hài lòng. Sẽ quay lại cho các dịp kỷ niệm quan trọng.",
    stars: 5,
  },
  {
    name: "Anh Nguyễn Quốc Bảo",
    role: "Nhà đầu tư",
    service: "Amis du Vin Gala Night",
    img: `${BASE}/c14ed7531_generated_image.png`,
    text: "Đẳng cấp và tinh tế. Đêm Gala thật sự vượt mong đợi — điểm đến xứng đáng cho giới doanh nhân.",
    stars: 5,
  },
];

/**
 * Testimonials — 5 dẫn chứng khách hàng VIP.
 * Mỗi thẻ: ảnh đại diện (hoặc monogram) + dịch vụ đã sử dụng + sao + nhận xét.
 */
export default function Testimonials() {
  return (
    <section className="relative py-24 sm:py-32 bg-card">
      <div className="max-w-7xl mx-auto px-5 sm:px-8">
        <Reveal>
          <div className="text-center max-w-2xl mx-auto mb-14">
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Khách hàng nói gì</p>
            <h2 className="font-heading text-3xl sm:text-5xl text-foreground mb-5">Dẫn chứng tin cậy</h2>
          </div>
        </Reveal>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
          {FEEDBACK.map((t, i) => (
            <Reveal key={t.name} delay={(i % 3) * 100}>
              <div className="card-lift h-full rounded-sm border border-border bg-background p-7 flex flex-col">
                <div className="flex items-center gap-4 mb-5">
                  {t.img ? (
                    <Image src={t.img} alt={t.name} className="w-14 h-14 rounded-full shrink-0" fittingType="fill" />
                  ) : (
                    <div className="w-14 h-14 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center font-heading text-base text-[var(--wine)] shrink-0">
                      {t.initials}
                    </div>
                  )}
                  <div className="min-w-0">
                    <p className="font-heading text-sm text-foreground truncate">{t.name}</p>
                    <p className="text-xs text-muted-foreground truncate">{t.role}</p>
                  </div>
                </div>

                <span className="inline-flex items-center self-start gap-1.5 text-[10px] uppercase tracking-[0.12em] px-2.5 py-1 rounded-full border border-[var(--gold)]/30 bg-[var(--gold)]/10 text-[var(--gold)] mb-4">
                  {t.service}
                </span>

                <Quote className="w-7 h-7 text-[var(--wine)]/25 mb-3" />
                <div className="flex gap-0.5 mb-4">
                  {Array.from({ length: t.stars }).map((_, s) => (
                    <Star key={s} className="w-4 h-4 fill-[var(--gold)] text-[var(--gold)]" />
                  ))}
                </div>
                <p className="text-sm text-foreground/80 leading-relaxed flex-1">“{t.text}”</p>
              </div>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}