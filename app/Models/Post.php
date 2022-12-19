<?php

namespace App\Models;

use Yadda\Enso\Blog\Models\Post as BaseClass;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Yadda\Enso\Media\Contracts\ImageFile;
use Yadda\Enso\Utilities\Helpers;

class Post extends BaseClass
{
    /**
     * Thumbnail image for this Location
     *
     * @return BelongsTo
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'thumbnail_id');
    }
}
