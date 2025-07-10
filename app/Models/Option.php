<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
class Option extends Model
{
    use Flagable;
    protected $appends = ['is_correct'];

    public const FLAG_IS_CORRECT = 1;

    public function getIsCorrectAttribute() {
        return ($this->flags & self::FLAG_IS_CORRECT) == self::FLAG_IS_CORRECT;
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
