import { useState } from "react";
import { Grape } from "lucide-react";

export default function AgeVerification({ onVerify }) {
  const currentYear = new Date().getFullYear();
  const [birthYear, setBirthYear] = useState(1995);
  const [closing, setClosing] = useState(false);

  const age = currentYear - birthYear;
  const isEligible = age >= 18;

  const handleConfirm = () => {
    if (!isEligible || closing) return;
    setClosing(true);
    window.setTimeout(onVerify, 450);
  };

  return (
    <div className={`fixed inset-0 z-[100] flex items-center justify-center p-5 ${closing ? "animate-fade-out" : "animate-fade-in"}`} role="dialog" aria-modal="true">
      <div className="absolute inset-0 bg-black/70 backdrop-blur-md" />
      <div className="absolute inset-0 bg-wine-radial" />
      <div className="relative w-full max-w-lg text-center animate-scale-in bg-card border border-border rounded-sm px-6 py-12 sm:px-12 shadow-[0_40px_80px_-30px_rgba(33,30,25,0.5)]">
        <div className="flex justify-center mb-7">
          <div className="w-16 h-16 rounded-full border border-[var(--gold)]/40 flex items-center justify-center bg-[var(--wine)]/5 animate-float-slow"><Grape className="w-7 h-7 text-[var(--wine)]" strokeWidth={1.2} /></div>
        </div>
        <p className="text-xs uppercase tracking-[0.35em] text-[var(--gold)] mb-4">Amis du Vin</p>
        <h2 className="font-heading text-2xl sm:text-3xl text-foreground leading-snug mb-4">Vui lòng xác nhận bạn đủ 18 tuổi<br className="hidden sm:block" /> để truy cập không gian Amis du Vin</h2>
        <p className="text-sm text-muted-foreground max-w-sm mx-auto mb-10">Theo quy định về đồ uống có cồn, chúng tôi cần xác minh độ tuổi của bạn trước khi tiếp tục.</p>
        <div className="mb-3">
          <div className="flex items-end justify-center gap-3 mb-6">
            <span className="text-5xl font-heading text-foreground tabular-nums">{birthYear}</span>
            <span className="text-[var(--gold)] text-sm mb-2">Năm sinh</span>
          </div>
          <input type="range" min={1940} max={currentYear} value={birthYear} onChange={(e) => setBirthYear(Number(e.target.value))} className="vintage-slider" aria-label="Chọn năm sinh" />
          <div className="flex justify-between text-[10px] uppercase tracking-widest text-muted-foreground mt-3"><span>1940</span><span>{currentYear}</span></div>
        </div>
        <p className={`text-sm mt-7 mb-7 transition-colors ${isEligible ? "text-[var(--gold)]" : "text-[var(--destructive)]"}`}>
          {isEligible ? `Bạn đủ ${age} tuổi — đủ điều kiện truy cập` : `Bạn ${age} tuổi — chưa đủ 18 tuổi`}
        </p>
        <button onClick={handleConfirm} disabled={!isEligible} className="btn-wine w-full max-w-xs mx-auto py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px]">Xác nhận &amp; Truy cập</button>
      </div>
    </div>
  );
}