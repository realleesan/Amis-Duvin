const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { ArrowRight } from "lucide-react";
import { Image } from "@/components/ui/image";
import Reveal from "./Reveal";

const PORTRAIT = "https://media.db.com/images/public/6a623336361c483b3f15558c/1a9505e2b_image.png";

/**
 * Sommelier — Khối tóm tắt nhân hiệu (Section 3).
 * Ảnh chân dung hero + heading + CTA mở Modal Deep-dive.
 */
export default function Sommelier({ onOpenProfile }) {
  return (
    <section id="sommelier" className="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
      <div className="absolute inset-0 bg-wine-radial opacity-70" />
      <div className="relative max-w-7xl mx-auto px-5 sm:px-8">
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
          {/* Ảnh chân dung — bo góc, shadow đỏ vang */}
          <Reveal>
            <div className="relative">
              <div className="absolute -inset-4 rounded-sm bg-[var(--wine)]/20 blur-3xl" />
              <div className="relative aspect-[4/5] overflow-hidden rounded-sm border border-border shadow-[0_30px_70px_-20px_rgba(182,32,37,0.45)]">
                <Image
                  src={PORTRAIT}
                  alt="Sommelier Alex Thịnh"
                  className="w-full h-full"
                  fittingType="fill"
                  focalPointX={0.5}
                  focalPointY={0.45} />
                
                <div className="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent" />
              </div>
            </div>
          </Reveal>

          {/* Nội dung */}
          <Reveal delay={200}>
            <div>
              <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-5">Sommelier</p>
              <p className="font-serif-display italic text-lg sm:text-xl text-foreground/60 mb-2">
                Chuyên gia Rượu vang &amp; Nghệ thuật Ngoại giao
              </p>
              <h2 className="font-heading text-4xl sm:text-5xl text-foreground mb-5">
                Sommelier Alex Thịnh
              </h2>
              <div className="hairline w-20 mb-7" />
              <p className="text-base text-foreground/75 leading-relaxed mb-9 max-w-xl [font-family:'Archivo',_sans-serif]">Người dẫn dắt những câu chuyện tinh hoa trên bàn tiệc. Với nhiều năm kinh nghiệm phục vụ giới doanh nhân và CEO, Alex Thịnh không chỉ mang đến kiến thức uyên thâm về vang, mà còn nâng tầm nghệ thuật giao tiếp và phong cách sống đẳng cấp.

              </p>
              <button
                onClick={onOpenProfile}
                className="btn-invert px-7 py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px] inline-flex items-center gap-2 group">
                
                Khám phá hành trình của Alex Thịnh
                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </Reveal>
        </div>
      </div>
    </section>);

}