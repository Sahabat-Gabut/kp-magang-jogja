<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApprenticeSelectCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request)
    {
        return $this->collection->map->only('id', 'photo', 'team_id', 'jss');
    }
}
