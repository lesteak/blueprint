<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Yadda\Enso\Blog\Contracts\PostResource;

class PostListResource extends JsonResource implements PostResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'categories' => $this->whenLoaded('categories', function () {
                return CategoryResource::collection($this->categories);
            }),
            'publish_at' => $this->publish_at ? $this->publish_at->toIso8601String() : null,
            'thumbnail' => $this->whenLoaded('thumbnail', function () {
                return ImageResource::make($this->thumbnail, [
                    'post_thumbnail',
                    'post_thumbnail_2x',
                ]);
            }),
            'title' => $this->title,
            'url' => $this->url,
        ];
    }
}
