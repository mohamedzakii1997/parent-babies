<?php

namespace App\Http\Requests;

class StoreBabyRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'age' => 'required|numeric',
            'gender' =>  ['required','in:Male,Female'],
        ];
    }

}
