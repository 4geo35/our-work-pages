<?php

return [
    // Settings
    "allowedBlocks" => [],

    // Models
    "customOurWorkModel" => null,
    "customOurWorkModelObserver" => null,

    // Controllers
    "customOurWorkAdminController" => null,

    // Components
    "customAdminOurWorkIndexComponent" => null,
    "customAdminOurWorkShowComponent" => null,

    // Policies
    "ourWorkPolicy" => \GIS\OurWorkPages\Policies\OurWorkPolicy::class,
    "ourWorkPolicyKey" => "our_works",
    "ourWorkPolicyTitle" => "Управление нашими работами",
];
