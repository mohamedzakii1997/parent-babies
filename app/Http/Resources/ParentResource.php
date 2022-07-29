<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'route' => 'parent',
            'id' => intval($this->id),
            'name' => $this->name,
            'phone'=>$this->phone,
            'email'=>$this->email,
        ];
    }
}
