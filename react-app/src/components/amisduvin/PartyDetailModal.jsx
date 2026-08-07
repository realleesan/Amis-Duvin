import { useEffect, useState } from "react";
import { X, Phone, MessageCircle, CalendarCheck, Coins, Clock, Users } from "lucide-react";
import { Image } from "@/components/ui/image";

const ZALO_URL = "https://zalo.me/0901234567";
const HOTLINE = "0901234567";

/**
 * PartyDetailModal — chi tiết gói Food & Wine Pairing.
 * Banner + thực đơn/món/vang + 3 CTA (Đặt tiệc, Zalo, Hotline).
 */
export default function PartyDetailModal({ pkg, onClose, onBook }) {
  const [closing, setClosing] = useState(false);
  const premium = pkg.level === "Premium";

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

        <div className="relative h-44 sm:h-52 shrink-0 overflow-hidden">
          <Image src={pkg.img} alt={pkg.name} className="w-full h-full" fittingType="fill" />
          <div className="absolute inset-0 bg-gradient-to-t from-card via-black/40 to-black/20" />
          <div className="absolute bottom-0 left-0 right-0 p-6 sm:p-7">
            <span className={`inline-block text-[10px] uppercase tracking-[0.15em] px-2.5 py-1 rounded-full border backdrop-blur-sm mb-2 ${premium ? "text-[var(--gold)] border-[var(--gold)]/40 bg-[var(--gold)]/15" : "text-white/80 border-white/25 bg-white/10"}`}>
              {premium ? "Premium Level" : "Standard Level"}
            </span>
            <h3 className="font-heading text-2xl sm:text-3xl text-white leading-tight drop-shadow-md">{pkg.name}</h3>
          </div>
        </div>

        <div className="p-7 sm:p-9 overflow-y-auto">
          <p className="text-sm text-muted-foreground leading-relaxed mb-6">{pkg.desc}</p>

          <div className="grid grid-cols-3 gap-3 mb-6">
            <Info icon={<Coins className="w-3.5 h-3.5" />} label="Chi phí dự kiến" value={pkg.price} />
            <Info icon={<Clock className="w-3.5 h-3.5" />} label="Thời lượng" value={pkg.duration} />
            <Info icon={<Users className="w-3.5 h-3.5" />} label="Sức chứa" value={pkg.pax} />
          </div>

          <h4 className="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-3">Thực đơn & Rượu vang</h4>
          <ul className="space-y-2.5 mb-7">
            {pkg.menu.map((m, i) => (
              <li key={i} className="flex items-start justify-between gap-3 text-sm border-b border-border pb-2.5 last:border-0">
                <span className="text-foreground/85">{m.dish}</span>
                <span className="text-[var(--wine)] font-medium text-right shrink-0 max-w-[45%]">{m.wine}</span>
              </li>
            ))}
          </ul>

          <div className="space-y-2.5">
            <button
              onClick={() => closeWith(() => onBook())}
              className="btn-invert w-full flex items-center justify-center gap-2 py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px]"
            >
              <CalendarCheck className="w-4 h-4" /> Đặt tiệc ngay!
            </button>
            <div className="grid grid-cols-2 gap-2.5">
              <a href={ZALO_URL} target="_blank" rel="noopener noreferrer" className="btn-ghost flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[48px]">
                <MessageCircle className="w-4 h-4" /> Tư vấn Zalo
              </a>
              <a href={`tel:${HOTLINE}`} className="btn-ghost flex items-center justify-center gap-2 py-3.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[48px]">
                <Phone className="w-4 h-4" /> Hotline
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

function Info({ icon, label, value }) {
  return (
    <div className="rounded-sm border border-border bg-background px-3 py-3 text-center">
      <span className="text-[var(--gold)] flex justify-center mb-1">{icon}</span>
      <p className="text-[9px] uppercase tracking-wide text-muted-foreground mb-0.5">{label}</p>
      <p className="text-xs sm:text-sm text-foreground font-medium leading-tight">{value}</p>
    </div>
  );
}