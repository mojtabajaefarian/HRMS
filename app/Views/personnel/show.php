<?php ob_start(); ?>
<div class="page-header">
    <div>
        <h1>پرونده پرسنلی: <?= htmlspecialchars($person['full_name']) ?></h1>
        <p class="muted">کد پرسنلی: <?= htmlspecialchars($person['personnel_code']) ?> | دسته: <?= htmlspecialchars((string)($person['category_name'] ?? '')) ?> | تیم: <?= htmlspecialchars((string)($person['team_name'] ?? '')) ?></p>
    </div>
    <a class="btn" href="<?= app_config('base_url') ?>/personnel">بازگشت</a>
</div>
<?php if(!empty($flash)): ?><div class='alert success'><?= htmlspecialchars($flash) ?></div><?php endif; ?>

<div class="grid-2">
    <div class="card">
        <h2>اطلاعات پایه</h2>
        <table class="mini-table">
            <tr><th>نام</th><td><?= htmlspecialchars($person['full_name']) ?></td></tr>
            <tr><th>کد ملی</th><td><?= htmlspecialchars((string)($person['national_code'] ?? '')) ?></td></tr>
            <tr><th>موبایل</th><td><?= htmlspecialchars((string)($person['mobile'] ?? '')) ?></td></tr>
            <tr><th>وضعیت پرونده</th><td><?= htmlspecialchars($person['file_status']) ?></td></tr>
            <tr><th>درصد تکمیل</th><td><?= (int)$person['completion_percent'] ?>%</td></tr>
            <tr><th>آخرین بروزرسانی</th><td><?= htmlspecialchars((string)($person['last_updated_at'] ?? '')) ?></td></tr>
            <tr><th>توضیحات</th><td><?= nl2br(htmlspecialchars((string)($person['notes'] ?? ''))) ?></td></tr>
        </table>
    </div>

    <div class="card">
        <h2>سمت‌ها</h2>
        <form method="post" action="<?= app_config('base_url') ?>/personnel/<?= (int)$person['id'] ?>/positions/save">
            <div class="check-grid">
                <?php $selected = array_map(fn($x)=>(int)$x['position_id'], $positions); ?>
                <?php foreach($allPositions as $pos): ?>
                    <label class="check-item">
                        <input type="checkbox" name="position_ids[]" value="<?= (int)$pos['id'] ?>" <?= in_array((int)$pos['id'], $selected, true) ? 'checked' : '' ?>>
                        <span><?= htmlspecialchars($pos['name']) ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="form-actions"><button class="btn primary">ذخیره سمت‌ها</button></div>
        </form>
    </div>
</div>

<div class="grid-3">
    <div class="card">
        <h2>نواقص پرونده</h2>
        <form method="post" action="<?= app_config('base_url') ?>/personnel/<?= (int)$person['id'] ?>/deficiencies/store" class="stack-form">
            <input name="deficiency_title" placeholder="عنوان نقص" required>
            <textarea name="deficiency_description" placeholder="توضیحات"></textarea>
            <input name="due_at" type="datetime-local">
            <select name="deficiency_status"><option value="باز">باز</option><option value="بسته">بسته</option></select>
            <button class="btn primary">ثبت نقص</button>
        </form>
        <table class="mini-table mt">
            <tr><th>عنوان</th><th>وضعیت</th></tr>
            <?php foreach($deficiencies as $row): ?>
                <tr><td><?= htmlspecialchars($row['deficiency_title']) ?></td><td><?= htmlspecialchars($row['deficiency_status']) ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h2>پیگیری‌ها</h2>
        <form method="post" action="<?= app_config('base_url') ?>/personnel/<?= (int)$person['id'] ?>/followups/store" class="stack-form">
            <textarea name="followup_text" placeholder="متن پیگیری" required></textarea>
            <input name="followup_at" type="datetime-local">
            <select name="followup_status"><option value="باز">باز</option><option value="بسته">بسته</option></select>
            <textarea name="result_text" placeholder="نتیجه"></textarea>
            <button class="btn primary">ثبت پیگیری</button>
        </form>
        <table class="mini-table mt">
            <tr><th>پیگیری</th><th>وضعیت</th></tr>
            <?php foreach($followups as $row): ?>
                <tr><td><?= htmlspecialchars($row['followup_text']) ?></td><td><?= htmlspecialchars($row['followup_status']) ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h2>اقدامات</h2>
        <form method="post" action="<?= app_config('base_url') ?>/personnel/<?= (int)$person['id'] ?>/actions/store" class="stack-form">
            <input name="action_title" placeholder="عنوان اقدام" required>
            <textarea name="action_description" placeholder="شرح اقدام"></textarea>
            <input name="action_at" type="datetime-local">
            <select name="action_status"><option value="باز">باز</option><option value="بسته">بسته</option></select>
            <textarea name="result_text" placeholder="نتیجه"></textarea>
            <button class="btn primary">ثبت اقدام</button>
        </form>
        <table class="mini-table mt">
            <tr><th>اقدام</th><th>وضعیت</th></tr>
            <?php foreach($actions as $row): ?>
                <tr><td><?= htmlspecialchars($row['action_title']) ?></td><td><?= htmlspecialchars($row['action_status']) ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php $content = ob_get_clean(); require __DIR__.'/../layouts/main.php'; ?>
