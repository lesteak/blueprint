<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Yadda\Enso\Crud\Contracts\IsCrudModel as ContractsIsCrudModel;
use Yadda\Enso\Crud\Contracts\Model\IsPublishable as ModelIsPublishable;
use Yadda\Enso\Crud\Traits\HasFlexibleFields;
use Yadda\Enso\Crud\Traits\IsCrudModel;
use Yadda\Enso\Crud\Traits\Model\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Media\Contracts\ImageFile;
use Yadda\Enso\Meta\Traits\HasMeta;
use Yadda\Enso\Utilities\Helpers;

class Location extends Model implements ContractsIsCrudModel, ModelIsPublishable
{
    use HasMeta,
        HasFlexibleFields,
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
        'geo' => '[]',
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
        'geo' => 'array',
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
        'geo',
        'glowfox_id',
        'name',
        'phone',
        'published',
        'publish_at',
        'slug',
        'thumbnail_id',
        'hero_image_id',
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
     * Gets the Geolocation latitude for this Location.
     *
     * @return float|null
     */
    public function getLat(): ?float
    {
        return Arr::get($this->geo, 'location.lat', null);
    }

    /**
     * Gets the Geolocation longitude for this Location.
     *
     * @return float|null
     */
    public function getLng(): ?float
    {
        return Arr::get($this->geo, 'location.lng', null);
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
     * Name of the permission that allows users to view a page irrespective of
     * it's publishing state.
     *
     * @return string|null
     */
    public function getPublishViewOverridePermission()
    {
        return 'view-unpublished-locations';
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Whether this Location has a geolocation set. We assume that 0,0 is NOT a
     * valid location for this purpose.
     *
     * @return bool
     */
    public function hasGeoLocation(): bool
    {
        return !empty($this->getLat()) && !empty($this->getLng());
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

    /**
     * Hero image for this Trainer
     *
     * @return BelongsTo
     */
    public function heroImage(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'hero_image_id');
    }
}
