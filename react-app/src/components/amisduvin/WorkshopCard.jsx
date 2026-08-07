import { useState } from "react";
import { Calendar, Clock, Users, RotateCw, ArrowRight, Coins } from "lucide-react";
import { Image } from "@/components/ui/image";
import { statusMeta } from "./workshopData";

/**
 * WorkshopCard — thẻ 3D Flip (click / chạm để lật).
 * Mặt trước: ảnh nền + overlay tối, tên, ngày giờ, badge, CTA (zoom nhẹ khi hover).
 * Mặt sau: học phí, sĩ số, số chỗ còn (FOMO), trạng thái, CTA + xem chi tiết.
 */
export default function WorkshopCard({ w, onRegister, onDetail, onWaitlist }) {
  const [flipped, setFlipped] = useState(false);
  const meta = statusMeta(w.status);
  const isFull = w.status === "full";

  // Badge trên mặt trước luôn sáng (nền ảnh tối)
  const frontBadge = isFull
    ? "text-white/70 border-white/25 bg-white/10"
    : "text-emerald-300 border-emerald-400/40 bg-emerald-500/20";

  return (
    <div className="group [perspective:1400px] h-[460px] transition-shadow duration-500 hover:shadow-[0_24px_50px_-22px_rgba(33,30,25,0.3)]">
      <div
        className={`relative w-full h-full transition-transform duration-700 [transform-style:preserve-3d] ${flipped ? "[transform:rotateY(180deg)]" : ""}`}
        onClick={() => setFlipped((f) => !f)}
        role="button"
        tabIndex={0}
      >
        {/* ============ MẶT TRƯỚC — ảnh nền ============ */}
        <div className="absolute inset-0 [backface-visibility:hidden] rounded-sm border border-border overflow-hidden cursor-pointer">
          <Image src={w.img} alt={w.name} className="absolute inset-0 w-full h-full transition-transform duration-[1.2s] group-hover:scale-105" fittingType="fill" />
          {/* Lớp phủ tối giữ độ tương phản chữ */}
          <div className="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/25" />

          <div className="relative h-full p-6 sm:p-7 flex flex-col text-white">
            <div className="flex items-start justify-between mb-5">
              <span className="font-heading text-3xl text-gradient-gold">{w.no}</span>
              <span className={`inline-flex items-center gap-1.5 text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm ${frontBadge}`}>
                <span className="w-1.5 h-1.5 rounded-full bg-current" />
                {meta.label}
              </span>
            </div>

            <h3 className="font-heading text-xl text-white mb-4 leading-tight min-h-[3.5rem] drop-shadow-md">{w.name}</h3>

            <div className="space-y-2 mb-4">
              <div className="flex items-center gap-2 text-xs text-white/80">
                <Calendar className="w-3.5 h-3.5 text-[var(--gold)] shrink-0" /><span>{w.date}</span>
              </div>
              <div className="flex items-center gap-2 text-xs text-white/80">
                <Clock className="w-3.5 h-3.5 text-[var(--gold)] shrink-0" /><span>{w.time}</span>
              </div>
            </div>

            <div className="flex-1" />

            <div className="flex items-center gap-1.5 text-[11px] text-white/60 mb-4">
              <RotateCw className="w-3 h-3" /> Chạm để xem chi tiết
            </div>

            <button
              onClick={(e) => { e.stopPropagation(); isFull ? onWaitlist?.(w) : onRegister(w.id); }}
              className={`w-full flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] transition-all duration-300 ${isFull ? "bg-white/15 text-white/80 backdrop-blur-sm hover:bg-white/25" : "btn-invert"}`}
            >
              {isFull ? "Giữ chỗ cho lần tới" : "Giữ chỗ"}
              {!isFull && <ArrowRight className="w-3.5 h-3.5" />}
            </button>
          </div>
        </div>

        {/* ============ MẶT SAU ============ */}
        <div className="absolute inset-0 [backface-visibility:hidden] [transform:rotateY(180deg)] rounded-sm border border-[var(--wine)]/30 bg-background p-6 sm:p-7 flex flex-col">
          <div className="flex items-center justify-between mb-5">
            <p className="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)]">Thông tin Workshop</p>
            <span className={`inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border ${meta.cls}`}>{meta.label}</span>
          </div>

          <h3 className="font-heading text-lg text-foreground mb-5 leading-tight">{w.name}</h3>

          <div className="space-y-3.5 text-sm flex-1">
            <Row icon={<Coins className="w-4 h-4" />} label="Học phí dự kiến" value={w.tuition} />
            <Row icon={<Users className="w-4 h-4" />} label="Sĩ số lớp" value={`${w.minStudents} – ${w.maxStudents} học viên`} />
            <div className="flex items-center justify-between border-t border-border pt-3.5">
              <span className="flex items-center gap-2 text-foreground/60 text-xs uppercase tracking-wide">
                <Users className="w-4 h-4" /> Số chỗ còn nhận
              </span>
              {isFull ? (
                <span className="text-sm font-semibold text-muted-foreground">Đã đầy</span>
              ) : (
                <span className="text-sm font-bold text-[var(--wine)] animate-pulse">Chỉ còn {w.slotsLeft} chỗ</span>
              )}
            </div>
          </div>

          <div className="flex flex-col gap-2.5 mt-5">
            <button
              onClick={(e) => { e.stopPropagation(); isFull ? onWaitlist?.(w) : onRegister(w.id); }}
              className={`w-full flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] transition-all duration-300 ${isFull ? "btn-ghost" : "btn-invert"}`}
            >
              {isFull ? "Giữ chỗ cho lần tới" : "Giữ chỗ"}
            </button>
            <button
              onClick={(e) => { e.stopPropagation(); onDetail(w); }}
              className="btn-ghost w-full flex items-center justify-center gap-2 py-3 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[44px]"
            >
              Xem chi tiết
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

function Row({ icon, label, value }) {
  return (
    <div className="flex items-center justify-between">
      <span className="flex items-center gap-2 text-foreground/60 text-xs uppercase tracking-wide">{icon}{label}</span>
      <span className="text-sm text-foreground font-medium text-right">{value}</span>
    </div>
  );
}