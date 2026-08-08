<!-- Admin Top Header Component -->
<header class="h-16 border-b border-border/40 bg-card/60 backdrop-blur-md px-6 flex items-center justify-between shrink-0">
  <div class="flex items-center gap-3">
    <span class="text-xs uppercase tracking-[0.2em] text-[var(--gold)] font-medium">CMS Workspace</span>
    <span class="text-muted-foreground/40">•</span>
    <a href="/" target="_blank" class="text-xs text-muted-foreground hover:text-foreground flex items-center gap-1.5 transition-colors">
      <span>Xem Landing Page</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-3.5 h-3.5"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
    </a>
  </div>

  <div class="flex items-center gap-4">
    <!-- Theme Toggle Button -->
    <button type="button" class="theme-toggle-btn p-2 rounded-full hover:bg-muted transition-colors text-muted-foreground hover:text-foreground" aria-label="Đổi giao diện Sáng/Tối" title="Đổi giao diện Sáng/Tối">
      <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun w-4 h-4 text-[var(--gold)]"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
      <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon w-4 h-4 text-foreground hidden"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
    </button>

    <span class="text-muted-foreground/30">•</span>

    <div class="text-xs text-muted-foreground font-mono">
      <?= date('d/m/Y H:i') ?>
    </div>
  </div>
</header>
