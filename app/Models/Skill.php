<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns\Flagable;
class Skill extends Model
{
    protected $fillable = ['name'];
    protected $appends = ['active'];
    use Flagable;
   
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

    public function industry()
    {
        return $this->belongsToMany(Industry::class);
    }
    
    public function industries()
    {
        return $this->belongsToMany(Industry::class, 'industry_skill', 'skill_id', 'industry_id')
                    ->withPivot('industry_skill_id', 'flags')
                    ->withTimestamps();
    }
}
