<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTool extends Model
{
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }
}
