<?php ob_start(); ?>
<div class="page-header">
    <div><h1>داشبورد</h1><p class="muted">نمای کلی وضعیت منابع انسانی</p></div>
    <a class="btn primary" href="<?= app_config('base_url') ?>/personnel/create">+ ثبت پرسنل</a>
</div>
<div class="stats-grid">
    <div class="card stat"><div class="stat-num"><?= (int)$stats['personnel'] ?></div><div class="stat-label">کل پرسنل</div></div>
    <div class="card stat"><div class="stat-num"><?= (int)$stats['open_deficiencies'] ?></div><div class="stat-label">نقص‌های باز</div></div>
    <div class="card stat"><div class="stat-num"><?= (int)$stats['open_followups'] ?></div><div class="stat-label">پیگیری‌های باز</div></div>
    <div class="card stat"><div class="stat-num"><?= (int)$stats['open_actions'] ?></div><div class="stat-label">اقدامات باز</div></div>
</div>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
