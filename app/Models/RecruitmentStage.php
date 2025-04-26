<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruitmentStage extends Model
{
    protected $primaryKey = 'StageId';

    protected $fillable = [
        'ApplicationId',
        'StageName',
        'StageStatus',
        'CompletionDate',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'ApplicationId');
    }
}