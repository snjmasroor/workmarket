<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, Notifiable, SoftDeletes, Flagable;
    protected $table = 'addresses';
    protected $primaryKey = 'address_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
