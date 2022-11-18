<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Yadda\Enso\Crud\Contracts\IsCrudModel as ContractsIsCrudModel;
use Yadda\Enso\Crud\Contracts\Model\IsPublishable as ModelIsPublishable;
use Yadda\Enso\Crud\Traits\IsCrudModel;
use Yadda\Enso\Crud\Traits\Model\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Media\Contracts\ImageFile;
use Yadda\Enso\Meta\Traits\HasMeta;
use Yadda\Enso\Utilities\Helpers;

class Location extends Model implements ContractsIsCrudModel, ModelIsPublishable
{
    use HasMeta,
        IsCrudModel,
        IsPublishable;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'content' => '[]',
        'description_json' => '[]',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
        'description_json' => 'array',
        'hero_image_id' => 'integer',
        'published' => 'boolean',
        'publish_at' => 'datetime',
        'thumbnail_id' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'content',
        'description',
        'description_json',
        'email',
        'glowfox_id',
        'hero_image_id',
        'name',
        'phone',
        'published',
        'publish_at',
        'slug',
        'thumbnail_id',
    ];

    /**
     * Classes that take place in this Location.
     *
     * @return BelongsToMany
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(EnsoCrud::modelClass('class'), 'class_location', 'location_id', 'class_id');
    }

    /**
     * Gets the name of the 'Publish At' DateTime column on this publishable
     *
     * @return string|null
     */
    public function getPublishAtColumn()
    {
        return 'publish_at';
    }

    /**
     * Hero image for this Location
     *
     * @return BelongsTo
     */
    public function heroImage(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'hero_image_id');
    }

    /**
     * Thumbnail image for this Location
     *
     * @return BelongsTo
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'thumbnail_id');
    }

    /**
     * Trainers who teach in this Location.
     *
     * @return BelongsToMany
     */
    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(EnsoCrud::modelClass('trainer'), 'location_trainer', 'location_id', 'trainer_id');
    }
}
