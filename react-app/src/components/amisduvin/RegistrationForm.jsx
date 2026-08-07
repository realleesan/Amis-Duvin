const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { useState, useRef, useCallback, useEffect } from "react";
import { User, Phone, Mail, Users, Loader2, ShieldAlert, Wallet, Clock, ShieldCheck, Calendar, CalendarCheck } from "lucide-react";

import Reveal from "./Reveal";

const PHONE_RE = /^0\d{9}$/;
const EMAIL_RE = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const SPAM_THRESHOLD = 5;
const SPAM_WINDOW = 3000;
const LOCK_DURATION = 5000;

// Các khung giờ tiệc (mỗi slot 2 tiếng) — so khớp với lịch bận của Sommelier
const PARTY_SLOTS = [
  { id: "11-13", label: "11:00 – 13:00", start: 11 * 60, end: 13 * 60, meal: "Trưa" },
  { id: "13-15", label: "13:00 – 15:00", start: 13 * 60, end: 15 * 60, meal: "Trưa" },
  { id: "15-17", label: "15:00 – 17:00", start: 15 * 60, end: 17 * 60, meal: "Chiều" },
  { id: "17-19", label: "17:00 – 19:00", start: 17 * 60, end: 19 * 60, meal: "Tối" },
  { id: "19-21", label: "19:00 – 21:00", start: 19 * 60, end: 21 * 60, meal: "Tối" },
];

const TRUST = [
  { icon: Wallet, title: "Chi phí dự kiến", text: "Từ 1.500.000đ/khách — tuỳ gói Food & Wine Pairing và số lượng khách. Báo giá chi tiết sau khi chốt thực đơn." },
  { icon: Wallet, title: "Phương thức thanh toán", text: "Chuyển khoản ngân hàng, QR VNPay hoặc tiền mặt. Đặt cọc 30% để giữ chỗ, thanh toán phần còn lại trước tiệc." },
  { icon: Clock, title: "Thời gian CSKH xác nhận", text: "Trong vòng 2 giờ làm việc, bộ phận CSKH sẽ liên hệ qua Zalo/SĐT để chốt thông tin." },
  { icon: ShieldCheck, title: "Chính sách hoàn/hủy", text: "Hoàn 100% nếu hủy trước 72 giờ. Trong vòng 72 giờ, giữ 50% chi phí đặt cọc." },
];

function todayStr() {
  const d = new Date();
  const local = new Date(d.getTime() - d.getTimezoneOffset() * 60000);
  return local.toISOString().slice(0, 10);
}

function toMinutes(iso) {
  const d = new Date(iso);
  return d.getHours() * 60 + d.getMinutes();
}

function slotOverlaps(slot, busyMin) {
  return busyMin.some((b) => slot.start < b.end && b.start < slot.end);
}

/**
 * RegistrationForm — Form đặt tiệc (CRO-optimised).
 * Trường: Họ tên, SĐT, Email, Số lượng, Ngày, Khung giờ (lịch Sommelier), Ghi chú.
 * Kế bên: trust box (chi phí, thanh toán, CSKH, hoàn/hủy).
 */
