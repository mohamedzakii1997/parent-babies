<?php

namespace App\Http\Requests;

use App\Http\Controllers\BaseResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new BaseResponse();
        throw new HttpResponseException($response->response(101, 'Validation Error',200, $validator->errors()->all()));
    }
}
