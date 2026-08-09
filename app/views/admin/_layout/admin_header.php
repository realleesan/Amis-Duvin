<!-- Admin Top Header Component -->
<header class="h-16 border-b border-border/40 bg-card/60 backdrop-blur-md px-6 flex items-center justify-between shrink-0 relative z-30">
  <div class="flex items-center gap-3">
    <span class="text-xs uppercase tracking-[0.2em] text-[var(--gold)] font-medium">CMS Workspace</span>
    <span class="text-muted-foreground/40">•</span>
    <a href="/" target="_blank" class="text-xs text-muted-foreground hover:text-foreground flex items-center gap-1.5 transition-colors">
      <span>Xem Landing Page</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-3.5 h-3.5"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
    </a>
  </div>

  <div class="flex items-center gap-4">
    <!-- Notification Bell Dropdown Component -->
    <div class="relative">
      <button type="button" id="notifBellBtn" onclick="toggleNotifDropdown(event)" class="relative p-2 rounded-full hover:bg-muted transition-colors text-muted-foreground hover:text-foreground focus:outline-none" title="Thông báo &amp; Biến động">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-4 h-4"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path></svg>
        <span id="notifBadge" class="hidden absolute top-1 right-1 w-2.5 h-2.5 rounded-full bg-rose-500 border-2 border-card animate-pulse"></span>
      </button>

      <!-- Dropdown Popup -->
      <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 sm:w-96 bg-card border border-border/40 rounded-md shadow-2xl overflow-hidden z-50 animate-scale-in">
        <div class="p-3 border-b border-border/40 flex items-center justify-between bg-muted/20">
          <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-foreground">Thông báo &amp; Biến động</span>
            <span id="notifUnreadTag" class="text-[10px] px-1.5 py-0.5 rounded-full bg-[var(--wine)]/20 text-[var(--gold)] font-mono font-bold hidden">0 mới</span>
          </div>
          <button type="button" onclick="markAllNotifHeader()" class="text-[11px] text-[var(--gold)] hover:underline font-medium">
            Đã đọc tất cả
          </button>
        </div>

        <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-border/30">
          <div class="p-6 text-center text-xs text-muted-foreground">Đang tải thông báo...</div>
        </div>

        <div class="p-2.5 border-t border-border/40 bg-muted/20 text-center">
          <a href="<?= admin_url('notifications') ?>" class="text-xs text-foreground font-semibold hover:text-[var(--gold)] transition-colors flex items-center justify-center gap-1">
            <span>Xem tất cả thông báo</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5"><path d="m9 18 6-6-6-6"></path></svg>
          </a>
        </div>
      </div>
    </div>

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

<script>
function fetchHeaderNotifications() {
  fetch('<?= admin_url('api/notifications/unread') ?>')
    .then(r => r.json())
    .then(data => {
      if (!data.success) return;
      const badge = document.getElementById('notifBadge');
      const tag = document.getElementById('notifUnreadTag');
      const list = document.getElementById('notifList');

      if (data.unread_count > 0) {
        badge.classList.remove('hidden');
        tag.classList.remove('hidden');
        tag.textContent = data.unread_count + ' mới';
      } else {
        badge.classList.add('hidden');
        tag.classList.add('hidden');
      }

      if (!data.items || data.items.length === 0) {
        list.innerHTML = '<div class="p-6 text-center text-xs text-muted-foreground">Không có thông báo mới nào.</div>';
        return;
      }

      let html = '';
      data.items.forEach(item => {
        const isUnread = item.is_read == 0;
        let typeBadge = '<span class="text-[10px] uppercase font-mono text-emerald-400 font-semibold">Đặt tiệc</span>';
        if (item.type === 'content') typeBadge = '<span class="text-[10px] uppercase font-mono text-amber-400 font-semibold">Nội dung</span>';
        if (item.type === 'user') typeBadge = '<span class="text-[10px] uppercase font-mono text-blue-400 font-semibold">Nhân sự</span>';
        if (item.type === 'system') typeBadge = '<span class="text-[10px] uppercase font-mono text-rose-400 font-semibold">Hệ thống</span>';

        html += `
          <div class="p-3 text-xs hover:bg-muted/30 transition-colors ${isUnread ? 'bg-amber-500/5' : ''}">
            <div class="flex items-center justify-between mb-1">
              ${typeBadge}
              <span class="text-[10px] font-mono text-muted-foreground">${item.created_at ? item.created_at.substring(11, 16) : ''}</span>
            </div>
            <a href="${item.action_url ? item.action_url : '<?= admin_url('notifications') ?>'}" class="font-semibold text-foreground hover:text-[var(--gold)] block truncate">
              ${item.title}
            </a>
            <p class="text-muted-foreground text-[11px] line-clamp-2 mt-0.5">${item.content}</p>
            <div class="text-[10px] text-muted-foreground/75 mt-1 font-mono">Bởi: ${item.user_name}</div>
          </div>
        `;
      });
      list.innerHTML = html;
    })
    .catch(() => {});
}

function toggleNotifDropdown(e) {
  e.stopPropagation();
  const dropdown = document.getElementById('notifDropdown');
  dropdown.classList.toggle('hidden');
  if (!dropdown.classList.contains('hidden')) {
    fetchHeaderNotifications();
  }
}

function markAllNotifHeader() {
  fetch('<?= admin_url('api/notifications/mark-all-read') ?>', { method: 'POST' })
    .then(r => r.json())
    .then(() => fetchHeaderNotifications());
}

document.addEventListener('click', function(e) {
  const dropdown = document.getElementById('notifDropdown');
  const btn = document.getElementById('notifBellBtn');
  if (dropdown && !dropdown.contains(e.target) && !btn.contains(e.target)) {
    dropdown.classList.add('hidden');
  }
});

document.addEventListener('DOMContentLoaded', fetchHeaderNotifications);
</script>
