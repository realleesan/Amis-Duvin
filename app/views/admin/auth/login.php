<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập Admin CMS — Amis du Vin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          borderRadius: {
            lg: 'var(--radius)',
            md: 'calc(var(--radius) - 2px)',
            sm: 'calc(var(--radius) - 4px)'
          },
          colors: {
            background: 'hsl(var(--background))',
            foreground: 'hsl(var(--foreground))',
            card: {
              DEFAULT: 'hsl(var(--card))',
              foreground: 'hsl(var(--card-foreground))'
            },
            popover: {
              DEFAULT: 'hsl(var(--popover))',
              foreground: 'hsl(var(--popover-foreground))'
            },
            primary: {
              DEFAULT: 'hsl(var(--primary))',
              foreground: 'hsl(var(--primary-foreground))'
            },
            secondary: {
              DEFAULT: 'hsl(var(--secondary))',
              foreground: 'hsl(var(--secondary-foreground))'
            },
            muted: {
              DEFAULT: 'hsl(var(--muted))',
              foreground: 'hsl(var(--muted-foreground))'
            },
            accent: {
              DEFAULT: 'hsl(var(--accent))',
              foreground: 'hsl(var(--accent-foreground))'
            },
            destructive: {
              DEFAULT: 'hsl(var(--destructive))',
              foreground: 'hsl(var(--destructive-foreground))'
            },
            border: 'hsl(var(--border))',
            input: 'hsl(var(--input))',
            ring: 'hsl(var(--ring))'
          },
          fontFamily: {
            heading: ['var(--font-heading)'],
            serifDisplay: ['var(--font-serif)'],
            sans: ['var(--font-body)'],
            signature: ['var(--font-signature)']
          }
        }
      }
    };
  </script>
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body class="bg-background text-foreground min-h-screen flex items-center justify-center p-5">
  <div class="max-w-md w-full bg-card border border-border/40 rounded-sm p-8 sm:p-10 shadow-2xl space-y-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-wine-radial opacity-30 pointer-events-none"></div>

    <div class="relative z-10 text-center space-y-4">
      <div class="flex justify-center mb-2">
        <img src="https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png" alt="Amis du Vin" class="h-16 w-auto object-contain">
      </div>

      <p class="text-[10px] uppercase tracking-[0.35em] text-[var(--gold)] font-medium">Hệ thống Quản trị CMS</p>
      <h2 class="font-heading text-2xl text-foreground">Đăng nhập tài khoản</h2>

      <?php if (!empty($error)): ?>
        <div class="p-3.5 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs text-center">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="/admin/login" method="POST" class="space-y-4 text-left pt-2">
        <div>
          <label for="loginUsername" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Tên đăng nhập</label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </span>
            <input type="text" id="loginUsername" name="username" required placeholder="admin / cskh / marketing" class="input-elegant w-full pl-11 pr-4 py-3.5 rounded-sm text-sm" autocomplete="username">
          </div>
        </div>

        <div>
          <label for="loginPassword" class="block text-xs uppercase tracking-[0.15em] text-foreground/60 mb-2">Mật khẩu</label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock w-4 h-4"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </span>
            <input type="password" id="loginPassword" name="password" required placeholder="••••••••" class="input-elegant w-full pl-11 pr-4 py-3.5 rounded-sm text-sm" autocomplete="current-password">
          </div>
        </div>

        <button type="submit" class="btn-wine w-full py-4 rounded-sm text-xs uppercase tracking-[0.2em] font-medium shadow-lg mt-4 min-h-[48px]">
          Đăng nhập CMS
        </button>
      </form>

      <div class="pt-4 border-t border-border/40 text-[11px] text-muted-foreground">
        <p>Amis du Vin Admin Panel &copy; 2026</p>
      </div>
    </div>
  </div>
</body>
</html>
