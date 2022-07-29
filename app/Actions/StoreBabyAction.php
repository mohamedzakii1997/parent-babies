<?php
namespace App\Actions;

use App\Models\Baby;
use Illuminate\Http\Request;


class StoreBabyAction
{
    public function execute(Request $request):void
    {
        $baby =  Baby::create([
            'parent_id'=>auth('api')->user()->id,
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
        ]);

    }
}
