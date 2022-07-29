<?php

namespace App\Http\Controllers;


use App\Actions\RegisterParentAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ParentResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class AuthController extends BaseResponse
{



    public function register(RegisterRequest $request,RegisterParentAction $registerParentAction)
    {
        DB::beginTransaction();
        try {
            // action that register parent
            $parent =   $registerParentAction->execute($request);

            DB::commit();
            return $this->response(200, $parent->api_token, 200, [], 0, [
                'parent' => new ParentResource($parent),
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }
    }


    public function login(LoginRequest $request)
    {
        if (Auth::guard('parent')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            $parent = Auth::guard('parent')->user();
            if (!$parent->api_token) {
                $parent->api_token = Str::random(80);
                $parent->save();
            }
            return $this->response(200, $parent->api_token, 200, [], 0, [
                'parent' => new ParentResource($parent),
            ]);
        }
        return $this->response(101, 'Validation Error', 200, ['parent not found']);
    }


    public function logout()
    {
        $parent = auth('api')->user();
        $parent->api_token = null;
        $parent->save();
        return $this->response(200, 'You are logged out successfully', 200);
    }


}
