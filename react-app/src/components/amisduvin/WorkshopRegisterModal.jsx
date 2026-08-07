import { useState, useRef, useCallback, useEffect } from "react";
import { User, Phone, Mail, X, Loader2, ShieldAlert, Calendar, Clock, Coins, Check } from "lucide-react";
import { Image } from "@/components/ui/image";
import { WORKSHOPS } from "./workshopData";

const PHONE_RE = /^0\d{9}$/;
const EMAIL_RE = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const SPAM_THRESHOLD = 5;
const SPAM_WINDOW = 3000;
const LOCK_DURATION = 5000;

/**
 * WorkshopRegisterModal — form "Giữ chỗ Workshop" tách biệt.
 * - Tự điền workshop khách vừa bấm "Giữ chỗ" (chỉ hiển thị, không cho chọn lại).
 * - Trường: Họ tên, SĐT, Email.
 * - Phần "Đặt chỗ thêm workshop khác" — checkbox các buổi còn chỗ khác.
 * - Đồng bộ thiết kế + anti-spam với form đặt tiệc.
 */
export default function WorkshopRegisterModal({ workshop, onClose, onSuccess }) {
  const [form, setForm] = useState({ name: "", phone: "", email: "" });
  const [extra, setExtra] = useState([]);
  const [submitting, setSubmitting] = useState(false);
  const [spamLocked, setSpamLocked] = useState(false);
  const [closing, setClosing] = useState(false);
  const clickTimes = useRef([]);

  useEffect(() => {
    document.body.style.overflow = "hidden";
    return () => { document.body.style.overflow = ""; };
  }, []);

  const handleClose = useCallback(() => {
    setClosing(true);
    window.setTimeout(onClose, 380);
  }, [onClose]);

  useEffect(() => {
    const onKey = (e) => { if (e.key === "Escape") handleClose(); };
    window.addEventListener("keydown", onKey);
    return () => window.removeEventListener("keydown", onKey);
  }, [handleClose]);

  const others = WORKSHOPS.filter((w) => w.id !== workshop.id && w.status === "open");

  const errors = {
    name: form.name.trim().length >= 2 ? "" : "Vui lòng nhập họ tên (tối thiểu 2 ký tự)",
    phone: PHONE_RE.test(form.phone.trim()) ? "" : "Số điện thoại phải đúng 10 số (bắt đầu bằng 0)",
    email: EMAIL_RE.test(form.email.trim()) ? "" : "Email không hợp lệ",
  };
  const isValid = !Object.values(errors).some((e) => e);

  const handleChange = (field) => (e) => setForm((f) => ({ ...f, [field]: e.target.value }));
  const toggleExtra = (id) => setExtra((prev) => (prev.includes(id) ? prev.filter((x) => x !== id) : [...prev, id]));

  const handleSubmit = useCallback(
    async (e) => {
      e.preventDefault();
      if (submitting || spamLocked) return;
      if (!isValid) return;

      const now = Date.now();
      clickTimes.current = clickTimes.current.filter((t) => now - t < SPAM_WINDOW);
      clickTimes.current.push(now);
      if (clickTimes.current.length > SPAM_THRESHOLD) {
        setSpamLocked(true);
        clickTimes.current = [];
        window.setTimeout(() => setSpamLocked(false), LOCK_DURATION);
        return;
      }

      setSubmitting(true);
      window.setTimeout(() => {
        setSubmitting(false);
        setForm({ name: "", phone: "", email: "" });
        setExtra([]);
        onSuccess({ workshop, extra });
      }, 2000);
    },
    [isValid, submitting, spamLocked, onSuccess, workshop, extra]
  );

  return (
    <div className="fixed inset-0 z-[60] flex items-center justify-center p-4 sm:p-6">
      <div className={`absolute inset-0 bg-black/70 ${closing ? "animate-fade-out" : "animate-fade-in"}`} onClick={handleClose} />

      <div className={`relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-card border border-border rounded-sm shadow-2xl ${closing ? "animate-fade-out" : "animate-scale-in"}`}>
        {/* Header */}
        <div className="sticky top-0 z-10 glass px-6 sm:px-8 py-5 flex items-center justify-between border-b border-border">
          <div>
            <p className="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-1">Giữ chỗ Workshop</p>
            <h3 className="font-heading text-lg text-foreground">Đăng ký tham gia</h3>
          </div>
          <button onClick={handleClose} className="w-10 h-10 flex items-center justify-center text-muted-foreground hover:text-foreground rounded-full hover:bg-muted transition-colors" aria-label="Đóng">
            <X className="w-5 h-5" />
          </button>
        </div>

        <form onSubmit={handleSubmit} className="p-6 sm:p-8" noValidate>
          {/* Workshop đã chọn (tự điền, chỉ hiển thị) */}
          <p className="text-[10px] uppercase tracking-[0.18em] text-foreground/50 mb-3">Workshop bạn chọn</p>
          <div className="flex gap-4 rounded-sm border border-[var(--wine)]/30 bg-[var(--wine)]/5 p-4 mb-6">
            <Image src={workshop.img} alt={workshop.name} className="w-20 h-20 rounded-sm shrink-0" fittingType="fill" />
            <div className="min-w-0">
              <h4 className="font-heading text-base text-foreground leading-tight mb-2">{workshop.name}</h4>
              <div className="space-y-1 text-xs text-muted-foreground">
                <p className="flex items-center gap-1.5"><Calendar className="w-3 h-3 text-[var(--gold)]" />{workshop.date}</p>
                <p className="flex items-center gap-1.5"><Clock className="w-3 h-3 text-[var(--gold)]" />{workshop.time}</p>
                <p className="flex items-center gap-1.5"><Coins className="w-3 h-3 text-[var(--gold)]" />{workshop.tuition}</p>
              </div>
            </div>
          </div>

          {/* Trường nhập */}
          <Field icon={<User className="w-4 h-4" />} label="Họ và tên" error={errors.name} touched={form.name.length > 0}>
            <input type="text" value={form.name} onChange={handleChange("name")} placeholder="Nguyễn Văn An" className="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autoComplete="name" autoFocus />
          </Field>

          <div className="grid sm:grid-cols-2 gap-4">
            <Field icon={<Phone className="w-4 h-4" />} label="Số điện thoại" error={errors.phone} touched={form.phone.length > 0}>
              <input type="tel" inputMode="numeric" value={form.phone} onChange={handleChange("phone")} placeholder="0912345678" maxLength={10} className="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autoComplete="tel" />
            </Field>
            <Field icon={<Mail className="w-4 h-4" />} label="Email" error={errors.email} touched={form.email.length > 0}>
              <input type="email" value={form.email} onChange={handleChange("email")} placeholder="an@email.com" className="input-elegant w-full bg-transparent pl-11 pr-4 py-3.5 rounded-sm text-sm" autoComplete="email" />
            </Field>
          </div>

          {/* Đặt chỗ thêm workshop khác */}
          {others.length > 0 && (
            <div className="mb-6">
              <p className="text-[10px] uppercase tracking-[0.18em] text-foreground/50 mb-3">Đặt chỗ thêm workshop khác (tuỳ chọn)</p>
              <div className="space-y-2">
                {others.map((w) => {
                  const checked = extra.includes(w.id);
                  return (
                    <label key={w.id} className={`flex items-center gap-3 rounded-sm border px-3.5 py-3 cursor-pointer transition-colors ${checked ? "border-[var(--wine)] bg-[var(--wine)]/5" : "border-border hover:border-[var(--wine)]/40"}`}>
                      <span className={`w-5 h-5 rounded border flex items-center justify-center shrink-0 transition-colors ${checked ? "bg-[var(--wine)] border-[var(--wine)]" : "border-border"}`}>
                        {checked && <Check className="w-3.5 h-3.5 text-white" />}
                      </span>
                      <input type="checkbox" checked={checked} onChange={() => toggleExtra(w.id)} className="sr-only" />
                      <div className="min-w-0 flex-1">
                        <p className="text-sm text-foreground truncate">{w.name}</p>
                        <p className="text-[11px] text-muted-foreground">{w.date} · {w.tuition}</p>
                      </div>
                    </label>
                  );
                })}
              </div>
            </div>
          )}

          {spamLocked && (
            <div className="flex items-center gap-3 bg-[var(--destructive)]/8 border border-[var(--destructive)]/25 rounded-sm px-4 py-3.5 mb-5 animate-fade-in">
              <ShieldAlert className="w-5 h-5 text-[var(--destructive)] shrink-0" />
              <p className="text-xs text-[var(--destructive)]">Hệ thống phát hiện bất thường, vui lòng xác thực bạn là người thật để tiếp tục.</p>
            </div>
          )}

          <button type="submit" disabled={!isValid || submitting || spamLocked} className="btn-invert w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2">
            {submitting ? (<><Loader2 className="w-4 h-4 spin-wine" /> Đang gửi...</>) : ("Giữ chỗ")}
          </button>

          <p className="text-center text-[11px] text-muted-foreground mt-4">Thông tin của bạn được bảo mật tuyệt đối theo chính sách của Amis du Vin.</p>
        </form>
      </div>
    </div>
  );
}

function Field({ icon, label, error, touched, children }) {
  return (
    <div className="mb-4">
      <label className="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">{label}</label>
      <div className="relative">
        <span className="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">{icon}</span>
        {children}
      </div>
      {touched && error && <p className="text-xs text-[var(--destructive)] mt-2 animate-fade-in">{error}</p>}
    </div>
  );
}