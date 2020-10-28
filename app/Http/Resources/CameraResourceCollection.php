<?php

namespace App\Http\Resources;

use App\Models\Camera;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CameraResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function (Camera $camera) {
                return [
                    'latitude' => $camera->latitude,
                    'longitude' => $camera->longitude,
                    'name' => $camera->name,
                ];
            })
        ];
    }
}
