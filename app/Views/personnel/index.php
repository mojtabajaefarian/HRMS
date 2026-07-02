<?php ob_start(); ?>
<h1>لیست پرسنل</h1>
<table class="table">
<thead><tr><th>ردیف</th><th>نام و نام خانوادگی</th><th>تیم</th><th>وضعیت پرونده</th></tr></thead>
<tbody>
<?php foreach (($rows ?? []) as $row): ?>
<tr>
<td><?= (int)$row['id'] ?></td>
<td><?= htmlspecialchars($row['full_name']) ?></td>
<td><?= htmlspecialchars($row['team']) ?></td>
<td><?= htmlspecialchars($row['status']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<p><a href="/dashboard">بازگشت به داشبورد</a></p>
<?php $content = ob_get_clean(); require __DIR__ . '/../layouts/main.php'; ?>
