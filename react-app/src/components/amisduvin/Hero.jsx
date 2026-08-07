const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { ChevronDown } from "lucide-react";
import { Image } from "@/components/ui/image";
import Reveal from "./Reveal";

const HERO_IMG = "https://media.db.com/images/public/6a623336361c483b3f15558c/1d3f75363_generated_b7d85214.png";

/**
 * Hero — ảnh nền không gian fine dining tối ấm, headline + CTA chính.
 */
export default function Hero({ onExplore }) {
  return (
    <section id="hero" className="relative min-h-screen flex items-center overflow-hidden">
      {/* Ảnh nền */}
      <div className="absolute inset-0">
        <Image
          src={HERO_IMG}
          alt="Không gian fine dining ấm áp với rượu vang và ánh nến"
          className="absolute inset-0 w-full h-full"
          fittingType="fill"
        />
        <div className="absolute inset-0 bg-gradient-to-b from-black/75 via-black/45 to-background" />
        <div className="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent" />
      </div>

      {/* Nội dung */}
      <div className="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 w-full pt-28 pb-20">
        <Reveal>
          <p className="text-[var(--gold)] text-xs sm:text-sm uppercase tracking-[0.4em] mb-6">
            Rượu vang &amp; những người bạn
          </p>
        </Reveal>
        <Reveal delay={150}>
          <h1 className="font-heading text-4xl sm:text-6xl lg:text-7xl text-white leading-[1.05] max-w-4xl mb-7">
            Không gian Tiệc riêng tư
            <span className="block text-2xl sm:text-3xl lg:text-4xl font-serif-display italic font-normal text-white/90 mt-4">
              & Tinh hoa ẩm thực Rượu vang
            </span>
          </h1>
        </Reveal>
        <Reveal delay={300}>
          <p className="text-base sm:text-lg text-white/70 max-w-xl mb-10 leading-relaxed">
            Trải nghiệm tiệc riêng tư kết hợp ẩm thực và rượu vang tinh tế, trọn vẹn văn hoá vang tại Hà Nội.
          </p>
        </Reveal>
        <Reveal delay={450}>
          <div className="flex flex-col sm:flex-row gap-4">
            <button
              onClick={onExplore}
              className="btn-invert px-8 py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px]"
            >
              Đặt tiệc ngay
            </button>
          </div>
        </Reveal>
      </div>

      {/* Cuộn xuống */}
      <button
        onClick={() => document.getElementById("about")?.scrollIntoView({ behavior: "smooth" })}
        className="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-white/50 hover:text-white transition-colors"
        aria-label="Cuộn xuống"
      >
        <span className="text-[10px] uppercase tracking-[0.3em]">Cuộn xuống</span>
        <ChevronDown className="w-5 h-5 animate-bounce" />
      </button>
    </section>
  );
}