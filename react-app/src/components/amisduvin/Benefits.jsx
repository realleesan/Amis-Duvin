import { Wine, Users, Sparkles } from "lucide-react";
import Reveal from "./Reveal";

const BENEFITS = [
  {
    icon: Wine,
    title: "Hiểu vang dễ dàng",
    desc: "Kiến thức rượu vang được truyền đạt gần gũi, thực tế — ai cũng tự tin thưởng thức và chọn vang cho mọi dịp.",
  },
  {
    icon: Users,
    title: "Trải nghiệm cùng chuyên gia",
    desc: "Được dẫn dắt trực tiếp bởi Sommelier Alex Thịnh với hơn 24 năm kinh nghiệm tại các nhà hàng, khách sạn 5 sao.",
  },
  {
    icon: Sparkles,
    title: "Kết nối trong không gian thân mật",
    desc: "Không gian nhỏ, ấm cúng — nơi mỗi buổi tiệc trở thành câu chuyện kết nối giữa người, vang và ẩm thực.",
  },
];

/**
 * Benefits — Giới thiệu Amis du Vin (lợi ích cốt lõi) + bảo chứng công ty mẹ.
 */
export default function Benefits() {
  return (
    <section id="about" className="scroll-anchor relative py-24 sm:py-28 bg-background overflow-hidden">
      <div className="absolute inset-0 bg-wine-radial opacity-60" />
      <div className="relative max-w-7xl mx-auto px-5 sm:px-8">
        <Reveal>
          <div className="text-center max-w-2xl mx-auto mb-14">
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Về Amis du Vin</p>
            <h2 className="font-heading text-3xl sm:text-5xl text-foreground mb-5">Lợi ích cốt lõi</h2>
          </div>
        </Reveal>

        <div className="grid md:grid-cols-3 gap-6 lg:gap-8">
          {BENEFITS.map((b, i) => (
            <Reveal key={b.title} delay={i * 120}>
              <div className="card-lift h-full rounded-sm border border-border bg-card p-8 text-center">
                <div className="w-14 h-14 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center mx-auto mb-6 text-[var(--wine)]">
                  <b.icon className="w-6 h-6" strokeWidth={1.5} />
                </div>
                <h3 className="font-heading text-xl text-foreground mb-3">{b.title}</h3>
                <p className="text-sm text-muted-foreground leading-relaxed">{b.desc}</p>
              </div>
            </Reveal>
          ))}
        </div>

        <Reveal delay={200}>
          <div className="flex items-center justify-center gap-4 mt-12">
            <span className="hairline w-12" />
            <p className="text-center text-xs sm:text-sm uppercase tracking-[0.2em] text-foreground/55">
              Amis du Vin — Một thương hiệu thuộc hệ sinh thái Vang Huy Phong
            </p>
            <span className="hairline w-12" />
          </div>
        </Reveal>
      </div>
    </section>
  );
}