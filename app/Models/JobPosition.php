<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    protected $primaryKey = 'JobId';

    protected $fillable = [
        'Title',
        'Department',
        'Description',
        'RequiredQualifications',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'JobId');
    }
}