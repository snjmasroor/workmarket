<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTest extends Model
{
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    public function test()
    {
        return $this->belongsTo(Tests::class, 'test_id');
    }

}
