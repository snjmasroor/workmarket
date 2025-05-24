<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = ['name'];
    use HasFactory, Notifiable, SoftDeletes, Flagable;
    protected $table = 'industries';
    protected $primaryKey = 'industry_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
