<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use Flagable;
    protected $appends = ['is_correct'];

    public const FLAG_IS_CORRECT = 1;

    public function getIsCorrectAttribute() {
        return ($this->flags & self::FLAG_IS_CORRECT) == self::FLAG_IS_CORRECT;
    }

    public function test()
    {
        return $this->belongsTo(Tests::class, 'test_id'); // ✅ explicitly define foreign key
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
