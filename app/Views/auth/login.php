<?php ob_start(); ?>
<div class="card login-card">
    <h1>ورود به HRMS</h1>
    <p>نسخه اولیه صفحه ورود</p>
    <form method="post" action="#">
        <div class="form-group"><label>نام کاربری</label><input type="text" name="username"></div>
        <div class="form-group"><label>رمز عبور</label><input type="password" name="password"></div>
        <button type="submit">ورود</button>
    </form>
    <div class="quick-links">
        <a href="/dashboard">ورود آزمایشی به داشبورد</a>
        <a href="/personnel">لیست پرسنل</a>
    </div>
</div>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
