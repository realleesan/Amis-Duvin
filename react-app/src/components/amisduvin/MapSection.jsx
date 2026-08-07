import { MapPin, Navigation, Clock, Car, Landmark } from "lucide-react";

const MAPS_EMBED = "https://www.google.com/maps?q=58B+V%C3%B5+V%C4%83n+D%C5%A9ng,+%C4%90%E1%BB%91ng+%C4%90a,+H%C3%A0+N%E1%BB%99i&output=embed";
const MAPS_LINK = "https://www.google.com/maps/search/?api=1&query=58B+V%C3%B5+V%C4%83n+D%C5%A9ng,+%C4%90%E1%BB%91ng+%C4%90a,+H%C3%A0+N%E1%BB%99i";

/**
 * MapSection — bản đồ + thông tin địa điểm (giờ hoạt động, gửi xe, điểm nhận diện).
 */
export default function MapSection() {
  return (
    <section id="map" className="scroll-anchor bg-background border-t border-border">
      <div className="max-w-7xl mx-auto px-5 sm:px-8 py-16 sm:py-20">
        <div className="grid lg:grid-cols-3 gap-8 lg:gap-12 items-center">
          <div>
            <p className="text-[var(--gold)] text-xs uppercase tracking-[0.35em] mb-3">Địa điểm</p>
            <h2 className="font-heading text-3xl sm:text-4xl text-foreground mb-4">Nhà hàng Amis du Vin</h2>
            <div className="hairline w-16 mb-5" />
            <div className="flex items-start gap-2.5 text-sm text-foreground/75 mb-6">
              <MapPin className="w-4 h-4 text-[var(--wine)] shrink-0 mt-0.5" />
              <span>58B Võ Văn Dũng, phường Đống Đa, Hà Nội</span>
            </div>

            <ul className="space-y-3.5 mb-7">
              <li className="flex items-start gap-3 text-sm text-foreground/75">
                <Clock className="w-4 h-4 text-[var(--gold)] shrink-0 mt-0.5" />
                <span><strong className="text-foreground">Giờ hoạt động:</strong> 10:00 – 23:00 (T2 – CN). Tiệc riêng theo lịch hẹn.</span>
              </li>
              <li className="flex items-start gap-3 text-sm text-foreground/75">
                <Car className="w-4 h-4 text-[var(--gold)] shrink-0 mt-0.5" />
                <span><strong className="text-foreground">Có chỗ gửi xe:</strong> Sân gửi xe miễn phí ngay trong ngõ, đủ ô tô &amp; xe máy.</span>
              </li>
              <li className="flex items-start gap-3 text-sm text-foreground/75">
                <Landmark className="w-4 h-4 text-[var(--gold)] shrink-0 mt-0.5" />
                <span><strong className="text-foreground">Điểm nhận diện:</strong> Cách Nhà thi đấu Đống Đa ~300m, gần ngã tư Võ Văn Dũng – Nguyễn Lương Bằng.</span>
              </li>
            </ul>

            <a href={MAPS_LINK} target="_blank" rel="noopener noreferrer" className="btn-invert inline-flex items-center gap-2 px-6 py-3.5 rounded-sm text-xs uppercase tracking-[0.15em] font-medium min-h-[48px]">
              <Navigation className="w-4 h-4" /> Mở Google Maps
            </a>
          </div>
          <div className="lg:col-span-2 rounded-sm overflow-hidden border border-border h-[300px] sm:h-[380px] shadow-[0_20px_50px_-25px_rgba(33,30,25,0.3)]">
            <iframe
              src={MAPS_EMBED}
              className="w-full h-full"
              style={{ border: 0 }}
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
              title="Bản đồ — Amis du Vin, 58B Võ Văn Dũng, Đống Đa, Hà Nội"
            />
          </div>
        </div>
      </div>
    </section>
  );
}