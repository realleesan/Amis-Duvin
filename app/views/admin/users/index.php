<?php
$title = 'Quản lý Nhân sự & Phân quyền — Admin CMS Amis du Vin';
$activeNav = 'users';

ob_start();
?>

<div class="space-y-6">
  <!-- Header & Add Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-border/40 pb-6">
    <div>
      <h2 class="font-heading text-2xl sm:text-3xl text-foreground">Quản lý Nhân sự &amp; Tài khoản CMS</h2>
      <p class="text-sm text-muted-foreground mt-1">Phân quyền vai trò truy cập Admin, CSKH và Marketing</p>
    </div>

    <div class="flex items-center gap-2">
      <button type="button" onclick="openCreateUserModal()" class="btn-wine inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" x2="19" y1="8" y2="14"></line><line x1="22" x2="16" y1="11" y2="11"></line></svg>
        <span>Tạo tài khoản mới</span>
      </button>

      <a href="<?= admin_url('trash') ?>?type=users" class="px-3 py-2.5 rounded-sm bg-rose-500/10 text-rose-400 border border-rose-500/30 hover:bg-rose-500/20 transition-colors text-xs font-medium inline-flex items-center gap-1.5" title="Xem thùng rác nhân sự">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
        <span>Thùng rác</span>
      </a>
    </div>
  </div>

  <!-- Bulk Action Bar -->
  <?php if (($user['role'] ?? '') === 'admin'): ?>
    <div id="bulkUserBar" class="hidden items-center justify-between p-3.5 bg-muted/40 border border-[var(--wine)]/30 rounded-sm shadow-md mb-4">
      <div class="flex items-center gap-2 text-xs text-foreground font-medium">
        <span class="w-2 h-2 rounded-full bg-[var(--gold)] animate-pulse"></span>
        <span>Đã chọn <strong id="bulkUserCount" class="text-[var(--gold)] font-mono font-bold">0</strong> tài khoản</span>
      </div>
      <button type="button" onclick="submitBulkUserDelete()" class="px-3 py-1.5 rounded text-xs font-medium bg-rose-500/15 text-rose-400 border border-rose-500/30 hover:bg-rose-500/25 transition-colors flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
        <span>Chuyển vào Thùng rác</span>
      </button>
    </div>
  <?php endif; ?>

  <!-- Users Table Form -->
  <form id="bulkUserForm" method="POST" action="<?= admin_url('users/bulk-delete') ?>">
    <div class="rounded-sm border border-border/40 bg-card overflow-hidden shadow-sm">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
          <thead>
            <tr class="bg-muted/40 text-[11px] uppercase tracking-wider text-muted-foreground border-b border-border/40 whitespace-nowrap">
              <th class="p-4 w-10 text-center">
                <input type="checkbox" id="selectAllUsers" onclick="toggleSelectAllUsers(this)" class="rounded border-border cursor-pointer">
              </th>
              <th class="p-4 w-20">ID</th>
              <th class="p-4 min-w-[170px]">Họ và tên</th>
              <th class="p-4 min-w-[150px]">Tên đăng nhập</th>
              <th class="p-4 w-32">Vai trò (Role)</th>
              <th class="p-4 w-36">Ngày tạo</th>
              <th class="p-4 w-36 text-right">Thao tác</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-border/40">
            <?php foreach ($users as $u): ?>
              <?php
                $roleBadge = match($u['role']) {
                  'admin' => 'bg-purple-500/15 text-purple-400 border-purple-500/30',
                  'cskh' => 'bg-blue-500/15 text-blue-400 border-blue-500/30',
                  'marketing' => 'bg-[var(--gold)]/15 text-[var(--gold)] border-[var(--gold)]/30',
                  default => 'bg-muted text-muted-foreground border-border'
                };
              ?>
              <tr class="hover:bg-muted/20 transition-colors">
                <td class="p-4 text-center">
                  <?php if ($u['id'] !== ($user['id'] ?? 0)): ?>
                    <input type="checkbox" name="ids[]" value="<?= $u['id'] ?>" class="user-cb rounded border-border cursor-pointer" onchange="updateBulkUserBar()">
                  <?php endif; ?>
                </td>
                <td class="p-4 font-mono text-xs text-muted-foreground">#<?= $u['id'] ?></td>
              <td class="p-4 font-medium text-foreground"><?= htmlspecialchars($u['full_name']) ?></td>
              <td class="p-4 font-mono text-xs text-[var(--gold)]"><?= htmlspecialchars($u['username']) ?></td>
              <td class="p-4 whitespace-nowrap">
                <span class="inline-block text-[10px] font-medium uppercase tracking-wider px-2.5 py-0.5 rounded-full border <?= $roleBadge ?>">
                  <?= htmlspecialchars($u['role']) ?>
                </span>
              </td>
              <td class="p-4 text-xs text-muted-foreground font-mono whitespace-nowrap"><?= date('d/m/Y H:i', strtotime($u['created_at'])) ?></td>
              <td class="p-4 text-right whitespace-nowrap">
                <div class="inline-flex items-center gap-1.5 justify-end">
                  <button type="button" onclick="openEditUserModal(<?= htmlspecialchars(json_encode($u), ENT_QUOTES, 'UTF-8') ?>)" class="px-3 py-1.5 rounded-sm bg-muted text-xs text-foreground hover:bg-[var(--wine)] hover:text-white transition-colors">
                    Sửa tài khoản
                  </button>
                  <?php if ($u['id'] !== ($user['id'] ?? 0)): ?>
                    <form action="<?= admin_url('users/delete') ?>" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn chuyển tài khoản này vào Thùng rác?')">
                      <input type="hidden" name="id" value="<?= $u['id'] ?>">
                      <button type="submit" class="px-2.5 py-1.5 rounded-sm bg-rose-500/10 text-xs text-rose-400 border border-rose-500/20 hover:bg-rose-500/20 transition-colors" title="Xóa tạm">
                        Xóa
                      </button>
                    </form>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</form>
