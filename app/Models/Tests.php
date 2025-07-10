<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tests extends Model
{
    protected $appends = ['active'];
    use Flagable, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'passing_score',
        'max_attempts',
        'duration_minutes',
    ];

    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id'); // ✅ explicitly define FK
    }

    public function userAttempts()
    {
        return $this->hasMany(UserTestAttempt::class);
    }//
}
