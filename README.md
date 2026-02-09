### Установка

Добавить `"./vendor/4geo35/our-work-pages/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/our-work-pages/src/resources/views/admin/**/*.blade.php",
"./vendor/4geo35/our-work-pages/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить `"./vendor/4geo35/our-work-pages/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/our-work-pages/src/resources/views/web/**/*.blade.php",
"./vendor/4geo35/our-work-pages/src/resources/views/livewire/web/**/*.blade.php"` в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`
