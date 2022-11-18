<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ImageResource extends JsonResource
{
    /**
     * Sizes to add to the urls array
     *
     * @var array
     */
    protected $sizes = [];

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, array $sizes = [])
    {
        $this->resource = $resource;
        $this->sizes = $sizes;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'alt_text' => $this->alt_text,
            'caption' => $this->caption,
            'mediatype' => $this->mediatype,
            'mimetype' => $this->mimetype,
            'original_filename' => $this->original_filename,
            'title' => $this->title,
            'url' => $this->getUrl(),
            'urls' => $this->when(count($this->sizes), $this->imageUrls()),
        ];
    }

    /**
     * Image urls to provide with the image
     *
     * @return array
     */
    protected function imageUrls(): array
    {
        $size_array = [];

        /**
         * Ability to alias sizes is a requirement since Ensō uses some resize presets
         * where the first character is a number, but javascript doesn't allow for
         * object attributes that start with numbers when accessing via dot notation.
         */
        foreach ($this->sizes as $key => $value) {
            if (is_numeric($key)) {
                $size_array[$value] = $value;
            } else {
                $size_array[$key] = $value;
            }
        }

        return (new Collection($size_array))
            ->map(function ($size) {
                return $this->resource->getResizeUrl($size, true);
            })->toArray();
    }
}
