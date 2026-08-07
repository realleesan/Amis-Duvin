import { useState } from "react";
import Reveal from "./Reveal";
import WorkshopCard from "./WorkshopCard";
import WorkshopDetailModal from "./WorkshopDetailModal";
import WorkshopCarousel from "./WorkshopCarousel";
import WaitlistModal from "./WaitlistModal";
import WorkshopRegisterModal from "./WorkshopRegisterModal";
import { WORKSHOPS } from "./workshopData";

/**
 * Workshops — "Chọn Workshop phù hợp với bạn".
 * 2 buổi gần nhất nổi bật (highlight) + 6 buổi còn lại dạng Carousel 3D xoay vòng.
 */
export default function Workshops({ onSuccess }) {
  const [detail, setDetail] = useState(null);
  const [waitlist, setWaitlist] = useState(null);
  const [registerWs, setRegisterWs] = useState(null);

  const handleRegister = (id) => {
    const ws = WORKSHOPS.find((w) => w.id === id);
    if (ws) setRegisterWs(ws);
  };

  const nearest = WORKSHOPS.slice(0, 2);
  const rest = WORKSHOPS.slice(2);

  return (
    <section id="workshops" className="scroll-anchor relative py-24 sm:py-32 bg-card overflow-hidden">
      <div className="max-w-7xl mx-auto px-5 sm:px-8">
        <Reveal>
          <div className="text-center max-w-2xl mx-auto mb-14">
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-4">Dịch vụ phụ</p>
            <h2 className="font-heading text-3xl sm:text-5xl text-foreground mb-5">Chọn Workshop phù hợp với bạn</h2>
            <p className="text-sm sm:text-base text-muted-foreground">Hai buổi gần nhất nổi bật — lướt để khám phá các chủ đề còn lại.</p>
          </div>
        </Reveal>

        {/* 2 buổi gần nhất — highlight */}
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-3xl mx-auto mb-16">
          {nearest.map((w, i) => (
            <Reveal key={w.id} delay={i * 120}>
              <WorkshopCard w={w} onRegister={handleRegister} onDetail={setDetail} onWaitlist={setWaitlist} />
            </Reveal>
          ))}
        </div>

        {/* Carousel 3D cho các buổi còn lại */}
        <Reveal delay={150}>
          <div className="relative">
            <p className="text-center text-xs uppercase tracking-[0.25em] text-[var(--gold)] mb-8">Các chủ đề tiếp theo</p>
            <WorkshopCarousel workshops={rest} onRegister={handleRegister} onWaitlist={setWaitlist} />
          </div>
        </Reveal>
      </div>

      {detail && (
        <WorkshopDetailModal
          w={detail}
          onClose={() => setDetail(null)}
          onRegister={(id) => { setDetail(null); handleRegister(id); }}
        />
      )}

      {waitlist && (
        <WaitlistModal workshopName={waitlist.name} onClose={() => setWaitlist(null)} />
      )}

      {registerWs && (
        <WorkshopRegisterModal
          workshop={registerWs}
          onClose={() => setRegisterWs(null)}
          onSuccess={() => { setRegisterWs(null); onSuccess(); }}
        />
      )}
    </section>
  );
}