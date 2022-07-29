<?php
namespace App\Http\Controllers;

class BaseResponse extends Controller
{
    public function response($code, $message, $statusCode , $validations = [], $item = 0, $object = null)
    {
        return response()->json(['code' => $code,'message' => $message, 'validation' => $validations,
            'item' => $item, 'object' => $object],$statusCode);
    }
}
