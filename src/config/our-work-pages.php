<?php

return [
    "urlPrefix" => "our-works",
    "pageTitle" => "Наши работы",

    "useBreadcrumbs" => true,
    "useH1" => true,

    "queryLabelKey" => "label",

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
];
