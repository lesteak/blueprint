<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Yadda\Enso\Crud\Contracts\IsCrudModel as ContractsIsCrudModel;
use Yadda\Enso\Crud\Contracts\Model\IsPublishable as ModelIsPublishable;
use Yadda\Enso\Crud\Traits\HasFlexibleFields;
use Yadda\Enso\Crud\Traits\IsCrudModel;
use Yadda\Enso\Crud\Traits\Model\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Media\Contracts\ImageFile;
use Yadda\Enso\Meta\Traits\HasMeta;
use Yadda\Enso\Utilities\Helpers;

class Trainer extends Model implements ContractsIsCrudModel, ModelIsPublishable
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
        'content',
        'description',
        'description_json',
        'hero_image_id',
        'name',
        'published',
        'publish_at',
        'role',
        'slug',
        'thumbnail_id',
    ];

    /**
     * Classes that this trainer teaches.
     *
     * @return BelongsToMany
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(EnsoCrud::modelClass('class'), 'class_trainer', 'trainer_id', 'class_id');
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
        return 'view-unpublished-trainers';
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
     * Hero image for this Trainer
     *
     * @return BelongsTo
     */
    public function heroImage(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'hero_image_id');
    }

    /**
     * Locations that this Trainer teaches at.
     *
     * @return BelongsToMany
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(EnsoCrud::modelClass('location'));
    }

    /**
     * Thumbnail image for this Trainer
     *
     * @return BelongsTo
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'thumbnail_id');
    }
}
