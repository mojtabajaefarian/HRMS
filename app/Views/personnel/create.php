<?php ob_start(); ?>
<div class='page-header'>
    <div><h1>ثبت پرسنل جدید</h1><p class='muted'>اطلاعات پایه پرونده پرسنلی</p></div>
    <a class='btn' href='<?= app_config('base_url') ?>/personnel'>بازگشت</a>
</div>
<form class='card form-card' method='post' action='<?= app_config('base_url') ?>/personnel/store'>
<div class='form-grid'>
<div><label>شماره ردیف</label><input name='row_no'></div>
<div><label>کد پرسنلی</label><input name='personnel_code' required></div>
<div class='span-2'><label>نام و نام خانوادگی</label><input name='full_name' required></div>
<div><label>کد ملی</label><input name='national_code'></div>
<div><label>موبایل</label><input name='mobile'></div>
<div><label>دسته</label><select name='category_id'><option value=''>انتخاب کنید</option><?php foreach($categories as $item): ?><option value='<?= (int)$item['id'] ?>'><?= htmlspecialchars($item['name']) ?></option><?php endforeach; ?></select></div>
<div><label>تیم</label><select name='team_id'><option value=''>انتخاب کنید</option><?php foreach($teams as $item): ?><option value='<?= (int)$item['id'] ?>'><?= htmlspecialchars($item['name']) ?></option><?php endforeach; ?></select></div>
<div><label>وضعیت پرونده</label><select name='file_status'><option value='ناقص'>ناقص</option><option value='تکمیل'>تکمیل</option></select></div>
<div><label>درصد تکمیل</label><input type='number' min='0' max='100' name='completion_percent' value='0'></div>
<div class='span-2'><label>توضیحات</label><textarea name='notes' rows='4'></textarea></div>
</div>
<div class='form-actions'><button class='btn primary' type='submit'>ثبت پرسنل</button></div>
</form>
<?php $content = ob_get_clean(); require __DIR__.'/../layouts/main.php'; ?>