export default function RegistrationForm({ onSuccess }) {
  const [form, setForm] = useState({ name: "", phone: "", email: "", participants: "1", date: "", slot: "", notes: "" });
  const [busy, setBusy] = useState([]);
  const [loadingSlots, setLoadingSlots] = useState(false);
  const [slotError, setSlotError] = useState(false);
  const [submitting, setSubmitting] = useState(false);
  const [spamLocked, setSpamLocked] = useState(false);
  const clickTimes = useRef([]);

  // Tải các khoảng bận của Sommelier khi chọn ngày
  useEffect(() => {
    if (!form.date) { setBusy([]); return; }
    let active = true;
    setLoadingSlots(true);
    setSlotError(false);
    db.functions.invoke("getSommelierAvailability", { date: form.date })
      .then((res) => {
        if (!active) return;
        const data = res.data || res;
        const list = (data.busy || []).map((b) => ({ start: toMinutes(b.start), end: toMinutes(b.end) }));
        setBusy(list);
      })
      .catch(() => { if (active) setSlotError(true); })
      .finally(() => { if (active) setLoadingSlots(false); });
    return () => { active = false; };
  }, [form.date]);

  const errors = {
    name: form.name.trim().length >= 2 ? "" : "Vui lòng nhập họ tên (tối thiểu 2 ký tự)",
    phone: PHONE_RE.test(form.phone.trim()) ? "" : "Số điện thoại phải đúng 10 số (bắt đầu bằng 0)",
    email: EMAIL_RE.test(form.email.trim()) ? "" : "Email không hợp lệ",
    participants: Number.isInteger(Number(form.participants)) && Number(form.participants) >= 1 ? "" : "Tối thiểu 1 người",
    date: form.date ? "" : "Vui lòng chọn ngày",
    slot: form.slot ? "" : "Vui lòng chọn khung giờ",
  };
  const isValid = !Object.values(errors).some((e) => e);

  const handleChange = (field) => (e) => setForm((f) => ({ ...f, [field]: e.target.value }));
  const handleDate = (e) => setForm((f) => ({ ...f, date: e.target.value, slot: "" }));

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
        setForm({ name: "", phone: "", email: "", participants: "1", date: "", slot: "", notes: "" });
        setBusy([]);
        onSuccess();
      }, 2000);
    },
    [isValid, submitting, spamLocked, onSuccess]
  );

  return (
    <section id="register" className="scroll-anchor relative py-24 sm:py-32 bg-background overflow-hidden">
      <div className="absolute inset-0 bg-wine-radial opacity-70" />
      <div className="relative max-w-6xl mx-auto px-5 sm:px-8">
        <Reveal>
          <div className="text-center mb-12">
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Đặt tiệc riêng</p>
            <h2 className="font-heading text-3xl sm:text-5xl text-foreground mb-5">Đăng ký đặt tiệc</h2>
            <p className="text-sm text-muted-foreground">Để lại thông tin, Amis du Vin sẽ liên hệ xác nhận qua Zalo &amp; Email.</p>
          </div>
        </Reveal>

        <div className="grid lg:grid-cols-5 gap-8 lg:gap-10 items-start">
          {/* Form */}
          <Reveal delay={120} className="lg:col-span-3">
            <form onSubmit={handleSubmit} className="bg-card border border-border rounded-sm p-7 sm:p-9 shadow-[0_20px_60px_-30px_rgba(33,30,25,0.25)]" noValidate>
              <Field icon={<User className="w-4 h-4" />} label="Họ và tên" error={errors.name} touched={form.name.length > 0}>
                <input type="text" value={form.name} onChange={handleChange("name")} placeholder="Nguyễn Văn An" className="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" autoComplete="name" />
              </Field>

              <div className="grid sm:grid-cols-2 gap-5">
                <Field icon={<Phone className="w-4 h-4" />} label="Số điện thoại" error={errors.phone} touched={form.phone.length > 0}>
                  <input type="tel" inputMode="numeric" value={form.phone} onChange={handleChange("phone")} placeholder="0912345678" maxLength={10} className="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" autoComplete="tel" />
                </Field>
                <Field icon={<Mail className="w-4 h-4" />} label="Email" error={errors.email} touched={form.email.length > 0}>
                  <input type="email" value={form.email} onChange={handleChange("email")} placeholder="an@email.com" className="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" autoComplete="email" />
                </Field>
              </div>

              <Field icon={<Users className="w-4 h-4" />} label="Số lượng người tham gia" error={errors.participants} touched={form.participants.length > 0}>
                <input type="number" min={1} value={form.participants} onChange={handleChange("participants")} className="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" />
              </Field>

              <Field icon={<Calendar className="w-4 h-4" />} label="Ngày đặt tiệc" error={errors.date} touched={!!form.date}>
                <input type="date" min={todayStr()} value={form.date} onChange={handleDate} className="input-elegant w-full bg-transparent pl-11 pr-4 py-4 rounded-sm text-sm" />
              </Field>

              {/* Khung giờ — đồng bộ Google Calendar */}
              <div className="mb-5">
                <label className="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Khung giờ (lịch Sommelier)</label>
                {!form.date ? (
                  <p className="text-xs text-muted-foreground italic py-3">Vui lòng chọn ngày để xem khung giờ còn trống.</p>
                ) : loadingSlots ? (
                  <div className="flex items-center gap-2 py-3 text-xs text-muted-foreground">
                    <Loader2 className="w-4 h-4 spin-wine" /> Đang tải lịch Sommelier...
                  </div>
                ) : (
                  <>
                    <div className="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                      {PARTY_SLOTS.map((s) => {
                        const isBusy = slotOverlaps(s, busy);
                        const selected = form.slot === s.id;
                        return (
                          <button
                            type="button"
                            key={s.id}
                            disabled={isBusy}
                            onClick={() => setForm((f) => ({ ...f, slot: s.id }))}
                            className={`rounded-sm border px-3 py-3 text-center transition-all min-h-[56px] ${selected ? "border-[var(--wine)] bg-[var(--wine)] text-white" : isBusy ? "border-border bg-muted/60 text-muted-foreground cursor-not-allowed line-through" : "border-border hover:border-[var(--wine)]/50 text-foreground"}`}
                          >
                            <span className="block text-xs font-medium">{s.label}</span>
                            <span className={`block text-[10px] mt-0.5 ${selected ? "text-white/80" : "text-muted-foreground"}`}>{isBusy ? "Đã hết slot" : s.meal}</span>
                          </button>
                        );
                      })}
                    </div>
                    {slotError && (
                      <p className="text-[11px] text-muted-foreground mt-2">Không tải được lịch trực tiếp — bạn vẫn có thể chọn giờ, chúng tôi sẽ xác nhận sau.</p>
                    )}
                    {form.slot && !slotError && (
                      <p className="flex items-center gap-1.5 text-[11px] text-emerald-600 dark:text-emerald-400 mt-2">
                        <CalendarCheck className="w-3.5 h-3.5" /> Khung giờ trống — Sommelier sẵn sàng.
                      </p>
                    )}
                    {!form.slot && !slotError && (
                      <p className="text-[11px] text-muted-foreground mt-2">Chọn một khung giờ còn trống để tiếp tục.</p>
                    )}
                  </>
                )}
              </div>

              <div className="mb-6">
                <label className="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Ghi chú (tuỳ chọn)</label>
                <textarea value={form.notes} onChange={handleChange("notes")} rows={3} placeholder="Yêu cầu đặc biệt, dị ứng, chế độ ăn, dịp lễ..." className="input-elegant w-full px-4 py-3.5 rounded-sm text-sm resize-none" />
              </div>

              {spamLocked && (
                <div className="flex items-center gap-3 bg-[var(--destructive)]/8 border border-[var(--destructive)]/25 rounded-sm px-4 py-4 mb-6 animate-fade-in">
                  <ShieldAlert className="w-5 h-5 text-[var(--destructive)] shrink-0" />
                  <p className="text-xs sm:text-sm text-[var(--destructive)]">Hệ thống phát hiện bất thường, vui lòng xác thực bạn là người thật để tiếp tục.</p>
                </div>
              )}

              <button type="submit" disabled={!isValid || submitting || spamLocked} className="btn-invert w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2 mt-2">
                {submitting ? (<><Loader2 className="w-4 h-4 spin-wine" /> Đang gửi...</>) : ("Đặt tiệc ngay")}
              </button>

              <p className="text-center text-[11px] text-muted-foreground mt-5">Thông tin của bạn được bảo mật tuyệt đối theo chính sách của Amis du Vin.</p>
            </form>
          </Reveal>

          {/* Trust box */}
          <Reveal delay={240} className="lg:col-span-2">
            <div className="rounded-sm border border-border bg-card p-7 sm:p-8 space-y-6">
              <div>
                <p className="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] mb-2">An tâm khi đặt tiệc</p>
                <h3 className="font-heading text-xl text-foreground">Thông tin đặt tiệc</h3>
                <div className="hairline w-16 mt-4" />
              </div>
              {TRUST.map((t) => (
                <div key={t.title} className="flex gap-3.5">
                  <span className="w-10 h-10 rounded-full bg-[var(--wine)]/10 border border-[var(--wine)]/25 flex items-center justify-center text-[var(--wine)] shrink-0">
                    <t.icon className="w-4 h-4" />
                  </span>
                  <div>
                    <p className="text-sm font-medium text-foreground mb-1">{t.title}</p>
                    <p className="text-xs text-muted-foreground leading-relaxed">{t.text}</p>
                  </div>
                </div>
              ))}
            </div>
          </Reveal>
        </div>
      </div>
    </section>
  );
}

function Field({ icon, label, error, touched, children }) {
  return (
    <div className="mb-5">
      <label className="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">{label}</label>
      <div className="relative">
        <span className="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">{icon}</span>
        {children}
      </div>
      {touched && error && <p className="text-xs text-[var(--destructive)] mt-2 animate-fade-in">{error}</p>}
    </div>
  );
}