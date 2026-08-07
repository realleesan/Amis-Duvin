const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { ArrowRight } from "lucide-react";
import { Image } from "@/components/ui/image";
import Reveal from "./Reveal";

const SPACE = "https://media.db.com/images/public/6a623336361c483b3f15558c/4f49d4a8f_generated_image.png";
const LOGO = "https://media.db.com/images/public/6a623336361c483b3f15558c/0bde20e94_LogoAmisDuVins.png";

/**
 * BrandStory — Section "Giới thiệu Thương hiệu" (ngay dưới Sommelier).
 * Zig-zag đảo ngược: Chữ Trái - Ảnh Phải (Desktop) / 1 cột (Mobile).
 * CTA mở Modal Thương hiệu. Reveal nối tiếp animation sau khối Alex Thịnh.
 */
export default function BrandStory({ onOpenBrand }) {
  return (
    <section id="brand" className="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
      <div className="absolute inset-0 bg-wine-radial opacity-70" />
      <div className="relative max-w-7xl mx-auto px-5 sm:px-8">
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
          {/* Cột Chữ (trái Desktop) */}
          <Reveal>
            <div>
              <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-5">Hệ sinh thái DuVins — Huy Phong Group</p>
              <h2 className="font-heading text-4xl sm:text-5xl text-foreground mb-5 leading-tight">Amis du Vin — Trái tim trải nghiệm

              </h2>
              <div className="hairline w-20 mb-7" />
              <p className="text-base text-foreground/75 leading-relaxed mb-9 max-w-xl [font-family:'Archivo',_sans-serif] font-medium">Amis du Vin là thương hiệu trải nghiệm rượu vang thuộc hệ sinh thái du Vin, một thương hiệu bán lẻ của Huy Phong Group. Amis du Vin được định vị như một không gian trải nghiệm văn hóa vang - nơi ẩm thực, rượu vang và cảm xúc gặp nhau. Không chỉ đơn thuần là phòng thử rượu, đây là một nhà hàng nhỏ, ấm cúng, nơi khách hàng được hướng dẫn cách thưởng thức rượu vang, hiểu về nghệ thuật pairing giữa rượu và món ăn, rượu và âm nhạc, và tận hưởng trọn vẹn giá trị của “văn hóa vang” trong đời sống Việt. Nguồn gốc & cảm hứng Amis du Vin ra đời từ mong muốn của du Vin và Huy Phong Group: mang văn hóa rượu vang đến gần hơn với người Việt, giúp mọi người hiểu rằng thưởng thức vang không chỉ là thói quen, mà là một trải nghiệm nghệ thuật, tinh tế và nhân văn.

              </p>
              <button
                onClick={onOpenBrand}
                className="btn-ghost px-7 py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px] inline-flex items-center gap-2 group">
                
                Khám phá câu chuyện Amis DuVins
                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </Reveal>

          {/* Cột Ảnh (phải Desktop) */}
          <Reveal delay={200}>
            <div className="relative">
              <div className="absolute -inset-4 rounded-sm bg-[var(--wine)]/20 blur-3xl" />
              <div className="relative aspect-[4/5] overflow-hidden rounded-sm border border-border shadow-[0_30px_70px_-20px_rgba(178,2,37,0.45)]">
                <Image src={SPACE} alt="Không gian Amis DuVins" className="w-full h-full" fittingType="fill" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent" />

                {/* Logo Amis DuVins dạng chữ ký — góc trên ảnh */}
                <div className="absolute top-4 left-4 sm:top-5 sm:left-5">
                  <img src={LOGO} alt="Amis DuVins" className="h-10 sm:h-12 w-auto object-contain rounded-sm" />
                </div>

                {/* Chữ ký Brittany Signature */}
                <div className="absolute bottom-5 right-5 sm:bottom-6 sm:right-6">
                  <p className="font-signature text-3xl sm:text-4xl text-white/95 leading-none drop-shadow-md">Amis DuVins</p>
                </div>
              </div>
            </div>
          </Reveal>
        </div>
      </div>
    </section>);

}