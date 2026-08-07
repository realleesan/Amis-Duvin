import { useState, useCallback } from "react";
import AgeVerification from "@/components/amisduvin/AgeVerification";
import Header from "@/components/amisduvin/Header";
import Hero from "@/components/amisduvin/Hero";
import Benefits from "@/components/amisduvin/Benefits";
import FoodWinePairing from "@/components/amisduvin/FoodWinePairing";
import Sommelier from "@/components/amisduvin/Sommelier";
import SommelierModal from "@/components/amisduvin/SommelierModal";
import Testimonials from "@/components/amisduvin/Testimonials";
import FAQ from "@/components/amisduvin/FAQ";
import RegistrationForm from "@/components/amisduvin/RegistrationForm";
import SuccessPopup from "@/components/amisduvin/SuccessPopup";
import Workshops from "@/components/amisduvin/Workshops";
import MapSection from "@/components/amisduvin/MapSection";
import Footer from "@/components/amisduvin/Footer";

export default function Home() {
  const [verified, setVerified] = useState(
    () => sessionStorage.getItem("adv_verified") === "1"
  );
  const [showSuccess, setShowSuccess] = useState(false);
  const [showProfile, setShowProfile] = useState(false);

  const handleVerify = useCallback(() => {
    sessionStorage.setItem("adv_verified", "1");
    setVerified(true);
  }, []);

  const scrollTo = useCallback((id) => {
    document.getElementById(id)?.scrollIntoView({ behavior: "smooth" });
  }, []);

  const handleSuccess = useCallback(() => setShowSuccess(true), []);

  return (
    <div className="min-h-screen bg-background">
      {!verified && <AgeVerification onVerify={handleVerify} />}

      <Header onRegister={() => scrollTo("register")} />

      <main>
        <Hero onExplore={() => scrollTo("pairing")} />
        <Benefits />
        <FoodWinePairing onBook={() => scrollTo("register")} />
        <Sommelier onOpenProfile={() => setShowProfile(true)} />
        <Testimonials />
        <FAQ />
        <RegistrationForm onSuccess={handleSuccess} />
        <Workshops onSuccess={handleSuccess} />
        <MapSection />
      </main>

      <Footer />

      {showSuccess && (
        <SuccessPopup
          onGuide={() => {
            setShowSuccess(false);
            window.setTimeout(() => scrollTo("faq"), 120);
          }}
          onDismiss={() => setShowSuccess(false)}
        />
      )}

      {showProfile && (
        <SommelierModal
          onClose={() => setShowProfile(false)}
          onRegister={() => {
            setShowProfile(false);
            window.setTimeout(() => scrollTo("register"), 350);
          }}
          onExploreWorkshops={() => {
            setShowProfile(false);
            window.setTimeout(() => scrollTo("workshops"), 350);
          }}
        />
      )}
    </div>
  );
}