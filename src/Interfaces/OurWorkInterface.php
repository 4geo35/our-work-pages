<?php

namespace GIS\OurWorkPages\Interfaces;

use ArrayAccess;
use GIS\EditableBlocks\Interfaces\ShouldBlocksInterface;
use GIS\Fileable\Interfaces\ShouldGalleryInterface;
use GIS\Fileable\Interfaces\ShouldImageInterface;
use GIS\Metable\Interfaces\ShouldMetaInterface;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use JsonSerializable;
use Stringable;
interface OurWorkInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable,
    ShouldMetaInterface, ShouldImageInterface, ShouldBlocksInterface
{

}
