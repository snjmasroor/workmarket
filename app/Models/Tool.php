<?php

namespace App\Models;
use App\Concerns\Flagable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
     use Flagable, SoftDeletes;
    protected $appends = ['active'];
     protected $fillable = [
        'name',
        'type',
        'model',
        'price',
        'verification_method',
    ];

    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
}
