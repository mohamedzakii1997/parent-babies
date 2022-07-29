<?php
namespace App\Actions;


use App\Models\Baby;
use Illuminate\Http\Request;

class DeleteBabyAction
{
    public function execute(Request $request)
    {
         Baby::where('parent_id',auth('api')->user()->id)
            ->where('id',$request->babyId)->delete();


    }
}
