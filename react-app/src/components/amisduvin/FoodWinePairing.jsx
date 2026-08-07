const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { useState, useRef } from "react";
import { ChevronLeft, ChevronRight, ArrowRight } from "lucide-react";
import { Image } from "@/components/ui/image";
import Reveal from "./Reveal";
import PartyDetailModal from "./PartyDetailModal";

const PACKAGES = [
  {
    name: "Signature Pairing",
    level: "Standard",
    desc: "Sự kết hợp kinh điển giữa rượu vang và các món ngon đặc trưng, mở đầu hành trình thưởng thức tinh tế.",
    img: "https://media.db.com/images/public/6a623336361c483b3f15558c/e6d25f6b5_generated_78290a91.png",
    price: "Từ 1.500.000đ/khách",
    duration: "2.5 giờ",
    pax: "8–20 khách",
    menu: [
      { dish: "Khởi vị — Carpaccio bò, parmigiano", wine: "Pinot Noir" },
      { dish: "Món chính — Ngừ sốt tiêu, bơ thảo mộc", wine: "Cabernet Sauvignon" },
      { dish: "Tráng miệng — Tart chocolate đen", wine: "Port Tawny" },
    ],
  },
  {
    name: "Gourmet Selection",
    level: "Standard",
    desc: "Bộ sưu tập món cao cấp được thiết kế riêng, kết hợp hoàn hảo cùng những dòng vang thượng hạng.",
    img: "https://media.db.com/images/public/6a623336361c483b3f15558c/4f229480d_generated_ffd34238.png",
    price: "Từ 2.000.000đ/khách",
    duration: "3 giờ",
    pax: "8–20 khách",
    menu: [
      { dish: "Khởi vị — Sashimi cá hồi Na Uy", wine: "Chardonnay" },
      { dish: "Món chính — Bò bít tết Wagyu", wine: "Malbec" },
      { dish: "Tráng miệng — Crème brûlée vani", wine: "Sauternes" },
    ],
  },
  {
    name: "Private Cellar",
    level: "Premium",
    desc: "Trải nghiệm thử rượu độc quyền trong hầm rượu riêng, dành cho những người sành vang đích thực.",
    img: "https://media.db.com/images/public/6a623336361c483b3f15558c/0a280a9c0_generated_bbd5d622.png",
    price: "Từ 3.500.000đ/khách",
    duration: "3.5 giờ",
    pax: "6–12 khách",
    menu: [
      { dish: "Nếm thử 5 dòng vang hầm riêng", wine: "Vertical Tasting" },
      { dish: "Phô mai nhập khẩu & pâté", wine: "Bordeaux Grand Cru" },
      { dish: "Món chính — Thỏ nấu rượu vang", wine: "Burgundy Pinot" },
    ],
  },
  {
    name: "Amis du Vin Gala Night",
    level: "Premium",
    desc: "Đêm tiệc thượng lưu tráng lệ với thực đơn Sommelier thiết kế, không gian riêng tư đẳng cấp.",
    img: "https://media.db.com/images/public/6a623336361c483b3f15558c/af384a896_generated_47deb67b.png",
    price: "Từ 5.000.000đ/khách",
    duration: "4 giờ",
    pax: "15–40 khách",
    menu: [
      { dish: "Aperitif & lộ trình vang 7 món", wine: "Champagne" },
      { dish: "Món chính — Cừu nướng thảo mộc", wine: "Barolo Riserva" },
      { dish: "Tráng miệng — Soufflé chocolate", wine: "Tokaji Aszú" },
    ],
  },
];

/**
 * FoodWinePairing — Section trọng tâm chuyển đổi.
 * Grid card (Desktop) / carousel (Mobile). Click thẻ → Modal chi tiết gói.
 */
