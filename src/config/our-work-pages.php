<?php

return [
    // Settings
    "allowedBlocks" => [],

    // Models
    "customOurWorkModel" => null,
    "customOurWorkModelObserver" => null,

    "customOurWorkLabelModel" => null,
    "customOurWorkLabelModelObserver" => null,

    // Controllers
    "customOurWorkAdminController" => null,

    // Components
    "customAdminOurWorkIndexComponent" => null,
    "customAdminOurWorkShowComponent" => null,

    // Policies
    "ourWorkPolicy" => \GIS\OurWorkPages\Policies\OurWorkPolicy::class,
    "ourWorkPolicyKey" => "our_works",
    "ourWorkPolicyTitle" => "Управление нашими работами",

    "ourWorkLabelPolicy" => \GIS\OurWorkPages\Policies\OurWorkLabelPolicy::class,
    "ourWorkLabelPolicyKey" => "our_work_labels",
    "ourWorkLabelPolicyTitle" => "Управление метками наших работ",
];
