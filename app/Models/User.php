<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $primaryKey = 'UserId';

    protected $fillable = [
        'UserName',
        'Password',
    ];

    protected $hidden = [
        'Password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
}