<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ShowBabyRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'babyId'=>['required','integer',Rule::exists('babies', 'id')->where('parent_id',auth('api')->user()->id)],
        ];
    }

}
