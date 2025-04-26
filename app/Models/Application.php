<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $primaryKey = 'ApplicationId';

    protected $fillable = [
        'ApplicantId',
        'JobId',
        'ApplicationStatus',
        'ReviewDate',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'ApplicantId');
    }

    public function job()
    {
        return $this->belongsTo(JobPosition::class, 'JobId');
    }

    public function recruitmentStages()
    {
        return $this->hasMany(RecruitmentStage::class, 'ApplicationId');
    }
}