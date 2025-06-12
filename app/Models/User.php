<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns\Flagable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, Flagable;
    // protected $table = 'users';
    // protected $primaryKey = 'user_id';
    // protected $keyType = 'string';
    // public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['active', 'user_image_url'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];
    public const FLAG_ACTIVE = 1;


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "superadmin", "admin"][$value],
        );
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    
    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
    public function getUserImageUrlAttribute ()
    {
        return asset('storage/users/' . $this->image);
    }
     public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the latest address for the User.
     */
    public function latestAddress()
    {
        return $this->hasOne(Address::class)->latestOfMany();
    }
    public function educations()
    {
        return $this->hasMany(UserEducation::class);
    }

}
