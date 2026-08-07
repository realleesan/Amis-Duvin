const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { Phone, Mail, MapPin, Facebook, Youtube } from "lucide-react";

const LOGO = "https://media.db.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png";

export default function Footer() {
  return (
    <footer className="bg-card border-t border-border pt-16 pb-8">
      <div className="max-w-7xl mx-auto px-5 sm:px-8">
        <div className="grid md:grid-cols-3 gap-10 mb-12">
          <div>
            <div className="mb-5">
              <img src={LOGO} alt="Amis du Vin" className="h-16 sm:h-20 w-auto object-contain rounded-sm" />
            </div>
            <p className="text-sm text-muted-foreground leading-relaxed max-w-xs">Không gian kết nối văn hóa, nghệ thuật và ẩm thực rượu vang — trải nghiệm tinh tế tại Hà Nội.</p>
          </div>
          <div>
            <h4 className="text-xs uppercase tracking-[0.25em] text-[var(--gold)] mb-5">Liên hệ</h4>
            <ul className="space-y-4 text-sm">
              <li className="flex items-start gap-3 text-foreground/70"><MapPin className="w-4 h-4 text-[var(--wine)] shrink-0 mt-0.5" /><span>58B Võ Văn Dũng, Đống Đa, Hà Nội</span></li>
              <li><a href="tel:0919686540" className="flex items-center gap-3 text-foreground/70 hover:text-[var(--wine)] transition-colors"><Phone className="w-4 h-4 text-[var(--wine)] shrink-0" /><span>091 968 65 40</span></a></li>
              <li><a href="mailto:alexthinh.vn@gmail.com" className="flex items-center gap-3 text-foreground/70 hover:text-[var(--wine)] transition-colors"><Mail className="w-4 h-4 text-[var(--wine)] shrink-0" /><span>alexthinh.vn@gmail.com</span></a></li>
            </ul>
          </div>
          <div>
            <h4 className="text-xs uppercase tracking-[0.25em] text-[var(--gold)] mb-5">Theo dõi</h4>
            <p className="text-sm text-muted-foreground mb-5">Kết nối với Amis du Vin trên các nền tảng.</p>
            <div className="flex gap-3">
              <SocialLink href="https://www.facebook.com/profile.php?id=61581094990311" label="Facebook"><Facebook className="w-5 h-5" /></SocialLink>
              <SocialLink href="https://zalo.me/0919686540" label="Zalo OA"><span className="text-xs font-bold">Zalo</span></SocialLink>
              <SocialLink href="https://youtube.com" label="Youtube"><Youtube className="w-5 h-5" /></SocialLink>
            </div>
          </div>
        </div>
        <div className="hairline mb-6" />
        <div className="flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
          <p className="text-xs text-muted-foreground">© {new Date().getFullYear()} Amis du Vin. Rượu vang &amp; những người bạn.</p>
          <div className="flex items-center gap-4">
            <button onClick={() => document.getElementById("register")?.scrollIntoView({ behavior: "smooth" })} className="text-[11px] text-muted-foreground/70 hover:text-[var(--wine)] transition-colors">Cam kết bảo mật thông tin</button>
            <p className="text-[11px] text-muted-foreground/70">Uống có trách nhiệm — 18+</p>
          </div>
        </div>
      </div>
    </footer>
  );
}

function SocialLink({ href, label, children }) {
  return (
    <a href={href} target="_blank" rel="noopener noreferrer" aria-label={label} className="w-11 h-11 rounded-full border border-border flex items-center justify-center text-foreground/65 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-all duration-300">{children}</a>
  );
}