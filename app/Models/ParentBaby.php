<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ParentBaby extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'parents';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'api_token',
    ];


    public function partner()
    {
        return $this->hasOne(ParentBaby::class,'id','partner_id');
    }

    public function babies()
    {
        return $this->hasMany(Baby::class);
    }


}
