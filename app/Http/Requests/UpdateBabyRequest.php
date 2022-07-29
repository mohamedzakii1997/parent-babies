<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateBabyRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'babyId'=>['required','integer',Rule::exists('babies', 'id')->where('parent_id',auth('api')->user()->id)],
            'name' => 'required|string|max:191',
            'age' => 'required|numeric',
            'gender' =>  ['required','in:Male,Female'],
        ];
    }

}
