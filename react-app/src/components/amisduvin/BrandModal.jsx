const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { useState, useEffect, useCallback } from "react";
import { X, ArrowRight, HeartHandshake, Users, Eye, Sparkles, Link2, Compass, Target } from "lucide-react";
import { Image } from "@/components/ui/image";

const SPACE = "https://media.db.com/images/public/6a623336361c483b3f15558c/4f49d4a8f_generated_image.png";
const LOGO = "https://media.db.com/images/public/6a623336361c483b3f15558c/0bde20e94_LogoAmisDuVins.png";

const VALUES = [
  { icon: HeartHandshake, label: "Thân thiện" },
  { icon: Users, label: "Gần gũi" },
  { icon: Eye, label: "Thấu hiểu" },
  { icon: Sparkles, label: "Tinh tế" },
  { icon: Link2, label: "Kết nối" },
];

/**
 * BrandModal — Slide-out profile Thương hiệu (cùng cấu trúc & animation SommelierModal).
 * Khối A: Nguồn gốc & Cảm hứng • Khối B: Tầm nhìn & Sứ mệnh (grid 2 card)
 * • Khối C: 5 Giá trị cốt lõi (icon list) • Khối D: Sticky CTA → cuộn xuống Workshops.
 */
export default function BrandModal({ onClose, onExploreWorkshops }) {
  const [closing, setClosing] = useState(false);

  useEffect(() => {
    document.body.style.overflow = "hidden";
    return () => { document.body.style.overflow = ""; };
  }, []);

  const closeWith = useCallback((action) => {
    setClosing(true);
    window.setTimeout(() => { document.body.style.overflow = ""; action(); }, 400);
  }, []);

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
            <div className="h-11 shrink-0">
              <img src={LOGO} alt="Amis DuVins" className="h-11 w-auto object-contain rounded-sm" />
            </div>
            <div className="min-w-0">
              <p className="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] leading-none mb-1">Hệ sinh thái DuVins</p>
              <p className="font-heading text-base sm:text-lg text-foreground truncate">Amis DuVins — Huy Phong Group</p>
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
          {/* Banner không gian */}
          <div className="relative h-56 sm:h-64 overflow-hidden rounded-sm border border-border">
            <Image src={SPACE} alt="Không gian Amis DuVins" className="w-full h-full" fittingType="fill" />
            <div className="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-black/20" />
            <div className="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
              <p className="font-signature text-3xl sm:text-4xl text-white/95 leading-none mb-2">Amis DuVins</p>
              <p className="font-heading text-xl sm:text-2xl text-white leading-tight">Trái tim trải nghiệm văn hoá vang</p>
            </div>
          </div>

          {/* KHỐI A — Nguồn gốc & Cảm hứng */}
          <section>
            <SectionTitle eyebrow="Khối A" title="Nguồn gốc & Cảm hứng" />
            <p className="text-base text-foreground/80 leading-relaxed max-w-2xl">
              Ra đời từ mong muốn mang văn hoá rượu vang đến gần hơn với người Việt. Được hình thành bởi Sommelier Alex Thịnh — người thổi hồn vào từng ly rượu với chữ “A” trong logo như một dấu ấn cá nhân, cùng Chef Mạnh đến từ khách sạn 5 sao Sofitel Metropole Hà Nội.
            </p>
          </section>

          {/* KHỐI B — Tầm nhìn & Sứ mệnh */}
          <section>
            <SectionTitle eyebrow="Khối B" title="Tầm nhìn & Sứ mệnh" />
            <div className="grid sm:grid-cols-2 gap-5">
              <Card
                icon={<Target className="w-5 h-5" />}
                title="Sứ mệnh"
                text="Mang đến cho khách hàng sự thân thiện, gần gũi và thấu hiểu tình đời. Giới thiệu cách thưởng thức rượu vang một cách tinh tế và đúng nghĩa."
              />
              <Card
                icon={<Compass className="w-5 h-5" />}
                title="Tầm nhìn"
                text="Trở thành địa điểm trải nghiệm văn hoá rượu vang, nơi mọi người có thể kết nối, sẻ chia và cảm nhận giá trị tinh thần của rượu vang trong từng khoảnh khắc."
              />
            </div>
          </section>

          {/* KHỐI C — 5 Giá trị cốt lõi */}
          <section>
            <SectionTitle eyebrow="Khối C" title="5 Giá trị cốt lõi" />
            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
              {VALUES.map((v) => (
                <div
                  key={v.label}
                  className="flex flex-col items-center text-center gap-3 p-5 rounded-sm border border-border bg-background hover:border-[var(--wine)]/40 hover:-translate-y-1 transition-all duration-500"
                >
                  <span className="w-12 h-12 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)]">
                    <v.icon className="w-5 h-5" />
                  </span>
                  <span className="font-heading text-base text-foreground">{v.label}</span>
                </div>
              ))}
            </div>
          </section>

          <div className="h-2" />
        </div>

        {/* KHỐI D — Sticky CTA */}
        <div className="shrink-0 border-t border-border bg-card px-5 sm:px-8 py-4">
          <button
            onClick={() => closeWith(onExploreWorkshops)}
            className="btn-wine w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2"
          >
            Trải nghiệm Không gian Amis DuVins
            <ArrowRight className="w-4 h-4" />
          </button>
        </div>
      </div>
    </div>
  );
}

function SectionTitle({ eyebrow, title }) {
  return (
    <div className="mb-7">
      <p className="text-[var(--gold)] text-[10px] uppercase tracking-[0.3em] mb-2">{eyebrow}</p>
      <h3 className="font-heading text-2xl sm:text-3xl text-foreground">{title}</h3>
      <div className="hairline w-16 mt-4" />
    </div>
  );
}

function Card({ icon, title, text }) {
  return (
    <div className="rounded-sm border border-border bg-background p-6 sm:p-7 hover:border-[var(--wine)]/40 transition-colors duration-500">
      <div className="flex items-center gap-3 mb-4">
        <span className="w-10 h-10 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)]">{icon}</span>
        <h4 className="font-heading text-lg text-foreground">{title}</h4>
      </div>
      <p className="text-sm text-foreground/75 leading-relaxed">{text}</p>
    </div>
  );
}