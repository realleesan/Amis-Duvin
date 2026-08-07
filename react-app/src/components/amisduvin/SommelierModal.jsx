const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { useState, useEffect, useCallback } from "react";
import { X, ChevronLeft, ChevronRight, ArrowRight, Award, Briefcase, Building2 } from "lucide-react";
import { Image } from "@/components/ui/image";

const BASE = "https://media.db.com/images/public/6a623336361c483b3f15558c";

const PORTRAIT = `${BASE}/1a9505e2b_image.png`;

const MOMENTS = [
  { img: `${BASE}/4a03e052e_image.png`, caption: "Hành trình học vang Pháp — Nhận giải French Wines Learning Journey" },
  { img: `${BASE}/e789f3c10_image.png`, caption: "Giám khảo quốc tế — Cathay Pacific HKIWSC 2017, Hong Kong" },
  { img: `${BASE}/b3b4047de_image.png`, caption: "Nghệ thuật phục vụ — Trải nghiệm Fine Dining riêng tư" },
  { img: `${BASE}/36ad6c80b_image.png`, caption: "Khám phá hương vị — Nghệ thuật thưởng thức & thử nếm" },
];

const CERTS = [
  { img: `${BASE}/615248ce1_image.png`, title: "Vietnam Best Sommelier in French Wine 2015", sub: "Concours du Meilleur Sommelier du Vietnam — Chung kết" },
  { img: `${BASE}/742e873b8_image.png`, title: "Advanced Ambassador — Academy of Wines of Portugal", sub: "Level III Training · Macau, 2014" },
  { img: `${BASE}/35171c789_image.png`, title: "Provence Wine Council (CIVP) Seminar", sub: "Provence Rosé Wine · Kuala Lumpur, 2015" },
];

const AWARDS = [
  "Chứng chỉ quốc tế WSET Level 3 Award in Wines and Spirits (UK) — Lý thuyết đạt loại xuất sắc. WSET Level 1 và 2 xuất sắc.",
  "Chứng chỉ WSET Sake Level 1, Chứng chỉ Đại sứ rượu vang Bồ Đào Nha, chứng chỉ Bartender do Học viện Du lịch Macao cấp, cùng nhiều chứng chỉ khác về vang.",
  "Cử nhân tiếng Pháp — Đại học Hà Nội (HANU).",
  "Giải nhất cuộc thi phục vụ và thử nếm vang Pháp tại Việt Nam 2015.",
  "Giải nhì cuộc thi phục vụ và thử nếm vang Pháp VN 2020.",
  "Giải nhì cuộc thi phục vụ và thử nếm vang Bồ Đào Nha — Macao 2013.",
  "Giải ba cuộc thi vang quốc tế khu vực Đông Nam Á + Đài Loan — Bangkok 2015.",
  "Bán kết cuộc thi vang Pháp khu vực Châu Á — Kuala Lumpur 2015.",
];

const EXPERIENCE = [
  "24 năm làm việc trong các nhà hàng, khách sạn 5 sao trong và ngoài nước, và công ty nhập khẩu rượu vang.",
  "Giám khảo chấm điểm rượu vang quốc tế tại Hong Kong IWSC 2017.",
  "Giám khảo chọn vang cho Vietnam Airlines từ 2023 – nay.",
  "Giám khảo cuộc thi chung kết Sommelier Rượu vang Pháp 2018 tại HCM.",
  "Đã đặt chân đến 20 quốc gia và vùng lãnh thổ; 4 chuyến trải nghiệm vang tại Châu Âu, 2 lần tại Úc, 1 lần tại Mỹ; tham dự nhiều sự kiện lớn về rượu vang (Bordeaux, HK, Singapore…).",
  "Hợp tác giảng dạy cho các trường đại học: KTQD, Greenwich…",
  "Chia sẻ văn hóa tiêu dùng vang trên VTV2, VTV3, VTV Cab 15… và các tạp chí.",
  "Dạy kiến thức vang cho các khách sạn, nhà hàng trong cả nước (Sofitel Metropole, JW Marriott, Intercontinental, Vinpearl, Amanoi… các tàu 5 sao tại Hạ Long).",
  "Chia sẻ văn hóa ngoại giao trên bàn tiệc cho các cơ quan, tổ chức (ĐH Ngoại Thương, Ngân hàng BIDV, Seabank, Dược Trafaco…).",
  "Tổ chức sự kiện, hội thảo và kết nối về vang cho các nhà máy nước ngoài tại thị trường Việt Nam.",
  "Đại diện Hiệp hội giáo dục rượu vang Úc dạy chương trình vang 2025 tại VN.",
];

const POSITIONS = [
  "Hiện tại: Giám đốc Công ty Cổ phần Quốc tế GCC Thịnh Phát.",
  "Chuyên gia tư vấn và đào tạo cho công ty ADT.",
  "Hợp tác với các công ty nhập khẩu vang lớn như Huy Phong.",
  "Giám sát Bar tại các khách sạn 5 sao.",
  "Sommelier tại khách sạn 5 sao trong và ngoài nước.",
  "3 năm Phó Chủ tịch Hiệp hội Sommelier Sài Gòn.",
  "Hiện là Phó Chủ tịch Hanoi Vino Club.",
  "Giám đốc đào tạo và tổ chức sự kiện cho công ty Đa Lộc 2014 – 2019.",
];

