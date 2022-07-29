<?php
namespace App\Actions;

use App\Models\ParentBaby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterParentAction
{
    public function execute(Request $request)
    {

        $parent =  ParentBaby::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $parent->api_token = Str::random(80);
        $parent->save();
        return $parent;
    }
}
