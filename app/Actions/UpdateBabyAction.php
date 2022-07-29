<?php
namespace App\Actions;

use App\Models\Baby;
use Illuminate\Http\Request;


class UpdateBabyAction
{
    public function execute(Request $request):void
    {
        $baby =  Baby::where('id',$request->babyId)->update([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
        ]);

    }
}
