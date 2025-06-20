<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCertification extends Model
{
    protected $table = 'job_certifications';
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function certificate()
    {
        return $this->belongsTo(Certification::class, 'certificate_id');
    }
}
