<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns\Flagable;
class Industry extends Model
{
    protected $fillable = ['name'];
    protected $appends = ['active'];
    use Flagable;
   
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function skill()
    {
        return $this->belongsToMany(Skill::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'industry_skill', 'industry_id', 'skill_id')
                    ->withPivot('industry_skill_id', 'flags')
                    ->withTimestamps();
    }
}
