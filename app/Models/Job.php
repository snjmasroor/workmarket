<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use App\Models\Skill;
use App\Models\JobSkill;

class Job extends Model
{
    protected $fillable = [
    'user_id', 'title', 'description', 'industry_id', 'budget', 'deadline', 'flags'];
    protected $table = 'post_jobs';

    protected $appends = ['active', 'fixed', 'hourly', 'remote', 'onsite', 'open', 'in_progress', 'completed', 'cancelled'];
    use Flagable;
   
    public const FLAG_ACTIVE   = 1; // 1
    public const FLAG_FIXED        = 2; // 2
    public const FLAG_HOURLY       = 4; // 4
    public const FLAG_REMOTE       = 8; // 8
    public const FLAG_ONSITE       = 16; // 16
    public const FLAG_OPEN         = 32; // 32
    public const FLAG_IN_PROGRESS  = 64; // 64
    public const FLAG_COMPLETED    = 128; // 128
    public const FLAG_CANCELLED    = 256; // 256

   public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) === self::FLAG_ACTIVE;
    }

    public function getFixedAttribute() {
        return ($this->flags & self::FLAG_FIXED) === self::FLAG_FIXED;
    }

    public function getHourlyAttribute() {
        return ($this->flags & self::FLAG_HOURLY) === self::FLAG_HOURLY;
    }

    public function getRemoteAttribute() {
        return ($this->flags & self::FLAG_REMOTE) === self::FLAG_REMOTE;
    }

    public function getOnsiteAttribute() {
        return ($this->flags & self::FLAG_ONSITE) === self::FLAG_ONSITE;
    }

    public function getOpenAttribute() {
        return ($this->flags & self::FLAG_OPEN) === self::FLAG_OPEN;
    }

    public function getInProgressAttribute() {
        return ($this->flags & self::FLAG_IN_PROGRESS) === self::FLAG_IN_PROGRESS;
    }

    public function getCompletedAttribute() {
        return ($this->flags & self::FLAG_COMPLETED) === self::FLAG_COMPLETED;
    }

    public function getCancelledAttribute() {
        return ($this->flags & self::FLAG_CANCELLED) === self::FLAG_CANCELLED;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The industry this job belongs to.
     */
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    /**
     * The skills required for this job.
     */

     public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id')
                    ->withPivot('id', 'flags')
                    ->withTimestamps();
    }
    public function certifications()
    {
        return $this->belongsToMany(Certification::class, 'job_certifications');
    }
    
}
