<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class IndustrySkill extends Model
{
    protected $table = 'industry_skill';
    protected $fillable = ['name'];
    protected $appends = ['active'];
    use Flagable;
   
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

     public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
