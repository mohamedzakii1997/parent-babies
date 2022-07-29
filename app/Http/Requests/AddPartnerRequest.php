<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AddPartnerRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'partnerId'=>['required','integer',Rule::exists('parents', 'id')->where(function ($query) {
                return $query->where('id','!=',auth('api')->user()->id);
            })],
        ];
    }

}
