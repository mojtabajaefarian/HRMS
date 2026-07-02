<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'HRMS') ?></title>
    <link rel="stylesheet" href="<?= app_config('base_url') ?>/assets/css/app.css">
</head>
<body>
<div class="topbar">
    <div class="brand">سام‌فون HRMS</div>
    <div class="top-links">
        <?php if (\App\Core\Auth::check()): ?>
            <a href="<?= app_config('base_url') ?>/dashboard">داشبورد</a>
            <a href="<?= app_config('base_url') ?>/personnel">پرسنل</a>
            <a href="<?= app_config('base_url') ?>/logout">خروج</a>
        <?php endif; ?>
    </div>
</div>
<div class="page-wrap"><?= $content ?? '' ?></div>
</body>
</html>
