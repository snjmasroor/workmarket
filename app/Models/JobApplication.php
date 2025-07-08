<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class JobApplication extends Model
{
    use Flagable;

    protected $appends = ['active', 'pending', 'accepted', 'rejected', 'contract_send'];

    public const FLAG_ACTIVE = 1;
    public const FLAG_PENDING = 2;
    public const FLAG_ACCEPTED = 4;
    public const FLAG_REJECTED = 8;
    public const FLAG_CONTRACT_SEND = 16;

    public function getContractSendAttribute() {
        return ($this->flags & self::FLAG_CONTRACT_SEND) == self::FLAG_CONTRACT_SEND;
    }

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

    public function getPendingAttribute() {
        return ($this->flags & self::FLAG_PENDING) == self::FLAG_PENDING;
    }
    public function getAcceptedAttribute() {
        return ($this->flags & self::FLAG_ACCEPTED) == self::FLAG_ACCEPTED;
    }
    public function getRejectedAttribute() {
        return ($this->flags & self::FLAG_REJECTED) == self::FLAG_REJECTED;
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contract()
    {
        return $this->hasOne(Contract::class, 'job_application_id');
    }
}
