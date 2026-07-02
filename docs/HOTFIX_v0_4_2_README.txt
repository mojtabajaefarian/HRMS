HRMS HOTFIX v0.4.2

مشکل اصلی از routes/web.php تنها نبود؛ در واقع public/index.php باید قبل از require کردن routes/web.php
یک نمونه از Router بسازد و داخل متغیر $router قرار دهد.

در این هات‌فیکس:
1) public/index.php اصلاح شده
2) routes/web.php هم طوری اصلاح شده که اگر Router موجود نبود، خطای واضح بدهد

فایل‌هایی که باید Replace شوند:
- public/index.php
- routes/web.php
