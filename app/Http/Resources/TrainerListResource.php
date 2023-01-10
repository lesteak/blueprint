<?php

namespace App\Http\Resources;

use App\Http\Resources\ClassListResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\LocationListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerListResource extends JsonResource
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
            'locations' => $this->whenLoaded('locations', function () {
                return LocationListResource::collection($this->locations);
            }),
            'name' => $this->name,
            'role' => $this->role,
            'slug' => $this->slug,
            'thumbnail' => $this->whenLoaded('thumbnail', function () {
                return ImageResource::make($this->thumbnail, [
                    'grid_square',
                    'grid_square_2x',
                ]);
            }),
            'url' => route('trainers.show', $this->slug),
        ];
    }
}
