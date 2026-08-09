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

    <button type="button" onclick="openCreateUserModal()" class="btn-wine inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" x2="19" y1="8" y2="14"></line><line x1="22" x2="16" y1="11" y2="11"></line></svg>
      <span>Tạo tài khoản mới</span>
    </button>
  </div>

  <!-- Users Table -->
  <div class="rounded-sm border border-border/40 bg-card overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm border-collapse">
        <thead>
          <tr class="bg-muted/40 text-[11px] uppercase tracking-wider text-muted-foreground border-b border-border/40">
            <th class="p-4">ID</th>
            <th class="p-4">Họ và tên</th>
            <th class="p-4">Tên đăng nhập</th>
            <th class="p-4">Vai trò (Role)</th>
            <th class="p-4">Ngày tạo</th>
            <th class="p-4 text-right">Thao tác</th>
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
              <td class="p-4 font-mono text-xs text-muted-foreground">#<?= $u['id'] ?></td>
              <td class="p-4 font-medium text-foreground"><?= htmlspecialchars($u['full_name']) ?></td>
              <td class="p-4 font-mono text-xs text-[var(--gold)]"><?= htmlspecialchars($u['username']) ?></td>
              <td class="p-4">
                <span class="inline-block text-[10px] font-medium uppercase tracking-wider px-2.5 py-0.5 rounded-full border <?= $roleBadge ?>">
                  <?= htmlspecialchars($u['role']) ?>
                </span>
              </td>
              <td class="p-4 text-xs text-muted-foreground"><?= date('d/m/Y H:i', strtotime($u['created_at'])) ?></td>
              <td class="p-4 text-right">
                <button type="button" onclick="openEditUserModal(<?= htmlspecialchars(json_encode($u), ENT_QUOTES, 'UTF-8') ?>)" class="px-3 py-1.5 rounded-sm bg-muted text-xs text-foreground hover:bg-[var(--wine)] hover:text-white transition-colors">
                  Sửa tài khoản
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
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
</script>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
