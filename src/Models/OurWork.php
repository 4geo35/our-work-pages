<?php

namespace GIS\OurWorkPages\Models;

use GIS\EditableBlocks\Traits\ShouldBlocks;
use GIS\Fileable\Traits\ShouldImage;
use GIS\Metable\Traits\ShouldMeta;
use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;

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
}
