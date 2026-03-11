<?php

namespace GIS\OurWorkPages\Models;

use GIS\EditableBlocks\Traits\ShouldBlocks;
use GIS\Fileable\Traits\ShouldImage;
use GIS\Metable\Traits\ShouldMeta;
use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OurWork extends Model implements OurWorkInterface
{
    use ShouldSlug, ShouldMeta, ShouldImage, ShouldMarkdown, ShouldBlocks;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "description",

        "date_from",
        "date_to",
        "author_name",

        "published_at",
    ];

    public function labels(): BelongsToMany
    {
        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        return $this->belongsToMany($modelClass, "our_work_label", "label_id", "work_id");
    }

    public function getHumanFromAttribute(): ?string
    {
        $value = $this->date_from;
        if (empty($value)) { return $value; }
        return date_helper()->format($value, "d.m.Y");
    }

    public function getHumanToAttribute(): ?string
    {
        $value = $this->date_to;
        if (empty($value)) { return $value; }
        return date_helper()->format($value, "d.m.Y");
    }
}
