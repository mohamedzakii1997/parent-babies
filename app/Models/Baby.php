<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baby extends Model
{
    protected $fillable = [
        'name',
        'age',
        'gender',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(ParentBaby::class);
    }

}
