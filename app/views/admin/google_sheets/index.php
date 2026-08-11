<?php
$title = 'Cấu hình Google Sheets — Admin CMS Amis Duvin';
$activeNav = 'sheets';

ob_start();
?>

<div class="space-y-8 max-w-4xl">
  <!-- Header -->
  <div class="border-b border-border/40 pb-6">
    <h2 class="font-heading text-2xl sm:text-3xl text-foreground">Tích hợp Google Sheets API (Option 1 Master Data)</h2>
    <p class="text-sm text-muted-foreground mt-1">Cấu hình đẩy dữ liệu tự động hoặc thủ công từ CMS sang Google Sheets để báo cáo</p>
  </div>

  <!-- Main Config Card -->
  <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-6 shadow-sm">
    <div class="flex items-center justify-between border-b border-border/40 pb-4">
      <div>
        <span class="text-[10px] uppercase tracking-widest text-[var(--gold)]">Integration Settings</span>
        <h3 class="font-heading text-xl text-foreground">Thông tin Cấu hình Webhook &amp; Spreadsheet ID</h3>
      </div>
      <span class="text-xs uppercase tracking-widest px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 font-medium">Master Data: Admin CMS</span>
    </div>

    <form action="<?= admin_url('google-sheets/update') ?>" method="POST" class="space-y-6">
      <div>
        <label for="sheetsSpreadsheetId" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Google Spreadsheet ID (Mã trang tính)</label>
        <input type="text" id="sheetsSpreadsheetId" name="sheet_id" autocomplete="off" value="<?= htmlspecialchars($config['sheet_id'] ?? '') ?>" required placeholder="Ví dụ: 1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-mono">
        <p class="text-xs text-muted-foreground mt-1.5">Mã ID nằm trên đường dẫn URL của Google Sheet (nằm giữa `/d/` và `/edit`).</p>
      </div>

      <div>
        <label for="sheetsWebhookUrl" class="block text-xs uppercase tracking-widest text-muted-foreground mb-2">Webhook URL / Google Apps Script Webhook URL</label>
        <input type="url" id="sheetsWebhookUrl" name="webhook_url" autocomplete="off" value="<?= htmlspecialchars($config['webhook_url'] ?? '') ?>" placeholder="https://script.google.com/macros/s/AKfycbx.../exec" class="input-elegant w-full px-4 py-3 rounded-sm text-sm font-mono">
        <p class="text-xs text-muted-foreground mt-1.5">Đường dẫn Webhook Google Apps Script nhận dữ liệu Lead tự động đẩy sang hàng cuối Google Sheets.</p>
      </div>

      <div class="grid sm:grid-cols-2 gap-5 pt-2">
        <label class="flex items-center gap-3 cursor-pointer p-4 rounded-sm border border-border/40 bg-card/40">
          <input type="checkbox" name="is_active" <?= !empty($config['is_active']) ? 'checked' : '' ?> class="w-4 h-4 text-[var(--wine)] rounded border-border focus:ring-0">
          <div>
            <span class="block text-sm font-medium text-foreground">Kích hoạt Tích hợp</span>
            <span class="block text-xs text-muted-foreground">Bật/tắt kết nối Google Sheets</span>
          </div>
        </label>

        <label class="flex items-center gap-3 cursor-pointer p-4 rounded-sm border border-border/40 bg-card/40">
          <input type="checkbox" name="auto_sync" <?= !empty($config['auto_sync']) ? 'checked' : '' ?> class="w-4 h-4 text-[var(--wine)] rounded border-border focus:ring-0">
          <div>
            <span class="block text-sm font-medium text-foreground">Tự động Đồng bộ (Auto-Sync)</span>
            <span class="block text-xs text-muted-foreground">Tự động đẩy khi khách vừa đăng ký hoặc khi CSKH đổi trạng thái đơn</span>
          </div>
        </label>
      </div>

      <div class="pt-4 flex flex-wrap gap-4 items-center justify-between border-t border-border/40">
        <button type="submit" class="btn-wine px-6 py-3.5 rounded-sm text-xs uppercase tracking-widest font-medium shadow-md">
          Lưu cấu hình Google Sheets
        </button>

        <form action="<?= admin_url('google-sheets/test') ?>" method="POST" class="inline-block">
          <button type="submit" class="btn-invert px-6 py-3.5 rounded-sm text-xs uppercase tracking-widest font-medium">
            🧪 Bấm Kiểm tra Kết nối (Test Connection)
          </button>
        </form>
      </div>
    </form>
  </div>

  <!-- Google Apps Script Guide Card -->
  <div class="rounded-sm border border-border/40 bg-card p-6 sm:p-8 space-y-4 shadow-sm">
    <h4 class="font-heading text-lg text-foreground flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-code-2 w-5 h-5 text-[var(--gold)]"><path d="m18 16 4-4-4-4"></path><path d="m6 8-4 4 4 4"></path><path d="m14.5 4-5 16"></path></svg>
      <span>Mẫu Google Apps Script cho Google Sheets</span>
    </h4>
    <p class="text-xs text-muted-foreground leading-relaxed">
      Dán đoạn mã dưới đây vào mục <strong>Extensions $\rightarrow$ Apps Script</strong> trong Google Sheets của bạn và bấm <strong>Deploy as Web App</strong> (Quyền truy cập: <em>Anyone</em>) để nhận Webhook URL:
    </p>

    <pre class="bg-card/60 p-4 rounded-sm border border-border/40 text-xs text-foreground/80 font-mono overflow-x-auto selection:bg-[var(--wine)] select-all"><code>function doPost(e) {
  try {
    var data = JSON.parse(e.postData.contents);
    var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
    var lead = data.lead;

    sheet.appendRow([
      lead.lead_code,
      lead.full_name,
      lead.phone,
      lead.email,
      lead.participants,
      lead.booking_date,
      lead.time_slot,
      lead.notes,
      lead.status,
      lead.created_at
    ]);

    return ContentService.createTextOutput(JSON.stringify({status: "success"}))
      .setMimeType(ContentService.MimeType.JSON);
  } catch (err) {
    return ContentService.createTextOutput(JSON.stringify({status: "error", message: err.message}))
      .setMimeType(ContentService.MimeType.JSON);
  }
}</code></pre>
  </div>
</div>

<?php
$adminContent = ob_get_clean();
require __DIR__ . '/../_layout/admin_master.php';
?>
