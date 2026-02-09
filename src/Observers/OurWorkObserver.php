<?php

namespace GIS\OurWorkPages\Observers;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Models\OurWork;

class OurWorkObserver
{
    public function creating(OurWorkInterface $ourWork): void
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $priority = $modelClass::query()
            ->select("id", "priority")
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $ourWork->priority = $priority + 1;
    }
}
