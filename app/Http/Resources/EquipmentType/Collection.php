<?php

namespace App\Http\Resources\EquipmentType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
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
            'data' => \App\Http\Resources\EquipmentType\Resource::collection($this->collection),
        ];
    }
}
