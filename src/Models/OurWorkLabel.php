<?php

namespace GIS\OurWorkPages\Models;

use GIS\OurWorkPages\Interfaces\OurWorkLabelInterface;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OurWorkLabel extends Model implements OurWorkLabelInterface
{
    use ShouldSlug;

    protected $fillable = [
        "title",
        "slug",
    ];

    public function works(): BelongsToMany
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        return $this->belongsToMany($modelClass, "our_work_label", "work_id", "label_id");
    }
}
