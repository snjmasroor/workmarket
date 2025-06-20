<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    
    protected $table = 'job_qualifications';
    public function postJob()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
