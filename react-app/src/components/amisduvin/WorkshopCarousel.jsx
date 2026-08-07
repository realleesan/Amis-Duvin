import { useState, useRef } from "react";
import { ChevronLeft, ChevronRight, Coins } from "lucide-react";
import { Image } from "@/components/ui/image";
import { statusMeta } from "./workshopData";

/**
 * WorkshopCarousel — 3D coverflow (xoay vòng).
 * Thẻ active nổi bật (scale 1, opacity đầy), thẻ xung quanh chìm mờ + nghiêng.
 * Swipe/kéo + nút điều hướng. Click thẻ bên cạnh để đưa lên chính giữa.
 */
export default function WorkshopCarousel({ workshops, onRegister, onWaitlist }) {
  const [active, setActive] = useState(0);
  const startX = useRef(null);
  const n = workshops.length;

  const go = (dir) => setActive((a) => (a + dir + n) % n);

  const onDown = (e) => {
    startX.current = e.touches ? e.touches[0].clientX : e.clientX;
  };
  const onUp = (e) => {
    if (startX.current === null) return;
    const endX = e.changedTouches ? e.changedTouches[0].clientX : e.clientX;
    const dx = endX - startX.current;
    if (Math.abs(dx) > 50) go(dx > 0 ? -1 : 1);
    startX.current = null;
  };

  return (
    <div
      className="relative select-none"
      onMouseDown={onDown}
      onMouseUp={onUp}
      onTouchStart={onDown}
      onTouchEnd={onUp}
    >
      <div className="relative h-[440px] [perspective:1400px]">
        {workshops.map((w, i) => {
          let o = i - active;
          if (o > n / 2) o -= n;
          if (o < -n / 2) o += n;
          const abs = Math.abs(o);
          if (abs > 2) return null;

          const isActive = o === 0;
          const meta = statusMeta(w.status);
          const isFull = w.status === "full";

          return (
            <div
              key={w.id}
              className="absolute left-1/2 top-0 w-[260px] sm:w-[300px] h-full transition-all duration-500 ease-out [transform-style:preserve-3d]"
              style={{
                transform: `translateX(-50%) translateX(${o * 175}px) translateZ(${-abs * 150}px) rotateY(${o * -35}deg) scale(${isActive ? 1 : 0.82})`,
                opacity: isActive ? 1 : 0.4,
                zIndex: 10 - abs,
                pointerEvents: isActive ? "auto" : "none",
              }}
              onClick={() => !isActive && setActive(i)}
            >
              <CarouselCard w={w} meta={meta} isFull={isFull} onRegister={onRegister} onWaitlist={onWaitlist} />
            </div>
          );
        })}
      </div>

      <div className="flex items-center justify-center gap-4 mt-6">
        <button onClick={() => go(-1)} className="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-colors" aria-label="Trước">
          <ChevronLeft className="w-5 h-5" />
        </button>
        <span className="text-xs uppercase tracking-[0.2em] text-muted-foreground tabular-nums">{active + 1} / {n}</span>
        <button onClick={() => go(1)} className="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/70 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-colors" aria-label="Sau">
          <ChevronRight className="w-5 h-5" />
        </button>
      </div>
    </div>
  );
}

function CarouselCard({ w, meta, isFull, onRegister, onWaitlist }) {
  return (
    <div className="relative w-full h-full rounded-sm border border-border overflow-hidden bg-card flex flex-col shadow-[0_24px_60px_-25px_rgba(33,30,25,0.4)]">
      <div className="relative h-40 overflow-hidden shrink-0">
        <Image src={w.img} alt={w.name} className="w-full h-full" fittingType="fill" />
        <div className="absolute inset-0 bg-gradient-to-t from-card via-black/40 to-transparent" />
        <span className="absolute top-3 left-3 font-heading text-2xl text-gradient-gold">{w.no}</span>
        <span className={`absolute top-3 right-3 inline-flex items-center text-[9px] uppercase tracking-[0.15em] px-2 py-0.5 rounded-full border backdrop-blur-sm ${isFull ? "text-white/70 border-white/25 bg-white/10" : "text-emerald-300 border-emerald-400/40 bg-emerald-500/20"}`}>
          {meta.label}
        </span>
      </div>

      <div className="p-5 flex flex-col flex-1">
        <h3 className="font-heading text-lg text-foreground mb-1.5 leading-tight">{w.name}</h3>
        <p className="text-xs text-muted-foreground mb-3">{w.date}{w.time ? ` · ${w.time}` : ""}</p>

        <div className="flex items-center gap-1.5 text-xs text-foreground/70 mb-2">
          <Coins className="w-3.5 h-3.5 text-[var(--gold)]" /> {w.tuition}
        </div>
        {!isFull && <p className="text-xs font-semibold text-[var(--wine)] mb-3">Chỉ còn {w.slotsLeft} chỗ</p>}

        <div className="flex-1" />

        <button
          onClick={(e) => { e.stopPropagation(); if (isFull) onWaitlist(w); else onRegister(w.id); }}
          className={`w-full py-3 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[44px] ${isFull ? "btn-ghost" : "btn-invert"}`}
        >
          {isFull ? "Giữ chỗ cho lần tới" : "Giữ chỗ"}
        </button>
      </div>
    </div>
  );
}