import { useEffect, useState } from "react";
import { Wine, X, BookOpen, MapPin } from "lucide-react";

const MAPS_URL = "https://www.google.com/maps/search/?api=1&query=58B+V%C3%B5+V%C4%83n+D%C5%A9ng,+%C4%90%E1%BB%91ng+%C4%90a,+H%C3%A0+N%E1%BB%99i";
const SOURCES = ["Facebook", "Bạn bè giới thiệu", "Instagram", "Zalo", "Google", "Khác"];

/**
 * SuccessPopup — cảm ơn sau khi đặt tiệc.
 * Thông tin giữ chỗ + quy trình; dropdown "Bạn biết đến từ đâu"; CTA hướng dẫn.
 */
export default function SuccessPopup({ onGuide, onDismiss }) {
  const [closing, setClosing] = useState(false);
  const [source, setSource] = useState("");

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
      <div className="absolute inset-0 bg-black/55 backdrop-blur-md" onClick={() => closeWith(onDismiss)} />
      <div className="relative w-full max-w-md text-center animate-scale-in bg-card border border-border rounded-sm px-7 py-10 sm:px-10 sm:py-12 shadow-[0_40px_80px_-30px_rgba(33,30,25,0.4)]">
        <button onClick={() => closeWith(onDismiss)} className="absolute top-4 right-4 w-9 h-9 flex items-center justify-center text-foreground/40 hover:text-foreground transition-colors" aria-label="Đóng"><X className="w-5 h-5" /></button>

        <div className="flex justify-center mb-6">
          <div className="w-16 h-16 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center"><Wine className="w-7 h-7 text-[var(--wine)]" strokeWidth={1.3} /></div>
        </div>

        <p className="text-[var(--gold)] text-xs uppercase tracking-[0.3em] mb-4">Đăng ký thành công</p>
        <h3 className="font-heading text-2xl sm:text-3xl text-foreground mb-4 leading-snug">Cảm ơn Quý khách!</h3>

        <div className="text-left rounded-sm border border-border bg-background px-5 py-4 mb-6">
          <p className="text-sm text-foreground/80 leading-relaxed mb-2">
            Chúng tôi sẽ <strong>giữ chỗ cho Quý khách trong 48 giờ</strong>. Đội ngũ CSKH liên hệ xác nhận qua Zalo/SĐT trong vòng <strong>2 giờ làm việc</strong>.
          </p>
          <p className="text-xs text-muted-foreground leading-relaxed">Quy trình: Xác nhận → Chốt thực đơn &amp; vang với Sommelier → Đặt cọc giữ chỗ → Tận hưởng tiệc.</p>
        </div>

        {/* Dropdown nguồn — thu data sau chuyển đổi */}
        <div className="text-left mb-7">
          <label className="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Bạn biết đến chúng tôi từ đâu?</label>
          <select value={source} onChange={(e) => setSource(e.target.value)} className="input-elegant w-full px-4 py-3.5 rounded-sm text-sm cursor-pointer">
            <option value="" disabled>Chọn nguồn</option>
            {SOURCES.map((s) => <option key={s} value={s} className="bg-card text-foreground">{s}</option>)}
          </select>
        </div>

        <div className="space-y-3">
          <button onClick={() => closeWith(onGuide)} className="btn-invert w-full py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px] flex items-center justify-center gap-2"><BookOpen className="w-4 h-4" /> Xem hướng dẫn chi tiết</button>
          <a href={MAPS_URL} target="_blank" rel="noopener noreferrer" className="btn-ghost w-full py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px] flex items-center justify-center gap-2"><MapPin className="w-4 h-4" /> Xem địa điểm</a>
          <button onClick={() => closeWith(onDismiss)} className="w-full py-3 text-xs uppercase tracking-[0.18em] text-foreground/45 hover:text-foreground/80 transition-colors min-h-[44px]">Đóng</button>
        </div>
      </div>
    </div>
  );
}