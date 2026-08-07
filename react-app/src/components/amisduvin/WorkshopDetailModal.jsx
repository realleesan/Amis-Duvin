import { useEffect, useState } from "react";
import { X, Calendar, Clock, Coins, Users, ArrowRight } from "lucide-react";
import { Image } from "@/components/ui/image";
import { statusMeta } from "./workshopData";

/**
 * WorkshopDetailModal — popup chi tiết 1 workshop.
 * Banner ảnh + đầy đủ trường: học phí, sĩ số, số chỗ còn, trạng thái + CTA.
 */
export default function WorkshopDetailModal({ w, onClose, onRegister }) {
  const [closing, setClosing] = useState(false);
  const meta = statusMeta(w.status);
  const isFull = w.status === "full";

  useEffect(() => {
    document.body.style.overflow = "hidden";
    return () => { document.body.style.overflow = ""; };
  }, []);

  const closeWith = (action) => {
    setClosing(true);
    window.setTimeout(() => { document.body.style.overflow = ""; action(); }, 380);
  };

  return (
    <div className={`fixed inset-0 z-[100] flex items-center justify-center p-5 ${closing ? "animate-fade-out" : "animate-fade-in"}`} role="dialog" aria-modal="true">
      <div className="absolute inset-0 bg-black/60 backdrop-blur-md" onClick={() => closeWith(onClose)} />

      <div className="relative w-full max-w-lg animate-scale-in bg-card border border-border rounded-sm overflow-hidden shadow-[0_40px_80px_-30px_rgba(33,30,25,0.5)] max-h-[92vh] flex flex-col">
        <button onClick={() => closeWith(onClose)} className="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center text-white/80 hover:text-white rounded-full hover:bg-white/15 transition-colors" aria-label="Đóng">
          <X className="w-5 h-5" />
        </button>

        {/* Banner ảnh */}
        <div className="relative h-44 sm:h-52 shrink-0 overflow-hidden">
          <Image src={w.img} alt={w.name} className="w-full h-full" fittingType="fill" />
          <div className="absolute inset-0 bg-gradient-to-t from-card via-black/40 to-black/20" />
          <div className="absolute bottom-0 left-0 right-0 p-6 sm:p-7">
            <div className="flex items-center gap-3 mb-1.5">
              <span className="font-heading text-2xl text-gradient-gold">{w.no}</span>
              <span className={`inline-flex items-center text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm ${isFull ? "text-white/70 border-white/25 bg-white/10" : "text-emerald-300 border-emerald-400/40 bg-emerald-500/20"}`}>{meta.label}</span>
            </div>
            <h3 className="font-heading text-2xl sm:text-3xl text-white leading-tight drop-shadow-md">{w.name}</h3>
          </div>
        </div>

        {/* Nội dung cuộn */}
        <div className="p-7 sm:p-9 overflow-y-auto">
          <div className="grid sm:grid-cols-2 gap-4 mb-5">
            <Info icon={<Calendar className="w-4 h-4" />} label="Ngày" value={w.date} />
            <Info icon={<Clock className="w-4 h-4" />} label="Giờ" value={w.time} />
            <Info icon={<Coins className="w-4 h-4" />} label="Học phí dự kiến" value={w.tuition} />
            <Info icon={<Users className="w-4 h-4" />} label="Sĩ số lớp" value={`${w.minStudents} – ${w.maxStudents} HV`} />
          </div>

          {/* FOMO số chỗ còn */}
          <div className="flex items-center justify-between rounded-sm border border-border bg-background px-4 py-3.5 mb-6">
            <span className="text-xs uppercase tracking-wide text-foreground/60">Số chỗ còn nhận</span>
            {isFull ? (
              <span className="text-sm font-semibold text-muted-foreground">Đã đầy</span>
            ) : (
              <span className="text-base font-bold text-[var(--wine)]">Chỉ còn {w.slotsLeft} chỗ</span>
            )}
          </div>

          <p className="text-sm text-muted-foreground leading-relaxed mb-7">{w.desc}</p>

          <button
            onClick={() => closeWith(() => onRegister(w.id))}
            disabled={isFull}
            className={`w-full flex items-center justify-center gap-2 py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] transition-all duration-300 ${isFull ? "bg-muted text-muted-foreground cursor-not-allowed" : "btn-wine"}`}
          >
            {isFull ? "Đã kín chỗ" : "Đăng ký Workshop này"}
            {!isFull && <ArrowRight className="w-4 h-4" />}
          </button>
        </div>
      </div>
    </div>
  );
}

function Info({ icon, label, value }) {
  return (
    <div className="flex items-start gap-2.5">
      <span className="text-[var(--gold)] mt-0.5">{icon}</span>
      <div>
        <p className="text-[10px] uppercase tracking-wide text-muted-foreground">{label}</p>
        <p className="text-sm text-foreground font-medium">{value}</p>
      </div>
    </div>
  );
}