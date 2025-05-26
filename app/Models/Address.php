<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns\Flagable;
class Address extends Model
{
    use SoftDeletes, Flagable;
    protected $appends = ['active'];
     public const FLAG_ACTIVE = 1;
    // protected $table = 'addresses';
    // protected $primaryKey = 'address_id';
    // protected $keyType = 'string';
    // public $incrementing = false;
    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
