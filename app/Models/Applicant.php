<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $primaryKey = 'ApplicantId';

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'ContactNumber',
        'ApplicationDate',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'ApplicantId');
    }
}