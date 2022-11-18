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

class ClassModel extends Model implements ContractsIsCrudModel, ModelIsPublishable
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
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
        'hero_image_id',
        'name',
        'published',
        'publish_at',
        'slug',
        'thumbnail_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

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
     * Hero image for this Class
     *
     * @return BelongsTo
     */
    public function heroImage(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'hero_image_id');
    }

    /**
     * Locations that this Class is available at.
     *
     * @return BelongsToMany
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(EnsoCrud::modelClass('location'), 'class_location', 'class_id', 'location_id');
    }

    /**
     * Thumbnail image for this Class
     *
     * @return BelongsTo
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Helpers::getConcreteClass(ImageFile::class), 'thumbnail_id');
    }

    /**
     * Trainers who teach this Class.
     *
     * @return BelongsToMany
     */
    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(EnsoCrud::modelClass('trainer'), 'class_trainer', 'class_id', 'trainer_id');
    }
}
