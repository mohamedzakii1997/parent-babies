<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'email' => 'required|string|max:191|exists:parents,email',
            'password' => 'required|string|max:191',
        ];
    }

}
