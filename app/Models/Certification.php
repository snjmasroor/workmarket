<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use Flagable, SoftDeletes;
    protected $appends = ['active'];
     protected $fillable = [
        'name',
        'issuing_organization',
        'certification_level',
        'validity_period',
        'expiration_date',
        'verification_method',
    ];

    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_certifications');
    }
}
