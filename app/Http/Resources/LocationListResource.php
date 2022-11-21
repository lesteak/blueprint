<?php

namespace App\Http\Resources;

use App\Http\Resources\ClassListResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\TrainerListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationListResource extends JsonResource
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
            'classes' => $this->whenLoaded('classes', function () {
                return ClassListResource::collection($this->classes);
            }),
            'name' => $this->name,
            'slug' => $this->slug,
            'thumbnail' => $this->whenLoaded('thumbnail', function () {
                return ImageResource::make($this->thumbnail, [
                    'grid_item',
                    'grid_item_2x',
                ]);
            }),
            'trainers' => $this->whenLoaded('trainers', function () {
                return TrainerListResource::collection($this->trainers);
            }),
            'url' => route('locations.show', $this->slug),
        ];
    }
}
