<?php ob_start(); ?>
<h1>404</h1>
<p>صفحه مورد نظر پیدا نشد.</p>
<p><a href="/login">بازگشت به ورود</a></p>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
