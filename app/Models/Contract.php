<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
class Contract extends Model
{
    protected $appends = ['active', 'pending', 'completed', 'cancelled', 'accepted'];
    use Flagable;

    public const FLAG_ACTIVE = 1;
    public const FLAG_PENDING = 2;
    public const FLAG_COMPLETED = 4;
    public const FLAG_CANCELLED = 8;
    public const FLAG_ACCEPTED = 16;
    
    protected $fillable = [
        'admin_id',
        'user_id',
        'job_id',
        'job_application_id',
        'terms',
        'amount',
        'start_date',
        'end_date',
    ];
    
    public function getAcceptedAttribute() {
        return ($this->flags & self::FLAG_ACCEPTED) == self::FLAG_ACCEPTED;
    }
    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
    public function getPendingAttribute() {
        return ($this->flags & self::FLAG_PENDING) == self::FLAG_PENDING;
    }
    public function getCompletedAttribute() {
        return ($this->flags & self::FLAG_COMPLETED) == self::FLAG_COMPLETED;
    }
    public function getCancelledAttribute() {
        return ($this->flags & self::FLAG_CANCELLED) == self::FLAG_CANCELLED;
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function job() {
        return $this->belongsTo(Job::class);
    }
    
    public function application() {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }
}
