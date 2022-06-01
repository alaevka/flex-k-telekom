<?php

namespace App\Http\Resources\Equipment;

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
            'data' => \App\Http\Resources\Equipment\Resource::collection($this->collection),
        ];
    }
}