/**
 * SommelierModal — Deep-dive profile (slide-out panel 80% desktop / 100% mobile).
 * Khối A: Carousel khoảnh khắc • Khối B: Lưới chứng chỉ (grayscale→color + lightbox)
 * • Khối C: Sticky CTA • Danh sách giải thưởng / kinh nghiệm / vị trí.
 */
export default function SommelierModal({ onClose, onRegister, onExploreWorkshops }) {
  const [closing, setClosing] = useState(false);
  const [active, setActive] = useState(0);
  const [lightbox, setLightbox] = useState(null);

  useEffect(() => {
    document.body.style.overflow = "hidden";
    return () => { document.body.style.overflow = ""; };
  }, []);

  // Carousel auto-play
  useEffect(() => {
    const id = setInterval(() => setActive((a) => (a + 1) % MOMENTS.length), 5000);
    return () => clearInterval(id);
  }, []);

  const closeWith = useCallback((action) => {
    setClosing(true);
    window.setTimeout(() => {
      document.body.style.overflow = "";
      action();
    }, 400);
  }, []);

  const go = (dir) => setActive((a) => (a + dir + MOMENTS.length) % MOMENTS.length);

  return (
    <div className="fixed inset-0 z-[100]">
      {/* Backdrop glassmorphism */}
      <div
        className={`absolute inset-0 bg-black/60 backdrop-blur-md ${closing ? "animate-fade-out" : "animate-fade-in"}`}
        onClick={() => closeWith(onClose)}
      />

      {/* Panel slide-out phải */}
      <div
        className={`absolute right-0 top-0 h-full w-full md:w-4/5 bg-card border-l border-border flex flex-col ${
          closing ? "animate-slide-out-right" : "animate-slide-in-right"
        }`}
      >
        {/* Header dính */}
        <div className="shrink-0 flex items-center justify-between px-5 sm:px-8 py-4 border-b border-border bg-card">
          <div className="flex items-center gap-3 min-w-0">
            <div className="w-11 h-11 rounded-sm overflow-hidden border border-border shrink-0">
              <Image src={PORTRAIT} alt="Alex Thịnh" className="w-full h-full" fittingType="fill" focalPointX={0.5} focalPointY={0.4} />
            </div>
            <div className="min-w-0">
              <p className="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] leading-none mb-1">Sommelier</p>
              <p className="font-heading text-base sm:text-lg text-foreground truncate">Alex Thịnh</p>
            </div>
          </div>
          <button
            onClick={() => closeWith(onClose)}
            className="w-11 h-11 flex items-center justify-center text-foreground/60 hover:text-foreground rounded-full hover:bg-foreground/5 transition-colors shrink-0"
            aria-label="Đóng"
          >
            <X className="w-6 h-6" />
          </button>
        </div>

        {/* Nội dung cuộn dọc */}
        <div className="flex-1 overflow-y-auto px-5 sm:px-8 lg:px-12 py-10 space-y-16">
          {/* Intro */}
          <div className="max-w-2xl">
            <p className="font-serif-display italic text-xl sm:text-2xl text-foreground/80 leading-relaxed">
              “Mỗi chai vang là một câu chuyện — và tôi là người kể câu chuyện ấy trên những bàn tiệc tinh hoa.”
            </p>
            <p className="text-sm text-muted-foreground mt-4">— Sommelier Alex Thịnh</p>
          </div>

          {/* KHỐI A — Nghệ thuật & Ngoại giao */}
          <section>
            <SectionTitle eyebrow="Khối A" title="Nghệ thuật & Ngoại giao" />
            <p className="text-sm text-muted-foreground leading-relaxed mb-7 max-w-2xl">
              Người kết nối giới tinh hoa trong các buổi tiệc Private &amp; Fine Dining — nơi vang trở thành cầu nối giữa văn hóa, nghệ thuật và ngoại giao thương gia.
            </p>

            {/* Carousel */}
            <div className="relative overflow-hidden rounded-sm border border-border">
              <div
                className="flex transition-transform duration-700 ease-out"
                style={{ transform: `translateX(-${active * 100}%)` }}
              >
                {MOMENTS.map((m) => (
                  <div key={m.img} className="relative w-full shrink-0 aspect-[16/10]">
                    <Image src={m.img} alt={m.caption} className="w-full h-full" fittingType="fill" />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/15 to-transparent" />
                    <div className="absolute bottom-0 left-0 right-0 p-5 sm:p-8">
                      <p className="text-white/95 font-serif-display text-lg sm:text-2xl italic leading-snug">{m.caption}</p>
                    </div>
                  </div>
                ))}
              </div>
              <button
                onClick={() => go(-1)}
                className="absolute left-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center hover:bg-[var(--wine)] transition-colors"
                aria-label="Trước"
              >
                <ChevronLeft className="w-5 h-5" />
              </button>
              <button
                onClick={() => go(1)}
                className="absolute right-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center hover:bg-[var(--wine)] transition-colors"
                aria-label="Sau"
              >
                <ChevronRight className="w-5 h-5" />
              </button>
              <div className="absolute bottom-4 right-5 flex gap-2">
                {MOMENTS.map((_, i) => (
                  <button
                    key={i}
                    onClick={() => setActive(i)}
                    className={`h-1.5 rounded-full transition-all duration-300 ${i === active ? "w-6 bg-[var(--wine)]" : "w-1.5 bg-white/50"}`}
                    aria-label={`Slide ${i + 1}`}
                  />
                ))}
              </div>
            </div>
          </section>

          {/* KHỐI B — Bảo chứng Học thuật */}
          <section>
            <SectionTitle eyebrow="Khối B" title="Bảo chứng Học thuật" />
            <p className="text-sm text-muted-foreground leading-relaxed mb-7 max-w-2xl">
              Những bảo chứng học thuật và giải thưởng quốc tế — minh chứng cho hành trình tận tâm với nghệ thuật vang. Di chuột để xem, bấm để phóng to chi tiết.
            </p>

            <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
              {CERTS.map((c) => (
                <button
                  key={c.img}
                  onClick={() => setLightbox(c.img)}
                  className="group relative block overflow-hidden rounded-sm border border-border aspect-[4/3] text-left"
                >
                  <Image src={c.img} alt={c.title} className="media-dim w-full h-full" fittingType="fill" />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500" />
                  <div className="absolute inset-x-0 bottom-0 p-4 translate-y-3 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                    <p className="text-white text-sm font-medium leading-snug">{c.title}</p>
                    <p className="text-white/65 text-xs mt-1">{c.sub}</p>
                  </div>
                  <span className="absolute top-3 right-3 w-9 h-9 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <ArrowRight className="w-4 h-4 -rotate-45" />
                  </span>
                </button>
              ))}
            </div>

            {/* CTA chuyên biệt dưới chứng chỉ */}
            <button
              onClick={() => closeWith(onExploreWorkshops)}
              className="btn-ghost mt-7 px-7 py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px] inline-flex items-center gap-2 group"
            >
              Đăng ký Workshop với Sommelier
              <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
            </button>
          </section>

          {/* Danh sách chuyên môn */}
          <section className="grid lg:grid-cols-2 gap-10">
            <ListBlock icon={<Award className="w-5 h-5" />} title="Giải thưởng & Học vấn" items={AWARDS} />
            <ListBlock icon={<Building2 className="w-5 h-5" />} title="Vị trí công việc" items={POSITIONS} />
            <div className="lg:col-span-2">
              <ListBlock icon={<Briefcase className="w-5 h-5" />} title="Kinh nghiệm nghề nghiệp" items={EXPERIENCE} />
            </div>
          </section>

          <div className="h-2" />
        </div>

        {/* KHỐI C — Sticky CTA chốt sale */}
        <div className="shrink-0 border-t border-border bg-card px-5 sm:px-8 py-4">
          <button
            onClick={() => closeWith(onRegister)}
            className="btn-wine w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2"
          >
            Đăng ký Workshop cùng Sommelier Alex Thịnh
            <ArrowRight className="w-4 h-4" />
          </button>
        </div>
      </div>

      {/* Lightbox — z-index cao nhất */}
      {lightbox && (
        <div
          className="absolute inset-0 z-[110] flex items-center justify-center p-4 bg-black/92 backdrop-blur-sm animate-fade-in"
          onClick={() => setLightbox(null)}
        >
          <button
            onClick={() => setLightbox(null)}
            className="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/10 text-white flex items-center justify-center hover:bg-[var(--wine)] transition-colors"
            aria-label="Đóng ảnh"
          >
            <X className="w-6 h-6" />
          </button>
          <div onClick={(e) => e.stopPropagation()} className="flex items-center justify-center">
            <Image src={lightbox} alt="Chứng chỉ" fittingType="fit" className="w-[92vw] h-[85vh]" />
          </div>
        </div>
      )}
    </div>
  );
}

function SectionTitle({ eyebrow, title }) {
  return (
    <div className="mb-2">
      <p className="text-[var(--gold)] text-[10px] uppercase tracking-[0.3em] mb-2">{eyebrow}</p>
      <h3 className="font-heading text-2xl sm:text-3xl text-foreground">{title}</h3>
      <div className="hairline w-16 mt-4" />
    </div>
  );
}

function ListBlock({ icon, title, items }) {
  return (
    <div>
      <h4 className="flex items-center gap-2.5 text-[var(--wine)] font-heading text-lg sm:text-xl mb-5">
        <span className="w-9 h-9 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center">
          {icon}
        </span>
        {title}
      </h4>
      <ul className="space-y-3">
        {items.map((a, i) => (
          <li key={i} className="flex gap-3 text-sm text-foreground/80 leading-relaxed">
            <span className="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0" />
            <span>{a}</span>
          </li>
        ))}
      </ul>
    </div>
  );
}