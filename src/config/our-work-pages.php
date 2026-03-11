<?php

return [
    "urlPrefix" => "our-works",
    "pageTitle" => "Наши работы",

    "useBreadcrumbs" => true,
    "useH1" => true,

    "queryLabelKey" => "label",

    "fullPageBlocks" => true, // Блоки на всю ширину
    "fullAside" => true, // Тизер сбоку с полным описанием и картинкой, при отображении не на всю страницу

    // Btn text
    "showBtnText" => "Подробнее о проекте",

    // Settings
    "allowedBlocks" => [],

    // Models
    "customOurWorkModel" => null,
    "customOurWorkModelObserver" => null,

    "customOurWorkLabelModel" => null,
    "customOurWorkLabelModelObserver" => null,

    // Controllers
    "customOurWorkAdminController" => null,

    "customOurWorkWebController" => null,

    // Components
    "customAdminOurWorkIndexComponent" => null,
    "customAdminOurWorkShowComponent" => null,
    "customAdminOurWorkLabelListComponent" => null,

    "customWebOurWorkIndexComponent" => null,

    // Policies
    "ourWorkPolicy" => \GIS\OurWorkPages\Policies\OurWorkPolicy::class,
    "ourWorkPolicyKey" => "our_works",
    "ourWorkPolicyTitle" => "Управление нашими работами",

    "ourWorkLabelPolicy" => \GIS\OurWorkPages\Policies\OurWorkLabelPolicy::class,
    "ourWorkLabelPolicyKey" => "our_work_labels",
    "ourWorkLabelPolicyTitle" => "Управление метками наших работ",

    // Templates
    "templates" => [
        "our-work-teaser" => \GIS\OurWorkPages\Templates\OurWorkTeaser::class,
        "tablet-our-work-teaser" => \GIS\OurWorkPages\Templates\TabletOurWorkTeaser::class,
        "mobile-our-work-teaser" => \GIS\OurWorkPages\Templates\MobileOurWorkTeaser::class,

        "our-work-aside" => \GIS\OurWorkPages\Templates\OurWorkAside::class,
    ],
];
