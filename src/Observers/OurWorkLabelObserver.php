<?php

namespace GIS\OurWorkPages\Observers;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Interfaces\OurWorkLabelInterface;
use GIS\OurWorkPages\Models\OurWork;
use GIS\OurWorkPages\Models\OurWorkLabel;

class OurWorkLabelObserver
{
    public function creating(OurWorkLabelInterface $label): void
    {
        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        $priority = $modelClass::query()
            ->select("id", "priority")
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $label->priority = $priority + 1;
    }
}
