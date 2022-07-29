<?php
namespace App\Actions;


use App\Models\Baby;
use Illuminate\Http\Request;

class AddPartnerAction
{
    public function execute(Request $request)
    {
       $parent =  auth('api')->user();
       $parent->partner_id = $request->partnerId;
       $parent->save();
    }
}
