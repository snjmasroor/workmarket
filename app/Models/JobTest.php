<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTest extends Model
{
    protected $fillable = [
        'job_id',
        'test_id',
        'scoring_criteria',
        // add any other fields you're trying to save
    ];
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    public function test()
    {
        return $this->belongsTo(Tests::class, 'test_id');
    }

}
