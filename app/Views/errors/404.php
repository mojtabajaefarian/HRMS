<?php ob_start(); ?>
<div class="card">
    <h1>404</h1>
    <p>صفحه مورد نظر پیدا نشد.</p>
    <?php if (!empty($debug_path)): ?><p class="muted">مسیر: <?= htmlspecialchars($debug_path) ?></p><?php endif; ?>
    <p><a class="btn" href="<?= app_config('base_url') ?>/">بازگشت</a></p>
</div>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
