<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'phone' => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:parents,phone',
            'email' => 'required|email|max:191|unique:parents',
            'password' => 'required|string|max:191',
        ];
    }

}
