<!-- Sommelier Journey Drawer Modal -->
<div id="sommelierModal" class="modal-overlay !justify-end !p-0">
  <div class="relative h-full w-full md:w-4/5 bg-card border-l border-border flex flex-col shadow-[0_0_80px_rgba(0,0,0,0.8)] modal-drawer-panel">
    <!-- Modal Header -->
    <div class="shrink-0 flex items-center justify-between px-5 sm:px-8 py-4 border-b border-border bg-card">
      <div class="flex items-center gap-3 min-w-0">
        <div class="w-11 h-11 rounded-sm overflow-hidden border border-border shrink-0">
          <span class="inline-block relative w-full h-full">
            <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/1a9505e2b_image.png/v1/fill/w_42,h_42,fp_0.50_0.40,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/1a9505e2b_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Alex Thịnh">
          </span>
        </div>
        <div class="min-w-0">
          <p class="text-[10px] uppercase tracking-[0.25em] text-[var(--gold)] leading-none mb-1">Sommelier</p>
          <p class="font-heading text-base sm:text-lg text-foreground truncate">Alex Thịnh</p>
        </div>
      </div>
      <div class="flex items-center gap-3 sm:gap-4">
        <div class="flex items-center gap-2 sm:gap-2.5">
          <a href="https://www.facebook.com/nguyen.alex.589" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-border flex items-center justify-center text-foreground/75 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook w-4 h-4"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
          </a>
          <a href="https://zalo.me/0919686540" target="_blank" rel="noopener noreferrer" aria-label="Zalo" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-border flex items-center justify-center text-foreground/75 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-all duration-300">
            <span class="text-[11px] font-bold">Zalo</span>
          </a>
          <a href="mailto:alexthinh.vn@gmail.com" target="_blank" rel="noopener noreferrer" aria-label="Email" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-border flex items-center justify-center text-foreground/75 hover:border-[var(--wine)] hover:text-[var(--wine)] transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
          </a>
        </div>
        <button onclick="closeSommelierModal()" class="w-10 h-10 flex items-center justify-center text-foreground/60 hover:text-foreground rounded-full hover:bg-foreground/5 transition-colors shrink-0" aria-label="Đóng">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
        </button>
      </div>
    </div>

    <!-- Modal Body with hidden scrollbar (no-scrollbar utility) -->
    <div class="flex-1 overflow-y-auto no-scrollbar px-5 sm:px-8 lg:px-12 py-10 space-y-16">
      <!-- Quote -->
      <div class="w-full">
        <p class="font-serif-display italic text-xl sm:text-2xl text-foreground/80 leading-relaxed">“Mỗi chai vang là một câu chuyện — và tôi là người kể câu chuyện ấy trên những bàn tiệc tinh hoa.”</p>
        <p class="text-sm text-muted-foreground mt-4">— Sommelier Alex Thịnh</p>
      </div>

      <!-- Khối A: Nghệ thuật & Ngoại giao (Slider) -->
      <section>
        <div class="mb-2">
          <h3 class="font-heading text-2xl sm:text-3xl text-foreground">Nghệ thuật &amp; Ngoại giao</h3>
          <div class="hairline w-16 mt-4"></div>
        </div>
        <p class="text-sm text-muted-foreground leading-relaxed mb-7 w-full">Người kết nối giới tinh hoa trong các buổi tiệc Private &amp; Fine Dining — nơi vang trở thành cầu nối giữa văn hóa, nghệ thuật và ngoại giao thương gia.</p>

        <!-- Image Slider Component -->
        <div class="relative overflow-hidden rounded-sm border border-border">
          <div id="sommelierSliderTrack" class="flex transition-transform duration-700 ease-out" style="transform: translateX(0%);">
            <!-- Slide 1 -->
            <div class="relative w-full shrink-0 aspect-[16/10]">
              <span class="inline-block relative w-full h-full">
                <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/4a03e052e_image.png/v1/fill/w_633,h_396,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/4a03e052e_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Hành trình học vang Pháp — Nhận giải French Wines Learning Journey">
              </span>
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/15 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8">
                <p class="text-white/95 font-serif-display text-lg sm:text-2xl italic leading-snug">Hành trình học vang Pháp — Nhận giải French Wines Learning Journey</p>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="relative w-full shrink-0 aspect-[16/10]">
              <span class="inline-block relative w-full h-full">
                <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/e789f3c10_image.png/v1/fill/w_633,h_396,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/e789f3c10_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Giám khảo quốc tế — Cathay Pacific HKIWSC 2017, Hong Kong">
              </span>
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/15 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8">
                <p class="text-white/95 font-serif-display text-lg sm:text-2xl italic leading-snug">Giám khảo quốc tế — Cathay Pacific HKIWSC 2017, Hong Kong</p>
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="relative w-full shrink-0 aspect-[16/10]">
              <span class="inline-block relative w-full h-full">
                <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/b3b4047de_image.png/v1/fill/w_633,h_396,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/b3b4047de_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Nghệ thuật phục vụ — Trải nghiệm Fine Dining riêng tư">
              </span>
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/15 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8">
                <p class="text-white/95 font-serif-display text-lg sm:text-2xl italic leading-snug">Nghệ thuật phục vụ — Trải nghiệm Fine Dining riêng tư</p>
              </div>
            </div>

            <!-- Slide 4 -->
            <div class="relative w-full shrink-0 aspect-[16/10]">
              <span class="inline-block relative w-full h-full">
                <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/36ad6c80b_image.png/v1/fill/w_633,h_396,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/36ad6c80b_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Khám phá hương vị — Nghệ thuật thưởng thức &amp; thử nếm">
              </span>
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/15 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8">
                <p class="text-white/95 font-serif-display text-lg sm:text-2xl italic leading-snug">Khám phá hương vị — Nghệ thuật thưởng thức &amp; thử nếm</p>
              </div>
            </div>
          </div>

          <!-- Slider Controls -->
          <button onclick="prevSommelierSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center hover:bg-[var(--wine)] transition-colors" aria-label="Trước">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5"><path d="m15 18-6-6 6-6"></path></svg>
          </button>
          <button onclick="nextSommelierSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center hover:bg-[var(--wine)] transition-colors" aria-label="Sau">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5"><path d="m9 18 6-6-6-6"></path></svg>
          </button>

          <!-- Slider Dots -->
          <div id="sommelierSliderDots" class="absolute bottom-4 right-5 flex gap-2">
            <button onclick="goToSommelierSlide(0)" class="h-1.5 rounded-full transition-all duration-300 w-6 bg-[var(--wine)]" aria-label="Slide 1"></button>
            <button onclick="goToSommelierSlide(1)" class="h-1.5 rounded-full transition-all duration-300 w-1.5 bg-white/50" aria-label="Slide 2"></button>
            <button onclick="goToSommelierSlide(2)" class="h-1.5 rounded-full transition-all duration-300 w-1.5 bg-white/50" aria-label="Slide 3"></button>
            <button onclick="goToSommelierSlide(3)" class="h-1.5 rounded-full transition-all duration-300 w-1.5 bg-white/50" aria-label="Slide 4"></button>
          </div>
        </div>
      </section>

      <!-- Khối B: Bảo chứng Học thuật -->
      <section>
        <div class="mb-2">
          <h3 class="font-heading text-2xl sm:text-3xl text-foreground">Bảo chứng Học thuật</h3>
          <div class="hairline w-16 mt-4"></div>
        </div>
        <p class="text-sm text-muted-foreground leading-relaxed mb-7 w-full">Những bảo chứng học thuật và giải thưởng quốc tế — minh chứng cho hành trình tận tâm với nghệ thuật vang. Di chuột để xem, bấm để phóng to chi tiết.</p>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
          <!-- Cert 1 -->
          <button onclick="openCertLightbox('https://media.base44.com/images/public/6a623336361c483b3f15558c/615248ce1_image.png/v1/fill/w_917,h_687,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/615248ce1_image.webp')" class="group relative block overflow-hidden rounded-sm border border-border aspect-[4/3] text-left cursor-pointer">
            <span class="inline-block relative media-dim w-full h-full">
              <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/615248ce1_image.png/v1/fill/w_306,h_229,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/615248ce1_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Vietnam Best Sommelier in French Wine 2015">
            </span>
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-3 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
              <p class="text-white text-sm font-medium leading-snug">Vietnam Best Sommelier in French Wine 2015</p>
              <p class="text-white/65 text-xs mt-1">Concours du Meilleur Sommelier du Vietnam — Chung kết</p>
            </div>
            <!-- Top Right Diagonal Arrow Icon -->
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/50 backdrop-blur text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-4 h-4"><path d="M7 17 17 7"></path><path d="M7 7h10v10"></path></svg>
            </span>
          </button>

          <!-- Cert 2 -->
          <button onclick="openCertLightbox('https://media.base44.com/images/public/6a623336361c483b3f15558c/742e873b8_image.png/v1/fill/w_917,h_687,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/742e873b8_image.webp')" class="group relative block overflow-hidden rounded-sm border border-border aspect-[4/3] text-left cursor-pointer">
            <span class="inline-block relative media-dim w-full h-full">
              <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/742e873b8_image.png/v1/fill/w_306,h_229,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/742e873b8_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Advanced Ambassador — Academy of Wines of Portugal">
            </span>
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-3 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
              <p class="text-white text-sm font-medium leading-snug">Advanced Ambassador — Academy of Wines of Portugal</p>
              <p class="text-white/65 text-xs mt-1">Level III Training · Macau, 2014</p>
            </div>
            <!-- Top Right Diagonal Arrow Icon -->
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/50 backdrop-blur text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-4 h-4"><path d="M7 17 17 7"></path><path d="M7 7h10v10"></path></svg>
            </span>
          </button>

          <!-- Cert 3 -->
          <button onclick="openCertLightbox('https://media.base44.com/images/public/6a623336361c483b3f15558c/35171c789_image.png/v1/fill/w_917,h_687,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/35171c789_image.webp')" class="group relative block overflow-hidden rounded-sm border border-border aspect-[4/3] text-left cursor-pointer">
            <span class="inline-block relative media-dim w-full h-full">
              <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/35171c789_image.png/v1/fill/w_306,h_229,al_c,q_90,usm_0.66_1.00_0.01,enc_webp,quality_auto/35171c789_image.webp" loading="lazy" class="w-full h-full inset-0 absolute object-cover" alt="Provence Wine Council (CIVP) Seminar">
            </span>
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute inset-x-0 bottom-0 p-4 translate-y-3 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
              <p class="text-white text-sm font-medium leading-snug">Provence Wine Council (CIVP) Seminar</p>
              <p class="text-white/65 text-xs mt-1">Provence Rosé Wine · Kuala Lumpur, 2015</p>
            </div>
            <!-- Top Right Diagonal Arrow Icon -->
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/50 backdrop-blur text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-4 h-4"><path d="M7 17 17 7"></path><path d="M7 7h10v10"></path></svg>
            </span>
          </button>
        </div>

        <button onclick="closeSommelierModal(); scrollToId('register');" class="btn-ghost mt-7 px-7 py-4 rounded-sm text-sm uppercase tracking-[0.18em] font-medium min-h-[52px] inline-flex items-center gap-2 group">
          Đăng ký Party với Sommelier
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
        </button>
      </section>

      <!-- Details Section (Giải thưởng & Học vấn, Vị trí công việc, Kinh nghiệm) -->
      <!-- Background inside circle badge matches modal background (bg-card), border matches border-border -->
      <section class="grid lg:grid-cols-2 gap-10">
        <div>
          <h4 class="flex items-center gap-2.5 text-[var(--wine)] font-heading text-lg sm:text-xl mb-5">
            <span class="w-9 h-9 rounded-full border border-border bg-card flex items-center justify-center shrink-0 text-[var(--wine)]">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award w-5 h-5"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>
            </span>
            Giải thưởng &amp; Học vấn
          </h4>
          <ul class="space-y-3">
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Chứng chỉ quốc tế WSET Level 3 Award in Wines and Spirits (UK) — Lý thuyết đạt loại xuất sắc. WSET Level 1 và 2 xuất sắc.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Chứng chỉ WSET Sake Level 1, Chứng chỉ Đại sứ rượu vang Bồ Đào Nha, chứng chỉ Bartender do Học viện Du lịch Macao cấp, cùng nhiều chứng chỉ khác về vang.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Cử nhân tiếng Pháp — Đại học Hà Nội (HANU).</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giải nhất cuộc thi phục vụ và thử nếm vang Pháp tại Việt Nam 2015.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giải nhì cuộc thi phục vụ và thử nếm vang Pháp VN 2020.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giải nhì cuộc thi phục vụ và thử nếm vang Bồ Đào Nha — Macao 2013.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giải ba cuộc thi vang quốc tế khu vực Đông Nam Á + Đài Loan — Bangkok 2015.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Bán kết cuộc thi vang Pháp khu vực Châu Á — Kuala Lumpur 2015.</span></li>
          </ul>
        </div>

        <div>
          <h4 class="flex items-center gap-2.5 text-[var(--wine)] font-heading text-lg sm:text-xl mb-5">
            <span class="w-9 h-9 rounded-full border border-border bg-card flex items-center justify-center shrink-0 text-[var(--wine)]">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-5 h-5"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
            </span>
            Vị trí công việc
          </h4>
          <ul class="space-y-3">
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Hiện tại: Giám đốc Công ty Cổ phần Quốc tế GCC Thịnh Phát.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Chuyên gia tư vấn và đào tạo cho công ty ADT.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Hợp tác với các công ty nhập khẩu vang lớn như Huy Phong.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giám sát Bar tại các khách sạn 5 sao.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Sommelier tại khách sạn 5 sao trong và ngoài nước.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>3 năm Phó Chủ tịch Hiệp hội Sommelier Sài Gòn.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Hiện là Phó Chủ tịch Hanoi Vino Club.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giám đốc đào tạo và tổ chức sự kiện cho công ty Đa Lộc 2014 – 2019.</span></li>
          </ul>
        </div>

        <div class="lg:col-span-2">
          <h4 class="flex items-center gap-2.5 text-[var(--wine)] font-heading text-lg sm:text-xl mb-5">
            <span class="w-9 h-9 rounded-full border border-border bg-card flex items-center justify-center shrink-0 text-[var(--wine)]">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-5 h-5"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
            </span>
            Kinh nghiệm nghề nghiệp
          </h4>
          <ul class="space-y-3">
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>24 năm làm việc trong các nhà hàng, khách sạn 5 sao trong và ngoài nước, và công ty nhập khẩu rượu vang.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giám khảo chấm điểm rượu vang quốc tế tại Hong Kong IWSC 2017.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giám khảo chọn vang cho Vietnam Airlines từ 2023 – nay.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Giám khảo cuộc thi chung kết Sommelier Rượu vang Pháp 2018 tại HCM.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Đã đặt chân đến 20 quốc gia và vùng lãnh thổ; 4 chuyến trải nghiệm vang tại Châu Âu, 2 lần tại Úc, 1 lần tại Mỹ; tham dự nhiều sự kiện lớn về rượu vang (Bordeaux, HK, Singapore…).</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Hợp tác giảng dạy cho các trường đại học: KTQD, Greenwich…</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Chia sẻ văn hóa tiêu dùng vang trên VTV2, VTV3, VTV Cab 15… và các tạp chí.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Dạy kiến thức vang cho các khách sạn, nhà hàng trong cả nước (Sofitel Metropole, JW Marriott, Intercontinental, Vinpearl, Amanoi… các tàu 5 sao tại Hạ Long).</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Chia sẻ văn hóa ngoại giao trên bàn tiệc cho các cơ quan, tổ chức (ĐH Ngoại Thương, Ngân hàng BIDV, Seabank, Dược Trafaco…).</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Tổ chức sự kiện, hội thảo và kết nối về vang cho các nhà máy nước ngoài tại thị trường Việt Nam.</span></li>
            <li class="flex gap-3 text-sm text-foreground/80 leading-relaxed"><span class="mt-2 w-1.5 h-1.5 rounded-full bg-[var(--wine)] shrink-0"></span><span>Đại diện Hiệp hội giáo dục rượu vang Úc dạy chương trình vang 2025 tại VN.</span></li>
          </ul>
        </div>
      </section>
    </div>

    <!-- Modal Sticky Footer Button -->
    <div class="shrink-0 border-t border-border bg-card px-5 sm:px-8 py-4">
      <button onclick="closeSommelierModal(); scrollToId('register');" class="btn-wine w-full py-4 rounded-sm text-sm uppercase tracking-[0.2em] font-medium min-h-[52px] flex items-center justify-center gap-2">
        Đăng ký Party cùng Sommelier Alex Thịnh
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
      </button>
    </div>
  </div>
</div>

<!-- Lightbox Zoom Modal for Academic Certificates (Image 2) -->
<!-- Guaranteed top layer with z-[99999] backdrop-blur-md -->
<div id="certLightboxModal" class="modal-overlay !p-4 !z-[99999] backdrop-blur-md" onclick="closeCertLightbox()">
  <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center justify-center animate-scale-in" onclick="event.stopPropagation()">
    <button onclick="closeCertLightbox()" class="absolute -top-12 right-0 sm:top-2 sm:-right-12 w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition-colors z-10" aria-label="Đóng">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>
    <div class="relative w-full overflow-hidden rounded-sm border border-white/20 shadow-2xl bg-black/90">
      <img id="certLightboxImg" src="" class="w-full h-auto max-h-[82vh] object-contain mx-auto" alt="Certificate Full Resolution">
    </div>
  </div>
</div>
