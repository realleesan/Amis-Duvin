const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { useState, useEffect } from "react";
import { Menu, X } from "lucide-react";
import ThemeToggle from "./ThemeToggle";

const LOGO = "https://media.db.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png";

const NAV_LINKS = [
  { label: "Về chúng tôi", target: "about" },
  { label: "Food & Wine Pairing", target: "pairing" },
  { label: "Dịch vụ khác", target: "workshops" },
  { label: "Liên hệ", target: "map" },
];

/**
 * Header sticky — trong suốt trên hero, chuyển glass khi cuộn.
 * Bao gồm nút chuyển Dark/Light mode.
 */
export default function Header({ onRegister }) {
  const [scrolled, setScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 40);
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const scrollTo = (id) => {
    document.getElementById(id)?.scrollIntoView({ behavior: "smooth" });
    setMobileOpen(false);
  };

  const navColor = scrolled
    ? "text-foreground/70 hover:text-foreground"
    : "text-white/80 hover:text-white";

  return (
    <header
      className={`fixed top-0 inset-x-0 z-50 transition-all duration-500 ${
        scrolled ? "glass py-3" : "bg-transparent py-5"
      }`}
    >
      <div className="max-w-7xl mx-auto px-5 sm:px-8 flex items-center justify-between">
        <button
          onClick={() => scrollTo("hero")}
          className="flex items-center group transition-transform duration-300 hover:scale-[1.03]"
          aria-label="Amis du Vin"
        >
          <img
            src={LOGO}
            alt="Amis du Vin"
            className="h-9 sm:h-10 w-auto object-contain rounded-sm"
          />
        </button>

        <nav className="hidden md:flex items-center gap-7">
          {NAV_LINKS.map((l) => (
            <button
              key={l.target}
              onClick={() => scrollTo(l.target)}
              className={`relative text-sm tracking-wide py-2 group transition-colors ${navColor}`}
            >
              {l.label}
              <span className="absolute left-0 -bottom-0.5 h-px w-0 bg-[var(--wine)] transition-all duration-300 group-hover:w-full" />
            </button>
          ))}
          <ThemeToggle scrolled={scrolled} />
          <button
            onClick={onRegister}
            className="btn-invert px-6 py-2.5 rounded-sm text-xs uppercase tracking-[0.18em] font-medium"
          >
            Đặt tiệc ngay
          </button>
        </nav>

        <div className="md:hidden flex items-center gap-1">
          <ThemeToggle scrolled={scrolled} />
          <button
            onClick={() => setMobileOpen((v) => !v)}
            className={`w-11 h-11 flex items-center justify-center transition-colors ${scrolled ? "text-foreground" : "text-white"}`}
            aria-label="Mở menu"
          >
            {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>
      </div>

      <div
        className={`md:hidden overflow-hidden transition-all duration-500 ${
          mobileOpen ? "max-h-96 glass" : "max-h-0"
        }`}
      >
        <nav className="px-5 py-4 flex flex-col gap-1">
          {NAV_LINKS.map((l) => (
            <button
              key={l.target}
              onClick={() => scrollTo(l.target)}
              className="text-left py-3.5 text-base text-foreground/85 hover:text-[var(--wine)] transition-colors min-h-[44px] border-b border-border"
            >
              {l.label}
            </button>
          ))}
          <button
            onClick={() => { onRegister(); setMobileOpen(false); }}
            className="btn-invert mt-3 py-3.5 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[48px]"
          >
            Đặt tiệc ngay
          </button>
        </nav>
      </div>
    </header>
  );
}