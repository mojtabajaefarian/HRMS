<?php ob_start(); ?>
<div class='page-header'>
    <div><h1>مدیریت پرسنل</h1><p class='muted'>لیست پرسنل و وضعیت پرونده‌ها</p></div>
    <a class='btn primary' href='<?= app_config('base_url') ?>/personnel/create'>+ ثبت پرسنل جدید</a>
</div>
<?php if(!empty($flash)): ?><div class='alert success'><?= htmlspecialchars($flash) ?></div><?php endif; ?>
<div class='card'>
<table class='table'>
<thead>
<tr><th>ردیف</th><th>کد پرسنلی</th><th>نام</th><th>کد ملی</th><th>موبایل</th><th>دسته</th><th>تیم</th><th>وضعیت پرونده</th><th>درصد تکمیل</th><th>جزئیات</th></tr>
</thead>
<tbody>
<?php if(empty($rows)): ?>
<tr><td colspan='10' class='empty'>هنوز پرسنلی ثبت نشده است.</td></tr>
<?php else: foreach($rows as $r): ?>
<tr>
<td><?= htmlspecialchars((string)($r['row_no'] ?? '')) ?></td>
<td><?= htmlspecialchars((string)$r['personnel_code']) ?></td>
<td><?= htmlspecialchars((string)$r['full_name']) ?></td>
<td><?= htmlspecialchars((string)($r['national_code'] ?? '')) ?></td>
<td><?= htmlspecialchars((string)($r['mobile'] ?? '')) ?></td>
<td><?= htmlspecialchars((string)($r['category_name'] ?? '')) ?></td>
<td><?= htmlspecialchars((string)($r['team_name'] ?? '')) ?></td>
<td><?= htmlspecialchars((string)$r['file_status']) ?></td>
<td><?= (int)($r['completion_percent'] ?? 0) ?>%</td>
<td><a class="btn small" href="<?= app_config('base_url') ?>/personnel/<?= (int)$r['id'] ?>">پرونده</a></td>
</tr>
<?php endforeach; endif; ?>
</tbody></table></div>
<?php $content = ob_get_clean(); require __DIR__.'/../layouts/main.php'; ?>
