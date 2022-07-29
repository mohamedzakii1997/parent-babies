<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BabyResource extends JsonResource
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
            'age' => $this->age,
            'gender' => $this->gender,
            'parentName' => $this->parent?$this->parent->name:null,
            'myBaby'=>($this->parent_id == auth('api')->user()->id)?'My Baby':'Partner Baby : ' .auth('api')->user()->partner->name,
        ];
    }
}
