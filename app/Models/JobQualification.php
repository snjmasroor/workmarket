<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    
    protected $table = 'job_qualifications';
    protected $fillable = [
        'job_id', 'education_level', 'min_years_experience', 'field', 'language',];
    public function postJob()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
