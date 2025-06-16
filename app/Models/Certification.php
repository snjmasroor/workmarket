<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    //

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_certifications');
    }
}
