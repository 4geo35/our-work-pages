### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/our-work-pages/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/our-work-pages/src/resources/views/admin/**/*.blade.php",
    "./vendor/4geo35/our-work-pages/src/resources/views/livewire/admin/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/our-work-pages/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/our-work-pages/src/resources/views/web/**/*.blade.php",
    "./vendor/4geo35/our-work-pages/src/resources/views/livewire/web/**/*.blade.php"

Запустить миграции для создания таблиц `php artisan migrate`

#### Views

Сокращение для представлений: `owp`  
Меню для панели администрирования: `<x-owp::menu-item/>`

#### Livewire Components

Web

- `owp-web-our-works-index`: список тизеров

#### Config

Название файла: `our-work-pages`

- `urlPrefix` => `our-works`: адрес страницы
- `pageTitle` => `Наши работы`: заголовок станицы
- `useBreadcrumbs` => `true`: выводить хлебные крошки на странице
- `useH1` => `true`: выводить h1
- `queryLabelKey` => `label`: название для метки в параметрах адреса
- `showTeaserOnShowPage` => true: Выводить тизер на странице просмотра, если выключить, то блоки будут на всю ширину
- `fullPageBlocks` => `false`: Блоки на всю ширину, если выбран этот вариант, то нужно ставить изображение, иначе фигня выйдет
- `fullAside` => `true`: Тизер сбоку с полным описанием и картинкой, при отображении не на всю страницу
- `showBtnText` => `Подробнее о проекте`: текст кнопки
- `allowedBlocks` => `[]`: доступные блоки
