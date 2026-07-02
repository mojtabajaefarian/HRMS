HRMS HOTFIX v0.4.1

علت خطا:
در فایل routes/web.php نسخه قبلی، عبارت PHP opening tag و ساختار فایل به شکلی بود که در بعضی سیستم‌ها متغیر $router به‌درستی در context فایل require شده resolve نمی‌شد و نتیجه این خطا بود:
Undefined variable $router
Call to a member function get() on null

این هات‌فیکس فقط routes/web.php را جایگزین می‌کند.
بعد از Replace کردن فایل، دوباره این آدرس‌ها را تست کنید:
1) /HRMS/public/
2) /HRMS/public/personnel
3) /HRMS/public/personnel/1