</div>

<!-- Create User Modal -->
<div id="createUserModal" class="modal-overlay">
  <div class="relative w-full max-w-md bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeCreateUserModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-4">Tạo Tài khoản CMS mới</h3>

    <form action="<?= admin_url('users/create') ?>" method="POST" class="space-y-4">
      <div>
        <label for="createFullName" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Họ và tên nhân sự</label>
        <input type="text" id="createFullName" name="full_name" required autocomplete="name" placeholder="Ví dụ: Nguyễn Văn An" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
      </div>

      <div>
        <label for="createUsername" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Tên đăng nhập</label>
        <input type="text" id="createUsername" name="username" required autocomplete="username" placeholder="cskh02" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-mono">
      </div>

      <div>
        <label for="createPassword" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Mật khẩu</label>
        <input type="password" id="createPassword" name="password" required autocomplete="new-password" placeholder="••••••••" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
      </div>

      <div>
        <label for="createRole" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Vai trò (Role)</label>
        <select id="createRole" name="role" autocomplete="off" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
          <option value="cskh" class="bg-card text-foreground">CSKH (Quản lý Đơn tiệc &amp; Sheets)</option>
          <option value="marketing" class="bg-card text-foreground">Marketing (Quản lý Nội dung CMS)</option>
          <option value="admin" class="bg-card text-foreground">Admin (Toàn quyền)</option>
        </select>
      </div>

      <div class="pt-3 flex gap-3">
        <button type="submit" class="btn-wine flex-1 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
          Tạo tài khoản
        </button>
        <button type="button" onclick="closeCreateUserModal()" class="px-5 py-3 rounded-sm bg-muted text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground">
          Hủy
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal-overlay">
  <div class="relative w-full max-w-md bg-card border border-border/40 rounded-sm p-6 sm:p-8 shadow-2xl animate-scale-in my-auto">
    <button onclick="closeEditUserModal()" type="button" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <h3 class="font-heading text-xl text-foreground mb-4">Sửa tài khoản <span id="editUserUsername" class="text-[var(--gold)] font-mono"></span></h3>

    <form action="<?= admin_url('users/update') ?>" method="POST" class="space-y-4">
      <input type="hidden" id="editUserId" name="id" value="">

      <div>
        <label for="editUserFullName" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Họ và tên nhân sự</label>
        <input type="text" id="editUserFullName" name="full_name" required autocomplete="name" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
      </div>

      <div>
        <label for="editUserNewPassword" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Mật khẩu mới (Bỏ trống nếu không đổi)</label>
        <input type="password" id="editUserNewPassword" name="new_password" autocomplete="new-password" placeholder="••••••••" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
      </div>

      <div>
        <label for="editUserRole" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Vai trò (Role)</label>
        <select id="editUserRole" name="role" autocomplete="off" class="input-elegant w-full px-4 py-3 rounded-sm text-sm">
          <option value="cskh" class="bg-card text-foreground">CSKH (Quản lý Đơn tiệc &amp; Sheets)</option>
          <option value="marketing" class="bg-card text-foreground">Marketing (Quản lý Nội dung CMS)</option>
          <option value="admin" class="bg-card text-foreground">Admin (Toàn quyền)</option>
        </select>
      </div>

      <div class="pt-3 flex gap-3">
        <button type="submit" class="btn-wine flex-1 py-3 rounded-sm text-xs uppercase tracking-widest font-medium">
          Cập nhật thông tin
        </button>
        <button type="button" onclick="closeEditUserModal()" class="px-5 py-3 rounded-sm bg-muted text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground">
          Hủy
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function openCreateUserModal() {
  document.getElementById('createUserModal').classList.add('active');
}
function closeCreateUserModal() {
  document.getElementById('createUserModal').classList.remove('active');
}
function openEditUserModal(user) {
  document.getElementById('editUserId').value = user.id;
  document.getElementById('editUserUsername').textContent = user.username;
  document.getElementById('editUserFullName').value = user.full_name;
  document.getElementById('editUserRole').value = user.role;
  document.getElementById('editUserModal').classList.add('active');
}
function closeEditUserModal() {
  document.getElementById('editUserModal').classList.remove('active');
}

function toggleSelectAllUsers(master) {
  const checkboxes = document.querySelectorAll('.user-cb');
  checkboxes.forEach(cb => cb.checked = master.checked);
  updateBulkUserBar();
}

function updateBulkUserBar() {
  const checked = document.querySelectorAll('.user-cb:checked');
  const all = document.querySelectorAll('.user-cb');
  const bar = document.getElementById('bulkUserBar');
  const countEl = document.getElementById('bulkUserCount');
  const master = document.getElementById('selectAllUsers');

  if (countEl) countEl.textContent = checked.length;
  if (bar) {
    if (checked.length > 0) {
      bar.classList.remove('hidden');
      bar.classList.add('flex');
    } else {
      bar.classList.add('hidden');
      bar.classList.remove('flex');
    }
  }
  if (master && all.length > 0) {
    master.checked = (checked.length === all.length);
    master.indeterminate = (checked.length > 0 && checked.length < all.length);
  }
}

function submitBulkUserDelete() {
  const checked = document.querySelectorAll('.user-cb:checked');
  if (checked.length === 0) {
    alert('Vui lòng chọn ít nhất 1 tài khoản để xóa.');
    return;
  }
  if (confirm(`Bạn có chắc chắn muốn chuyển ${checked.length} tài khoản đã chọn vào Thùng rác?`)) {
    document.getElementById('bulkUserForm').submit();
  }
}
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