export default function FoodWinePairing({ onBook }) {
  const [selected, setSelected] = useState(null);
  const carouselRef = useRef(null);

  const scrollByCard = (dir) => {
    const el = carouselRef.current;
    if (!el) return;
    el.scrollBy({ left: dir * (el.clientWidth * 0.85), behavior: "smooth" });
  };

  return (
    <section id="pairing" className="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
      <div className="absolute inset-0 bg-wine-radial opacity-60" />
      <div className="relative max-w-7xl mx-auto px-5 sm:px-8">
        <Reveal>
          <div className="text-center max-w-2xl mx-auto mb-14">
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Dịch vụ tiệc riêng</p>
            <h2 className="font-heading text-3xl sm:text-5xl text-foreground mb-5">Food &amp; Wine Pairing</h2>
            <p className="text-sm sm:text-base text-muted-foreground">Bốn trải nghiệm kết hợp ẩm thực và rượu vang, từ tinh hoa tiêu chuẩn đến đỉnh cao thượng lưu.</p>
          </div>
        </Reveal>

        <div className="hidden md:grid grid-cols-2 gap-6 lg:gap-8">
          <Reveal><PackageCard pkg={PACKAGES[0]} onDetail={setSelected} /></Reveal>
          <Reveal delay={120}><PackageCard pkg={PACKAGES[1]} onDetail={setSelected} /></Reveal>
          <Reveal delay={80}><PackageCard pkg={PACKAGES[2]} premium onDetail={setSelected} /></Reveal>
          <Reveal delay={200}><PackageCard pkg={PACKAGES[3]} premium onDetail={setSelected} /></Reveal>
        </div>

        <div className="md:hidden">
          <div className="flex items-center justify-between mb-4">
            <span className="text-xs uppercase tracking-[0.2em] text-[var(--gold)]">Vuốt để xem tiếp</span>
            <div className="flex gap-2">
              <button onClick={() => scrollByCard(-1)} className="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 active:bg-foreground/5 transition-colors" aria-label="Trước"><ChevronLeft className="w-5 h-5" /></button>
              <button onClick={() => scrollByCard(1)} className="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 active:bg-foreground/5 transition-colors" aria-label="Sau"><ChevronRight className="w-5 h-5" /></button>
            </div>
          </div>
          <div ref={carouselRef} className="no-scrollbar flex gap-4 overflow-x-auto snap-x snap-mandatory pb-4 -mx-5 px-5">
            {PACKAGES.map((p) => (
              <div key={p.name} className="snap-center shrink-0 w-[85%]">
                <PackageCard pkg={p} premium={p.level === "Premium"} onDetail={setSelected} />
              </div>
            ))}
          </div>
        </div>
      </div>

      {selected && (
        <PartyDetailModal pkg={selected} onClose={() => setSelected(null)} onBook={() => { setSelected(null); onBook(); }} />
      )}
    </section>
  );
}

function PackageCard({ pkg, premium = false, onDetail }) {
  return (
    <div
      onClick={() => onDetail(pkg)}
      role="button"
      tabIndex={0}
      className={`card-lift group h-full rounded-sm border bg-card overflow-hidden flex flex-col cursor-pointer ${premium ? "border-[var(--gold)]/30" : "border-border"}`}
    >
      <div className="relative aspect-[4/3] overflow-hidden">
        <Image src={pkg.img} alt={pkg.name} className="w-full h-full transition-transform duration-700 group-hover:scale-105" fittingType="fill" />
        <div className="absolute inset-0 bg-gradient-to-t from-card via-card/20 to-transparent" />
        <span className={`absolute top-4 left-4 text-[10px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full backdrop-blur-sm ${premium ? "bg-[var(--gold)]/15 text-[var(--gold)] border border-[var(--gold)]/40" : "bg-black/50 text-white border border-white/20"}`}>
          {premium ? "Premium Level" : "Standard Level"}
        </span>
      </div>
      <div className="p-6 flex flex-col flex-1">
        <h3 className="font-heading text-xl sm:text-2xl text-foreground mb-3">{pkg.name}</h3>
        <p className="text-sm text-muted-foreground leading-relaxed mb-6 flex-1">{pkg.desc}</p>
        <div className="flex items-center justify-between">
          <span className="text-sm font-medium text-[var(--wine)]">{pkg.price}</span>
          <span className="btn-invert inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium">
            Xem chi tiết <ArrowRight className="w-3.5 h-3.5" />
          </span>
        </div>
      </div>
    </div>
  );
}