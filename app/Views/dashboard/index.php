<?php ob_start(); ?>
<h1>داشبورد HRMS</h1>
<div class="grid">
    <div class="card"><strong>تعداد پرسنل</strong><br>0</div>
    <div class="card"><strong>پرونده کامل</strong><br>0</div>
    <div class="card"><strong>پرونده ناقص</strong><br>0</div>
    <div class="card"><strong>پیگیری‌ها</strong><br>0</div>
</div>
<p><a href="/personnel">مشاهده لیست پرسنل</a></p>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
