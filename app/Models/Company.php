<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class Company extends Model
{
    use Flagable;
    protected $appends = ['active'];
    protected $fillable = [
        'admin_id',
        'industry_id',
        'name'
    ];
     public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
