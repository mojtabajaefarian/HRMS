<?php /** @var string $title */ /** @var string $content */ ?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title ?? 'HRMS') ?></title>
<link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<div class="container"><?= $content ?? '' ?></div>
</body>
</html>
