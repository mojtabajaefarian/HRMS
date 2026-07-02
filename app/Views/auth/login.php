<?php ob_start(); ?>
<div class="card login-card">
    <h1>ورود به سامانه HRMS</h1>
    <p class="muted">نسخه 0.5 — هسته پایدار + پرونده پرسنلی + پیگیری‌ها</p>
    <?php if (!empty($flash)): ?><div class="alert error"><?= htmlspecialchars($flash) ?></div><?php endif; ?>
    <form method="post" action="<?= app_config('base_url') ?>/login">
        <label>نام کاربری</label>
        <input name="username" placeholder="مثال: admin" required>
        <label>رمز عبور</label>
        <input type="password" name="password" placeholder="رمز عبور" required>
        <button class="btn primary">ورود</button>
    </form>
    <p class="muted mt">کاربر پیش‌فرض: <b>admin</b> / رمز: <b>123456</b></p>
</div>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
