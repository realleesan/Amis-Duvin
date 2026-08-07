import { useEffect, useState } from "react";
import { X, Mail, Phone, Loader2, Check } from "lucide-react";

const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const PHONE_RE = /^0\d{9}$/;

/**
 * WaitlistModal — "Giữ chỗ cho lần tới" (workshop đã kín).
 * Thu email + SĐT, mock submit thành công.
 */
export default function WaitlistModal({ workshopName, onClose }) {
  const [form, setForm] = useState({ email: "", phone: "" });
  const [submitting, setSubmitting] = useState(false);
  const [done, setDone] = useState(false);

  useEffect(() => {
    document.body.style.overflow = "hidden";
    return () => { document.body.style.overflow = ""; };
  }, []);

  const valid = EMAIL_RE.test(form.email.trim()) && PHONE_RE.test(form.phone.trim());

  const submit = (e) => {
    e.preventDefault();
    if (!valid || submitting) return;
    setSubmitting(true);
    window.setTimeout(() => {
      setSubmitting(false);
      setDone(true);
    }, 1500);
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-5 animate-fade-in" role="dialog" aria-modal="true">
      <div className="absolute inset-0 bg-black/60 backdrop-blur-md" onClick={onClose} />
      <div className="relative w-full max-w-sm animate-scale-in bg-card border border-border rounded-sm p-7 sm:p-8 text-center shadow-[0_40px_80px_-30px_rgba(33,30,25,0.5)]">
        <button onClick={onClose} className="absolute top-4 right-4 w-9 h-9 flex items-center justify-center text-foreground/40 hover:text-foreground transition-colors" aria-label="Đóng">
          <X className="w-5 h-5" />
        </button>

        {done ? (
          <>
            <div className="w-14 h-14 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center mx-auto mb-5">
              <Check className="w-6 h-6 text-[var(--wine)]" />
            </div>
            <h3 className="font-heading text-xl text-foreground mb-2">Đã ghi nhận!</h3>
            <p className="text-sm text-muted-foreground mb-6">Chúng tôi sẽ thông báo sớm khi <strong>{workshopName}</strong> mở chỗ mới.</p>
            <button onClick={onClose} className="btn-ghost w-full py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px]">Đóng</button>
          </>
        ) : (
          <>
            <h3 className="font-heading text-xl text-foreground mb-2">Giữ chỗ cho lần tới</h3>
            <p className="text-sm text-muted-foreground mb-6"><strong>{workshopName}</strong> hiện đã kín. Để lại thông tin, chúng tôi sẽ liên hệ khi có lịch mới.</p>
            <form onSubmit={submit} className="space-y-4 text-left">
              <div className="relative">
                <Mail className="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground" />
                <input type="email" value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} placeholder="Email của bạn" className="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autoComplete="email" />
              </div>
              <div className="relative">
                <Phone className="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground" />
                <input type="tel" inputMode="numeric" maxLength={10} value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} placeholder="Số điện thoại" className="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autoComplete="tel" />
              </div>
              <button type="submit" disabled={!valid || submitting} className="btn-invert w-full py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] flex items-center justify-center gap-2">
                {submitting ? (<><Loader2 className="w-4 h-4 spin-wine" /> Đang gửi...</>) : "Lưu thông tin"}
              </button>
              <div className="relative my-1 pt-2">
                <div className="hairline" />
                <span className="absolute left-1/2 -translate-x-1/2 -top-2.5 bg-card px-3 text-[10px] uppercase tracking-[0.2em] text-muted-foreground">hoặc</span>
              </div>
              <a href="tel:0919686540" className="btn-ghost w-full py-3.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium min-h-[48px] flex items-center justify-center gap-2">
                <Phone className="w-4 h-4" /> Liên hệ Sales — 091 968 65 40
              </a>
            </form>
          </>
        )}
      </div>
    </div>
  );
}