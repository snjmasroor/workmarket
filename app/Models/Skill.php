<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];
    use HasFactory, Notifiable, SoftDeletes, Flagable;
    protected $table = 'skills';
    protected $primaryKey = 'skill_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }
}
