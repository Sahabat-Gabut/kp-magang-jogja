<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        => $this->id,
            'fullname'  => $this->fullname,
            'username'  => $this->username,
            'admin'     => $this->whenLoaded('admin'),
            'apprentice'=> $this->whenLoaded('apprentice')
        ];
    }
}
